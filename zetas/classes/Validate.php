<?php

/**
  * Validation class, Validate.php
  * Check fields and data validity
  * @category classes
  *
  * @author PrestaShop <support@prestashop.com>
  * @copyright PrestaShop
  * @license http://www.opensource.org/licenses/osl-3.0.php Open-source licence 3.0
  * @version 1.3
  *
  */

class Validate
{
 	/**
	* Check for e-mail validity
	*
	* @param string $email e-mail address to validate
	* @return boolean Validity is ok or not
	*/
	static public function isEmail($email)
    {
    	return preg_match('/^[a-z0-9!#$%&\'*+\/=?^`{}|~_-]+[.a-z0-9!#$%&\'*+\/=?^`{}|~_-]*@[a-z0-9]+[._a-z0-9-]*\.[a-z0-9]+$/ui', $email);
    }

    /**
	* Check for module URL validity
	*
	* @param string $url module URL to validate
	* @param array $errors Reference array for catching errors
	* @return boolean Validity is ok or not
	*/
	static public function isModuleUrl($url, &$errors)
	{
		if (!$url OR $url == 'http://')
			$errors[] = Tools::displayError('please specify module URL');
		elseif (substr($url, -4) != '.tar' AND substr($url, -4) != '.zip' AND substr($url, -4) != '.tgz' AND substr($url, -7) != '.tar.gz')
			$errors[] = Tools::displayError('unknown archive type');
		else
		{
			if ((strpos($url, 'http')) === false)
				$url = 'http://'.$url;
			if (!is_array(@get_headers($url)))
				$errors[] = Tools::displayError('invalid URL');
		}
		if (!sizeof($errors))
			return true;
		return false;

	}

	/**
	* Check for MD5 string validity
	*
	* @param string $md5 MD5 string to validate
	* @return boolean Validity is ok or not
	*/
	static public function isMd5($md5)
	{
		return preg_match('/^[a-z0-9]{32}$/ui', $md5);
	}

	/**
	* Check for SHA1 string validity
	*
	* @param string $sha1 SHA1 string to validate
	* @return boolean Validity is ok or not
	*/
	static public function isSha1($sha1)
	{
		return preg_match('/^[a-z0-9]{40}$/ui', $sha1);
	}

	/**
	* Check for a float number validity
	*
	* @param float $float Float number to validate
	* @return boolean Validity is ok or not
	*/
    static public function isFloat($float)
    {
		return strval(floatval($float)) == strval($float);
	}
	
    static public function isUnsignedFloat($float)
    {
			return strval(floatval($float)) == strval($float) AND $float >= 0;
	}

	/**
	* Check for a float number validity
	*
	* @param float $float Float number to validate
	* @return boolean Validity is ok or not
	*/
    static public function isOptFloat($float)
    {
		return empty($float) OR self::isFloat($float);
	}

	/**
	* Check for a carrier name validity
	*
	* @param string $name Carrier name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isCarrierName($name)
	{
		return empty($name) OR preg_match('/^[^<>;=#{}]*$/ui', $name);
	}

	/**
	* Check for an image size validity
	*
	* @param string $size Image size to validate
	* @return boolean Validity is ok or not
	*/
	static public function isImageSize($size)
	{
		return preg_match('/^[0-9]{1,4}$/ui', $size);
	}

	static public function isOptId($id)
	{
		return empty($id) OR self::isUnsignedId($id);
	}

	/**
	* Check for name validity
	*
	* @param string $name Name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isName($name)
	{
		return preg_match('/^[^0-9!<>,;?=+()@#"°{}_$%:]*$/ui', stripslashes($name));
	}

	/**
	* Check for hook name validity
	*
	* @param string $hook Hook name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isHookName($hook)
	{
		return preg_match('/^[a-z0-9_-]+$/ui', $hook);
	}

	/**
	* Check for sender name validity
	*
	* @param string $mailName Sender name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isMailName($mailName)
	{
		return preg_match('/^[^<>;=#{}]*$/ui', $mailName);
	}

	/**
	* Check for e-mail subject validity
	*
	* @param string $mailSubject e-mail subject to validate
	* @return boolean Validity is ok or not
	*/
	static public function isMailSubject($mailSubject)
	{
		return preg_match('/^[^<>;{}]*$/ui', $mailSubject);
	}

	/**
	* Check for module name validity
	*
	* @param string $moduleName Module name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isModuleName($moduleName)
	{
		return preg_match('/^[a-z0-9_-]+$/ui', $moduleName);
	}

	/**
	* Check for template name validity
	*
	* @param string $tplName Template name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isTplName($tplName)
	{
		return preg_match('/^[a-z0-9_-]+$/ui', $tplName);
	}

	static public function isTplFileName($tplFileName)
	{
		return preg_match('/^[a-zA-Z0-9\/_.-]+/ui', $tplFileName);
	}

	/**
	* Check for icon file validity
	*
	* @param string $icon Icon filename to validate
	* @return boolean Validity is ok or not
	*/
	static public function isIconFile($icon)
	{
		return preg_match('/^[a-z0-9_-]+\.[gif|jpg|jpeg|png]$/ui', $icon);
	}

	/**
	* Check for ico file validity
	*
	* @param string $icon Icon filename to validate
	* @return boolean Validity is ok or not
	*/
	static public function isIcoFile($icon)
	{
		return preg_match('/^[a-z0-9_-]+\.ico$/ui', $icon);
	}

	/**
	* Check for image type name validity
	*
	* @param string $type Image type name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isImageTypeName($type)
	{
		return preg_match('/^[a-z0-9_ -]+$/ui', $type);
	}

	/**
	* Check for price validity
	*
	* @param string $price Price to validate
	* @return boolean Validity is ok or not
	*/
	static public function isPrice($price)
	{
		return preg_match('/^[0-9]{1,10}(\.[0-9]{1,9})?$/ui', $price);
	}

	/**
	* Check for language code (ISO) validity
	*
	* @param string $isoCode Language code (ISO) to validate
	* @return boolean Validity is ok or not
	*/
	static public function isLanguageIsoCode($isoCode)
	{
		return preg_match('/^[a-z]{2,3}$/ui', $isoCode);
	}
	
	static public function isStateIsoCode($isoCode)
	{
		return preg_match('/^[a-z]{1,4}$/ui', $isoCode);
	}

	/**
	* Check for gender code (ISO) validity
	*
	* @param string $isoCode Gender code (ISO) to validate
	* @return boolean Validity is ok or not
	*/
	static public function isGenderIsoCode($isoCode)
	{
		return preg_match('/^[0|1|2|9]$/ui', $isoCode);
	}

	/**
	* Check for gender code (ISO) validity
	*
	* @param string $isoCode Gender code (ISO) to validate
	* @return boolean Validity is ok or not
	*/
	static public function isGenderName($genderName)
	{
		return preg_match('/^[a-z.]+$/ui', $genderName);
	}

	/**
	* Check for discount coupon name validity
	*
	* @param string $discountName Discount coupon name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isDiscountName($discountName)
	{
		return preg_match('/^[^!<>,;?=+()@"°{}_$%:]{3,32}$/ui', $discountName);
	}

	/**
	* Check for product or category name validity
	*
	* @param string $name Product or category name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isCatalogName($name)
	{
		return preg_match('/^[^<>;=#{}]*$/ui', $name);
	}

	/**
	* Check for a message validity
	*
	* @param string $message Message to validate
	* @return boolean Validity is ok or not
	*/
	static public function isMessage($message)
	{
		return preg_match('/^([^<>{}]|<br \/>)*$/ui', $message);
	}

	/**
	* Check for a country name validity
	*
	* @param string $name Country name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isCountryName($name)
	{
		return preg_match('/^[a-z -]+$/ui', $name);
	}

	/**
	* Check for a link (url-rewriting only) validity
	*
	* @param string $link Link to validate
	* @return boolean Validity is ok or not
	*/
	static public function isLinkRewrite($link)
	{
		return empty($link) OR preg_match('/^[_a-z0-9-]+$/ui', $link);
	}

	/**
	* Check for zone name validity
	*
	* @param string $name Zone name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isZoneName($name)
	{
		return preg_match('/^[a-z -()]+$/ui', $name);
	}

	/**
	* Check for a postal address validity
	*
	* @param string $address Address to validate
	* @return boolean Validity is ok or not
	*/
	static public function isAddress($address)
	{
		return empty($address) OR preg_match('/^[^!<>?=+@{}_$%]*$/ui', $address);
	}

	/**
	* Check for city name validity
	*
	* @param string $city City name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isCityName($city)
	{
		return preg_match('/^[^!<>;?=+@#"°{}_$%]*$/ui', $city);
	}

	/**
	* Check for search query validity
	*
	* @param string $search Query to validate
	* @return boolean Validity is ok or not
	*/
	static public function isValidSearch($search)
	{
		return preg_match('/^[^<>;=#{}]{0,64}$/ui', $search);
	}

	/**
	* Check for standard name validity
	*
	* @param string $name Name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isGenericName($name)
	{
		return empty($name) OR preg_match('/^[^<>;=#{}]*$/ui', $name);
	}

	/**
	* Check for HTML field validity (no XSS please !)
	*
	* @param string $html HTML field to validate
	* @return boolean Validity is ok or not
	*/
	static public function isCleanHtml($html)
	{
		$jsEvent = 'onmousedown|onmousemove|onmmouseup|onmouseover|onmouseout|onload|onunload|onfocus|onblur|onchange|onsubmit|ondblclick|onclick|onkeydown|onkeyup|onkeypress|onmouseenter|onmouseleave';
		return (!preg_match('/<[ \t\n]*script/ui', $html) && !preg_match('/<.*('.$jsEvent.')[ \t\n]*=/ui', $html)  && !preg_match('/.*script\:/ui', $html));
	}

	/**
	* Check for product reference validity
	*
	* @param string $reference Product reference to validate
	* @return boolean Validity is ok or not
	*/
	static public function isReference($reference)
	{
		return preg_match('/^[^<>;={}]*$/ui', $reference);
	}

	/**
	* Check for password validity
	*
	* @param string $passwd Password to validate
	* @return boolean Validity is ok or not
	*/
	static public function isPasswd($passwd, $size = 5)
	{
		return preg_match('/^[.a-z_0-9-!@#$%\^&*()]{'.$size.',32}$/ui', $passwd);
	}

	static public function isPasswdAdmin($passwd)
	{
		return self::isPasswd($passwd, 8);
	}

	/**
	* Check for configuration key validity
	*
	* @param string $configName Configuration key to validate
	* @return boolean Validity is ok or not
	*/
	static public function isConfigName($configName)
	{
		return preg_match('/^[a-z_0-9-]+$/ui', $configName);
	}

	/**
	* Check for date validity
	*
	* @param string $date Date to validate
	* @return boolean Validity is ok or not
	*/
	static public function isDate($date)
	{
		if (!preg_match('/^([0-9]{4})-((0?[1-9])|(1[0-2]))-((0?[1-9])|([1-2][0-9])|(3[01]))( [0-9]{2}:[0-9]{2}:[0-9]{2})?$/ui', $date, $matches))
			return false;
		return checkdate(intval($matches[2]), intval($matches[5]), intval($matches[0]));
	}

	/**
	* Check for birthDate validity
	*
	* @param string $date birthdate to validate
	* @return boolean Validity is ok or not
	*/
	static public function isBirthDate($date)
	{
	 	if (empty($date) || $date == '0000-00-00')
	 		return true;
	 	if (preg_match('/^([0-9]{4})-((0?[1-9])|(1[0-2]))-((0?[1-9])|([1-2][0-9])|(3[01]))( [0-9]{2}:[0-9]{2}:[0-9]{2})?$/ui', $date, $birthDate)) {
			 if ($birthDate[1] >= date('Y') - 9)
	 			return false;
	 		return true;
	 	}
		return false;
	}

	/**
	* Check for boolean validity
	*
	* @param boolean $bool Boolean to validate
	* @return boolean Validity is ok or not
	*/
	static public function isBool($bool)
	{
		return is_null($bool) OR is_bool($bool) OR preg_match('/^[0|1]{1}$/ui', $bool);
	}

	/**
	* Check for phone number validity
	*
	* @param string $phoneNumber Phone number to validate
	* @return boolean Validity is ok or not
	*/
	static public function isPhoneNumber($phoneNumber)
	{
		return preg_match('/^[+0-9. ()-]*$/ui', $phoneNumber);
	}

	/**
	* Check for barcode validity (EAN-13)
	*
	* @param string $ean13 Barcode to validate
	* @return boolean Validity is ok or not
	*/
	static public function isEan13($ean13)
	{
		return !$ean13 OR preg_match('/^[0-9]{0,13}$/ui', $ean13);
	}

	/**
	* Check for postal code validity
	*
	* @param string $postcode Postal code to validate
	* @return boolean Validity is ok or not
	*/
	static public function isPostCode($postcode)
	{
		return preg_match('/^[a-z 0-9-]+$/ui', $postcode);
	}

	/**
	* Check for table or identifier validity
	* Mostly used in database for ordering : ASC / DESC
	*
	* @param string $orderWay Keyword to validate
	* @return boolean Validity is ok or not
	*/
	static public function isOrderWay($orderWay)
	{
		return ($orderWay === 'ASC' | $orderWay === 'DESC' | $orderWay === 'asc' | $orderWay === 'desc');
	}

	/**
	* Check for table or identifier validity
	* Mostly used in database for ordering : ORDER BY field
	*
	* @param string $orderBy Field to validate
	* @return boolean Validity is ok or not
	*/
	static public function isOrderBy($orderBy)
	{
		return preg_match('/^[a-z0-9_-]+$/ui', $orderBy);
	}

	/**
	* Check for table or identifier validity
	* Mostly used in database for table names and id_table
	*
	* @param string $table Table/identifier to validate
	* @return boolean Validity is ok or not
	*/
	static public function isTableOrIdentifier($table)
	{
		return preg_match('/^[a-z0-9_-]+$/ui', $table);
	}

	/**
	* Check for values list validity
	* Mostly used in database for insertions (A,B,C),(A,B,C)...
	*
	* @param string $list List to validate
	* @return boolean Validity is ok or not
	*/
	static public function isValuesList($list)
	{
		return true;
		/* For history reason, we keep this line */
		// return preg_match('/^[0-9,\'(). NULL]+$/ui', $list);
	}

	/**
	* Check for tags list validity
	*
	* @param string $list List to validate
	* @return boolean Validity is ok or not
	*/
	static public function isTagsList($list)
	{
		return preg_match('/^[^!<>;?=+#"°{}_$%]*$/ui', $list);
	}

	/**
	* Check for an integer validity
	*
	* @param integer $id Integer to validate
	* @return boolean Validity is ok or not
	*/
	static public function isInt($value)
	{
		return ((string)(int)$value === (string)$value OR $value === false);
	}

	/**
	* Check for an integer validity (unsigned)
	*
	* @param integer $id Integer to validate
	* @return boolean Validity is ok or not
	*/
	static public function isUnsignedInt($value)
	{
		return (self::isInt($value) AND $value < 4294967296 AND $value >= 0);
	}

	/**
	* Check for an integer validity (unsigned)
	* Mostly used in database for auto-increment
	*
	* @param integer $id Integer to validate
	* @return boolean Validity is ok or not
	*/
	static public function isUnsignedId($id)
	{
		return self::isUnsignedInt($id); /* Because an id could be equal to zero when there is no association */
	}

	static public function isNullOrUnsignedId($id)
	{
		return is_null($id) OR self::isUnsignedId($id);
	}

	/**
	* Check object validity
	*
	* @param integer $object Object to validate
	* @return boolean Validity is ok or not
	*/
	static public function isLoadedObject($object)
	{
		return is_object($object) AND $object->id;
	}

	/**
	* Check object validity
	*
	* @param integer $object Object to validate
	* @return boolean Validity is ok or not
	*/
	static public function isColor($color)
	{
		return preg_match('/^(#[0-9A-Fa-f]{6}|[[:alnum:]]*)$/ui', $color);
	}

	/**
	* Check object validity
	*
	* @param integer $object Object to validate
	* @return boolean Validity is ok or not
	*/
	static public function isUrl($url)
	{
		return preg_match('/^([[:alnum:]]|[:#%&_=\(\)\.\? \+\-@\/])+$/ui', $url);
	}

	/**
	* Check object validity
	*
	* @param integer $object Object to validate
	* @return boolean Validity is ok or not
	*/
	static public function isAbsoluteUrl($url)
	{
		if (!empty($url))
			return preg_match('/^https?:\/\/([[:alnum:]]|[:#%&_=\(\)\.\? \+\-@\/\$])+$/ui', $url);
		return true;
	}

	/**
	* Check for standard name file validity
	*
	* @param string $name Name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isFileName($name)
	{
		return preg_match('/^[a-z0-9_.-]*$/ui', $name);
	}

	/**
	* Check for admin panel tab name validity
	*
	* @param string $name Name to validate
	* @return boolean Validity is ok or not
	*/
	static public function isTabName($name)
	{
		return preg_match('/^[a-z0-9_-]*$/ui', $name);
	}

	static public function isWeightUnit($unit)
	{
		return preg_match('/^[[:alpha:]]{1,3}$/ui', $unit);
	}

	static public function isProtocol($protocol)
	{
		return preg_match('/^http(s?):\/\/$/ui', $protocol);
	}


	static public function isSubDomainName($subDomainName)
	{
		return preg_match('/^[[:alnum:]]*$/ui', $subDomainName);
	}

	static public function isVoucherDescription($text)
	{
		return preg_match('/^([^<>{}]|<br \/>)*$/ui', $text);
	}
	
	/**
	* Check if the char values is a granularity value
	*
	* @param char $value
	* @return boolean Validity is ok or not
	*/
	static public function isGranularityValue($value)
	{
		return (!is_null($value) AND ($value === 'd' OR $value === 'm' OR $value === 'y'));
	}
	
	/**
	* Check if the value is a sort direction value (DESC/ASC)
	*
	* @param char $value
	* @return boolean Validity is ok or not
	*/
	static public function IsSortDirection($value)
	{
		return (!is_null($value) AND ($value === 'ASC' OR $value === 'DESC'));
	}

	/**
	* Customization fields' label validity
	*
	* @param integer $object Object to validate
	* @return boolean Validity is ok or not
	*/
	static public function isLabel($label)
	{
		return (preg_match('/^[^{}<>]*$/ui', $label));
	}

	/**
	* Price display method validity
	*
	* @param integer $data Data to validate
	* @return boolean Validity is ok or not
	*/
	static public function isPriceDisplayMethod($data)
	{
		return ($data == PS_TAX_EXC OR $data == PS_TAX_INC);
	}
	
	/**
	* Check for Dni validity
	*
	* @param string $dni to validate
	* @return int
	*/
	static public function isDni($dni)
	{
		/*
		Return code:
		1 : It's Ok
		0 : Bad format for DNI
		-1 : DNI duplicate
		-2 : NIF error
		-3 : CIF error
		-4 : NIE error
		*/
		
		if (!$dni)
			return 1;
		
		$dni = strtoupper($dni);
		if (!preg_match('/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/', $dni)) 
			return 0;
		
		$result = Db::getInstance()->getValue('
		SELECT COUNT(`id_customer`) AS total 
		FROM `'._DB_PREFIX_.'customer` 
		WHERE `dni` = \''.pSQL($dni).'\'
		');
		if($result)
			return -1;
		
		for ($i=0;$i<9;$i++)
			$char[$i] = substr($dni, $i, 1);
		// 12345678T
		if (preg_match('/(^[0-9]{8}[A-Z]{1}$)/', $dni))
			if ($char[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($dni, 0, 8) % 23, 1))
				return 1;
			else
				return -2;
		
		$sum = $char[2] + $char[4] + $char[6];
		for ($i = 1; $i < 8; $i += 2)
			$sum += substr((2 * $char[$i]),0,1) + substr((2 * $char[$i]),1,1);
		
		$n = 10 - substr($sum, strlen($sum) - 1, 1);
		
		if (preg_match('/^[KLM]{1}/', $dni))
			if ($char[8] == chr(64 + $n))
				return 1;
			else
	 			return -2;
		
		if (preg_match('/^[ABCDEFGHJNPQRSUVW]{1}/', $dni))
			if ($char[8] == chr(64 + $n) || $char[8] == substr($n, strlen($n) - 1, 1))
				return 1;
			else
				return -3;
		
		if (preg_match('/^[T]{1}/', $dni))
			if ($char[8] == preg_match('/^[T]{1}[A-Z0-9]{8}$/', $dni))
				return 1;
			else
				return -4;
		
		if (preg_match('/^[XYZ]{1}/', $dni))
			if ($char[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(str_replace(array('X','Y','Z'), array('0','1','2'), $dni), 0, 8) % 23, 1))
				return 1;
			else
				return -4;
		
		return 0;
	}

	/**
	* Check if $data is a PrestaShop cookie object
	*
	* @param mixed $data to validate
	* @return bool
	*/
	static public function isCookie($data)
	{
		return (is_object($data) AND get_class($data) == 'Cookie');
	}

	/**
	* Price display method validity
	*
	* @param string $data Data to validate
	* @return boolean Validity is ok or not
	*/
	static public function isString($data)
	{
		return is_string($data);
	}
}

?>
