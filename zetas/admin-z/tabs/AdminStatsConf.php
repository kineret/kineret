<?php

/**
  * Statistics
  * @category stats
  *
  * @author Damien Metzger / Epitech
  * @copyright Epitech / PrestaShop
  * @license http://www.opensource.org/licenses/osl-3.0.php Open-source licence 3.0
  * @version 1.2
  */
  
include_once(dirname(__FILE__).'/AdminStatsTab.php');
include_once(PS_ADMIN_DIR.'/tabs/AdminPreferences.php');

class AdminStatsConf extends AdminPreferences
{
	public function __construct()
	{
 		$this->_fieldsSettings = array(
			'PS_STATS_RENDER' => array('title' => $this->l('Graph engine'), 'validation' => 'isGenericName'),
			'PS_STATS_GRID_RENDER' => array('title' => $this->l('Grid engine'),	'validation' => 'isGenericName'),
			'PS_STATS_OLD_CONNECT_AUTO_CLEAN' => array( 'title' => $this->l('Auto-clean period'), 'validation' => 'isGenericName'));
		parent::__construct();
	}
	
	public function postProcess()
	{
		if (Tools::getValue('submitSettings'))
		{
		 	if ($this->tabAccess['edit'] === '1')
				$this->_postConfig($this->_fieldsSettings);
			else
				$this->_errors[] = Tools::displayError('You do not have permission to edit something here.');
		}
	}
	
	public function display()
	{
		global $currentIndex, $cookie;
		
		$graphEngine = Configuration::get('PS_STATS_RENDER');
		$gridEngine = Configuration::get('PS_STATS_GRID_RENDER');
		$autoclean = Configuration::get('PS_STATS_OLD_CONNECT_AUTO_CLEAN');
		$arrayGraphEngines = ModuleGraphEngine::getGraphEngines();
		$arrayGridEngines = ModuleGridEngine::getGridEngines();
		$autocleanPeriod = array('never' => $this->l('Never'),
			'week' => $this->l('Week'),
			'month' => $this->l('Month'),
			'year' => $this->l('Year'));
		
		echo '<form action="'.$currentIndex.'&token='.$this->token.'&submitSettings=1" method="post">
			<fieldset><legend><img src="../img/admin/tab-preferences.gif" />'.$this->l('Settings').'</legend>';
				
		#Graph Engines
		echo '<label class="clear">'.$this->l('Graph engine').': </label><div class="margin-form">';
		if (sizeof($arrayGraphEngines))
		{
			foreach ($arrayGraphEngines as $k => $value)
				echo '<div id="sgraphcontent_'.$k.'">'.$value[1].'</div><script language="javascript">getE(\'sgraphcontent_'.$k.'\').style.display = \'none\';</script>';
			echo '<div style="float: left"><select name="PS_STATS_RENDER">';
			foreach ($arrayGraphEngines as $k => $value)
				echo '<option value="'.$k.'"'.($k == $graphEngine ? ' selected="selected"' : '').' onclick="getE(\'render_graph_content\').innerHTML = getE(\'sgraphcontent_'.$k.'\').innerHTML;">'.$value[0].'</option>';
			echo '</select></div>
			<div id="render_graph_content" style="float:left;margin-left:20px;width:400px;">'.$arrayGraphEngines[$graphEngine][1].'</div>
			<div class="clear"></div>';
		}
		else
			echo $this->l('No graph engine module installed');
		echo '</div>';
			
		#Grid Engines
		echo '<label class="clear">'.$this->l('Grid engine').': </label><div class="margin-form">';
		if (sizeof($arrayGridEngines))
		{
			foreach ($arrayGridEngines as $k => $value)
				echo '<div id="sgridcontent_'.$k.'">'.$value[1].'	</div><script language="javascript">getE(\'sgridcontent_'.$k.'\').style.display = \'none\';</script>';
			echo '<div style="float: left"><select name="PS_STATS_GRID_RENDER">';
			foreach ($arrayGridEngines as $k => $value)
				echo '<option value="'.$k.'"'.($k == $gridEngine ? ' selected="selected"' : '').' onclick="getE(\'render_grid_content\').innerHTML = getE(\'sgridcontent_'.$k.'\').innerHTML;">'.$value[0].'</option>';
			echo '</select></div>
			<div id="render_grid_content" style="float:left;margin-left:20px;width:400px;">'.$arrayGridEngines[$gridEngine][1].'</div>
			<div class="clear"></div>';
		}
		else
			echo $this->l('No grid engine module installed');
		echo '</div>';
		
		echo '<label class="clear">'.$this->l('Clean automatically').': </label>
				<div class="margin-form">
					<select id="PS_STATS_OLD_CONNECT_AUTO_CLEAN" name="PS_STATS_OLD_CONNECT_AUTO_CLEAN">';
		foreach ($autocleanPeriod as $k => $value)
			echo '		<option value="'.$k.'"'.($k == $autoclean ? ' selected="selected"' : '').'>'.$value.'&nbsp;</option>';
		echo '		</select>
				</div>';
				
		#End Of Form
		echo '<input type="submit" value="'.$this->l('   Save   ').'" name="submitSettings" class="button" />
			</fieldset>
		</form>';
	}
}

?>
