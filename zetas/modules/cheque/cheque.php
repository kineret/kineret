<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class Cheque extends PaymentModule
{
	private $_html = '';
	private $_postErrors = array();

	public  $chequeName;
	public  $address;

	public function __construct()
	{
		$this->name = 'cheque';
		$this->tab = 'Payment';
		$this->version = '2.3';
		
		$this->currencies = true;
		$this->currencies_mode = 'checkbox';

		$config = Configuration::getMultiple(array('CHEQUE_NAME', 'CHEQUE_ADDRESS'));
		if (isset($config['CHEQUE_NAME']))
			$this->chequeName = $config['CHEQUE_NAME'];
		if (isset($config['CHEQUE_ADDRESS']))
			$this->address = $config['CHEQUE_ADDRESS'];
			
		parent::__construct();

		$this->displayName = $this->l('Cheque');
		$this->description = $this->l('Module for accepting payments by cheque');
		$this->confirmUninstall = $this->l('Are you sure you want to delete your details ?');
		
		if (!isset($this->chequeName) OR !isset($this->address))
			$this->warning = $this->l('\'To the order of\' and address must be configured in order to use this module correctly');
		if (!sizeof(Currency::checkPaymentCurrencies($this->id)))
			$this->warning = $this->l('No currency set for this module');
	}

	public function install()
	{
		if (!parent::install() OR !$this->registerHook('payment') OR !$this->registerHook('paymentReturn'))
			return false;
		return true;
	}

	public function uninstall()
	{
		if (!Configuration::deleteByName('CHEQUE_NAME') OR !Configuration::deleteByName('CHEQUE_ADDRESS') OR !parent::uninstall())
			return false;
		return true;
	}

	private function _postValidation()
	{
		if (isset($_POST['btnSubmit']))
		{
			if (empty($_POST['name']))
				$this->_postErrors[] = $this->l('\'To the order of\' field is required.');
			elseif (empty($_POST['address']))
				$this->_postErrors[] = $this->l('Address is required.');
		}
	}

	private function _postProcess()
	{
		if (isset($_POST['btnSubmit']))
		{
			Configuration::updateValue('CHEQUE_NAME', $_POST['name']);
			Configuration::updateValue('CHEQUE_ADDRESS', $_POST['address']);
		}
		$this->_html .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('OK').'" /> '.$this->l('Settings updated').'</div>';
	}

	private function _displayCheque()
	{
		$this->_html .= '<img src="../modules/cheque/cheque.jpg" style="float:left; margin-right:15px;"><b>'.$this->l('This module allows you to accept payments by cheque.').'</b><br /><br />
		'.$this->l('If the client chooses this payment mode, the order will change its status into a \'Waiting for payment\' status.').'<br />
		'.$this->l('Therefore, you will need to manually confirm the order as soon as you receive a cheque.').'<br /><br /><br />';
	}

	private function _displayForm()
	{
		$this->_html .=
		'<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset>
			<legend><img src="../img/admin/contact.gif" />'.$this->l('Contact details').'</legend>
				<table border="0" width="500" cellpadding="0" cellspacing="0" id="form">
					<tr><td colspan="2">'.$this->l('Please specify the name and address to which customers must send their cheque').'.<br /><br /></td></tr>
					<tr><td width="130" style="height: 35px;">'.$this->l('To the order of').'</td><td><input type="text" name="name" value="'.htmlentities(Tools::getValue('name', $this->chequeName), ENT_COMPAT, 'UTF-8').'" style="width: 300px;" /></td></tr>
					<tr>
						<td width="130" style="vertical-align: top;">'.$this->l('Address').'</td>
						<td><textarea name="address" rows="3" cols="53">'.htmlentities(Tools::getValue('address', $this->address), ENT_COMPAT, 'UTF-8').'</textarea></td>
					</tr>
					<tr><td colspan="2" align="center"><br /><input class="button" name="btnSubmit" value="'.$this->l('Update settings').'" type="submit" /></td></tr>
				</table>
			</fieldset>
		</form>';
	}

	public function getContent()
	{
		$this->_html = '<h2>'.$this->displayName.'</h2>';

		if (!empty($_POST))
		{
			$this->_postValidation();
			if (!sizeof($this->_postErrors))
				$this->_postProcess();
			else
				foreach ($this->_postErrors AS $err)
					$this->_html .= '<div class="alert error">'. $err .'</div>';
		}
		else
			$this->_html .= '<br />';

		$this->_displayCheque();
		$this->_displayForm();

		return $this->_html;
	}

	public function execPayment($cart)
	{
		if (!$this->active)
			return ;
		
		if (!$this->_checkCurrency($cart))
			Tools::redirectLink(__PS_BASE_URI__.'order.php');

		global $cookie, $smarty;
		
		$smarty->assign(array(
			'nbProducts' => $cart->nbProducts(),
			'cust_currency' => $cart->id_currency,
			'currencies' => $this->getCurrency(),
			'total' => $cart->getOrderTotal(true, 3),
			'isoCode' => Language::getIsoById(intval($cookie->id_lang)),
			'chequeName' => $this->chequeName,
			'chequeAddress' => nl2br2($this->address),
			'this_path' => $this->_path,
            'this_path_ssl' => Tools::getHttpHost(true, true).__PS_BASE_URI__.'modules/'.$this->name.'/'
		));

		return $this->display(__FILE__, 'payment_execution.tpl');
	}

	public function hookPayment($params)
	{
		if (!$this->active)
			return ;
		if (!$this->_checkCurrency($params['cart']))
			return ;

		global $smarty;

		$smarty->assign(array(
            'this_path' => $this->_path,
            'this_path_ssl' => Tools::getHttpHost(true, true).__PS_BASE_URI__.'modules/'.$this->name.'/'
            ));
		return $this->display(__FILE__, 'payment.tpl');
	}

	public function hookPaymentReturn($params)
	{
		if (!$this->active)
			return ;

		global $smarty;
		$state = $params['objOrder']->getCurrentState();
		if ($state == _PS_OS_CHEQUE_ OR $state == _PS_OS_OUTOFSTOCK_)
			$smarty->assign(array(
				'total_to_pay' => Tools::displayPrice($params['total_to_pay'], $params['currencyObj'], false, false),
				'chequeName' => $this->chequeName,
				'chequeAddress' => nl2br2($this->address),
				'status' => 'ok',
				'id_order' => $params['objOrder']->id
			));
		else
			$smarty->assign('status', 'failed');
		return $this->display(__FILE__, 'payment_return.tpl');
	}
	
	private function _checkCurrency($cart)
	{
		$currency_order = new Currency(intval($cart->id_currency));
		$currencies_module = $this->getCurrency();
		$currency_default = Configuration::get('PS_CURRENCY_DEFAULT');

		if (is_array($currencies_module))
			foreach ($currencies_module AS $currency_module)
				if ($currency_order->id == $currency_module['id_currency'])
					return true;
	}
}
