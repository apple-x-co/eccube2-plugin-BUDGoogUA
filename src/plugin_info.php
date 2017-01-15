<?php
/**
 * プラグイン情報
 *
 * @package BUDGoogUA
 * @version 1.0.0
 */
class plugin_info{
    static $PLUGIN_CODE       = "BUDGoogUA";
    static $PLUGIN_NAME       = "Google Universal Analytics";
    static $PLUGIN_VERSION    = "1.0.0";
    static $COMPLIANT_VERSION = "2.13.0+";
    static $AUTHOR            = "Buddying Inc.";
    static $DESCRIPTION       = "Google Universal Analyticsをページに挿入します";
    static $PLUGIN_SITE_URL   = "http://buddying.jp/eccube/plugins/2/BUDGoogUA/";
    static $AUTHOR_SITE_URL   = "http://buddying.jp/";
    static $CLASS_NAME        = "BUDGoogUA";
    static $HOOK_POINTS       = array(
            array('prefilterTransform', 'prefilterTransform')
    );
    static $LICENSE           = "LGPL";
}
?>