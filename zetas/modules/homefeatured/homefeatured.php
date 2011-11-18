<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class HomeFeatured extends Module
{
	private $_html = '';
	private $_postErrors = array();

	function __construct()
	{
		$this->name = 'homefeatured';
		$this->tab = 'Tools';
		$this->version = '0.9';

		parent::__construct();
		
		$this->displayName = $this->l('Featured Products on the homepage');
		$this->description = $this->l('Displays Featured Products in the middle of your homepage');
	}

	function install()
	{
		if (!Configuration::updateValue('HOME_FEATURED_NBR', 8) OR !parent::install() OR !$this->registerHook('home'))
			return false;
		return true;
	}

	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitHomeFeatured'))
		{
			$nbr = intval(Tools::getValue('nbr'));
			if (!$nbr OR $nbr <= 0 OR !Validate::isInt($nbr))
				$errors[] = $this->l('Invalid number of product');
			else
				Configuration::updateValue('HOME_FEATURED_NBR', intval($nbr));
			if (isset($errors) AND sizeof($errors))
				$output .= $this->displayError(implode('<br />', $errors));
			else
				$output .= $this->displayConfirmation($this->l('Settings updated'));
		}
		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		$output = '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
				<p>'.$this->l('In order to add products to your homepage, just add them to the "home" category.').'</p><br />
				<label>'.$this->l('Number of product displayed').'</label>
				<div class="margin-form">
					<input type="text" size="5" name="nbr" value="'.Tools::getValue('nbr', intval(Configuration::get('HOME_FEATURED_NBR'))).'" />
					<p class="clear">'.$this->l('The number of products displayed on homepage (default: 10)').'</p>
					
				</div>
				<center><input type="submit" name="submitHomeFeatured" value="'.$this->l('Save').'" class="button" /></center>
			</fieldset>
		</form>';
		return $output;
	}

	function hookHome($params)
	{
		global $smarty;

		$category = new Category(1);
		$nb = intval(Configuration::get('HOME_FEATURED_NBR'));
		$products = $category->getProducts(intval($params['cookie']->id_lang), 1, ($nb ? $nb : 10));
		$smarty->assign(array('products' => $products, 'homeSize' => Image::getSize('home')));

		return $this->display(__FILE__, 'homefeatured.tpl');
	}
}
