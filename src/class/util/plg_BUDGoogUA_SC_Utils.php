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
    
    function sfCreateTable() {
    	// FIXME
    }
    
    function sfDropTable() {
    	// FIXME
    }
    
	function sfGetTrackingID() {
		$objQuery =& SC_Query_Ex::getSingletonInstance();
		if (!$objQuery->exists(self::CONFIG_TABLE_NAME)) {
			return null;
		}
		return $objQuery->get(self::FIELD_TRACKING_ID, self::CONFIG_TABLE_NAME);
	}
	
	function sfUpdateTrackingID($prop) {
		$new_prop = array();
		$new_prop['tracking_id'] = $properties['tracking_id'];
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
