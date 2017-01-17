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
 * プラグイン情報
 *
 * @package BUDGoogUA
 * @version $Id$
 */
class plugin_info{
    static $PLUGIN_CODE       = "BUDGoogUA";
    static $PLUGIN_NAME       = "Google Universal Analytics";
    static $PLUGIN_VERSION    = "1.0.0";
    static $COMPLIANT_VERSION = "2.12.0+";
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