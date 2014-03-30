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

include_once ('init.php');
?>
<html>
<head>
<title><?php echo LANG_HELP; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $db_settings['charset']; ?>">
<style type="text/css">
body {
	font-family: Arial, Helvetica, sans-serif; 
	font-size: 12px;
	margin: 5;
	padding: 0;
	color: black;
	background: white;
}
</style>
</head>

<body>
<h1><?php echo LANG_HELP; ?></h1>
<?php echo LANG_HELP_BODY; ?>
<?php echo $help_link; ?>
</body>
</html>
