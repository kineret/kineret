<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class Hipay extends PaymentModule
{
	private $arrayCategories;
	private $prod;

	public function __construct()
	{
		$this->name = 'hipay';
		$this->tab = 'Payment';
		$this->version = 1.0;

		$this->currencies = true;
		$this->currencies_mode = 'radio';

		parent::__construct();

		$this->prod = (int)Tools::getValue('HIPAY_PROD', Configuration::get('HIPAY_PROD'));
		// Define extracted from mapi/mapi_defs.php
		if (!defined('HIPAY_GATEWAY_URL')) 
			define('HIPAY_GATEWAY_URL','https://'.($this->prod ? '' : 'test.').'payment.hipay.com/order/');

		$this->displayName = $this->l('Hipay');
		$this->description = $this->l('Accepts payments by Hipay');
	}

	public function	install()
	{
		Configuration::updateValue('HIPAY_PROD', Configuration::get('HIPAY_PROD'));
		if (!Configuration::get('HIPAY_UNIQID'))
			Configuration::updateValue('HIPAY_UNIQID', uniqid());
		if (!Configuration::get('HIPAY_RATING'))
			Configuration::updateValue('HIPAY_RATING', 'ALL');
		
		return (parent::install() AND $this->registerHook('payment'));
	}

	public function hookPayment($params)
	{
		global $smarty, $cart;

		$currency = new Currency($this->getModuleCurrency($cart));
		$hipayAccount = ($this->prod ? Configuration::get('HIPAY_ACCOUNT_'.$currency->iso_code) : Configuration::get('HIPAY_ACCOUNT_TEST_'.$currency->iso_code));
		$hipayPassword = ($this->prod ? Configuration::get('HIPAY_PASSWORD_'.$currency->iso_code) : Configuration::get('HIPAY_PASSWORD_TEST_'.$currency->iso_code));
		$hipaySiteId = ($this->prod ? Configuration::get('HIPAY_SITEID_'.$currency->iso_code) : Configuration::get('HIPAY_SITEID_TEST_'.$currency->iso_code));
		$hipayCategory = ($this->prod ? Configuration::get('HIPAY_CATEGORY_'.$currency->iso_code) : Configuration::get('HIPAY_CATEGORY_TEST_'.$currency->iso_code));
		if ($hipayAccount AND $hipayPassword AND $hipaySiteId AND $hipayCategory AND Configuration::get('HIPAY_RATING'))
		{
			$smarty->assign('hipay_prod', $this->prod);
			$smarty->assign(array('this_path' => $this->_path, 'this_path_ssl' => self::getHttpHost(true, true).__PS_BASE_URI__.'modules/'.$this->name.'/'));
			return $this->display(__FILE__, 'payment.tpl');
		}
	}

	private function getModuleCurrency($cart)
	{
		$id_currency = (int)self::MysqlGetValue('SELECT id_currency FROM `'._DB_PREFIX_.'module_currency` WHERE id_module = '.(int)$this->id);
		if (!$id_currency OR $id_currency == -2)
			$id_currency = Configuration::get('PS_CURRENCY_DEFAULT');
		elseif ($id_currency == -1)
			$id_currency = $cart->id_currency;
		return $id_currency;
	}

	public function payment()
	{
		global $cookie, $cart;

		$id_currency = $this->getModuleCurrency($cart);
		// If the currency is forced to a different one than the current one, then the cart must be updated
		if ($cart->id_currency != $id_currency)
			if (Db::getInstance()->execute('UPDATE '._DB_PREFIX_.'cart SET id_currency = '.(int)$id_currency.' WHERE id_cart = '.(int)$cart->id))
				$cart->id_currency = $id_currency;
		
		$currency = new Currency($id_currency);
		$language = new Language($cart->id_lang);
		$customer = new Customer($cart->id_customer);
		$carrier = new Carrier($cart->id_carrier, $cart->id_lang);
		$id_zone = self::MysqlGetValue('SELECT id_zone FROM '._DB_PREFIX_.'address a INNER JOIN '._DB_PREFIX_.'country c ON a.id_country = c.id_country WHERE id_address = '.(int)$cart->id_address_delivery);

		require_once(dirname(__FILE__).'/mapi/mapi_package.php');
		
		$hipayAccount = ($this->prod ? Configuration::get('HIPAY_ACCOUNT_'.$currency->iso_code) : Configuration::get('HIPAY_ACCOUNT_TEST_'.$currency->iso_code));
		$hipayPassword = ($this->prod ? Configuration::get('HIPAY_PASSWORD_'.$currency->iso_code) : Configuration::get('HIPAY_PASSWORD_TEST_'.$currency->iso_code));
		$hipaySiteId = ($this->prod ? Configuration::get('HIPAY_SITEID_'.$currency->iso_code) : Configuration::get('HIPAY_SITEID_TEST_'.$currency->iso_code));
		$hipaycategory = ($this->prod ? Configuration::get('HIPAY_CATEGORY_'.$currency->iso_code) : Configuration::get('HIPAY_CATEGORY_TEST_'.$currency->iso_code));

		$paymentParams = new HIPAY_MAPI_PaymentParams();
		$paymentParams->setLogin($hipayAccount, $hipayPassword);
		$paymentParams->setAccounts($hipayAccount, $hipayAccount);
		$paymentParams->setDefaultLang(strtolower($language->iso_code).'_'.strtoupper($language->iso_code));
		$paymentParams->setMedia('WEB');
		$paymentParams->setRating(Configuration::get('HIPAY_RATING'));
		$paymentParams->setPaymentMethod(HIPAY_MAPI_METHOD_SIMPLE);
		$paymentParams->setCaptureDay(HIPAY_MAPI_CAPTURE_IMMEDIATE);
		$paymentParams->setCurrency(strtoupper($currency->iso_code));
		$paymentParams->setIdForMerchant($cart->id);
		$paymentParams->setMerchantSiteId($hipaySiteId);
		$paymentParams->setUrlCancel(self::getHttpHost(true, true).__PS_BASE_URI__.'order.php?step=3');
		$paymentParams->setUrlNok(self::getHttpHost(true, true).__PS_BASE_URI__.'order-confirmation.php?id_cart='.(int)$cart->id.'&amp;id_module='.(int)$this->id.'&amp;secure_key='.$customer->secure_key);
		$paymentParams->setUrlOk(self::getHttpHost(true, true).__PS_BASE_URI__.'order-confirmation.php?id_cart='.(int)$cart->id.'&amp;id_module='.(int)$this->id.'&amp;secure_key='.$customer->secure_key);
		$paymentParams->setUrlAck(self::getHttpHost(true, true).__PS_BASE_URI__.'modules/'.$this->name.'/validation.php');
		$paymentParams->setBackgroundColor('#FFFFFF');

		if (!$paymentParams->check())
		  return $this->l('[Hipay] Error: cannot create PaymentParams');

		$item = new HIPAY_MAPI_Product();
		$item->setName($this->l('Cart'));
		$item->setInfo('');
		$item->setquantity(1);
		$item->setRef($cart->id);
		$item->setCategory($hipaycategory);
		$item->setPrice($cart->getOrderTotal());
		try {
			if (!$item->check())
				return $this->l('[Hipay] Error: cannot create "Cart" Product');
		} catch (Exception $e) {
			return $this->l('[Hipay] Error: cannot create "Cart" Product');
		}
		$items = array($item);

		$order = new HIPAY_MAPI_Order();
		$order->setOrderTitle($this->l('Order total'));
		$order->setOrderCategory($hipaycategory);

		if (!$order->check())
		    return $this->l('[Hipay] Error: cannot create Order');

		try {
			$commande = new HIPAY_MAPI_SimplePayment($paymentParams, $order, $items);
		} catch (Exception $e) {
		  	return $this->l('[Hipay] Error:').' '.$e->getMessage();
		}

		$xmlTx = $commande->getXML();
		//d(htmlentities($xmlTx));
		$output = HIPAY_MAPI_SEND_XML::sendXML($xmlTx);
		$reply = HIPAY_MAPI_COMM_XML::analyzeResponseXML($output, $url, $err_msg, $err_keyword, $err_value, $err_code);

		if ($reply === true)
			Tools::redirectLink($url);
		else
		{
			global $smarty;
			include(dirname(__FILE__).'/../../header.php');
			$smarty->assign('errors', array('[Hipay] '.strval($err_msg).' ('.$output.')'));
			$_SERVER['HTTP_REFERER'] = self::getHttpHost(true, true).__PS_BASE_URI__.'order.php?step=3';
			$smarty->display(_PS_THEME_DIR_.'errors.tpl');
			include(dirname(__FILE__).'/../../footer.php');
		}
	}

	public function validation()
	{
		if (!array_key_exists('xml', $_POST))
			return;

		if (_PS_MAGIC_QUOTES_GPC_)
			$_POST['xml'] = stripslashes($_POST['xml']);
		
		require_once(dirname(__FILE__).'/mapi/mapi_package.php');

		if (HIPAY_MAPI_COMM_XML::analyzeNotificationXML($_POST['xml'], $operation, $status, $date, $time, $transid, $amount, $currency, $id_cart, $data) === false)
			file_put_contents('logs'.Configuration::get('HIPAY_UNIQID').'.txt', '['.date('Y-m-d H:i:s').'] '.$_POST['xml']."\n", FILE_APPEND);

		if (trim($operation) == 'capture' AND trim(strtolower($status)) == 'ok')
        {
            /* Paiement capturé sur Hipay = Paiement accepté sur Prestashop */
			$orderMessage = $operation.': '.$status."\n".'date: '.$date.' '.$time."\n".'transaction: '.$transid."\n".'amount: '.(float)$amount.' '.$currency."\n".'id_cart: '.(int)$id_cart;
            $this->validateOrder((int)$id_cart, _PS_OS_PAYMENT_, (float)$amount, $this->displayName, $orderMessage);
        }
        elseif (trim($operation) == 'refund' AND trim(strtolower($status)) == 'ok')
        {
            /* Paiement remboursé sur Hipay */
			if (!($id_order = Order::getOrderByCartId(intval($id_cart))))
				die(Tools::displayError());
            $order = new Order(intval($id_order));
            if (!$order->valid OR $order->getCurrentState() === _PS_OS_REFUND_)
				die(Tools::displayError());
			$orderHistory = new OrderHistory();
			$orderHistory->id_order = intval($order->id);
			$orderHistory->changeIdOrderState(intval(_PS_OS_REFUND_), intval($id_order));
			$orderHistory->addWithemail();
        }
	}

	public function getContent()
	{
		global $currentIndex, $cookie;

		$currencies = DB::getInstance()->ExecuteS('SELECT c.iso_code, c.name, c.sign FROM '._DB_PREFIX_.'currency c WHERE c.deleted = 0');
		
		if (Tools::isSubmit('submitHipay'))
		{
			Configuration::updateValue('HIPAY_PROD', Tools::getValue('HIPAY_PROD'));
			$this->prod = (int)Tools::getValue('HIPAY_PROD', Configuration::get('HIPAY_PROD'));
			
			foreach ($currencies as $currency)
			{
				if (Configuration::get('HIPAY_SITEID_'.$currency['iso_code']) != Tools::getValue('HIPAY_SITEID_'.$currency['iso_code']))
					Configuration::updateValue('HIPAY_CATEGORY_'.$currency['iso_code'], false);
				if (Configuration::get('HIPAY_SITEID_TEST_'.$currency['iso_code']) != Tools::getValue('HIPAY_SITEID_TEST_'.$currency['iso_code']))
					Configuration::updateValue('HIPAY_CATEGORY_TEST_'.$currency['iso_code'], false);
			
				Configuration::updateValue('HIPAY_ACCOUNT_'.$currency['iso_code'], Tools::getValue('HIPAY_ACCOUNT_'.$currency['iso_code']));
				Configuration::updateValue('HIPAY_ACCOUNT_TEST_'.$currency['iso_code'], Tools::getValue('HIPAY_ACCOUNT_TEST_'.$currency['iso_code']));
				Configuration::updateValue('HIPAY_PASSWORD_'.$currency['iso_code'], Tools::getValue('HIPAY_PASSWORD_'.$currency['iso_code']));
				Configuration::updateValue('HIPAY_PASSWORD_TEST_'.$currency['iso_code'], Tools::getValue('HIPAY_PASSWORD_TEST_'.$currency['iso_code']));
				Configuration::updateValue('HIPAY_SITEID_'.$currency['iso_code'], Tools::getValue('HIPAY_SITEID_'.$currency['iso_code']));
				Configuration::updateValue('HIPAY_SITEID_TEST_'.$currency['iso_code'], Tools::getValue('HIPAY_SITEID_TEST_'.$currency['iso_code']));
				Configuration::updateValue('HIPAY_CATEGORY_'.$currency['iso_code'], Tools::getValue('HIPAY_CATEGORY_'.$currency['iso_code']));
				Configuration::updateValue('HIPAY_CATEGORY_TEST_'.$currency['iso_code'], Tools::getValue('HIPAY_CATEGORY_TEST_'.$currency['iso_code']));
			}
			Configuration::updateValue('HIPAY_RATING', Tools::getValue('HIPAY_RATING'));
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getValue('token').'&conf=4');
		}
		
		// Check configuration
		$allow_url_fopen = ini_get('allow_url_fopen');
		$openssl = extension_loaded('openssl');
		$curl = extension_loaded('curl');
		$ping = ($allow_url_fopen AND $openssl AND $fd = fsockopen('payment.hipay.com', 443) AND fclose($fd));
		$online = (in_array(Tools::getRemoteAddr(), array('127.0.0.1', '::1')) ? false : true);
		$categories = true;
		$categoryRetrieval = true;
		foreach ($currencies as $currency)
		{
			if (($hipaySiteId = Configuration::get('HIPAY_SITEID_'.$currency['iso_code']) AND !count($this->getHipayCategories(true, $hipaySiteId)))
			OR ($hipaySiteIdTest = Configuration::get('HIPAY_SITEID_TEST_'.$currency['iso_code']) AND !count($this->getHipayCategories(false, $hipaySiteIdTest))))
				$categoryRetrieval = false;
			if ((Configuration::get('HIPAY_SITEID_'.$currency['iso_code']) AND !Configuration::get('HIPAY_CATEGORY_'.$currency['iso_code']))
			OR (Configuration::get('HIPAY_SITEID_TEST_'.$currency['iso_code']) AND !Configuration::get('HIPAY_CATEGORY_TEST_'.$currency['iso_code'])))
				$categories = false;
		}
		if (!$allow_url_fopen OR !$openssl OR !$curl OR !$ping OR !$categories OR !$categoryRetrieval OR !$online)
		{
			echo '
			<div class="warning warn">
				'.($allow_url_fopen ? '' : '<h3>'.$this->l('You are not allowed to open external URLs (allow_url_fopen)').'</h3>').'
				'.($curl ? '' : '<h3>'.$this->l('cURL is not enabled').'</h3>').'
				'.($openssl ? '' : '<h3>'.$this->l('OpenSSL is not enabled').'</h3>').'
				'.(($allow_url_fopen AND $openssl AND !$ping) ? '<h3>'.$this->l('Cannot access payment gateway').' '.HIPAY_GATEWAY_URL.' ('.$this->l('check your firewall').')</h3>' : '').'
				'.($online ? '' : '<h3>'.$this->l('Your shop is not online').'</h3>').'
				'.($categories ? '' : '<h3>'.$this->l('Hipay categories not set for every Site ID').'</h3>').'
				'.($categoryRetrieval ? '' : '<h3>'.$this->l('Impossible to retrieve Hipay categories. Please refer to your error log for more details.').'</h3>').'
			</div>';
		}

		$link = $currentIndex.'&configure='.$this->name.'&token='.Tools::getValue('token');
		$form = '
		<style>
			.hipay_label {float:none;font-weight:normal;padding:0;text-align:left;width:100%;line-height:30px}
			.hipay_help {vertical-align:middle}
			#hipay_table {border:1px solid #383838}
			#hipay_table td {border:1px solid #383838}
			#hipay_table td.hipay_end {border-top:none}
			#hipay_table td.hipay_block {border-bottom:none}
		</style>
		<fieldset><legend><img src="../modules/'.$this->name.'/logo.gif" /> '.$this->l('Hipay').'</legend>
			'.$this->l('Hipay is a secure electronic wallet which provides, to the merchants, a complete service package for online business transactions: whether for digital contents, software, music, subscriptions, physical goods…without having to negotiate with a bank and without technical charges.').'<br />'.$this->l('Free & Easy, Hipay implementation is a real asset to an e-commerce website that wants to expand in Europe: secure payments by international cards, local payment solutions, bank transfers…').'
			<br /><br />
			<ul>
			'.(Configuration::get('HIPAY_SITEID')
				? '<li><a href="https://www.hipay.com/auth" style="color:#D9263F;font-weight:700">'.$this->l('Log in to your merchant account').'</a></li>'
				: '<li><a href="https://www.hipay.com/registration/register" style="color:#D9263F;font-weight:700">'.$this->l('Create a hipay account').'</a></li>').'
			'.(Configuration::get('HIPAY_SITEID_TEST')
				? '<li><a href="https://test.www.hipay.com/auth" style="color:#D9263F;font-weight:700">'.$this->l('Log in to your test account').'</a></li>'
				: '<li><a href="https://test.www.hipay.com/registration/register" style="color:#D9263F">'.$this->l('Create a test account').'</a></li>').'
			</ul>
			<br />'.$this->l('Notice: if you want to refund a payment, please log in to your Hipay account then go to Merchant Management > Sales management.').'
		</fieldset>
		<div class="clear">&nbsp;</div>
		<fieldset><legend><img src="../modules/'.$this->name.'/logo.gif" /> '.$this->l('Configuration').'</legend>
			<form action="'.$link.'" method="post">
				<table id="hipay_table" cellspacing="0" cellpadding="0">
					<tr style="height:40px">
						<td style="padding-left:20px"><b>'.$this->l('Account').'</b></td>
						<td class="hipay_prod" style="width:250px;padding-left:8px">
							<input type="radio" name="HIPAY_PROD" value="1" '.((int)$this->prod ? 'checked="checked"' : '').'
								onclick="switchHipayAccount(1);" />
							<span class="hipay_prod_span">'.$this->l('real / production').'</span>
						</td>
						<td class="hipay_test" style="width:250px;padding-left:8px">
							<input type="radio" name="HIPAY_PROD" value="0" '.((int)$this->prod ? '' : 'checked="checked"').'
								onclick="switchHipayAccount(0);" />
								<span class="hipay_test_span">'.$this->l('sandbox / test').'</span><br />
						</td>
					</tr>';
		foreach ($currencies as $currency)
		{
			$form .= '<tr>
						<td style="width:200px;padding-left:20px" class="hipay_block"><b>'.$this->l('Configuration in').' '.$currency['name'].' '.$currency['sign'].'</b></td>
						<td class="hipay_prod hipay_block" style="padding-left:10px">
							<label class="hipay_label" for="HIPAY_ACCOUNT_'.$currency['iso_code'].'">'.$this->l('Account number').' <a href="../modules/'.$this->name.'/screenshots/accountnumber.png" target="_blank"><img src="../modules/'.$this->name.'/help.png" class="hipay_help" /></a></label><br />
							<input type="text" id="HIPAY_ACCOUNT_'.$currency['iso_code'].'" name="HIPAY_ACCOUNT_'.$currency['iso_code'].'" value="'.Tools::getValue('HIPAY_ACCOUNT_'.$currency['iso_code'], Configuration::get('HIPAY_ACCOUNT_'.$currency['iso_code'])).'" /><br />
							<label class="hipay_label" for="HIPAY_PASSWORD_'.$currency['iso_code'].'">'.$this->l('Merchant password').' <a href="../modules/'.$this->name.'/screenshots/merchantpassword.png" target="_blank"><img src="../modules/'.$this->name.'/help.png" class="hipay_help" /></a></label><br />
							<input type="text" id="HIPAY_PASSWORD_'.$currency['iso_code'].'" name="HIPAY_PASSWORD_'.$currency['iso_code'].'" value="'.Tools::getValue('HIPAY_PASSWORD_'.$currency['iso_code'], Configuration::get('HIPAY_PASSWORD_'.$currency['iso_code'])).'" /><br />
							<label class="hipay_label" for="HIPAY_SITEID_'.$currency['iso_code'].'">'.$this->l('Site ID').' <a href="../modules/'.$this->name.'/screenshots/siteid.png" target="_blank"><img src="../modules/'.$this->name.'/help.png" class="hipay_help" /></a></label><br />
							<input type="text" id="HIPAY_SITEID_'.$currency['iso_code'].'" name="HIPAY_SITEID_'.$currency['iso_code'].'" value="'.Tools::getValue('HIPAY_SITEID_'.$currency['iso_code'], Configuration::get('HIPAY_SITEID_'.$currency['iso_code'])).'" /><br />';
			if ($ping AND $hipaySiteId = (int)Configuration::get('HIPAY_SITEID_'.$currency['iso_code']))
			{
				$form .= '	<label for="HIPAY_CATEGORY_'.$currency['iso_code'].'" class="hipay_label">'.$this->l('Category').'</label><br />
							<select id="HIPAY_CATEGORY_'.$currency['iso_code'].'" name="HIPAY_CATEGORY_'.$currency['iso_code'].'">';
				foreach ($this->getHipayCategories(true, $hipaySiteId) as $id => $name)
					$form.= '	<option value="'.(int)$id.'" '.(Tools::getValue('HIPAY_CATEGORY_'.$currency['iso_code'], Configuration::get('HIPAY_CATEGORY_'.$currency['iso_code'])) == $id ? 'selected="selected"' : '').'>'.htmlentities($name, ENT_COMPAT, 'UTF-8').'</option>';
				$form .= '	</select><br />';
			}
			$form .= '	</td>
						<td class="hipay_test hipay_block" style="padding-left:10px">
							<label class="hipay_label" for="HIPAY_ACCOUNT_TEST_'.$currency['iso_code'].'">'.$this->l('Test account number').' <a href="../modules/'.$this->name.'/screenshots/accountnumber.png" target="_blank"><img src="../modules/'.$this->name.'/help.png" class="hipay_help" /></a></label><br />
							<input type="text" id="HIPAY_ACCOUNT_TEST_'.$currency['iso_code'].'" name="HIPAY_ACCOUNT_TEST_'.$currency['iso_code'].'" value="'.Tools::getValue('HIPAY_ACCOUNT_TEST_'.$currency['iso_code'], Configuration::get('HIPAY_ACCOUNT_TEST_'.$currency['iso_code'])).'" /><br />
							<label class="hipay_label" for="HIPAY_PASSWORD_TEST_'.$currency['iso_code'].'">'.$this->l('Merchant password').' <a href="../modules/'.$this->name.'/screenshots/merchantpassword.png" target="_blank"><img src="../modules/'.$this->name.'/help.png" class="hipay_help" /></a></label><br />
							<input type="text" id="HIPAY_PASSWORD_TEST_'.$currency['iso_code'].'" name="HIPAY_PASSWORD_TEST_'.$currency['iso_code'].'" value="'.Tools::getValue('HIPAY_PASSWORD_TEST_'.$currency['iso_code'], Configuration::get('HIPAY_PASSWORD_TEST_'.$currency['iso_code'])).'" /><br />
							<label class="hipay_label" for="HIPAY_SITEID_TEST_'.$currency['iso_code'].'">'.$this->l('Site ID').' <a href="../modules/'.$this->name.'/screenshots/siteid.png" target="_blank"><img src="../modules/'.$this->name.'/help.png" class="hipay_help" /></a></label><br />
							<input type="text" id="HIPAY_SITEID_TEST_'.$currency['iso_code'].'" name="HIPAY_SITEID_TEST_'.$currency['iso_code'].'" value="'.Tools::getValue('HIPAY_SITEID_TEST_'.$currency['iso_code'], Configuration::get('HIPAY_SITEID_TEST_'.$currency['iso_code'])).'" /><br />';
			if ($ping AND $hipaySiteId = (int)Configuration::get('HIPAY_SITEID_TEST_'.$currency['iso_code']))
			{
				$form .= '	<label for="HIPAY_CATEGORY_TEST_'.$currency['iso_code'].'" class="hipay_label">'.$this->l('Category').'</label><br />
							<select id="HIPAY_CATEGORY_TEST_'.$currency['iso_code'].'" name="HIPAY_CATEGORY_TEST_'.$currency['iso_code'].'">';
				foreach ($this->getHipayCategories(true, $hipaySiteId) as $id => $name)
					$form.= '	<option value="'.(int)$id.'" '.(Tools::getValue('HIPAY_CATEGORY_TEST_'.$currency['iso_code'], Configuration::get('HIPAY_CATEGORY_TEST_'.$currency['iso_code'])) == $id ? 'selected="selected"' : '').'>'.htmlentities($name, ENT_COMPAT, 'UTF-8').'</option>';
				$form .= '	</select><br />';
			}
			$form .= '	</td>
					</tr>
					<tr><td class="hipay_end">&nbsp;</td><td class="hipay_prod hipay_end">&nbsp;</td><td class="hipay_test hipay_end">&nbsp;</td></tr>';
		}
		$form .= '</table>
				<hr class="clear" />
				<label for="HIPAY_RATING">'.$this->l('Authorized age group').'</label>
				<div class="margin-form">
					<select id="HIPAY_RATING" name="HIPAY_RATING">
						<option value="ALL">'.$this->l('For all ages').'</option>
						<option value="+12" '.(Tools::getValue('HIPAY_RATING', Configuration::get('HIPAY_RATING')) == '+12' ? 'selected="selected"' : '').'>'.$this->l('For ages 12 and over').'</option>
						<option value="+16" '.(Tools::getValue('HIPAY_RATING', Configuration::get('HIPAY_RATING')) == '+16' ? 'selected="selected"' : '').'>'.$this->l('For ages 16 and over').'</option>
						<option value="+18" '.(Tools::getValue('HIPAY_RATING', Configuration::get('HIPAY_RATING')) == '+18' ? 'selected="selected"' : '').'>'.$this->l('For ages 18 and over').'</option>
					</select>
				</div>
				<hr class="clear" />
				<p>'.$this->l('Notice: please verify that the currency mode you\'ve chosen in the payment tab is compatible with your Hipay account(s).').'</p>
				<input type="submit" name="submitHipay" value="'.$this->l('Update configuration').'" class="button" />
        	</form>
		</fieldset>
		<script type="text/javascript">
			function switchHipayAccount(prod)
			{
				if (prod)
				{';
			foreach ($currencies as $currency)
				$form .= '
					$("#HIPAY_ACCOUNT_'.$currency['iso_code'].'").css("background-color", "#FFFFFF");
					$("#HIPAY_ACCOUNT_TEST_'.$currency['iso_code'].'").css("background-color", "#EEEEEE");
					$("#HIPAY_PASSWORD_'.$currency['iso_code'].'").css("background-color", "#FFFFFF");
					$("#HIPAY_PASSWORD_TEST_'.$currency['iso_code'].'").css("background-color", "#EEEEEE");
					$("#HIPAY_SITEID_'.$currency['iso_code'].'").css("background-color", "#FFFFFF");
					$("#HIPAY_SITEID_TEST_'.$currency['iso_code'].'").css("background-color", "#EEEEEE");';
			$form .= '
					$(".hipay_prod").css("background-color", "#AADEAA");
					$(".hipay_test").css("background-color", "transparent");
					$(".hipay_prod_span").css("font-weight", "700");
					$(".hipay_test_span").css("font-weight", "200");
				}
				else
				{';
			foreach ($currencies as $currency)
				$form .= '
					$("#HIPAY_ACCOUNT_'.$currency['iso_code'].'").css("background-color", "#EEEEEE");
					$("#HIPAY_ACCOUNT_TEST_'.$currency['iso_code'].'").css("background-color", "#FFFFFF");
					$("#HIPAY_PASSWORD_'.$currency['iso_code'].'").css("background-color", "#EEEEEE");
					$("#HIPAY_PASSWORD_TEST_'.$currency['iso_code'].'").css("background-color", "#FFFFFF");
					$("#HIPAY_SITEID_'.$currency['iso_code'].'").css("background-color", "#EEEEEE");
					$("#HIPAY_SITEID_TEST_'.$currency['iso_code'].'").css("background-color", "#FFFFFF");';
			$form .= '	
					$(".hipay_prod").css("background-color", "transparent");
					$(".hipay_test").css("background-color", "#AADEAA");
					$(".hipay_prod_span").css("font-weight", "200");
					$(".hipay_test_span").css("font-weight", "700");
				}
			}
			switchHipayAccount('.(int)$this->prod.');
		</script>';
		return $form;
	}

	private function getHipayCategories($prod, $hipaySiteId)
	{
		if (!is_array($this->arrayCategories))
		{
			$this->arrayCategories = array();
			if ($xml = simplexml_load_string(file_get_contents('https://'.($prod ? '' : 'test.').'www.hipay.com/payment-order/list-categories/id/'.$hipaySiteId)))
			{
				foreach ($xml->children() as $categoriesList)
					foreach ($categoriesList->children() as $category)
						$this->arrayCategories[strval($category['id'])] = strval($category);
			}
		}
		return $this->arrayCategories;
	}
	
	// Retro compatibility with 1.2.5
	static private function MysqlGetValue($query)
	{
		$row = Db::getInstance()->getRow($query);
		return array_shift($row);
	}
	
	// Retro compatibility with 1.2.5
	static private function getHttpHost($http = false, $entities = false)
	{
		$host = (isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST']);
		if ($entities)
			$host = htmlspecialchars($host, ENT_COMPAT, 'UTF-8');
		if ($http)
			$host = (Configuration::get('PS_SSL_ENABLED') ? 'https://' : 'http://').$host;
		return $host;
	}
}

?>
