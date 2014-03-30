<?php
/**********************************************************************************
* eTicket – http://www.eticketsupport.com                                         *
* by Digital Frontiers, UTO                                                       *
***********************************************************************************
* Software Version: eTicket 1.7.3                                                 *
* Software by: Digital Frontiers, UTO (http://www.eticketsupport.com)             *
* Copyright 2008 by: Digital Frontiers, UTO (http://www.eticketsupport.com)       *
* Support, News, Updates at: http://www.eticketsupport.com                        *
***********************************************************************************
* This program is free software; you may redistribute it and/or modify it under   *
* the terms of the provided license as published by Digital Frontiers, UTO.       *
*                                                                                 *
* This program is distributed in the hope that it is and will be useful, but      *
* WITHOUT ANY WARRANTIES; without even any implied warranty of MERCHANTABILITY    *
* or FITNESS FOR A PARTICULAR PURPOSE.                                            *
*                                                                                 *
* See the "license.txt" file for details of the eTicket license.                  *
* The latest version can always be found at http://www.eticketsupport.com.        *
**********************************************************************************/

if (!defined('ISINC')) die('serious error! File: '.__FILE__.' File line: '.__LINE__.'');
if ($_SESSION['user']['type'] !== 'admin') {
    die(LANG_ERROR_DENIED);
}
$err = '';
if ($login[$a] || $login['ID'] === ADMIN) {
    $_POST['c_id'] = (int)$_POST['c_id'];
    if ($_POST['submit']) {
        //update
        if (!$_POST['name'] or !$_POST['email']) {
            $err.= LANG_ERROR_MISSING_FIELDS . '<br>';
        }
        // namecheck for new category name
        $sql = sprintf("SELECT * FROM %s WHERE name='%s'", $db_table['categories'], mysql_real_escape_string($_POST['name']));
        $namecheck = mysql_fetch_array(mysql_query($sql));
        if (($namecheck['name']) && ($_POST['name'] !== $_POST['old_name'])) {
            $err.= LANG_ERROR_CAT_EXISTS . '<br>';
        }
        if (!$err) {
            $_POST['hidden'] = isset($_POST['hidden']) ? 1 : 0;
            $data = array('name' => $_POST['name'], 'pophost' => $_POST['pophost'], 'popuser' => $_POST['popuser'], 'poppass' => $_POST['poppass'], 'email' => $_POST['email'], 'signature' => $_POST['sig'], 'hidden' => $_POST['hidden'], 'reply_method' => $_POST['reply_method']);
            $w = array('ID' => $_POST['c_id']);
            $sql = mysql_build_query('update', $db_table['categories'], $data, $w);
            mysql_query($sql);
            if (mysql_error()) {
                $err.= LANG_FAILED . ' ' . mysql_error();
            }
        }
    } elseif ($_POST['delete']) {
        $err = '';
        if ($_POST['c_id'] === 1) {
            $err = LANG_ERROR_DEFAULT_CAT_NODEL;
        }
        $query = mysql_query("SELECT * FROM " . $db_table['categories']);
        $rnum = mysql_num_rows($query);
        if ($rnum === 1) {
            $err = LANG_ERROR_ONE_CAT;
        }
        if (!$err) {
            $sql = sprintf("DELETE FROM %s WHERE ID=%s", $db_table['categories'], mysql_real_escape_string($_POST['c_id']));
            mysql_query($sql);
            if (mysql_error()) {
                $err.= LANG_FAILED . ' ' . mysql_error();
            }
        }
    } elseif ($_POST['add']) {
        $err = '';
        //check for empty fields
        if (!$_POST['name'] || !$_POST['email']) {
            $err.= LANG_ERROR_MISSING_FIELDS . '<br>';
        }
        //name check
        $sql = sprintf("SELECT * FROM %s WHERE name='%s'", $db_table['categories'], mysql_real_escape_string($_POST['name']));
        $namecheck = mysql_fetch_array(mysql_query($sql));
        if (strtolower($_POST['name']) === strtolower($namecheck['name'])) {
            $err.= LANG_ERROR_CAT_EXISTS . '<br>';
        }
        if (!$err) {
            $_POST['hidden'] = isset($_POST['hidden']) ? 1 : 0;
            $data = array('name' => $_POST['name'], 'pophost' => $_POST['pophost'], 'popuser' => $_POST['popuser'], 'poppass' => $_POST['poppass'], 'email' => $_POST['email'], 'signature' => $_POST['sig'], 'hidden' => $_POST['hidden'], 'reply_method' => $_POST['reply_method']);
            $sql = mysql_build_query('insert', $db_table['categories'], $data);
            mysql_query($sql);
            if (mysql_error()) {
                $err.= LANG_FAILED . ' ' . mysql_error();
            }
            $_POST['c_id'] = mysql_insert_id(); // select category created
            
        }
    }
    $inc = 'admin_cat.html';
}
?>