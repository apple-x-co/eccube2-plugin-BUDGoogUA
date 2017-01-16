<?php
require_once CLASS_EX_REALDIR . 'page_extends/admin/LC_Page_Admin_Ex.php';
require_once PLUGIN_UPLOAD_REALDIR . 'BUDGoogUA/class/util/plg_BUDGoogUA_SC_Utils.php';

class LC_Page_Plugin_BUDGoogUA_Config extends LC_Page_Admin_Ex {
    
	// DB
	// http://tetra-themes.com/ec-cube-database-274/
	
	// FORM
	// http://blog.livedoor.jp/kuworks/archives/50510206.html
	
    var $arrForm = array();
    
    /**
     * 初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = PLUGIN_UPLOAD_REALDIR . "BUDGoogUA/templates/config.tpl";
        $this->tpl_subtitle = "Google Universal Analytics設定";
    }
 
    /**
     * プロセス.
     *
     * @return void
     */
    function process() {
        $this->action();
        $this->sendResponse();
    }
 
    /**
     * Page のアクション.
     *
     * @return void
     */
    function action() {
        $objFormParam = new SC_FormParam_Ex();
        $this->lfInitParam($objFormParam);
        $objFormParam->setParam($_POST);
        $objFormParam->convParam();
 
        $arrForm = array();
        switch ($this->getMode()) {
        case 'edit':
            $arrForm = $objFormParam->getHashArray();
            $this->arrErr = $objFormParam->checkError();
            if (count($this->arrErr) == 0) {
                $this->arrErr = $this->updateData($arrForm);
                if (count($this->arrErr) == 0) {
                    $this->tpl_onload = "alert('登録が完了しました。');";
                    $this->tpl_onload .= 'window.close();';
                }
            }
            break;
        default:
        	$tracking_id = plg_BUDGoogUA_SC_Utils::sfGetTrackingID();
        	$arrForm['tracking_id'] = $ret;
            break;
        }
        $this->arrForm = $arrForm;
        $this->setTemplate($this->tpl_mainpage);
    }
 
    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
    }
     
    /**
     * パラメーター情報の初期化
     *
     * @param object $objFormParam SC_FormParamインスタンス
     * @return void
     */
    function lfInitParam(&$objFormParam) {
        $objFormParam->addParam('トラッキングID', 'tracking_id', SMTEXT_LEN, 'n', array('MAX_LENGTH_CHECK', 'GRAPH_CHECK'));
    }
 
    /**
     *
     * @param type $arrData
     * @return type 
     */
    function updateData($arrData) {
        $arrErr = array();
        
        $arrProps = array();
        $arrProps['tracking_id'] = $arrData['tracking_id'];
        $arrProps['update_date'] = 'CURRENT_TIMESTAMP';
        plg_BUDGoogUA_SC_Utils::sfUpdateProperties($arrProps);
       	
        return $arrErr;
    }
}
?>