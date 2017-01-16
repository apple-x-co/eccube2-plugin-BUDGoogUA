<?php
/**
 * プラグインメイン
 *
 * @package BUDGoogUA
 * @version 1.0.0
 */

require_once PLUGIN_UPLOAD_REALDIR . 'BUDGoogUA/class/util/plg_BUDGoogUA_SC_Utils.php';

class BUDGoogUA extends SC_Plugin_Base {
	
	// プラグインのインストーラ
	// http://svn.ec-cube.net/open_trac/ticket/2181
	
	// 標準規約
	// http://svn.ec-cube.net/open_trac/wiki/EC-CUBE%E6%A8%99%E6%BA%96%E8%A6%8F%E7%B4%84
	
	const PLUGIN_TEMPLATES_PATH = 'BUDGoogUA/templates/';
	
	function install($arrPlugin, $objPluginInstaller = null) {
    	$objPluginInstaller->sql(plg_BUDGoogUA_SC_Utils::sfGetCreateTableDDL());
    }
    
    function uninstall($arrPlugin, $objPluginInstaller = null) {
    	$objPluginInstaller->sql(plg_BUDGoogUA_SC_Utils::sfGetDropTableDDL());
    }
    
    function prefilterTransform(&$source, LC_Page_Ex $objPage, $filename) {
    	if (strcmp($filename, SITE_FRAME) === 0) {
			$objTransform = new SC_Helper_Transform_Ex($source);
 			$objTransform->select('head', 0)->appendChild(file_get_contents(PLUGIN_UPLOAD_REALDIR . self::PLUGIN_TEMPLATES_PATH . 'plg_BUDGoogUA_header.tpl'));
 			$source = $objTransform->getHTML();
		}
	}
	
	function preProcess(LC_Page_Ex $objPage) {
		$objPage->plg_budgoogua_tracking_id = plg_BUDGoogUA_SC_Utils::sfGetTrackingID();
	}
}
?>