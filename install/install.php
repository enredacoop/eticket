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

if (!isset($type)) $type = 'install';
//error_reporting(0);
$include = 'header.php';
if (file_exists($include)) {
    include_once ($include);
}
require_once ('functions.php');
echo '<h2>' . ucwords($type) . '</h2>';
//go up a level
chdir('..');
$setting_files = array('settings.php', 'pipe.php');
foreach($setting_files as $file) {
    if (!file_exists($file)) {
        if ($file == 'settings.php') {
            $errors[] = "'settings.php' not found. Rename 'settings.default.php' to 'settings.php' if this is a new install.";
            $fixsettings = 'settings.php';
        } else {
            $errors[] = "'$file' was not found! Ensure you have uploaded it.";
        }
    } elseif (filesize($file) <= 0) {
        $errors[] = "'$file' is 0 bytes! Ensure you have uploaded it correctly.";
    } elseif (!is_writable($file)) {
        $errors[] = "'$file' is not writable! chmod this file to 666 during installation.";
        $perms[] = $file;
    }
}
// Array of all the files in /install
$install_files = array('create.sql', 'default_settings.php', 'fixftp.php', 'footer.php', 'functions.php', 'header.php', 'index.php', 'install.php', 'phpinfo.php', 'step1.php', 'step2.php', 'step3.php', 'step4.php', 'template.php', 'upgrade.php', 'upgrade-1.5.9.sql', 'upgrade-1.7.0.sql');
$old_files = array('automail.pl', 'captcha.php', 'settings.pl', 'inc/admin_login.php', 'inc/admin_mytickets.php', 'inc/admin_mytickets.html.php', 'inc/lastans.php', 'inc/lastans.html.php', 'inc/main.html.php', 'inc/open_form.html.php', 'inc/rss.html.php', 'inc/search_form.html.php', 'inc/user_login.php', 'inc/vars.html.php', 'inc/viewticket.html.php', 'themes/eticket/style.css');
foreach ($old_files as $file) {
    if (file_exists($file)) {
        $errors[] = "Old file: '$file' found please remove this file.";
        $oldfile[] = $file;
    }
}

//Check to make sure the user has iconv and Multibyte string installed
if (!function_exists('iconv')) {
    $errors[] = "'iconv' is not installed. Please see <a href='http://us.php.net/manual/en/iconv.installation.php'>PHP.net</a> on how to install";
}
if (!function_exists('mb_get_info')) {
    $errors[] = "'Multibyte String' is not install. Please see <a href='http://us.php.net/manual/en/mbstring.installation.php'>PHP.net</a> on how to install";
}

if (ini_get('safe_mode')) {
    $errors[] = "Safe mode is on. This should be turned off";
}
    
    
$include = 'lang.php';
if (file_exists($include)) {
    include_once ($include);
}
$include = 'settings.php';
if (file_exists($include)) {
    include_once ($include);
}
//go back to install dir
chdir(dirname($_SERVER['SCRIPT_FILENAME']));
if (isset($_POST['step'])) {
    $step = $_POST['step'];
}
//check for no steps, start on step1
if ((!isset($step)) || (empty($step))) {
    $step = 1;
}
if ($step == 1) {
    echo "\n<h3>License Agreement</h3>\n";
} else {
    echo "\n<h3>Step $step:</h3>\n";
}
//step1, error checking and enter database settings
if ($step == 1) {
    include_once ('step1.php');
}
if ($step == 2) {
    include_once ('step2.php');
}
//step2, check database settings, store to file
if ($step == 3) {
    include_once ('step3.php');
}
//step3, update config settings file,
if ($step == 4) {
    include_once ('step4.php');
}
if ($step == "Fix Permissions") {
    include_once ('fixftp.php');
}
$include = 'footer.php';
if (file_exists($include)) {
    include_once ($include);
}
?>
