<?php

/**
  * Carriers tab for admin panel, AdminCarriers.php
  * @category admin
  *
  * @author PrestaShop <support@prestashop.com>
  * @copyright PrestaShop
  * @license http://www.opensource.org/licenses/osl-3.0.php Open-source licence 3.0
  * @version 1.3
  *
  */

include_once(PS_ADMIN_DIR.'/../classes/AdminTab.php');

class AdminCarriers extends AdminTab
{
	protected $maxImageSize = 30000;

	public function __construct()
	{
		global $cookie;

	 	$this->table = 'carrier';
	 	$this->className = 'Carrier';
	 	$this->lang = true;
	 	$this->edit = true;
	 	$this->delete = true;
	 	$this->deleted = true;
 		$this->fieldImageSettings = array('name' => 'logo', 'dir' => 's');

		$this->fieldsDisplay = array(
		'id_carrier' => array('title' => $this->l('ID'), 'align' => 'center', 'width' => 25),
		'name' => array('title' => $this->l('Name'), 'width' => 100),
		'logo' => array('title' => $this->l('Logo'), 'align' => 'center', 'image' => 's', 'orderby' => false, 'search' => false),
		'delay' => array('title' => $this->l('Delay'), 'width' => 300, 'orderby' => false),
		'active' => array('title' => $this->l('Status'), 'align' => 'center', 'active' => 'status', 'type' => 'bool', 'orderby' => false));

		$this->optionTitle = $this->l('Carrier options');
		$this->_fieldsOptions = array(
			'PS_CARRIER_DEFAULT' => array('title' => $this->l('Default carrier:'), 'desc' => $this->l('The default carrier used in shop'), 'cast' => 'intval', 'type' => 'select', 'identifier' => 'id_carrier', 'list' => Carrier::getCarriers(intval($cookie->id_lang), true)),
		);

		parent::__construct();
	}

	public function displayForm($isMainTab = true)
	{
		global $currentIndex, $cookie;
		parent::displayForm();

		$obj = $this->loadObject(true);
		$currentLanguage = intval($cookie->id_lang);

		echo '
		<form action="'.$currentIndex.'&submitAdd'.$this->table.'=1&token='.$this->token.'" method="post" enctype="multipart/form-data">
		'.($obj->id ? '<input type="hidden" name="id_'.$this->table.'" value="'.$obj->id.'" />' : '').'
			<fieldset class="width3"><legend><img src="../img/admin/delivery.gif" />'.$this->l('Carriers').'</legend>
				<label>'.$this->l('Company:').' </label>
				<div class="margin-form">
					<input type="text" size="25" name="name" value="'.htmlentities($this->getFieldValue($obj, 'name'), ENT_COMPAT, 'UTF-8').'" /> <sup>*</sup>
					<span class="hint" name="help_box">'.$this->l('Allowed characters: letters, spaces and').' ().-<span class="hint-pointer">&nbsp;</span></span>
					<p class="clear">'.$this->l('Carrier name displayed during checkout').'<br />'.$this->l('With a value of 0, the carrier name will be replaced by the shop name').'</p>
				</div>
				<label>'.$this->l('Logo:').' </label>
				<div class="margin-form">
					<input type="file" name="logo" />
					<p>'.$this->l('Upload logo from your computer').' (.gif, .jpg, .jpeg '.$this->l('or').' .png)</p>
				</div>
				<label>'.$this->l('Transit time:').' </label>
				<div class="margin-form">';
				foreach ($this->_languages as $language)
					echo '
					<div id="delay_'.$language['id_lang'].'" style="display: '.($language['id_lang'] == $this->_defaultFormLanguage ? 'block' : 'none').'; float: left;">
						<input type="text" size="41" maxlength="128" name="delay_'.$language['id_lang'].'" value="'.htmlentities($this->getFieldValue($obj, 'delay', intval($language['id_lang'])), ENT_COMPAT, 'UTF-8').'" /> <sup>*</sup>
					</div>';
				$this->displayFlags($this->_languages, $this->_defaultFormLanguage, 'delay', 'delay');
				echo '
					<p style="clear: both">'.$this->l('Time taken for product delivery; displayed during checkout').'</p>
				</div>
				<label>'.$this->l('URL:').' </label>
				<div class="margin-form">
					<input type="text" size="40" name="url" value="'.htmlentities($this->getFieldValue($obj, 'url'), ENT_COMPAT, 'UTF-8').'" />
					<p class="clear">'.$this->l('URL for the tracking number; type \'@\' where the tracking number will appear').'</p>
				</div>
				<label>'.$this->l('Tax:').'</label>
				<div class="margin-form">
					<select name="id_tax">
						<option value="0"'.(($obj->id AND $obj->id_tax == 0) ? ' selected="selected"' : '').'>'.$this->l('No tax').'</option>';
						$tvaList = Tax::getTaxes($currentLanguage);
						foreach ($tvaList AS $line)
							echo '<option value="'.$line['id_tax'].'"'.(($obj->id AND $obj->id_tax == $line['id_tax']) ? ' selected="selected"' : '').'>'.$line['name'].'</option>';
					echo '</select>
					<p>'.$this->l('Include tax on carrier, e.g., VAT').'</p>
				</div>
				<label>'.$this->l('Zone:').'</label>
				<div class="margin-form">';
					$carrier_zones = $obj->getZones();
					$zones = Zone::getZones(true);
					foreach ($zones AS $zone)
						echo '<input type="checkbox" id="zone_'.$zone['id_zone'].'" name="zone_'.$zone['id_zone'].'" value="true" '.(Tools::getValue('zone_'.$zone['id_zone'], (is_array($carrier_zones) AND in_array(array('id_carrier' => $obj->id, 'id_zone' => $zone['id_zone']), $carrier_zones))) ? ' checked="checked"' : '').'><label class="t" for="zone_'.$zone['id_zone'].'">&nbsp;<b>'.$zone['name'].'</b></label><br />';
				echo '<p>'.$this->l('The zone in which this carrier is to be used').'</p>
	</div>
				<label>'.$this->l('Group access:').'</label>
				<div class="margin-form">';
					$groups = Group::getGroups(intval($cookie->id_lang));
					if (sizeof($groups))
					{
						echo '
					<table cellspacing="0" cellpadding="0" class="table" style="width: 28em;">
						<tr>
							<th><input type="checkbox" name="checkme" class="noborder" onclick="checkDelBoxes(this.form, \'groupBox[]\', this.checked)"'.(!isset($obj->id) ? 'checked="checked" ' : '').' /></th>
							<th>'.$this->l('ID').'</th>
							<th>'.$this->l('Group name').'</th>
						</tr>';
						$irow = 0;
						foreach ($groups as $group)
							echo '
							<tr class="'.($irow++ % 2 ? 'alt_row' : '').'">
								<td><input type="checkbox" name="groupBox[]" class="groupBox" id="groupBox_'.$group['id_group'].'" value="'.$group['id_group'].'" '.((Db::getInstance()->getValue('SELECT id_group FROM '._DB_PREFIX_.'carrier_group WHERE id_carrier='.intval($obj->id).' AND id_group='.intval($group['id_group'])) OR (!isset($obj->id))) ? 'checked="checked" ' : '').'/></td>
								<td>'.$group['id_group'].'</td>
								<td><label for="groupBox_'.$group['id_group'].'" class="t">'.$group['name'].'</label></td>
							</tr>';
						echo '
					</table>
					<p style="padding:0px; margin:10px 0px 10px 0px;">'.$this->l('Mark all groups you want to give access to this carrier').'</p>
					';
					}
					else
						echo '<p>'.$this->l('No group created').'</p>';
					echo '				</div>
				<label>'.$this->l('Status:').' </label>
				<div class="margin-form">
					<input type="radio" name="active" id="active_on" value="1" '.($this->getFieldValue($obj, 'active') ? 'checked="checked" ' : '').'/>
					<label class="t" for="active_on"> <img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="active" id="active_off" value="0" '.(!$this->getFieldValue($obj, 'active') ? 'checked="checked" ' : '').'/>
					<label class="t" for="active_off"> <img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
					<p>'.$this->l('Include or exclude carrier from list of carriers on Front Office').'</p>
				</div>
				<label>'.$this->l('Shipping & handling:').' </label>
				<div class="margin-form">
					<input type="radio" name="shipping_handling" id="shipping_handling_on" value="1" '.($this->getFieldValue($obj, 'shipping_handling') ? 'checked="checked" ' : '').'/>
					<label class="t" for="shipping_handling_on"> <img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="shipping_handling" id="shipping_handling_off" value="0" '.(!$this->getFieldValue($obj, 'shipping_handling') ? 'checked="checked" ' : '').'/>
					<label class="t" for="shipping_handling_off"> <img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
					<p>'.$this->l('Include the shipping & handling costs in carrier price').'</p>
				</div>
				<label>'.$this->l('Out-of-range behavior:').' </label>
				<div class="margin-form">
					<select name="range_behavior">
						<option value="0"'.(!$this->getFieldValue($obj, 'range_behavior') ? ' selected="selected"' : '').'>'.$this->l('Apply the cost of the highest defined range').'</option>
						<option value="1"'.($this->getFieldValue($obj, 'range_behavior') ? ' selected="selected"' : '').'>'.$this->l('Disable carrier').'</option>
					</select>
					<p>'.$this->l('Out-of-range behavior when none is defined (e.g., when a customer\'s cart weight is superior to the highest range limit)').'</p>
				</div>
				<label>'.$this->l('Module:').' </label>
				<div class="margin-form">
					<input type="radio" name="is_module" id="active_on" value="1" '.($this->getFieldValue($obj, 'is_module') ? 'checked="checked" ' : '').'/>
					<label class="t" for="active_on"> <img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="is_module" id="active_off" value="0" '.(!$this->getFieldValue($obj, 'is_module') ? 'checked="checked" ' : '').'/>
					<label class="t" for="active_off"> <img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
					<p>'.$this->l('Mark this carrier as linked to a module').'</p>
				</div>
				<div class="margin-form">
					<input type="submit" value="'.$this->l('   Save   ').'" name="submitAdd'.$this->table.'" class="button" />
				</div>
				<div class="small"><sup>*</sup> '.$this->l('Required field').'</div>
			</fieldset>
		</form>';
	}

	public function beforeDelete($object)
	{
		return $object->isUsed();
	}

	public function afterDelete($object, $oldId)
	{
		$object->copyCarrierData(intval($oldId));
	}

	private function changeGroups($id_carrier, $delete = true)
	{
		if ($delete)
			Db::getInstance()->Execute('DELETE FROM '._DB_PREFIX_.'carrier_group WHERE id_carrier='.intval($id_carrier));
		$groups = Db::getInstance()->ExecuteS('SELECT id_group FROM `'._DB_PREFIX_.'group`');
		foreach ($groups as $group)
			if (in_array($group['id_group'], $_POST['groupBox']))
				Db::getInstance()->Execute('INSERT INTO '._DB_PREFIX_.'carrier_group (id_group, id_carrier) VALUES('.intval($group['id_group']).','.intval($id_carrier).')');
	}

	public function postProcess()
	{
		global $currentIndex;

		if (Tools::getValue('submitAdd'.$this->table))
		{
		 	/* Checking fields validity */
			$this->validateRules();
			if (!sizeof($this->_errors))
			{
				$id = intval(Tools::getValue('id_'.$this->table));

				/* Object update */
				if (isset($id) AND !empty($id))
				{
					if ($this->tabAccess['edit'] === '1')
					{
						$object = new $this->className($id);
						if (Validate::isLoadedObject($object))
						{
							Db::getInstance()->Execute('DELETE FROM '._DB_PREFIX_.'carrier_group WHERE id_carrier='.intval($id));
							$object->deleted = 1;
							$object->update();
							$objectNew = new $this->className();
							$this->copyFromPost($objectNew, $this->table);
							$result = $objectNew->add();
							if (Validate::isLoadedObject($objectNew))
							{
								$this->afterDelete($objectNew, $object->id);
								Hook::updateCarrier(intval($object->id), $objectNew);
							}
							$this->changeGroups($objectNew->id);
							if (!$result)
								$this->_errors[] = Tools::displayError('an error occurred while updating object').' <b>'.$this->table.'</b>';
							elseif ($this->postImage($objectNew->id))
								{
									$this->changeZones($objectNew->id);
									Tools::redirectAdmin($currentIndex.'&id_'.$this->table.'='.$object->id.'&conf=4'.'&token='.$this->token);
								}
						}
						else
							$this->_errors[] = Tools::displayError('an error occurred while updating object').' <b>'.$this->table.'</b> '.Tools::displayError('(cannot load object)');
					}
					else
						$this->_errors[] = Tools::displayError('You do not have permission to edit anything here.');
				}

				/* Object creation */
				else
				{
					if ($this->tabAccess['add'] === '1')
					{
						$object = new $this->className();
						$this->copyFromPost($object, $this->table);
						if (!$object->add())
							$this->_errors[] = Tools::displayError('an error occurred while creating object').' <b>'.$this->table.'</b>';
						elseif (($_POST['id_'.$this->table] = $object->id /* voluntary */) AND $this->postImage($object->id) AND $this->_redirect)
						{
							$this->changeZones($object->id);
							$this->changeGroups($object->id);
							Tools::redirectAdmin($currentIndex.'&id_'.$this->table.'='.$object->id.'&conf=3'.'&token='.$this->token);
						}
					}
					else
						$this->_errors[] = Tools::displayError('You do not have permission to add anything here.');
				}
			}
		}
		else
		{
			if ((Tools::isSubmit('submitDel'.$this->table) && in_array(Configuration::get('PS_CARRIER_DEFAULT'), Tools::getValue('carrierBox')))
				OR (isset($_GET['delete'.$this->table]) AND Tools::getValue('id_carrier') == Configuration::get('PS_CARRIER_DEFAULT')))
					$this->_errors[] = $this->l('Please set another carrier as default before deleting');
			else
				parent::postProcess();
		}
	}


	function changeZones($id)
	{
		$carrier = new $this->className($id);
		if (!Validate::isLoadedObject($carrier))
			die (Tools::displayError('object cannot be loaded'));
		$zones = Zone::getZones(true);
		foreach ($zones as $zone)
			if (sizeof($carrier->getZone($zone['id_zone'])))
			{
				if (!isset($_POST['zone_'.$zone['id_zone']]) OR !$_POST['zone_'.$zone['id_zone']])
					$carrier->deleteZone($zone['id_zone']);
			}
			else
				if (isset($_POST['zone_'.$zone['id_zone']]) AND $_POST['zone_'.$zone['id_zone']])
					$carrier->addZone($zone['id_zone']);
	}

	public function displayListContent($token = NULL)
	{
		foreach ($this->_list as $key => $list)
			if ($list['name'] == '0')
				$this->_list[$key]['name'] = Configuration::get('PS_SHOP_NAME');
		parent::displayListContent($token);
	}
}

?>
