<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../header.php');
include(dirname(__FILE__).'/pagseguro.php');

	$currency = new Currency
	(intval(isset($_POST['currency_payement']) ? $_POST['currency_payement'] : $cookie->id_currency));
	
	$total = floatval(number_format($cart->getOrderTotal(true, 3), 2, '.', ''));

	$pagseguro = new pagseguro();

	$mailVars = array
	(
		'{bankwire_owner}' 		=> $pagseguro->textshowemail, 
		'{bankwire_details}' 	=> '', 
		'{bankwire_address}' 	=> ''
	);
	
	$pagseguro->validateOrder
	(
		$cart->id, 
		Configuration::get('PAGSEGURO_STATUS_5'), 
		$total, 
		$pagseguro->displayName, 
		NULL, 
		$mailVars, 
		$currency->id
	);
	
	$order 		= new Order($pagseguro->currentOrder);
	$idCustomer = $order->id_customer;
	$idLang		= $order->id_lang;
	$customer 	= new Customer(intval($idCustomer));
	$CusMail	= $customer->email;
		
	$mailVars 	= array
	(
		'{email}'			=> Configuration::get('PS_SHOP_EMAIL'),
		'{firstname}' 		=> stripslashes($customer->firstname), 
		'{lastname}' 		=> stripslashes($customer->lastname	),
		'{terceiro}'		=> stripslashes($pagseguro->displayName),
		'{id_order}'		=> stripslashes($pagseguro->currentOrder),
		'{status}'			=> stripslashes($pagseguro->getStatus(Configuration::get('PAGSEGURO_STATUS_5'))),
		'{link}'			=> $pagseguro->getUrlByMyOrder($order)
	);
	
	$assunto 	= $pagseguro->getStatus(Configuration::get('PAGSEGURO_STATUS_5'));
	
		
	$pagseguro->enviar($mailVars, 'pagseguro_first', $assunto, $pagseguro->displayName, $idCustomer, $idLang, $customer->email, 'mails/');

	Tools::redirectLink(__PS_BASE_URI__.'order-confirmation.php?id_cart='.$cart->id.'&id_module='.$pagseguro->id.'&id_order='.$pagseguro->currentOrder.'&key='.$order->secure_key);

?>