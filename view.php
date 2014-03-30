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

require_once ('init.php');
if ($_SESSION['user']['type'] == 'client') {
    if ($login) {
        switch ($a) {
            case "view":
                $id = preg_replace('/\D+/', '', $_REQUEST['id']);
                $titles['viewticket'] = "$id: " . $titles['viewticket'];
                $inc_php = 'viewticket';
            break;
            case "close":
                if (count($_POST['t'])) {
                    foreach($_POST['t'] as $id => $val) {
                        CloseTicket($id);
                    }
                }
            break;
            case "reopen":
                if (count($_POST['t'])) {
                    foreach($_POST['t'] as $id => $val) {
                        ReopenTicket($id);
                    }
                }
            break;
            case "post":
                include_once (INC_DIR . $a . '.php');
            break;
            case "logout":
                $page = $page ? $page : $_SERVER['PHP_SELF'];
                logout($page);
            break;
        }
    } else {
        if ($_POST) {
            $err = LANG_ERROR_LOGIN;
            session_destroy();
        }
        $inc = 'user_login.html';
    }
} else {
    $inc = 'user_login.html';
}
if (!isset($inc) && !isset($inc_php)) {
    $inc_php = 'main';
}
$include = $site_header;
if (file_exists($include)) {
    include ($include);
}
if (function_exists('DisplayErrWarn')) {
    DisplayErrWarn();
}
if ($login && file_exists('core.js')) {
    echo $html['core.js'];
}
if (file_exists($themes_dir . $db_settings['theme'] . DIRECTORY_SEPARATOR . $inc . '.php')) {
    include_once ($themes_dir . $db_settings['theme'] . DIRECTORY_SEPARATOR . "$inc.php");
}
if (file_exists(INC_DIR . $inc_php . '.php')) {
    include_once (INC_DIR . $inc_php . '.php');
}
echo $html['end'];
$include = $site_footer;
if (file_exists($include)) {
    include ($include);
}
?>