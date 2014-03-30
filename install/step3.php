<?php
/**********************************************************************************
* eTicket – http://www.eticketsupport.com                                         *                                                                                        *
* by Digital Frontiers, UTO                                                       *                                                                                                                              *
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

if (!isset($step)) {
    header('Location: install.php');
    die();
}
//step2: check database details are correct, create/upgrade database and load a form of adjustable settings for step3
if (!isset($errors)) { //check the database connection
    $conn = @mysql_connect($_POST['db_host'], $_POST['db_user'], $_POST['db_pass']);
    if (!$conn) {
        $errors[] = 'Cannot connect to the database <b>server</b> using the information provided.';
    }
}
if (!isset($errors)) { //check the database name
    echo "<p>Database connection established...</p>\n";
    $selectdb = mysql_select_db($_POST['db_name'], $conn);
    if (!$selectdb) {
        $errors[] = 'Connected to the database, but the database name is incorrect.';
    }
}
if (!isset($errors)) {
    //database prefix
    $db_table_prefix = $_POST['db_table_prefix'] ? $_POST['db_table_prefix'] : 'ticket_';
    $db_table_tickets = $_POST['db_table_tickets'] ? $_POST['db_table_tickets'] : 'tickets';
    echo '<div class="databases">';
    echo "<p><b>Found database...</b></p>\n";
    echo "<p><b>Initializing database...</b></p>\n";
    if ($_POST["upgradever"] == "159") {
        $files = array('upgrade-1.5.9.sql');
        $query = mysql_query("SELECT * FROM " . $db_table_prefix . "config LIMIT 1");
        while ($fields = @mysql_fetch_assoc($query)) {
            foreach($fields as $key => $value) {
                $sqls[] = "DELETE FROM " . $db_table_prefix . "settings WHERE `key` = '$key'";
                $sqls[] = "INSERT INTO " . $db_table_prefix . "settings (`group`, `key`, `value`) VALUES (NULL, '$key', '$value');";
            }
            $sqls[] = "DROP TABLE " . $db_table_prefix . "config";
            $sqls[] = "UPDATE " . $db_table_prefix . "settings SET `group` = 'predef_answers' WHERE `group` ='answers'";
            $sqls[] = "UPDATE " . $db_table_tickets . " SET `status` = 'new' WHERE `status` = 'open'";
            $sqls[] = "UPDATE " . $db_table_prefix . "settings SET `key` = 'antispam_email' WHERE `key` ='ANTISPAM_EMAIL'";
            $sqls[] = "UPDATE " . $db_table_prefix . "settings SET `key` = 'antispam_msg' WHERE `key` ='ANTISPAM_MSG'";
            $sqls[] = "UPDATE " . $db_table_prefix . "settings SET `key` = 'antispam_subj' WHERE `key` ='ANTISPAM_SUBJECT'";
            $sqls[] = "UPDATE " . $db_table_prefix . "settings SET `key` = 'antispam_magicword' WHERE `key` ='ANTISPAM_MAGICWORD'";
            $sqls[] = "DELETE FROM " . $db_table_prefix . "settings WHERE `key` = 'captcha_dir'";
            $sqls[] = "DELETE FROM " . $db_table_prefix . "settings WHERE `key` = 'pop3_automail'";
            $sqls[] = "DELETE FROM " . $db_table_prefix . "settings WHERE `key` = 'answer_method'";
            $sqls[] = "DELETE FROM " . $db_table_prefix . "settings WHERE `key` = 'spamassassin_enable'";
            $sqls[] = "DELETE FROM " . $db_table_prefix . "settings WHERE `key` = 'umq'";
            $sqls[] = "UPDATE " . $db_table_tickets . " SET `status` = 'new' WHERE `status` != 'closed'";
            $sqls[] = "UPDATE " . $db_table_prefix . "settings SET `value` = 'eticket' WHERE `key` ='theme'";
        }
        $setting_query = mysql_query("SELECT * FROM " . $db_table_prefix . "settings WHERE `group` IS NOT NULL AND `group` NOT LIKE 'pri%' AND `group` NOT LIKE 'pre%'");
        while ($settings = mysql_fetch_assoc($setting_query)) {
            $sqls[] = "UPDATE `" . $db_table_prefix . "settings` SET `group` = NULL WHERE `ID` = $settings[ID] LIMIT 1";
        }
        if (!empty($sqls)) {
            if (mysql_error()) {
                $errors[] = LANG_FAILED . ': ' . mysql_error();
            }
            foreach($sqls as $sql) {
                if (!mysql_query($sql)) {
                    $errors[] = LANG_FAILED . ': ' . mysql_error() . " :<br>\n $sql";
                }
            }
        } else {
            $errors[] = "Incorrect database version, are you running a version greater than 1.5.9?";
        }
    } elseif ($_POST["upgradever"] == "170") {
        if (!empty($sqls)) {
            if (mysql_error()) {
                $errors[] = LANG_FAILED . ': ' . mysql_error();
            }
            foreach($sqls as $sql) {
                if (!mysql_query($sql)) {
                    $errors[] = LANG_FAILED . ': ' . mysql_error() . " :<br>\n $sql";
                }
            }
        }
        $files = array('upgrade-1.7.0.sql');
    } else {
        $files = array('create.sql');
    }
    foreach($files as $file) {
        if (file_exists($file)) {
            $end = ' <a href="#end">(skip to end)</a>';
            echo "<p><b>Running queries from '$file'...</b>$end</p>\n";
            $sql_query = file_get_contents($file);
            //fix the table prefix on the fly... (not that it works fully yet)
            $sql_query = str_replace("%TICKET_PREFIX%", "$db_table_prefix", $sql_query);
            $sql_query = str_replace("%TICKET_TABLE%", "$db_table_tickets", $sql_query);
            if (!mysql_run_queries($sql_query)) {
                $errors[] = "mySQL cannot run '$file' perhaps eTicket is already installed?";
                $errors[] = "Please fix the above error(s), install halted!";
                $create_error = 1;
            }
        } else {
            $errors[] = "Cannot locate '$file'.";
        }
    }
    echo '</div>';
}
echo '<a id="end"></a>';
//get configuration from database
$db_table = @mysql_fetch_array(mysql_query("SELECT * FROM " . $db_table_prefix . 'config'));
//let's guess some vars...
$phppath = phppath();
if ($installed) {
    $tsettings = @mysql_fetch_array(mysql_query("SELECT * FROM " . $db_table_prefix . "settings"));
    // Load the settings from the settings table
    $sql = @mysql_fetch_array(mysql_query("SHOW TABLES LIKE '" . $db_table_prefix . "settings'"));
    if ($sql) {
        $query = mysql_query("SELECT * FROM " . $db_table_prefix . "settings");
        $db_settings = array();
        while ($setting = mysql_fetch_array($query)) {
            if (!empty($setting['group'])) {
                $db_settings[$setting['group']][$setting['key']] = $setting['value'];
            } else {
                $db_settings[$setting['key']] = $setting['value'];
            }
        }
    }
}
//url details
//get rootpath details
if ($installed) {
    $root_url = $db_settings['root_url'];
    $rootpath_dir = rootpath_dir();
    $attachment_dir = $db_settings['attachment_dir'] ? $db_settings['attachment_dir'] : 'attachments' . DIRECTORY_SEPARATOR;
} else {
    $root_url = root_url();
    $rootpath_dir = rootpath_dir();
    $attachment_dir = $rootpath_dir . 'attachments' . DIRECTORY_SEPARATOR;
}
if (!isset($errors)) {
    $domain = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    //ftp info
    $ftp_server = $_POST['ftp_server'] ? $_POST['ftp_server'] : $_SERVER['SERVER_NAME'];
    $ftp_login = $_POST['ftp_login'] ? $_POST['ftp_login'] : get_current_user();
    $ftp_dir = $_POST['ftp_dir'] ? $_POST['ftp_dir'] : $rootpath_dir;
    $output.= '<hr><p>Enter your settings:</p>
<table>
<form id="settings" name="settings" method="post">

<tr>
<td><label>Path to php (for pipe.php)</label></td>
<td><input name="phppath" type="text" value="' . $phppath . '" />
</tr>

<tr>
<td><label>Root path:</label></td>
<td><input name="rootpath_dir" type="text" size="50" value="' . $rootpath_dir . '" />
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>';
    if ($type == "upgrade") {
        $output.= '
<tr>
<td colspan="2">To finish the install you must login as the admin.</td>
</tr>
<tr>
<td><label>Admin Username</label></td>
<td><input name="admin_user" type="text" value="admin" size="32" readonly />
</tr>

<tr>
<td><label>Admin Password</label></td>
<td><input name="admin_pass" type="password" value="" size="32" />
</tr>

<tr>
<td colspan="2">&nbsp;</td>
</tr>';
    } elseif ($type == "install") {
        $output = '<hr><p>Enter your settings:</p>
<table>
<form id="settings" name="settings" method="post">
    
<tr>
<td><label>Path to php (for pipe.php)</label></td>
<td><input name="phppath" type="text" value="' . $phppath . '" />
</tr>

<tr>
<td><label>Root path:</label></td>
<td><input name="rootpath_dir" type="text" size="50" value="' . $rootpath_dir . '" />
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td><label>Admin Username</label></td>
<td><input name="admin_user" type="text" value="admin" size="32" readonly />
</tr>

<tr>
<td>&nbsp;</td>
<td>You need to know this to login.</td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td><label>Admin Password</label></td>
<td><input name="admin_pass" type="password" value="" size="32" />
</tr>

<tr>
<td>&nbsp;</td>
<td>Please enter a secure password.</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td><label>Admin Name</label></td>
<td><input name="admin_name" type="text" value="Administrator" size="32" />
</tr>

<tr>
<td>&nbsp;</td>
<td>(eg: Administrator)</td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td><label>Admin Email</label></td>
<td><input name="admin_email" type="text" value="admin@' . $domain . '" size="32" />
</tr>

<tr>
<td>&nbsp;</td>
<td>(eg: "admin@example.com")</td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td><label>Default Category Name</label></td>
<td><input name="cat_name" type="text" value="Support" size="32" />
</tr>

<tr>
<td>&nbsp;</td>
<td>(eg: "Support") - Can be changed later</td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
	
<tr>
<td><label>Default Category Email Address</label></td>
<td><input name="cat_email" type="text" value="support@' . $domain . '" size="32" />
</tr>

<tr>
<td>&nbsp;</td>
<td>(eg: "support@example.com")</td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td><label>Root URL</label></td>
<td><input name="root_url" type="text" value="' . $root_url . '" size="32" />
</tr>

<tr>
<td>&nbsp;</td>
<td>(eg: "http://www.example.com/helpdesk")</td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td><label>Site Title</label></td>
<td><input name="site_title" type="text" value="' . $domain . ' - Helpdesk" size="32" />
</tr>

<tr>
<td>&nbsp;</td>
<td>(eg: "Your Company - Helpdesk")</td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td><label>Attachments Upload Directory</label></td>
<td><input name="attachment_dir" type="text" value="' . $attachment_dir . '" size="32" />
</tr>

<tr>
<td>&nbsp;</td>
<td>(eg: just "attachments" or "/home/user/attachments/" if its not in your web dir)</td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
	
<tr>
<td><label>Email Address of No Return</label></td>
<td><input name="no_return" type="text" value="noreply@' . $domain . '" size="32" />
</tr>

<tr>
<td>&nbsp;</td>
<td>(eg: "noreply@example.com" this must be a none existant address at your domain)</td>
</tr>
    
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>';
    }
    $output.= '<tr>
<td colspan="2">If you enter this information we can automatically finish the install.</td>
</tr>
    
<tr>
<td><label>Enable FTP</label></td>
<td><input type="checkbox" name="enable_ftp" value="1" ' . $_POST[enable_ftp] . '></td>
<tr>
   
<tr>
<td>FTP Server</td>
<td><input type="text" name="ftp_server" size="20" value="' . $ftp_server . '"></td>
</tr>

<tr>
<td>FTP Login</td>
<td><input type="text" name="ftp_login" size="20" value="' . $ftp_login . '"></td>
</tr>
    
<tr>
<td>FTP Password</td>
<td><input type="password" name="ftp_pass" size="20" value="' . $_POST[ftp_pass] . '"></td>
</tr>

<tr>
<td>FTP Directory</td>
<td><input type="text" name="ftp_dir" size="50" value="' . $ftp_dir . '"></td>
</tr>

<tr>
<td><label></label></td>
<td>

<input type="hidden" name="db_type" value="' . $_POST['db_type'] . '" />
<input type="hidden" name="db_host" value="' . $_POST['db_host'] . '" />
<input type="hidden" name="db_name" value="' . $_POST['db_name'] . '" />
<input type="hidden" name="db_user" value="' . $_POST['db_user'] . '" />
<input type="hidden" name="db_pass" value="' . $_POST['db_pass'] . '" />
<input type="hidden" name="db_table_prefix" value="' . $db_table_prefix . '" />
<input type="hidden" name="db_table_tickets" value="' . $db_table_tickets . '" />
<input type="hidden" name="step" value="4">
<input type="submit" name="Submit" value="Update Settings" />
</td>
</tr>
</form></table>';
}
if (isset($errors)) {
    $output = DisplayErrors($errors);
    if (isset($create_error)) {
        $output.= '<form id="thisform">
        <input type="button" onclick="window.location=\'upgrade.php\';" value="Switch to upgrade" />
        </form>';
    } else {
        $output.= '<form id="thisform">
        <input type="button" onclick="window.history.go(-1)" value="Go Back" />
        </form>';
    }
}
echo $output;
?>
