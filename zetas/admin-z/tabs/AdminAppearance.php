<?php

/**
  * Database tab for admin panel, AdminDb.php
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

class AdminAppearance extends AdminPreferences
{
	public function __construct()
	{
		$this->className = 'Configuration';
		$this->table = 'configuration';

 		$this->_fieldsAppearance = array(
			'PS_LOGO' => array('title' => $this->l('Header logo:'), 'desc' => $this->l('Will appear on page and e-mail headers'), 'type' => 'file', 'thumb' => array('file' => _PS_IMG_.'logo.jpg?date='.time(), 'pos' => 'before')),
			'PS_FAVICON' => array('title' => $this->l('Favicon:'), 'desc' => $this->l('The favicon used by your shop'), 'type' => 'file', 'thumb' => array('file' => _PS_IMG_.'favicon.ico?date='.time(), 'pos' => 'after')),
			'PS_NAVIGATION_PIPE' => array('title' => $this->l('Navigation pipe:'), 'desc' => $this->l('Used for navigation path inside categories/product'), 'cast' => 'strval', 'type' => 'text', 'size' => 20),
		);
		$this->_fieldsTheme = array(
			'PS_THEME' => array('title' => $this->l('Theme'), 'validation' => 'isGenericName', 'type' => 'image', 'list' => $this->_getThemesList(), 'max' => 3)
		);
		parent::__construct();
	}

	public function display()
	{
		global $currentIndex;
		
		// No cache for auto-refresh uploaded logo
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		$this->_displayForm('appearance', $this->_fieldsAppearance, $this->l('Appearance'), 'width3', 'appearance');
		echo '<br /><br />';
		$this->_displayForm('themes', $this->_fieldsTheme, $this->l('Themes'), 'width3', 'themes');
		echo '<br /><br />';
		if (@ini_get('allow_url_fopen'))
			echo '<script type="text/javascript">
				$.post("'.dirname($currentIndex).'/ajax.php",{page:"themes"},function(a){getE("prestastore-content").innerHTML="<legend><img src=\"../img/admin/prestastore.gif\" class=\"middle\" /> '.$this->l('Live from PrestaStore!').'</legend>"+a;});
			</script>
			<fieldset id="prestastore-content" class="width3"></fieldset>';			
		else
			echo '<a href="http://addons.prestashop.com/3-prestashop-themes">'.$this->l('Find new themes on PrestaShop Addons!').'</a>';
	}
	
	/**
	  * Return an array with themes and thumbnails
	  *
	  * @return array
	  */
	private function _getThemesList()
	{
		$dir = opendir(_PS_ALL_THEMES_DIR_);
		while ($folder = readdir($dir))
			if ($folder != '.' AND $folder != '..' AND file_exists(_PS_ALL_THEMES_DIR_.'/'.$folder.'/preview.jpg'))
				$themes[$folder]['name'] = $folder;
		closedir($dir);	
		return isset($themes) ? $themes : array();
	}
}

?>