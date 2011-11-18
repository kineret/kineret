<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class PaypalPayment extends PaypalAPI
{
	protected $_logs = array();

	public function getAuthorisation()
	{
		global $cookie, $cart;

		// Getting cart informations
		$currency = new Currency(intval($cart->id_currency));
		if (!Validate::isLoadedObject($currency))
			$this->_logs[] = $this->l('Not a valid currency');
		if (sizeof($this->_logs))
			return false;

		// Making request
		$vars = '?fromPayPal=1';
		$returnURL = Tools::getHttpHost(true, true).__PS_BASE_URI__.'modules/paypalapi/payment/submit.php'.$vars;
		$cancelURL = Tools::getHttpHost(true, true).__PS_BASE_URI__.'order.php';
		$paymentAmount = floatval($cart->getOrderTotal());
		$currencyCodeType = strval($currency->iso_code);
		$paymentType = 'Sale';
		$request = '&Amt='.urlencode($paymentAmount).'&PAYMENTACTION='.urlencode($paymentType).'&ReturnUrl='.urlencode($returnURL).'&CANCELURL='.urlencode($cancelURL).'&CURRENCYCODE='.urlencode($currencyCodeType).'&NOSHIPPING=1';
		if ($this->_pp_integral)
			$request .= '&SOLUTIONTYPE=Sole&LANDINGPAGE=Billing';
		else
			$request .= '&SOLUTIONTYPE=Mark&LANDINGPAGE=Login';
		$request .= '&LOCALECODE='.Language::getIsoById($cart->id_lang);
		if ($this->_header)
			$request .= '&HDRIMG='.urlencode($this->_header);

		// Calling PayPal API
		include(_PS_MODULE_DIR_.'paypalapi/api/paypallib.php');
		$ppAPI = new PaypalLib();
		$result = $ppAPI->makeCall($this->getAPIURL(), $this->getAPIScript(), 'SetExpressCheckout', $request);
		$this->_logs = array_merge($this->_logs, $ppAPI->getLogs());
		return $result;
	}

	public function home($params)
	{
		global $smarty;

		$smarty->assign('integral', $this->_pp_integral);
		$smarty->assign('logo', _MODULE_DIR_.$this->name.'/paypalapi.gif');
		return $this->display(__FILE__.'../', 'payment.tpl');
	}

	public function getLogs()
	{
		return $this->_logs;
	}
}
