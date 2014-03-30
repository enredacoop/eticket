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
$include = $site_header;
if (file_exists($include)) {
    include_once ($include);
}
if (function_exists('DisplayErrWarn')) {
    DisplayErrWarn();
}
if (file_exists('core.js')) {
    echo $html['core.js'];
}
?>
<div class="welcome">
<h2><?php echo LANG_WELCOME; ?></h2>
<p><?php echo LANG_LOGIN_TIP; ?></p>
</div>
<div class="openBox">
<hr>
<h2><?php echo LANG_OPEN_TICKET; ?></h2>
<?php include_once ('open_raw.php'); ?>
</div>
<div class="loginBox">
<hr>
<h2><?php echo LANG_VIEW_STATUS; ?></h2>
<form action="view.php" method="post">
<table cellspacing="0" cellpadding="3" border="0" class="loginBox">
    <tr> 
      <td><b><?php echo LANG_YOUR_EMAIL; ?>:</b></td>
      <td><input class="inputform" type="text" name="login_email" size="25" value="<?php echo $e; ?>"></td>
      <td><b><?php echo LANG_TICKET_ID; ?>:</b></td>
      <td><input class="inputform" type="text" name="login_ticket" size="10" value="<?php echo $t; ?>"></td>
      <td><input class="inputsubmit" type="submit" value="<?php echo LANG_VIEW_STATUS; ?>"></td>
    </tr>
</table>
</form>
</div>
<?php $include = $site_footer;
if (file_exists($include)) {
    include_once ($include);
} ?>
