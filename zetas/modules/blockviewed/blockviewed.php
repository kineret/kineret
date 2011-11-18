<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class BlockViewed extends Module
{
	private $_html = '';
	private $_postErrors = array();

	function __construct()
	{
		$this->name = 'blockviewed';
		$this->tab = 'Blocks';
		$this->version = 0.9;

		parent::__construct();

		$this->displayName = $this->l('Viewed products block');
		$this->description = $this->l('Adds a block displaying last-viewed products');
	}

	function install()
	{
		if (!parent::install()
			OR !$this->registerHook('leftColumn')
			OR !Configuration::updateValue('PRODUCTS_VIEWED_NBR', 2))
			return false;
		return true;
	}

	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitBlockViewed'))
		{
			if (!$productNbr = Tools::getValue('productNbr') OR empty($productNbr))
				$output .= '<div class="alert error">'.$this->l('You must fill in the \'Products displayed\' field').'</div>';
			elseif (intval($productNbr) == 0)
				$output .= '<div class="alert error">'.$this->l('Invalid number.').'</div>';
			else
			{
				Configuration::updateValue('PRODUCTS_VIEWED_NBR', intval($productNbr));
				$output .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l('Settings updated').'</div>';
			}
		}
		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		$output = '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
				<label>'.$this->l('Products displayed').'</label>
				<div class="margin-form">
					<input type="text" name="productNbr" value="'.Configuration::get('PRODUCTS_VIEWED_NBR').'" />
					<p class="clear">'.$this->l('Define the number of products displayed in this block').'</p>
				</div>
				<center><input type="submit" name="submitBlockViewed" value="'.$this->l('Save').'" class="button" /></center>
			</fieldset>
		</form>';
		return $output;
	}

	function hookRightColumn($params)
	{
		global $link, $smarty, $cookie;

		$id_product = intval(Tools::getValue('id_product'));
		$productsViewed = (isset($params['cookie']->viewed) AND !empty($params['cookie']->viewed)) ? array_slice(explode(',', $params['cookie']->viewed), 0, Configuration::get('PRODUCTS_VIEWED_NBR')) : array();

		if (sizeof($productsViewed))
		{
			$defaultCover = Language::getIsoById($params['cookie']->id_lang).'-default';

			$productIds = implode(',', $productsViewed);
			$productsImages = Db::getInstance()->ExecuteS('
			SELECT i.id_image, p.id_product, il.legend, p.active, pl.name, pl.description_short, pl.link_rewrite, cl.link_rewrite AS category_rewrite
			FROM '._DB_PREFIX_.'product p
			LEFT JOIN '._DB_PREFIX_.'product_lang pl ON (pl.id_product = p.id_product)
			LEFT JOIN '._DB_PREFIX_.'image i ON (i.id_product = p.id_product)
			LEFT JOIN '._DB_PREFIX_.'image_lang il ON (il.id_image = i.id_image)
			LEFT JOIN '._DB_PREFIX_.'category_lang cl ON (cl.id_category = p.id_category_default)
			WHERE p.id_product IN ('.$productIds.')
			AND pl.id_lang = '.intval($params['cookie']->id_lang).'
			AND cl.id_lang = '.intval($params['cookie']->id_lang).'
			AND i.cover = 1'
			);

			$productsImagesArray = array();
			foreach ($productsImages AS $pi)
				$productsImagesArray[$pi['id_product']] = $pi;

			$productsViewedObj = array();
			foreach ($productsViewed AS $productViewed)
			{
				$obj = (object)'Product';
				if (!isset($productsImagesArray[$productViewed]) || (!$obj->active = $productsImagesArray[$productViewed]['active']))
					continue;
				else
				{
					$obj->id = intval($productsImagesArray[$productViewed]['id_product']);
					$obj->cover = intval($productsImagesArray[$productViewed]['id_product']).'-'.intval($productsImagesArray[$productViewed]['id_image']);
					$obj->legend = $productsImagesArray[$productViewed]['legend'];
					$obj->name = $productsImagesArray[$productViewed]['name'];
					$obj->description_short = $productsImagesArray[$productViewed]['description_short'];
					$obj->link_rewrite = $productsImagesArray[$productViewed]['link_rewrite'];
					$obj->category_rewrite = $productsImagesArray[$productViewed]['category_rewrite'];

					if (!isset($obj->cover))
					{
						$obj->cover = $defaultCover;
						$obj->legend = '';
					}
					$productsViewedObj[] = $obj;
				}
			}

			if ($id_product AND !in_array($id_product, $productsViewed))
			{
				// Check if the user to the right of access to this product
				$result = Db::getInstance()->getRow('
				SELECT COUNT(cug.`id_customer`) AS total
				FROM `'._DB_PREFIX_.'product` p
				LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_product` = p.`id_product`)
				LEFT JOIN `'._DB_PREFIX_.'category_group` cg ON (cg.`id_category` = cp.`id_category`)
				LEFT JOIN `'._DB_PREFIX_.'customer_group` cug ON (cug.`id_group` = cg.`id_group`)
				WHERE p.`id_product` = '.intval($id_product).'
				'.($cookie->id_customer ? 'AND cug.`id_customer` = '.intval($cookie->id_customer) : 
				'AND cg.`id_group` = 1')
				);
				if ($result['total'])
					array_unshift($productsViewed, $id_product);
			}
			$viewed = '';
			foreach ($productsViewed AS $id_product_viewed)
				$viewed .= intval($id_product_viewed).',';
			$params['cookie']->viewed = rtrim($viewed, ',');

			if (!sizeof($productsViewedObj))
				return ;

			$smarty->assign(array(
				'productsViewedObj' => $productsViewedObj,
				'mediumSize' => Image::getSize('medium')));

			return $this->display(__FILE__, 'blockviewed.tpl');
		}
		elseif ($id_product)
			$params['cookie']->viewed = intval($id_product);
		return ;
	}

	function hookLeftColumn($params)
	{
		return $this->hookRightColumn($params);
	}

}
