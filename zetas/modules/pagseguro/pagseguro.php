<?php

##########################################
# Módulo Disponibilizado por Agência Pró #
#     http://www.agenciapro.com.br       #
#      USE MAS DEIXE OS CRÉDITOS!        #
#                                        #
#       MÓDULO CORRIDO PARA VERSÕES      #
#			1.1 DO PRESTASHOP            #
##########################################

/** MODULO CRIADO POR FERNANDO
 * @author Fernando Greiffo
 * @colaborador Mendes
 * @copyright Agência Pró
 * @site http://www.agenciapro.com.br 
 * @version 2.5 Beta
 **/

class pagseguro extends PaymentModule
{
	private $_html 			= '';
    private $_postErrors 	= array();
    public $currencies;
	public $_botoes 		= array(
		'default',
		'btnComprarBR.jpg',
		'btnPagarBR.jpg',
		'btnPagueComBR.jpg'
	);
	
	public $_banners 		= array(
		'btnPreferenciaCartoesBR_375x75.gif',
		'btnPreferenciaCartoesBR_418x74.gif',
		'btnPreferenciaCartoesBR_505x55.gif',
		'btnPreferenciaCartoesBR_575x40.gif',
		'btnPreferenciaCartoesBR_620x40.gif',
		'btnPreferenciaCartoesBR_665x55.gif',
		'btnPreferenciaCartoesBR_735x40.gif',
		'btnPreferenciasBR_160x45.gif',
		'btnPreferenciasBR_230x40.gif',
		'btnPreferenciasBR_238x73.gif',
		'btnPreferenciasBR_260x30.gif',
		'btnPreferenciasBR_275x40.gif',
		'btnPreferenciasBR_295x45.gif',
		'btnPreferenciasBR_370x40.gif',
		'btnPreferenciasBR_415x40.gif'
	);
	
	public function __construct()
    {
        $this->name 			= 'pagseguro';
        $this->tab 				= 'Payment';
        $this->version 			= '2.5 Beta';

        $this->currencies 		= true;
        $this->currencies_mode 	= 'radio';

        parent::__construct();

        $this->page 			= basename(__file__, '.php');
        $this->displayName 		= $this->l('PagSeguro');
        $this->description 		= $this->l('Aceitar pagamentos via pagseguro');
		$this->confirmUninstall = $this->l('Tem certeza de que pretende eliminar os seus dados?');
		$this->textshowemail 	= $this->l('Você deve seguir coretamente os procedimentos de pagamento do pagSeguro, para que sua compra seja validada.');
	}
	
	public function install()
	{
		
		if ( !Configuration::get('PAGSEGURO_STATUS_1') )
			$this->create_states();
		if 
		(
			!parent::install() 
		OR 	!Configuration::updateValue('PAGSEGURO_BUSINESS', 'pagseguro@seudominio.com.br')
		OR 	!Configuration::updateValue('PAGSEGURO_TOKEN', 	  '')
		OR 	!Configuration::updateValue('PAGSEGURO_BTN', 	  0)  
		OR 	!Configuration::updateValue('PAGSEGURO_BANNER',   0)    
		OR 	!$this->registerHook('payment') 
		OR 	!$this->registerHook('paymentReturn')
		OR 	!$this->registerHook('home')
		)
			return false;
			
		return true;
	}

		public function create_states()
	{
		
		$this->order_state = array(
		array( 'c9fecd', '11110', 'PagSeguro - Completo',	  	  'payment' ),
		array( 'ccfbff', '00100', 'PagSeguro - Aguardando Pagto', 		 ''	),
		array( 'ffffff', '10100', 'PagSeguro - Aprovado',			 	 ''	),
		array( 'fcffcf', '00100', 'PagSeguro - Em análise',				 ''	),
		array( 'fec9c9', '11110', 'PagSeguro - Cancelado', 'order_canceled'	),
		array( 'd6d6d6', '00100', 'PagSeguro - Em Aberto', 		   	 	''	)
		);
		
		/** OBTENDO UMA LISTA DOS IDIOMAS  **/
		$languages = Db::getInstance()->ExecuteS('
		SELECT `id_lang`, `iso_code`
		FROM `'._DB_PREFIX_.'lang`
		');
		/** /OBTENDO UMA LISTA DOS IDIOMAS  **/
		
		/** INSTALANDO STATUS PagSeguro **/		
		foreach ($this->order_state as $key => $value)
		{
			/** CRIANDO OS STATUS NA TABELA order_state **/
			Db::getInstance()->Execute
			('
				INSERT INTO `' . _DB_PREFIX_ . 'order_state` 
			( `invoice`, `send_email`, `color`, `unremovable`, `logable`, `delivery`) 
				VALUES
			('.$value[1][0].', '.$value[1][1].', \'#'.$value[0].'\', '.$value[1][2].', '.$value[1][3].', '.$value[1][4].');
			');
			/** /CRIANDO OS STATUS NA TABELA order_state **/
			
			$this->figura 	= mysql_insert_id();
			
			foreach ( $languages as $language_atual )
			{
				/** CRIANDO AS DESCRIÇÕES DOS STATUS NA TABELA order_state_lang  **/
				Db::getInstance()->Execute
				('
					INSERT INTO `' . _DB_PREFIX_ . 'order_state_lang` 
				(`id_order_state`, `id_lang`, `name`, `template`)
					VALUES
				('.$this->figura .', '.$language_atual['id_lang'].', \''.$value[2].'\', \''.$value[3].'\');
				');
				/** /CRIANDO AS DESCRIÇÕES DOS STATUS NA TABELA order_state_lang  **/	
			}
			
			
				/** COPIANDO O ICONE ATUAL **/
				$file 		= (dirname(__file__) . "/icons/$key.gif");
				$newfile 	= (dirname( dirname (dirname(__file__) ) ) . "/img/os/$this->figura.gif");
				if (!copy($file, $newfile)) {
    			return false;
    			}
    			/** /COPIANDO O ICONE ATUAL **/
			   		
    		/** GRAVA AS CONFIGURAÇÕES  **/
    		Configuration::updateValue("PAGSEGURO_STATUS_$key", 	$this->figura);
    		   				
		}
		
		return true;
		
	}

	public function uninstall()
	{
		if 
		(
			!Configuration::deleteByName('PAGSEGURO_BUSINESS')
		OR	!Configuration::deleteByName('PAGSEGURO_TOKEN')
		OR	!Configuration::deleteByName('PAGSEGURO_BTN')
		OR	!Configuration::deleteByName('PAGSEGURO_BANNER')
		OR 	!parent::uninstall()
		) 
			return false;
		
		return true;
	}

	public function getContent()
	{
		$this->_html = '<h2>PagSeguro</h2>';
		if (isset($_POST['submitPagSeguro']))
		{
			if (empty($_POST['business'])) $this->_postErrors[] = $this->l('Digite um e-mail para a cobrança');
			elseif (!Validate::isEmail($_POST['business'])) $this->_postErrors[] = $this->l('Digite um e-mail válido para a cobrança');
			
				if (!sizeof($this->_postErrors)) {
					Configuration::updateValue('PAGSEGURO_BUSINESS', $_POST['business']);
						if (!empty($_POST['pg_token']))
						{
						Configuration::updateValue('PAGSEGURO_TOKEN', $_POST['pg_token']);
						}
				$this->displayConf();
				}
				else $this->displayErrors();
		}
		elseif (isset($_POST['submitPagSeguro_Btn']))
		{
			Configuration::updateValue('PAGSEGURO_BTN', 	$_POST['btn_pg']);
			$this->displayConf();
		}
		elseif (isset($_POST['submitPagSeguro_Bnr']))
		{
			Configuration::updateValue('PAGSEGURO_BANNER', 	$_POST['banner_pg']);
			$this->displayConf();
		}

		$this->displayPagSeguro();
		$this->displayFormSettingsPagSeguro();
		return $this->_html;
	}
	
	public function displayConf()
	{
		$this->_html .= '
		<div class="conf confirm">
			<img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />
			'.$this->l('Configurações atualizadas').'
		</div>';
	}
	
	public function displayErrors()
	{
		$nbErrors = sizeof($this->_postErrors);
		$this->_html .= '
		<div class="alert error">
			<h3>'.($nbErrors > 1 ? $this->l('There are') : $this->l('There is')).' '.$nbErrors.' '.($nbErrors > 1 ? $this->l('errors') : $this->l('error')).'</h3>
			<ol>';
		foreach ($this->_postErrors AS $error)
			$this->_html .= '<li>'.$error.'</li>';
		$this->_html .= '
			</ol>
		</div>';
	}

	public function displayPagSeguro()
	{
		$this->_html .= '
		<img src="../modules/pagseguro/imagens/pagseguro.jpg" style="float:left; margin-right:15px;" />
		<b>'.$this->l('Este módulo permite aceitar pagamentos via PagSeguro.').'</b><br /><br />
		'.$this->l('Se o cliente escolher o módulo de pagamento, a conta do PagSeguro sera automaticamente creditado.').'<br />
		'.$this->l('Você precisa configurar o seu e-mail do PagSeguro, para depois usar este módulo.').'
		<br /><br /><br />';
	}

	public function displayFormSettingsPagSeguro()
	{
		$conf 			= Configuration::getMultiple
		(array(
			'PAGSEGURO_BUSINESS',
			'PAGSEGURO_TOKEN',
			'PAGSEGURO_BTN',
			'PAGSEGURO_BANNER'
			  )
		);
		
		$businessPag 	= array_key_exists('business', $_POST) ? $_POST['business'] : (array_key_exists('PAGSEGURO_BUSINESS', $conf) ? $conf['PAGSEGURO_BUSINESS'] : '');
		$token 			= array_key_exists('pg_token', $_POST) ? $_POST['pg_token'] : (array_key_exists('PAGSEGURO_TOKEN', $conf) ? $conf['PAGSEGURO_TOKEN'] : '');
		$btn 			= array_key_exists('btn_pg', $_POST) ? $_POST['btn_pg'] : (array_key_exists('PAGSEGURO_BTN', $conf) ? $conf['PAGSEGURO_BTN'] : '');
		$bnr 			= array_key_exists('banner_pg', $_POST) ? $_POST['banner_pg'] : (array_key_exists('PAGSEGURO_BANNER', $conf) ? $conf['PAGSEGURO_BANNER'] : '');
		
		/** FORMULÁRIO DE CONFIGURAÇÃO DO EMAIL E DO TOKEN **/
		$this->_html .= '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
		<fieldset>
			<legend><img src="../img/admin/contact.gif" />'.$this->l('Configurações').'</legend>
			<label>'.$this->l('E-mail para cobrança').':</label>
			<div class="margin-form"><input type="text" size="33" name="business" value="'.htmlentities($businessPag, ENT_COMPAT, 'UTF-8').'" /></div>
			<br />
			
			<label>'.$this->l('Token').':</label>
			<div class="margin-form"><input type="text" size="33" name="pg_token" value="'.$token.'" /></div>
			<br />
			
			<center><input type="submit" name="submitPagSeguro" value="'.$this->l('Atualizar').'" class="button" /></center>
		</fieldset>
		</form>';
		/** /FORMULÁRIO DE CONFIGURAÇÃO DO EMAIL E DO TOKEN **/
		
		/** FORMULÁRIO DE CONFIGURAÇÃO DO BOTÃO DE PAGAMENTO **/
		$this->_html .= '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
		<fieldset>
			<legend><img src="../img/admin/themes.gif" />'.$this->l('Botão').'</legend><br/>';
			
		foreach ( $this->_botoes as $id => $value )
		{
			if ($btn ==  $id){
				$check = 'checked="checked"'; 
			}else{
				$check = '';
			}
			
			$this->_html .=  '
			<div>
			<input type="radio" name="btn_pg" value="'.$id.'" '.$check.' >';
			
			if( $value == 'default' )
			$this->_html .=  '<input type="submit" value="Pague com o PagSeguro" class="exclusive_large" />';
			else
			$this->_html .=  '<img src="https://pagseguro.uol.com.br/Imagens/'.$value.'" />';
			
			$this->_html .=  '</div>
			<br />';
			
		}

		$this->_html .= '<br /><center><input type="submit" name="submitPagSeguro_Btn" value="'.$this->l('Salvar').'" 
			class="button" />
		</center>
		</fieldset>
		</form>';
		/** /FORMULÁRIO DE CONFIGURAÇÃO DO BOTÃO DE PAGAMENTO **/
		
		/** FORMULÁRIO DE CONFIGURAÇÃO DO BANNER DE EXIBIÇÃO **/
		$this->_html .= '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
		<fieldset>
			<legend><img src="../img/admin/themes.gif" />'.$this->l('Banner').'</legend><br/>';
			
		foreach ( $this->_banners as $id => $value )
		{
			if ($bnr ==  $id){
				$check = 'checked="checked"'; 
			}else{
				$check = '';
			}
			
			$this->_html .=  '
			<div>
			<input type="radio" name="banner_pg" value="'.$id.'" '.$check.' >';
			
			$this->_html .=  '
			<img src="https://pagseguro.uol.com.br/Imagens/Banners/'.$value.'" />';
			
			$this->_html .=  '
			</div>
			<br />';
			
		}

		$this->_html .= '<br /><center><input type="submit" name="submitPagSeguro_Bnr" value="'.$this->l('Salvar').'" 
			class="button" />
		</center>
		</fieldset>
		</form>';
		/** /FORMULÁRIO DE CONFIGURAÇÃO DO BANNER DE EXIBIÇÃO **/
		
	}

    public function execPayment($cart)
    {
        global $cookie, $smarty;
        $invoiceAddress 	= new Address(intval($cart->id_address_invoice));
        $customerPag 		= new Customer(intval($cart->id_customer));
        $currencies 		= Currency::getCurrencies();
        $currencies_used 	= array();
		$currency 			= $this->getCurrency();

        $currencies 		= Currency::getCurrencies();
        foreach ($currencies as $key => $currency)
            $smarty->assign(array(
			'currency_default' => new Currency(Configuration::get('PS_CURRENCY_DEFAULT')),
            'currencies' => $currencies_used, 
			'imgBtn' => "modules/pagseguro/imagens/pagseguro.jpg",
			'imgBnr' => "https://pagseguro.uol.com.br/Imagens/Banners/".
						$this->_banners[Configuration::get('PAGSEGURO_BANNER')],
            'currency_default' => new Currency(Configuration::get('PS_CURRENCY_DEFAULT')),
            'currencies' => $currencies_used, 
			'total' => number_format(Tools::convertPrice($cart->getOrderTotal(true, 3), $currency), 2, '.', ''), 
			'this_path_ssl' => (Configuration::get('PS_SSL_ENABLED') ?
            'https://' : 'http://') . htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT,'UTF-8') . __PS_BASE_URI__ . 'modules/' . $this->name . '/'));

        return $this->display(__file__, 'payment_execution.tpl');
    }
	
	public function hookPayment($params)
	{
		
		global $smarty;
		$smarty->assign(array(
			'imgBtn' => "modules/pagseguro/imagens/btnfinalizaBR.jpg",
			'this_path' => $this->_path, 'this_path_ssl' => (Configuration::get('PS_SSL_ENABLED') ?
			'https://' : 'http://') . htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT,
			'UTF-8') . __PS_BASE_URI__ . 'modules/' . $this->name . '/'));
		return $this->display(__file__, 'payment.tpl');
		
	}
	
	public function hookPaymentReturn($params)
    {
        global $smarty;
		include(dirname(__FILE__).'/includes/pagseguro.php');
		
		$cartPagSeguro 		= new pgs(array(
		'email_cobranca' => Configuration::get('PAGSEGURO_BUSINESS'),
		/** IMPORTANTISSIMO MOMENTO DA REFERENCIA DA TRANSAÇÃO **/
		'ref_transacao'=>'PRS-'.$params['objOrder']->id));
        
        $state 				= $params['objOrder']->getCurrentState();  
        $order 				= new Order($pagseguro->currentOrder);
		$DadosOrder 		= new Order($params['objOrder']->id);
		$DadosCart 			= new Cart($DadosOrder->id_cart);
		$currency 			= new Currency($DadosOrder->id_currency);
		$frete 				= number_format( Tools::convertPrice( $DadosOrder->total_shipping, $currency), 2, '.', '');
		$ArrayListaProdutos = $DadosOrder->getProducts();

		/** ADICIONA OS PRODUTOS AO ARRAY **/
		foreach($ArrayListaProdutos as $info) {
			$item = array (
				'id'         => uniqid(), //md5($info['product_id'].date("H:i:s"))
				'descricao'  => $info['product_name'],
				'quantidade' => $info['product_quantity'],
				'valor'      => $info['product_price_wt']
			);
			$cartPagSeguro->adicionar($item);	
		}
		/** //ADICIONA OS PRODUTOS AO ARRAY **/
		
		/** ADICIONA O FRETE AO ARRAY **/
		if($frete > 0) {
			$item = array (
				'id'         => "#FRETE",
				'descricao'  => "Frete",
				'quantidade' => 1,
				'valor'      => $frete
			);
			$cartPagSeguro->adicionar($item);
		}
		/** //ADICIONA O FRETE AO ARRAY **/

		/** OBTÉM DADOS SOBRE O DESCONTO E ADICIONA AO ARRAY **/
		$discounts = $DadosCart->getDiscounts();			
		if ( $discounts[0] ){
		
			$item = array (
				'id'         => "#DESCONTO",
				'descricao'  => $discounts[0]['description'],
				'quantidade' => 1,
				'valor'      => $DadosCart->getOrderTotal(true, 2)
			);
			$cartPagSeguro->adicionar($item);
		
		}
		/** //OBTÉM DADOS SOBRE O DESCONTO E ADICIONA AO ARRAY **/

		$formPagSeguro = $cartPagSeguro->mostra(array ('btn_submit'=> Configuration::get('PAGSEGURO_BTN') ));
		$smarty->assign(array(
			'totalApagar' 	=> Tools::displayPrice($params['total_to_pay'],$params['currencyObj'], false, false), 
			'status' 		=> 'ok', 
			'id_order' 		=> $params['objOrder']->id,
			'secure_key' 	=> $params['objOrder']->secure_key,
			'id_module' 	=> $this->id,
			'formPagSeguro' => $formPagSeguro
		));
		
		/*ECHO ( ereg_replace("[<>]","<br>", $formPagSeguro ) );
		
		break;*/
		
		#number_format(Tools::convertPrice(($params['cart']->getOrderShippingCost() + $params['cart']->getOrderTotal(true, 6)), $currency), 2, '.', '')
		return $this->display(__file__, 'payment_return.tpl');
    }
    
        function hookHome($params)
	{
    	include(dirname(__FILE__).'/includes/retorno.php');
    }
    
        function getStatus($param)
    {
    	global $cookie;
    		
    		$sql_status = Db::getInstance()->Execute
		('
			SELECT `name`
			FROM `'._DB_PREFIX_.'order_state_lang`
			WHERE `id_order_state` = '.$param.'
			AND `id_lang` = '.$cookie->id_lang.'
			
		');
		
		return mysql_result($sql_status, 0);
    }
    
    public function enviar($mailVars, $template, $assunto, $DisplayName, $idCustomer, $idLang, $CustMail, $TplDir)
	{
		
		Mail::Send
			( intval($idLang), $template, $assunto, $mailVars, $CustMail, null, null, null, null, null, $TplDir);
		
	}
	
	public function getUrlByMyOrder($myOrder)
	{

		$module				= Module::getInstanceByName($myOrder->module);			
		$pagina_qstring		= __PS_BASE_URI__."order-confirmation.php?id_cart="
							  .$myOrder->id_cart."&id_module=".$module->id."&id_order="
							  .$myOrder->id."&key=".$myOrder->secure_key;			
		
		if	(	$_SERVER['HTTPS']	!=	"on"	)
		$protocolo			=	"http";
		
		else
		$protocolo			=	"https";
		
		$retorno 			= $protocolo . "://" . $_SERVER['SERVER_NAME'] . $pagina_qstring;			
		return $retorno;

	}
    
}
?>