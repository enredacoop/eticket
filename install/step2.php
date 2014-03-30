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

if (!isset($step)) {
    header('Location: install.php');
    die();
}
//step1: database details, get them right and you may continue...
// Get the setting file version the make it so we can evaulate it
$setting_version = str_replace(".", "", $version);
if ($setting_version <= "159") {
    $select159 = "SELECTED";
} else {
    $select170 = "SELECTED";
}
if (version_compare(PHP_VERSION, '5.0.0', '<')) {
    echo '<b>WARNING:</b> You are using PHP version ' . PHP_VERSION . ' it is highly recommended that you use at least PHP version 5\n';
    echo 'This script will no longer work with this version of PHP!\n';
    die;
}

if (substr(PHP_OS,0,3) == 'WIN') {
    echo '<b>WARNING:</b> You are running eTicket on a Windows machine there are numerous issues with eTicket and Windows servers\n';
    echo ' you can still install eTicket but you do so with no warranty or support from eTicket. It is highly recommended that you install\n';
    echo ' eTicket on a *NIX machine\n';
}

if (!isset($errors)) {
    if ($type == "upgrade") {
        $upgradeveradd = '    <tr>
    <td><label>eTicket database version</label></td>
    <td>
        <select name="upgradever">
            <option value="159" ' . $select159 . '>1.5.9 or below</option>
            <option value="170" ' . $select170 . '>1.7.0 or above</option>
        </select>
    </td>
    </tr>';
    }
    $db_table_prefix = $db_table_prefix ? $db_table_prefix : 'ticket_';
    $db_table_tickets = $db_table_tickets ? $db_table_tickets : 'tickets';
    $output = '<p>Enter your database settings:</p>
	<table>
	<form id="database" name="database" method="post">
	<tr>
	<td><label>Database Type</label></td>
	<td>
		<select name="db_type">
			<option value="mysql">MySQL</option>
		</select>
    </td>
	</tr>

	<tr>
	<td><label>Database Server</label></td>
	<td><input name="db_host" type="text" value="' . $db_host . '" /></td>
	</tr>
    
    ' . $upgradeveradd . '
    
	<tr>
	<td><label>Database Name</label></td>
	<td><input name="db_name" type="text" value="' . $db_name . '" /></td>
	</tr>

	<tr>
	<td><label>Database Username</label></td>
	<td><input name="db_user" type="text" value="' . $db_user . '" /></td>
	</tr>
	<tr>
	<td><label>Database Password</label></td>
	<td><input name="db_pass" type="password" value="" /></td>
	</tr>

	<tr>
	<td><label>Table Prefix*</label></td>
	<td><input name="db_table_prefix" type="text" value="' . $db_table_prefix . '" /></td>
	</tr>
	<tr>
	<td colspan=2>(ie: "ticket_" makes the tables for config become "ticket_config")</td>
	</tr>
	
	<tr>
	<td><label>Tickets Table*</label></td>
	<td><input name="db_table_tickets" type="text" value="' . $db_table_tickets . '" /></td>
	</tr>
    
	<tr>
	<td colspan=2>(ie: "tickets") we need this as in the past this table didn\'t have a prefix.</td>
	</tr>

	<tr>
	<td><label></label></td>
	<td><input type="submit" name="Submit" value="Submit" /></td>
	</tr>
	<input type="hidden" name="step" value="3" />
	</form>
	</table>
	<p>* If unsure, please leave it as is.</p>
	';
}
if (isset($errors)) {
    $rootpath_dir = rootpath_dir();
    $output = DisplayErrors($errors);
    if (is_array($perms)) {
        $output.= "<p>I can fix these errors if you provide your FTP login information.</p>";
        $output.= '    <table>
    <form id="database" name="database" method="post">
    <tr>
    <td>FTP Server</td>
    <td><input type="text" name="ftp_server" size="20" value="' . $_SERVER[SERVER_NAME] . '"></td>
    </tr>

    <tr>
    <td>FTP Login</td>
    <td><input type="text" name="ftp_login" size="20" value="' . get_current_user() . '"></td>
    </tr>
    
    <tr>
    <td>FTP Password</td>
    <td><input type="password" name="ftp_pass" size="20"></td>
    </tr>

    <tr>
    <td>FTP Directory</td>
    <td><input type="text" name="ftp_dir" size="50" value="' . $rootpath_dir . '"></td>
    </tr>

    <tr>
    <td><label></label></td>
    <td><input type="submit" name="Submit" value="Submit" /></td>
    </tr>
    <input type="hidden" name="step" value="Fix Permissions" />
    </form>
    </table>';
    } else {
        $output.= '<p>Please fix the above error(s), install halted!</p>';
    }
}
echo $output;
?>