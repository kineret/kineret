<?php

$currentDir = dirname(__FILE__);

/* Base and themes */
define('_THEMES_DIR_',     __PS_BASE_URI__.'themes/');
define('_THEME_IMG_DIR_',  _THEMES_DIR_._THEME_NAME_.'/img/');
define('_THEME_CSS_DIR_',  _THEMES_DIR_._THEME_NAME_.'/css/');
define('_THEME_JS_DIR_',   _THEMES_DIR_._THEME_NAME_.'/js/');
define('_THEME_CAT_DIR_',  __PS_BASE_URI__.'img/c/');
define('_THEME_PROD_DIR_', __PS_BASE_URI__.'img/p/');
define('_THEME_PROD_PIC_DIR_', __PS_BASE_URI__.'upload/');
define('_THEME_MANU_DIR_', __PS_BASE_URI__.'img/m/');
define('_THEME_SCENE_DIR_', __PS_BASE_URI__.'img/scenes/');
define('_THEME_SCENE_THUMB_DIR_', __PS_BASE_URI__.'img/scenes/thumbs');
define('_THEME_SUP_DIR_',  __PS_BASE_URI__.'img/su/');
define('_THEME_SHIP_DIR_', __PS_BASE_URI__.'img/s/');
define('_THEME_LANG_DIR_', __PS_BASE_URI__.'img/l/');
define('_THEME_COL_DIR_',  __PS_BASE_URI__.'img/co/');
define('_SUPP_DIR_',       __PS_BASE_URI__.'img/su/');
define('_THEME_DIR_',      _THEMES_DIR_._THEME_NAME_.'/');
define('_MAIL_DIR_',        __PS_BASE_URI__.'mails/');
define('_MODULE_DIR_',        __PS_BASE_URI__.'modules/');
define('_PS_IMG_',         __PS_BASE_URI__.'img/');
define('_PS_ADMIN_IMG_',   _PS_IMG_.'admin/');

/* Directories */
define('_PS_ROOT_DIR_',             realpath($currentDir.'/..'));
define('_PS_CLASS_DIR_',            _PS_ROOT_DIR_.'/classes/');
define('_PS_TRANSLATIONS_DIR_',     _PS_ROOT_DIR_.'/translations/');
define('_PS_DOWNLOAD_DIR_',         _PS_ROOT_DIR_.'/download/');
define('_PS_MAIL_DIR_',             _PS_ROOT_DIR_.'/mails/');
define('_PS_ALL_THEMES_DIR_',       _PS_ROOT_DIR_.'/themes/');
define('_PS_THEME_DIR_',            _PS_ROOT_DIR_.'/themes/'._THEME_NAME_.'/');
define('_PS_IMG_DIR_',              _PS_ROOT_DIR_.'/img/');
define('_PS_CAT_IMG_DIR_',          _PS_IMG_DIR_.'c/');
define('_PS_PROD_IMG_DIR_',         _PS_IMG_DIR_.'p/');
define('_PS_SCENE_IMG_DIR_',        _PS_IMG_DIR_.'scenes/');
define('_PS_SCENE_THUMB_IMG_DIR_',  _PS_IMG_DIR_.'scenes/thumbs/');
define('_PS_MANU_IMG_DIR_',         _PS_IMG_DIR_.'m/');
define('_PS_SHIP_IMG_DIR_',         _PS_IMG_DIR_.'s/');
define('_PS_SUPP_IMG_DIR_',         _PS_IMG_DIR_.'su/');
define('_PS_COL_IMG_DIR_',			_PS_IMG_DIR_.'co/');
define('_PS_TMP_IMG_DIR_',          _PS_IMG_DIR_.'tmp/');
define('_PS_PROD_PIC_DIR_',			_PS_ROOT_DIR_.'/upload/');
define('_PS_TOOL_DIR_',             _PS_ROOT_DIR_.'/tools/');
define('_PS_SMARTY_DIR_',           _PS_TOOL_DIR_.'smarty/');
define('_PS_STEST_DIR_',            _PS_TOOL_DIR_.'simpletest/');
define('_PS_SWIFT_DIR_',            _PS_TOOL_DIR_.'swift/');
define('_PS_FPDF_PATH_',            _PS_TOOL_DIR_.'fpdf/');
define('_PS_PEAR_XML_PARSER_PATH_', _PS_TOOL_DIR_.'pear_xml_parser/');
define('_PS_CSS_DIR_',              __PS_BASE_URI__.'css/');
define('_PS_JS_DIR_',               __PS_BASE_URI__.'js/');

/* settings php */
define('_PS_TRANS_PATTERN_',            '(.*[^\\\\])');
define('_PS_MIN_TIME_GENERATE_PASSWD_', '360');

if (!defined('PHP_VERSION_ID')) 
{
    $version = explode('.', PHP_VERSION);
    define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}

define('_CAN_LOAD_FILES_', 1);

/* Order states */
define('_PS_OS_CHEQUE_',      1);
define('_PS_OS_PAYMENT_',     2);
define('_PS_OS_PREPARATION_', 3);
define('_PS_OS_SHIPPING_',    4);
define('_PS_OS_DELIVERED_',   5);
define('_PS_OS_CANCELED_',    6);
define('_PS_OS_REFUND_',      7);
define('_PS_OS_ERROR_',       8);
define('_PS_OS_OUTOFSTOCK_',  9);
define('_PS_OS_BANKWIRE_',    10);
define('_PS_OS_PAYPAL_',      11);

/* Tax behavior */
define('PS_PRODUCT_TAX', 0);
define('PS_STATE_TAX', 1);
define('PS_BOTH_TAX', 2);

define('_PS_PRICE_DISPLAY_PRECISION_', 2);
define('PS_TAX_EXC', 1);
define('PS_TAX_INC', 0);

define('PS_ROUND_UP', 0);
define('PS_ROUND_DOWN', 1);
define('PS_ROUND_HALF', 2);
