<?php
/**
 * プラグイン設定
 *
 * @package BUDGoogUA
 * @version 1.0.0
 */
require_once PLUGIN_UPLOAD_REALDIR . 'BUDGoogUA/LC_Page_Plugin_BUDGoogUA_Config.php';
$objPage = new LC_Page_Plugin_BUDGoogUA_Config();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
?>