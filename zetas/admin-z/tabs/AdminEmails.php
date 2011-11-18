<?php

/**
  * Emails tab for admin panel, AdminEmails.php
  * @category admin
  *
  * @author PrestaShop <support@prestashop.com>
  * @copyright PrestaShop
  * @license http://www.opensource.org/licenses/osl-3.0.php Open-source licence 3.0
  * @version 1.3
  *
  */

include_once(PS_ADMIN_DIR.'/../classes/AdminTab.php');
include_once(PS_ADMIN_DIR.'/tabs/AdminPreferences.php');

class AdminEmails extends AdminPreferences
{
	public function __construct()
	{
		global $cookie;

		$this->className = 'Configuration';
		$this->table = 'configuration';

		$contacts = Contact::getContacts($cookie->id_lang);
		for ($i = 0; $i < sizeof($contacts); ++$i)
			$contact_message[$i] = array('email_message' => $contacts[$i]['id_contact'], 'name' => $contacts[$i]['name']);
 		$this->_fieldsEmail = array(
		'PS_MAIL_EMAIL_MESSAGE' => array('title' => $this->l('Send e-mail to:'), 'desc' => $this->l('When customers send message from order page'), 'validation' => 'isUnsignedId', 'type' => 'select', 'cast' => 'intval', 'identifier' => 'email_message', 'list' => $contact_message),
		'PS_MAIL_METHOD' => array('title' => '', 'validation' => 'isGenericName', 'required' => true, 'type' => 'radio', 'choices' => array(1 => $this->l('Use PHP mail() function.  Recommended; works in most cases'), 2 => $this->l('Set my own SMTP parameters. For advanced users ONLY')), 'js' => array(1 => 'onclick="javascript:toggleLayer(\'SMTP_CONTAINER\', 0);"', 2 => 'onclick="toggleLayer(\'SMTP_CONTAINER\', 1);"')),
		'PS_MAIL_TYPE' => array('title' => '', 'validation' => 'isGenericName', 'required' => true, 'type' => 'radio', 'choices' => array(1 => $this->l('Send mail as HTML'), 2 => $this->l('Send mail as Text'), 3 => $this->l('Both'))),
		'SMTP_CONTAINER' => array('title' => '', 'type' => 'container'),
		'PS_MAIL_SERVER' => array('title' => $this->l('SMTP server:'), 'desc' => $this->l('IP or server name (e.g., smtp.mydomain.com)'), 'validation' => 'isGenericName', 'size' => 30, 'type' => 'text'),
		'PS_MAIL_USER' => array('title' => $this->l('SMTP user:'), 'desc' => $this->l('Leave blank if not applicable'), 'validation' => 'isGenericName', 'size' => 30, 'type' => 'text'),
		'PS_MAIL_PASSWD' => array('title' => $this->l('SMTP password:'), 'desc' => $this->l('Leave blank if not applicable'), 'validation' => 'isGenericName', 'size' => 30, 'type' => 'password'),
		'PS_MAIL_SMTP_ENCRYPTION' => array('title' => $this->l('Encryption:'), 'desc' => $this->l('Use an encrypt protocol'), 'type' => 'select', 'cast' => 'strval', 'identifier' => 'mode', 'list' => array(array('mode' => 'off', 'name' => $this->l('None')), array('mode' => 'tls', 'name' => $this->l('TLS')), array('mode' => 'ssl', 'name' => $this->l('SSL')))),
		'PS_MAIL_SMTP_PORT' => array('title' => $this->l('Port:'), 'desc' => $this->l('Number of port to use'), 'validation' => 'isInt', 'size' => 5, 'type' => 'text', 'cast' => 'intval'),
		'SMTP_CONTAINER_END' => array('title' => '', 'type' => 'container_end', 'content' => '<script type="text/javascript">if (getE("PS_MAIL_METHOD2_on").checked == false) { toggleLayer(\'SMTP_CONTAINER\', 0); }</script>')
		);
	
		parent::__construct();
	}
	
	public function postProcess()
	{
		if (isset($_POST['submitEmail'.$this->table]))
		{
		 	if ($this->tabAccess['edit'] === '1')
				$this->_postConfig($this->_fieldsEmail);
			else
				$this->_errors[] = Tools::displayError('You do not have permission to edit anything here.');
		}
	}
	
	public function display() {
		$this->_displayForm('email', $this->_fieldsEmail, $this->l('E-mail'), 'width2', 'email');
		$this->_displayMailTest();
	}
	
	private function _displayMailTest()
	{
		echo '
		<fieldset style="width:51%;margin-top:10px;">
			<legend><img src="../img/admin/email.gif" alt="" /> '.$this->l('Test your mail configuration').'</legend>
			<script type="text/javascript">
				var textMsg = "'.$this->l('This is a test message, your server is now available to send email').'";
				var textSubject = "'.$this->l('Test message - Prestashop').'";
				var textSendOk = "'.$this->l('Mail is send').'";
				var textSendError= "'.$this->l('Error: please check your configuration').'";
				var errorMail = "'.$this->l('This email adress is wrong!').'";
			</script>
			<script type="text/javascript" src="'._PS_JS_DIR_.'/sendMailTest.js"></script>
			<div style="clear: both; padding-top:15px;">
				<label>'.$this->l('Send a mail test at:').'</label>
				<div class="margin-form">
					<input type="text" name="testEmail" id="testEmail" value="'.Configuration::get('PS_SHOP_EMAIL').'" style="width:210px;margin-bottom:4px;" /><br />
					<input type="hidden" id="PS_MAIL_METHOD" name="PS_MAIL_METHOD" value="'.Configuration::get('PS_MAIL_METHOD').'" />
					<input type="hidden" id="PS_MAIL_SERVER" name="PS_MAIL_SERVER" value="'.Configuration::get('PS_MAIL_SERVER').'" />
					<input type="hidden" id="PS_MAIL_USER" name="PS_MAIL_USER" value="'.Configuration::get('PS_MAIL_USER').'" />
					<input type="hidden" id="PS_MAIL_PASSWD" name="PS_MAIL_PASSWD" value="'.Configuration::get('PS_MAIL_PASSWD').'" />
					<input type="hidden" id="PS_MAIL_SMTP_PORT" name="PS_MAIL_SMTP_PORT" value="'.Configuration::get('PS_MAIL_SMTP_PORT').'" />
					<input type="hidden" id="PS_MAIL_SMTP_ENCRYPTION" name="PS_MAIL_SMTP_ENCRYPTION" value="'.Configuration::get('PS_MAIL_SMTP_ENCRYPTION').'" />
					<input type="button" class="button" name="btEmailTest" id="btEmailTest" value="'.$this->l('Send a mail test').'" onClick="verifyMail();" /><br />
					<p id="mailResultCheck" style="display:none;"></p>
				</div>
			</div>
		</fieldset>
		';
	}
}

?>