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
if (!$s) $s = $_REQUEST['s'] ? htmlspecialchars($_REQUEST['s']) : 'basic';
$vars = array();
$vars['email'] = htmlspecialchars($_REQUEST['email']);
$vars['text'] = htmlspecialchars(stripslashes($_REQUEST['text']));
//cats
$tmp = '';
$query = mysql_query("SELECT * FROM " . $db_table['categories']);
while ($data = mysql_fetch_array($query)) {
    $selected = ($_SESSION['view']['cat'] == $data['ID']) ? ' SELECTED' : '';
    $hide = ($_SESSION['user']['type'] == 'client' && $data['hidden']);
    $data['name'] = $data['hidden'] ? "$data[name]*" : $data['name'];
    if (!$hide) {
        $tmp.= sprintf($html['option'], $data['ID'], $selected, $data['name']);
    }
}
$vars['cats'] = $tmp;
//reps
$tmp = '';
$query = mysql_query("SELECT * FROM " . $db_table['reps']);
while ($data = mysql_fetch_array($query)) {
    $selected = ($_SESSION['view']['rep'] == $data['ID']) ? ' SELECTED' : '';
    $tmp.= sprintf($html['option'], $data['ID'], $selected, $data['name']);
}
$vars['reps'] = $tmp;
//results per page
$tmp = '';
$array = array(5, 10, 15, 20, 25, 50, 100);
foreach($array as $key => $x) {
    $per = $_SESSION['view']['per'] ? $_SESSION['view']['per'] : $db_settings['tickets_per_page'];
    $selected = $per == $x ? ' SELECTED' : '';
    $tmp.= sprintf($html['option'], $x, $selected, $x);
}
$vars['results_pp'] = $tmp;
$news = ($s == 'basic') ? 'advanced' : 'basic';
$vars['stext'] = ($news == 'basic') ? LANG_BASIC : LANG_ADVANCED;
//work out the query string and url
$vars['surl'] = $_SERVER['PHP_SELF'] . '?s=' . $news;
$qs = preg_replace('/s=(basic|advanced)/', '', htmlspecialchars($_SERVER['QUERY_STRING']));
if ($qs != '') {
    $vars['surl'].= (substr($qs, 0, 1) == '&') ? $qs : "&amp;$qs";
}
include_once ($themes_dir . $db_settings['theme'] . DIRECTORY_SEPARATOR . 'search_form.html.php');
?>
