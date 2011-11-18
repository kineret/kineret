<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class PaypalAdmin extends PaypalAPI
{
	public function home()
	{
		// header
		$html = '<h2>Paypal</h2>
				<div style="float: right; width: 440px; height: 150px; border: dashed 1px #666; padding: 8px; margin-left: 12px;">
					<h2>'.$this->l('Opening your PayPal account').'</h2>
					<div style="clear: both;"></div>
					<p>'.$this->l('By opening your PayPal account by clicking on the following image you are helping us significantly to improve the PrestaShop software:').'</p>
					<p style="text-align: center;"><a href="https://www.paypal.com/fr/mrb/pal=TWJHHUL9AEP9C"><img src="../modules/paypal/prestashop_paypal.png" alt="PrestaShop & PayPal" style="margin-top: 12px;" /></a></p>
					<div style="clear: right;"></div>
				</div>
				<img src="../modules/paypalapi/paypalapi.gif" style="float:left; margin-right:15px;" />
				<b>'.$this->l('This module allows you to accept payments by PayPal.').'</b><br /><br />
				'.$this->l('If the client chooses this payment mode, your PayPal account will be automatically credited.').'<br />
				'.$this->l('You need to configure your PayPal account first before using this module.').'
				<div style="clear:both;">&nbsp;</div>';

		// process
		if (isset($_POST['submitPaypalSettings']) OR isset($_POST['submitPaypalAPI']))
		{
			$errors = $this->_checkValues();
			if (!sizeof($errors))
			{
				$this->_updateValues();
				$html .= '<div class="conf confirm"><img src="../img/admin/ok.gif" />'.$this->l('Settings updated').'</div>';
			}
			else
				$html .= $this->_displayErrors($errors);
		}

		// form
		$html .= $this->_displayFormSettings();
		return $html;
	}

	private function _checkValues()
	{
		$errors = array();

		if (isset($_POST['submitPaypalSettings']))
		{
			if (!isset($_POST['sandbox']))
				$_POST['sandbox'] = 1;
			if (!isset($_POST['expressCheckout']))
				$_POST['expressCheckout'] = 0;
			if (!$this->_expressCheckout AND intval($_POST['expressCheckout']))
				if (!$this->registerHook('shoppingCartExtra'))
				{
					$errors[] = $this->l('Cannot register module to validCart hook, ExpressCheckout not enabled');
					$_POST['expressCheckout'] = 0;
				}
			if ($this->_expressCheckout AND !intval($_POST['expressCheckout']))
				if (!$this->unregisterHook(Hook::get('shoppingCartExtra')))
				{
					$errors[] = $this->l('Cannot unregister module to validCart hook, ExpressCheckout not disabled');
					$_POST['expressCheckout'] = 1;
				}
		}
		elseif (isset($_POST['submitPaypalAPI']))
		{
			if (!isset($_POST['apiUser']) OR !$_POST['apiUser'])
				$errors[] = $this->l('You need to configure your PayPal API username');
			if (!isset($_POST['apiPassword']) OR !$_POST['apiPassword'])
				$errors[] = $this->l('You need to configure your PayPal API password');
			if (!isset($_POST['apiSignature']) OR !$_POST['apiSignature'])
				$errors[] = $this->l('You need to configure your PayPal API signature');
		}
		return $errors;
	}

	private function _updateValues()
	{
		if (isset($_POST['submitPaypalSettings']))
		{
			Configuration::updateValue('PAYPAL_HEADER', strval($_POST['header']));
			Configuration::updateValue('PAYPAL_SANDBOX', intval($_POST['sandbox']));
			Configuration::updateValue('PAYPAL_EXPRESS_CHECKOUT', intval($_POST['expressCheckout']));
			Configuration::updateValue('PAYPAL_INTEGRAL', intval($_POST['pp_integral']));
		}
		elseif (isset($_POST['submitPaypalAPI']))
		{
			Configuration::updateValue('PAYPAL_API_USER', strval($_POST['apiUser']));
			Configuration::updateValue('PAYPAL_API_PASSWORD', strval($_POST['apiPassword']));
			Configuration::updateValue('PAYPAL_API_SIGNATURE', strval($_POST['apiSignature']));
		}
	}

	private function _displayErrors($errors)
	{
		$nbErrors = sizeof($errors);
		$html = '
		<div class="alert error">
			<h3>'.($nbErrors > 1 ? $this->l('There are') : $this->l('There is')).' '.$nbErrors.' '.($nbErrors > 1 ? $this->l('errors') : $this->l('error')).'</h3>
			<ol>';
		foreach ($errors AS $error)
			$html .= '<li>'.$error.'</li>';
		$html .= '
			</ol>
		</div>';
		return $html;
	}

	private function _displayFormSettings()
	{
		$header = isset($_POST['header']) ? strval($_POST['header']) : $this->_header;
		$sandbox = isset($_POST['sandbox']) ? intval($_POST['sandbox']) : $this->_sandbox;
		$apiUser = isset($_POST['apiUser']) ? strval($_POST['apiUser']) : $this->_apiUser;
		$apiPassword = isset($_POST['apiPassword']) ? strval($_POST['apiPassword']) : $this->_apiPassword;
		$apiSignature = isset($_POST['apiSignature']) ? strval($_POST['apiSignature']) : $this->_apiSignature;
		$expressCheckout = isset($_POST['expressCheckout']) ? intval($_POST['expressCheckout']) : $this->_expressCheckout;
		$pp_integral = isset($_POST['pp_integral']) ? intval($_POST['pp_integral']) : $this->_pp_integral;

		$html= '
		<fieldset>
			<legend><img src="../img/admin/unknown.gif" />'.$this->l('Server Information').'</legend>
			<b style="color: red;">'.$this->l('Prior to the use of the PayPal module, please check if Curl or openSSL are activated on your server').'.</b><br /><br />
			'.$this->l('Without SSL, PayPalAPI module will not be able to contact PayPal').'.<br />
		</fieldset>
		<form action="'.strval($_SERVER['REQUEST_URI']).'" method="post" style="margin-top:20px; float:left;">
			<fieldset style="width:400px;">
				<legend><img src="../img/admin/edit.gif" />'.$this->l('General settings').'</legend>
				<label style="width:140px;">'.$this->l('Sandbox mode:').'</label>
				<div class="margin-form" style="padding-left:160px;">
					<input type="radio" name="sandbox" value="1" '.($sandbox ? 'checked="checked"' : '').' /> '.$this->l('Yes').'
					<input type="radio" name="sandbox" value="0" '.(!$sandbox ? 'checked="checked"' : '').' /> '.$this->l('No').'
					<p class="hint" style="display: block;float: none;">'.$this->l('When you active this option, PayPal run on mode test.').'</p>
				</div>
				<label style="clear:both; width:140px;">'.$this->l('PayPal Integral:').'</label>
				<div class="margin-form" style="padding-left:160px;">
					<input type="radio" name="pp_integral" value="1" '.($pp_integral ? 'checked="checked"' : '').' /> '.$this->l('Activate payments credit cards (CB, Visa, Mastercard) and private cards (Amex, Aurore, Cofinoga, 4 stars), and with PayPal account').'
				</div>
				<label style="clear:both; width:140px;">'.$this->l('PayPal Option+:').'</label>
				<div class="margin-form" style="padding-left:160px;">
					<input type="radio" name="pp_integral" value="0" '.(!$pp_integral ? 'checked="checked"' : '').' /> '.$this->l('Activate payments with PayPal account').'
				</div>
				<label style="clear:both; width:140px;">'.$this->l('Express Checkout:').'</label>
				<div class="margin-form" style="padding-left:160px;">
					<input type="radio" name="expressCheckout" value="1" '.($expressCheckout ? 'checked="checked"' : '').' /> '.$this->l('Yes').'
					<input type="radio" name="expressCheckout" value="0" '.(!$expressCheckout ? 'checked="checked"' : '').' /> '.$this->l('No').'
					<p class="hint" style="display: block;float: none;">'.$this->l('Payment with PayPal account in just two clicks (button from the PayPal shopping cart)').'</p>
				</div>
				<label style="clear:both; width:140px;">'.$this->l('Banner image URL:').'</label>
				<div class="margin-form" style="padding-left:160px;">
					<input type="text" size="30" name="header" value="'.($header ? htmlentities($header, ENT_COMPAT, 'UTF-8') : '').'" />
					<p class="hint" style="display: block;">'.$this->l('The image should be host on a secure (https) server. Max: 750x90px.').'</p>
				</div>
				<center style="clear:both; margin-top:50px;"><input type="submit" name="submitPaypalSettings" value="'.$this->l('Update settings').'" class="button" /></center>
			</fieldset>
		</form>
		<form action="'.strval($_SERVER['REQUEST_URI']).'" method="post" style="margin:20px 0px 0px 40px; float:left;">
			<fieldset style="width:428px;">
				<legend><img src="../img/admin/cog.gif" />'.$this->l('API settings:').'</legend>
				<label style="width:140px;">'.$this->l('API user:').'</label>
				<div class="margin-form" style="padding-left:160px;"><input type="text" size="20" name="apiUser" value="'.($apiUser ? htmlentities($apiUser, ENT_COMPAT, 'UTF-8') : '').'" /></div>
				<label style="width:141px;">'.$this->l('API password:').'</label>
				<div class="margin-form" style="padding-left:160px;"><input type="password" size="20" name="apiPassword" value="'.($apiPassword ? htmlentities($apiPassword, ENT_COMPAT, 'UTF-8') : '').'" /></div>
				<label style="width:140px;">'.$this->l('API signature:').'</label>
				<div class="margin-form" style="padding-left:160px;"><input type="text" size="30" name="apiSignature" value="'.($apiSignature ? htmlentities($apiSignature, ENT_COMPAT, 'UTF-8') : '').'" /></div>
				<br />
				<center style="clear:both;"><input type="submit" name="submitPaypalAPI" value="'.$this->l('Update settings').'" class="button" /></center>
			</fieldset>
		</form>
		<div style="clear:both;"><br /></div>
		<fieldset>
			<legend><img src="../img/admin/unknown.gif" />'.$this->l('API settings').'</legend>
			'.$this->l('Follow these steps in order to obtain your API authentication information by using an API signature as the authentication mechanism. If you are testing with a virtual account, repeat these steps both on the virtual account and on the real account at the same time. We recommend that you open a separate Web browser session when carrying out this procedure.').'<br /><br />
			'.$this->l('1. Log in to your PayPal Premier or Business account.').'<br /><br />
			'.$this->l('2. Click the Profile subtab located under the My Account heading.').'<br /><br />
			'.$this->l('3. Click the API Access link under the Account Information header.').'<br /><br />
			'.$this->l('4. Click the View API Certificate link in the right column.').'<br /><br />
			'.$this->l('5. Click the Request API signature radio button on the Request API Credentials page.').'<br /><br />
			'.$this->l('6. Complete the Request API Credential Request form by clicking the agreement checkbox and clicking Submit.').'<br /><br />
			'.$this->l('7. Save the values for API Username, Password and Signature (make sure this long character signature is copied).').'<br /><br />
			'.$this->l('8. Click the Done button after copying your API Username, Password, and Signature.').'<br /><br />
			'.$this->l('9. This will take you back to the API Access screen where you are finished.').'<br /><br />
		</fieldset>';
		return $html;
	}
}
