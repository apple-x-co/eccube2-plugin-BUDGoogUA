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
 * ユーティリティ
 *
 * @package BUDGoogUA
 * @version 1.0.0
 */
class plg_BUDGoogUA_SC_Utils
{
    const CONFIG_TABLE_NAME = 'plg_budgoogua_config';
    const FIELD_TRACKING_ID = 'tracking_id';
    
	/**
	 * テーブル作成DDLの取得
	 *
	 * @access public
	 * @param なし
	 * @return なし
	 */
    function sfGetCreateTableDDL() {
    	$ddl = <<< __EOS__
create table plg_budgoogua_config (
  config_id integer not null primary key auto_increment,
  tracking_id varchar(100) not null,
  update_date datetime not null
)
__EOS__;
    	return $ddl;
    }
    
	/**
	 * テーブル削除DDLの取得
	 *
	 * @access public
	 * @param なし
	 * @return なし
	 */
    function sfGetDropTableDDL() {
    	$ddl = "drop table plg_budgoogua_config";
    	return $ddl;
    }
    
	/**
	 * トラッキングIDの取得
	 *
	 * @access public
	 * @param なし
	 * @return なし
	 */
    function sfGetTrackingID() {
		$objQuery =& SC_Query_Ex::getSingletonInstance();
		if (!$objQuery->exists(self::CONFIG_TABLE_NAME)) {
			return null;
		}
		return $objQuery->get(self::FIELD_TRACKING_ID, self::CONFIG_TABLE_NAME);
	}
	
	/**
	 * 情報の更新
	 *
	 * @access public
	 * @param array $arrProps 連想配列
	 * @return なし
	 */
	function sfUpdateProperties($arrProps) {
		$arrNewProps = array();
		$arrNewProps['tracking_id'] = $arrProps['tracking_id'];
		$arrNewProps['update_date'] = 'CURRENT_TIMESTAMP';
		
		$objQuery =& SC_Query_Ex::getSingletonInstance();
		$objQuery->begin();
		
		if ($objQuery->exists(self::CONFIG_TABLE_NAME)) {
			$ret = $objQuery->update(self::CONFIG_TABLE_NAME, $arrNewProps);
		}
		else {
			$ret = $objQuery->insert(self::CONFIG_TABLE_NAME, $arrNewProps);
		}
		
		$objQuery->commit();
	}
	
	/**
	 * SQLの実行
	 *
	 * @access public
	 * @param string $sql SQL
	 * @return なし
	 */
	function sfExecuteSQL($sql) {
		// FIXME SC_Plugin_Installer::verifySql
	}
}
