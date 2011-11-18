<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');
include(dirname(__FILE__).'/paypal.php');

$paypal = new Paypal();
$cart = new Cart(intval($cookie->id_cart));

$address = new Address(intval($cart->id_address_invoice));
$country = new Country(intval($address->id_country));
$state = NULL;
if ($address->id_state)
	$state = new State(intval($address->id_state));
$customer = new Customer(intval($cart->id_customer));
$business = Configuration::get('PAYPAL_BUSINESS');
$header = Configuration::get('PAYPAL_HEADER');
$currency_order = new Currency(intval($cart->id_currency));
$currency_module = $paypal->getCurrency();

if (!Validate::isEmail($business))
	die($paypal->getL('Paypal error: (invalid or undefined business account email)'));

if (!Validate::isLoadedObject($address) OR !Validate::isLoadedObject($customer) OR !Validate::isLoadedObject($currency_module))
	die($paypal->getL('Paypal error: (invalid address or customer)'));

// check currency of payment
if ($currency_order->id != $currency_module->id)
{
	$cookie->id_currency = $currency_module->id;
	$cart->id_currency = $currency_module->id;
	$cart->update();
}

$smarty->assign(array(
	'redirect_text' => $paypal->getL('Please wait, redirecting to Paypal... Thanks.'),
	'cancel_text' => $paypal->getL('Cancel'),
	'cart_text' => $paypal->getL('My cart'),
	'return_text' => $paypal->getL('Return to shop'),
	'paypal_url' => $paypal->getPaypalUrl(),
	'address' => $address,
	'country' => $country,
	'state' => $state,
	'amount' => floatval($cart->getOrderTotal(true, 4)),
	'customer' => $customer,
	'total' => floatval($cart->getOrderTotal(true, 3)),
	'shipping' => Tools::ps_round(floatval($cart->getOrderShippingCost()) + floatval($cart->getOrderTotal(true, 6)), 2),
	'discount' => $cart->getOrderTotal(true, 2),
	'business' => $business,
	'currency_module' => $currency_module,
	'cart_id' => intval($cart->id),
	'products' => $cart->getProducts(),
	'paypal_id' => intval($paypal->id),
	'header' => $header,
	'url' => Tools::getHttpHost(true, true).__PS_BASE_URI__
));


if (is_file(_PS_THEME_DIR_.'modules/paypal/redirect.tpl'))
	$smarty->display(_PS_THEME_DIR_.'modules/'.$paypal->name.'/redirect.tpl');
else
	$smarty->display(_PS_MODULE_DIR_.$paypal->name.'/redirect.tpl');

?>
