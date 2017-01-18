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
		if (plg_BUDGoogUA_SC_Utils::sfExistsTable()) {
			return;
		}
		self::executeSQL($objPluginInstaller, plg_BUDGoogUA_SC_Utils::sfGetCreateTableDDL());
    }
    
    function uninstall($arrPlugin, $objPluginInstaller = null) {
    	if (!plg_BUDGoogUA_SC_Utils::sfExistsTable()) {
    		return;
    	}
		self::executeSQL($objPluginInstaller, plg_BUDGoogUA_SC_Utils::sfGetDropTableDDL());
    }
    
    function enable($plugins) {
    	// nop
    }
    
    function disable($plugins) {
    	// nop
    }
    
    function prefilterTransform(&$source, LC_Page_Ex $objPage, $filename) {
    	if (strcmp($filename, SITE_FRAME) === 0) {
			$objTransform = new SC_Helper_Transform_Ex($source);
 			$objTransform->select('head', 0)->appendChild(file_get_contents(PLUGIN_UPLOAD_REALDIR . self::PLUGIN_TEMPLATES_PATH . 'plg_BUDGoogUA_header.tpl'));
 			$source = $objTransform->getHTML();
		}
		elseif (strcmp($filename, 'home.tpl') === 0) {
			$objTransform = new SC_Helper_Transform_Ex($source);
			$objTransform->select('#home')->appendFirst(file_get_contents(PLUGIN_UPLOAD_REALDIR . self::PLUGIN_TEMPLATES_PATH . 'plg_budgoogua_chart.tpl'));
 			$source = $objTransform->getHTML();
		}
    }
	
	function preProcess(LC_Page_Ex $objPage) {
		$objPage->plg_budgoogua_tracking_id = plg_BUDGoogUA_SC_Utils::sfGetTrackingID();
	}
	
	/**
	 * SQLの実行
	 *
	 * @access private
	 * @param SC_Plugin_Installer $objPluginInstaller
	 * @param string $sql
	 * @return なし
	 */
	private static function executeSQL($objPluginInstaller, $sql) {
		if (is_null($objPluginInstaller)) {
			plg_BUDGoogUA_SC_Utils::sfExecuteSQL($sql);
			return;
		}
		
		$objPluginInstaller->sql($sql);
	}
	
    /**
     * ホーム表示前
     * 
     * @param LC_Page_EX $objPage 
     * @return なし
     */
	function LC_Page_Admin_Home_action_after($objPage) {
		//$arrParam = $this->loadData($objPage);
		$arrParam = array('ga_id' => 'oak.sano@gmail.com', 'ga_pw' => 'D5iZQqRz');
		
		if (empty($arrParam['ga_id']) || empty($arrParam['ga_pw'])) {
			return false;
		}
		
		//require 'class/ext/gapi.class.php';
		require_once(dirname(__FILE__) . "/class/ext/gapi.class.php");
		
		try {
			$objGAClient = new gapi($arrParam['ga_id'] , $arrParam['ga_pw']);
		}
		catch (Exception $e) {
			$objPage->tpl_budgoogua_auth_error = true;
		};
		
// 		if (!empty($objGAClient)) {
// 			$ga_profile_id = $arrParam['ga_view'];
// 			$dimensions    = array('year','month','day');
// 			$metrics       = array('pageviews','visits', 'visitors', 'pageviews');
// 			$sort_metric   = array('year','month','day');
// 			$filter        = '';
// 			$start_date    = date("Y-m-01");
// 			$end_date      = date("Y-m-t");
// 			$start_index   = 1;
// 			$max_results   = 10000;
		
// 			$objGAClient->requestReportData(
// 					$ga_profile_id,
// 					$dimensions,
// 					$metrics,
// 					$sort_metric,
// 					$filter,
// 					$start_date,
// 					$end_date,
// 					$start_index,
// 					$max_results
// 			);
// 			$arrGoogleAnalyticsGraph = $objGAClient->getResults();
		
// 			/* 売上情報取得 */
// 			$objQuery = SC_Query_Ex::getSingletonInstance();
// 			$where    = ' del_flg = 0';
// 			$where   .= ' AND create_date >= ?';
// 			$where   .= ' AND create_date <= ?';
// 			$where   .= ' AND status <> ?';
		
// 			$arrWhereVal[] = $start_date;
// 			$arrWhereVal[] = $end_date;
// 			$arrWhereVal[] = ORDER_CANCEL;
		
// 			$objQuery->setGroupBy('str_date');
// 			$objQuery->setOrder('str_date');
		
// 			$dbFactory = SC_DB_DBFactory_Ex::getInstance();
// 			$col = $dbFactory->getOrderTotalDaysWhereSql('');
		
// 			$arrTotalResults = $objQuery->select($col, 'dtb_order', $where, $arrWhereVal);
// 			$arrTotalMerge = array();
		
// 			/* GA DATA and Salse Data Merge */
// 			foreach ($arrGoogleAnalyticsGraph as $row) {
// 				$strDate = $row->getYear() . '-' .$row->getMonth() . '-' . $row->getDay();
// 				$arrTotalMerge[]['total'] = 0;
// 				foreach ($arrTotalResults as $data) {
// 					if ($data['str_date'] === $strDate) {
// 						$arrTotalMerge[]['total'] = $data['total'];
// 						break;
// 					}
// 				}
// 			}
		
// 			$objPage->arrGoogleAnalyticsGraph = $arrGoogleAnalyticsGraph;
// 			$objPage->arrTotalMerge = $arrTotalMerge;
// 			$objPage->strGoogleAnalyticsStartDate = $start_date;
// 			$objPage->strGoogleAnalyticsEndDate = $end_date;
// 		}
	}
}
?>