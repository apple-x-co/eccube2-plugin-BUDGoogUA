<?php
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
    
    function sfGetDropTableDDL() {
    	$ddl = "drop table plg_budgoogua_config";
    	return $ddl;
    }
    
	function sfGetTrackingID() {
		$objQuery =& SC_Query_Ex::getSingletonInstance();
		if (!$objQuery->exists(self::CONFIG_TABLE_NAME)) {
			return null;
		}
		return $objQuery->get(self::FIELD_TRACKING_ID, self::CONFIG_TABLE_NAME);
	}
	
	function sfUpdateProperties($prop) {
		$new_prop = array();
		$new_prop['tracking_id'] = $prop['tracking_id'];
		$new_prop['update_date'] = 'CURRENT_TIMESTAMP';
		
		$objQuery =& SC_Query_Ex::getSingletonInstance();
		$objQuery->begin();
		
		if ($objQuery->exists(self::CONFIG_TABLE_NAME)) {
			$ret = $objQuery->update(self::CONFIG_TABLE_NAME, $new_prop);
		}
		else {
			$ret = $objQuery->insert(self::CONFIG_TABLE_NAME, $new_prop);
		}
		
		$objQuery->commit();
	}
}
