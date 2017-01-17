<?php
/*
 * This file is part of EC-CUBE
*
* Copyright(c) 2000-2011 LOCKON CO.,LTD. All Rights Reserved.
*
* http://www.lockon.co.jp/
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/

/**
 * プラグインメイン
 *
 * @package BUDGoogUA
 * @version $Id$
 */

require_once PLUGIN_UPLOAD_REALDIR . 'BUDGoogUA/class/util/plg_BUDGoogUA_SC_Utils.php';

class BUDGoogUA extends SC_Plugin_Base {
	
	// プラグインのインストーラ
	// http://svn.ec-cube.net/open_trac/ticket/2181
	
	// 標準規約
	// http://svn.ec-cube.net/open_trac/wiki/EC-CUBE%E6%A8%99%E6%BA%96%E8%A6%8F%E7%B4%84
	
	const PLUGIN_TEMPLATES_PATH = 'BUDGoogUA/templates/';
	
	function install($arrPlugin, $objPluginInstaller = null) {
		if (is_null($objPluginInstaller)) {
			plg_BUDGoogUA_SC_Utils::sfExecuteSQL(plg_BUDGoogUA_SC_Utils::sfGetCreateTableDDL());
			return;
		}
		
    	$objPluginInstaller->sql(plg_BUDGoogUA_SC_Utils::sfGetCreateTableDDL());
    }
    
    function uninstall($arrPlugin, $objPluginInstaller = null) {
    	if (is_null($objPluginInstaller)) {
			plg_BUDGoogUA_SC_Utils::sfExecuteSQL(plg_BUDGoogUA_SC_Utils::sfGetDropTableDDL());
    		return;
		}
		
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