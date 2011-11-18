<?php
include(dirname(__FILE__).'/../../config/config.inc.php');

function show_countries($id_lang, $nb_by_line = 7)
{
	if (!is_numeric($id_lang) || !is_numeric($nb_by_line))
		return ("error");

	$output = '<style type="text/css">.country{cursor: pointer;} .country:hover{text-decoration: underline;}</style>
			<script type="text/javascript">$(document).ready(_registerClickOnCountry);</script>';
	$result = Db::getInstance()->ExecuteS('SELECT cl.`id_country`, `name`, `iso_code` FROM `'._DB_PREFIX_.'country_lang` cl 
								LEFT JOIN `'._DB_PREFIX_.'country` c ON  c.`id_country` = cl.`id_country` 
								WHERE `id_lang` = \''.intval($id_lang).'\' ORDER BY `name` ASC;');
	$separator = 0;
	foreach ($result as $index => $row)
	{
		if ($separator)
			$output .= ($separator % $nb_by_line) ? ' | ' : '<br />';
		$output .= '<a class="country" id="'.$row['id_country'].'">'.$row['name'] . ' (' . $row['iso_code'] . ')</a>';
		$separator++;
	}
	return ($output);
}

function show_buttons($id_lang, $id_country)
{
	if (!is_numeric($id_lang) || !is_numeric($id_country))
		return ("error");
	$coord_x = -1;
	$coord_y = -1;
	$output = '<script type="text/javascript">$(document).ready(_registerClickButtons);</script>
	<span id="selectinfo" style="text-align: center;"></span> ';

	$result = Db::getInstance()->ExecuteS('SELECT cl.`id_country`, `name`, `iso_code`, `x`, `y` FROM `'._DB_PREFIX_.'country_lang` cl 
								LEFT JOIN `'._DB_PREFIX_.'country` c ON  c.`id_country` = cl.`id_country` 
								LEFT JOIN `'._DB_PREFIX_.'location_coords` lc ON  c.`id_country` = lc.`id_country` 
								WHERE `id_lang` = \''.intval($id_lang).'\' AND cl.`id_country`= \''.intval($id_country).'\';');
	if (isset($result[0]['id_country']))
	{
		$output .= $result[0]['name'].' ('.$result[0]['iso_code'].')';
		if (isset($result[0]['x']) && isset($result[0]['y']))
		{
			$coord_x = $result[0]['x'];
			$coord_y = $result[0]['y'];
		}
	}
	$output .= '<input type="hidden" id="hiddenx" value="'.$coord_x.'" />
			<input type="hidden" id="hiddeny" value="'.$coord_y.'" />
			<center><input type="button" id="cancel_id" class="button" value="Cancel" />	
			<input type="button" id="validate_id" class="button" value="Validate" /></center>';
	return ($output);
}

function insert_coords($id_lang, $id_country, $x, $y)
{
	if (!is_numeric($id_lang) || !is_numeric($id_country) || !is_numeric($x) || !is_numeric($y))
		return ("error");
	Db::getInstance()->Execute('DELETE FROM `'._DB_PREFIX_.'location_coords` WHERE `id_country` = \''.$id_country.'\';');
	if (!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'location_coords` (`x`, `y`, `id_country`) VALUES (\''.intval($x).'\', \''.intval($y).'\', \''.intval($id_country).'\');'))
		echo("error while inserting data<br />");
	return (show_countries($id_lang));
}


$option = Tools::getValue('opt', 0);
$id_lang = Tools::getValue('id_lang');
	
if ($option == 1)
{
	echo show_countries($id_lang);
}
else if ($option == 2)
{
	$id_country = Tools::getValue('id_country');
	echo show_buttons($id_lang, $id_country);
}
else if ($option == 3)
{
	$id_country = Tools::getValue('id_country');
	$x = Tools::getValue('x');
	$y = Tools::getValue('y');
	echo insert_coords($id_lang, $id_country, $x, $y);
}

?>
