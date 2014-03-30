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

$include = 'header.php';
if (file_exists($include)) {
    include_once ($include);
}
require_once ('functions.php');
checkversion();
?>
<h2>Welcome to the eTicket Installer!</h2>
	<h3>Introduction</h3>
		<p>eTicket is an electronic (open source) support ticket system based on osTicket, 
			that can receive tickets via email (pop3 or pipe) and a web-based form, as well as manage them using a 
			web interface, with many new features and bug fixes. It makes an ideal helpdesk solution for any web site.</p>
		<p>Please make sure you have read the <a href="../readme.html">readme</a> file before you continue.</p>

	<h3>Upgrading</h3>
		<p><b>NOTICE: Always make backup your files AND database first!</b></p>
		<p>If you ARE upgrading, (backup: your attachements and settings files FIRST), remove all 
			files and folders, upload the new ones, and finally restore any files you backed up.</p>
		<p>Then, you MUST follow the <a href="upgrade.php">upgrade</a> to update the database.</p>
        <p><b>NOTICE:</b> Themes have changed drastically in version 1.7.0. You should inspect the 
        /theme/eticket/ directory and make sure your theme is compliant with the new standard. This installer will
        default your installation to the default theme to prevent any errors.</p>
        <p><b>NOTICE: If you have a custom theme you must add the following line in the footer section!</b>
        <pre>&lt;?php show_copy(); ?&gt;</pre>

	<h3>Installation</h3>
		<p>eTicket can be both installed from fresh or upgraded from previous versions of osTicket or eTicket. 
			The installer will handle both. Go to the <a href="./install.php">installer</a>.</p>
		<p>If you wish to do a clean install, please ensure you drop all your tables before running the installer.</p>

<p><b>NOTICE: Always make backup your files AND database first!</b></p>

<?php $include = 'footer.php';
if (file_exists($include)) {
    include_once ($include);
} ?>
