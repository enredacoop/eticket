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

/*
Use this to include the "open form" into your site
eg:

//enter helpdesk dir
chdir('helpdesk');
//include form
include('open_inc.php');
//return to dir
chdir(dirname($_SERVER['SCRIPT_FILENAME']));

*/
define('NO_JS', 1);
require_once ('init.php');
include_once (INC_DIR . 'open_inc.php');
if (function_exists('DisplayErrWarn')) {
    DisplayErrWarn();
}
if (isset($submitmsg)) {
    echo $submitmsg;
} else {
    include_once (INC_DIR . 'open_form.php');
}
//return to dir
chdir(dirname($_SERVER['SCRIPT_FILENAME']));
?>
