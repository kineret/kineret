<?php

/**
  * Statistics
  * @category stats
  *
  * @author Damien Metzger / Epitech
  * @copyright Epitech / PrestaShop
  * @license http://www.opensource.org/licenses/osl-3.0.php Open-source licence 3.0
  * @version 1.1
  */
  
if (!isset($_POST['token']) OR !isset($_POST['type']))
	die;

include(dirname(__FILE__).'/config/config.inc.php');

if ($_POST['type'] == 'navinfo')
{
	if (sha1($_POST['id_guest']._COOKIE_KEY_) != $_POST['token'])
		die;

	$guest = new Guest((int)$_POST['id_guest']);
	$guest->javascript = true;
	$guest->screen_resolution_x = intval($_POST['screen_resolution_x']);
	$guest->screen_resolution_y = intval($_POST['screen_resolution_y']);
	$guest->screen_color = intval($_POST['screen_color']);
	$guest->sun_java = intval($_POST['sun_java']);
	$guest->adobe_flash = intval($_POST['adobe_flash']);
	$guest->adobe_director = intval($_POST['adobe_director']);
	$guest->apple_quicktime = intval($_POST['apple_quicktime']);
	$guest->real_player = intval($_POST['real_player']);
	$guest->windows_media = intval($_POST['windows_media']);
	$guest->update();
}
elseif ($_POST['type'] == 'pagetime')
{
	if (sha1($_POST['id_connections'].$_POST['id_page'].$_POST['time_start']._COOKIE_KEY_) != $_POST['token'])
		die;
	if (!Validate::isInt($_POST['time']) OR $_POST['time'] <= 0)
		die;
	Connection::setPageTime((int)$_POST['id_connections'], (int)$_POST['id_page'], substr($_POST['time_start'], 0, 19), intval($_POST['time']));
}

?>
