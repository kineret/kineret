<?php

/**
  * Admin panel header, header.inc.php
  * @category admin
  *
  * @author PrestaShop <support@prestashop.com>
  * @copyright PrestaShop
  * @license http://www.opensource.org/licenses/osl-3.0.php Open-source licence 3.0
  * @version 1.3
  *
  */

// P3P Policies (http://www.w3.org/TR/2002/REC-P3P-20020416/#compact_policies)
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0'); // HTTP/1.1
header('Pragma: no-cache');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

require_once(dirname(__FILE__).'/init.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $iso; ?>" lang="<?php echo $iso; ?>">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link type="text/css" rel="stylesheet" href="../js/jquery/datepicker/datepicker.css" />
		<link type="text/css" rel="stylesheet" href="../modules/gridextjs/extjs/resources/css/ext-all.css" />
		<link type="text/css" rel="stylesheet" href="../css/admin.css" />
		<title>PrestaShop&trade; - <?php echo translate('Administration panel') ?></title>
		<script type="text/javascript">
			var helpboxes = <?php echo Configuration::get('PS_HELPBOX'); ?>;
			var roundMode = <?php echo Configuration::get('PS_PRICE_ROUND_MODE'); ?>;
		</script>
		<script type="text/javascript" src="<?php echo _PS_JS_DIR_ ?>jquery/jquery-1.2.6.pack.js"></script>
		<script type="text/javascript" src="../js/admin.js"></script>
		<script type="text/javascript" src="../js/toggle.js"></script>
		<script type="text/javascript" src="../js/tools.js"></script>
		<script type="text/javascript" src="../js/ajax.js"></script>
		<link rel="shortcut icon" href="../img/favicon.ico" />
		<?php echo Module::hookExec('backOfficeHeader'); ?>
		<!--[if IE]>
		<style type="text/css">
		fieldset {
			position: relative;
			padding-top: 25px;
		}
		legend {
			position: absolute;
			top: -0.5em;
			left: 1.1em;
		}
		</style>
		<![endif]--> 
	</head>
	<body>
		<div id="container">
			<div style="float:left;margin-top:11px">
				<form action="index.php?tab=AdminSearch&token=<?php echo Tools::getAdminToken('AdminSearch'.intval(Tab::getIdFromClassName('AdminSearch')).intval($cookie->id_employee)) ?>" method="post">
					<input type="text" name="bo_query" id="bo_query" style="width:140px" value="<?php echo Tools::htmlentitiesUTF8(Tools::getValue('bo_query')); ?>" />
					<select name="bo_search_type" id="bo_search_type" style="font-size:1em">
					<?php
						$options = array(1 => translate('catalog'), 2 => translate('customers'), 3 => translate('orders'), 4 => translate('invoices'), 5 => translate('carts'));
						echo '<option value="0">'.translate('everywhere').'</option>';
						foreach ($options as $optionId => $optionTranslation)
							echo '<option value="'.$optionId.'" '.((int)Tools::getValue('bo_search_type') == $optionId ? 'selected="selected"' : '').'>'.$optionTranslation.'</option>';
						echo '</select>&nbsp;
						<input type="submit" name="bo_search" value="'.translate('Search').'" class="button" />';
					?>
				</form>
			</div>
			<div style="float:left;margin:11px 0px 0px 50px" id="flagsLanguage">
				<div>
				<?php
				$link = new Link();
				$languages = Language::getLanguages();
				$i = 0;
				if (sizeof($languages) != 1)
					foreach ($languages AS $language)
					{
						echo '<a href="'.$link->getLanguageLinkAdmin($language['id_lang'], $language['name']).'&adminlang=1"><img src="'._PS_IMG_.'l/'.$language['id_lang'].'.jpg" alt="'.strtoupper($language['iso_code']).'" title="'.$language['name'].'" '.($language['id_lang'] == $cookie->id_lang ? 'class="selected_language"' : '').' /></a> ';
						if ($i == 4)
							echo '</div><div style="margin-top:5px;">';
						$i++;
					}
				?>
				</div>
			</div>
			<script type="text/javascript">$('#flagsLanguage img[class!=selected_language]').css('opacity', '0.3')</script>
			<div style="float: right; margin: 11px 0px 0px 20px; text-align:right;">
				<img src="../img/admin/quick.gif" style="margin-top:5px;" />&nbsp;
				<script type="text/javascript">
				function quickSelect(elt)
				{
					var eltVal = $(elt).val();
					if (eltVal == '0') return false;
					else if (eltVal.substr(eltVal.length - 6) == '_blank')
						window.open(eltVal.substr(0, eltVal.length - 6), '_blank');
					else location.href = eltVal;
				}
				</script>
				<select onchange="quickSelect(this);" style="font-size: 1em; margin:5px 20px 0px 0px;">
					<?php
						$quicks = QuickAccess::getQuickAccesses(intval($cookie->id_lang)); 
						echo '<option value="0">'.translate('Quick access').'</option>';
						foreach ($quicks AS &$quick)
						{
							preg_match('/tab=(.+)(&.+)?$/', $quick['link'], $adminTab);
							if (isset($adminTab[1]))
							{
								if (strpos($adminTab[1], '&'))
									$adminTab[1] = substr($adminTab[1], 0, strpos($adminTab[1], '&'));
								$quick['link'] .= '&token='.Tools::getAdminToken($adminTab[1].intval(Tab::getIdFromClassName($adminTab[1])).intval($cookie->id_employee));
							}
							echo '<option value="'.$quick['link'].($quick['new_window'] ? '_blank' : '').'">&gt; '.Category::hideCategoryPosition($quick['name']).'</option>';
						}
					?>
				</select>
				<img src="../img/admin/nav-user.gif" alt="<?php echo translate('user') ?>" />&nbsp;
				<a href="index.php?logout" title="<?php echo translate('logout') ?>">
					<b><?php echo Tools::substr($cookie->firstname, 0, 1).'.&nbsp;'.htmlentities($cookie->lastname, ENT_COMPAT, 'UTF-8'); ?></b>
					<img src="../img/admin/nav-logout.gif" alt="<?php echo translate('logout') ?>" />
				</a>
			</div>
			<br style="clear:both;" />
			<?php echo Module::hookExec('backOfficeTop'); ?>
			<ul id="menu" style="margin-top:20px">
				<?php
					global $cookie;

					/* Get current tab informations */
					$id_parent_tab_current = intval(Tab::getCurrentParentId());
					$tabs = Tab::getTabs(intval($cookie->id_lang), 0);
					foreach ($tabs AS $t)
					{
						if ($t['class_name'] == $tab)
							$id_parent = $t['id_tab'];
						if (checkTabRights($t['id_tab']) === true)
						{
							$img = '../img/t/'.$t['class_name'].'.gif';
							if (trim($t['module']) != '')
								$img = _MODULE_DIR_.$t['module'].'/'.$t['class_name'].'.gif';
							echo '
							<li'.((($t['class_name'] == $tab) OR ($id_parent_tab_current == $t['id_tab'])) ? ' class="active"' : '').'>
								<a href="index.php?tab='.$t['class_name'].'&token='.Tools::getAdminToken($t['class_name'].intval($t['id_tab']).intval($cookie->id_employee)).'"><img src="'.$img.'" alt="" style="width:16px;height:16px" /> '.$t['name'].'</a>
							</li>';
						}
					}
				?>
			</ul>
			<div id="main">
				<ul id="submenu">
				<?php
					global $cookie;

					/* Display tabs belonging to opened tab */
					$id_parent = isset($id_parent) ? $id_parent : $id_parent_tab_current;
					if (isset($id_parent) AND $id_parent != -1)
					{
					 	$subTabs = Tab::getTabs(intval($cookie->id_lang), intval($id_parent));
						foreach ($subTabs AS $t)
							if (checkTabRights($t['id_tab']) === true)
							{
								$img = '../img/t/'.$t['class_name'].'.gif';
								if (trim($t['module']) != '')
									$img = _MODULE_DIR_.$t['module'].'/'.$t['class_name'].'.gif';
								echo '
								<li>
									<a href="index.php?tab='.$t['class_name'].'&token='.Tools::getAdminToken($t['class_name'].intval($t['id_tab']).intval($cookie->id_employee)).'"><img src="'.$img.'" alt="" style="width:16px;height:16px" /></a> <a href="index.php?tab='.$t['class_name'].'&token='.Tools::getAdminToken($t['class_name'].intval($t['id_tab']).intval($cookie->id_employee)).'">'.$t['name'].'</a>
								</li>';
							}
					}
				?>
				</ul>
				<div id="content">
