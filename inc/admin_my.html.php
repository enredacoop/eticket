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
load_buttons();
?>
<div class="admin" id="my">
<form action="<?php echo $form_action; ?>" method="post">
	<input type="hidden" name="a" value="my">
	
	<table width="100%" border="0" cellspacing="1" cellpadding="2" class="TableMsg">
	<tr>
		<td class="TableHeaderText" width="120"><?php echo LANG_TITLE_MY; ?></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="mainTable"><b><?php echo LANG_USER; ?>:</b></td>
		<td class="mainTableAlt"><input type="text" name="username" value="<?php echo $vars['username']; ?>"></td>
	</tr>
	<tr>
		<td class="mainTable"><b><?php echo LANG_NAME; ?>:</b></td>
		<td class="mainTableAlt"><input type="text" name="name" value="<?php echo $vars['name']; ?>"></td>
	</tr>
	<tr>
		<td class="mainTable"><b><?php echo LANG_EMAIL; ?>:</b></td>
		<td class="mainTableAlt">
			<input type="text" name="email" value="<?php echo $vars['email']; ?>">
			<?php echo LANG_NOMAIL; ?>? 
			<input type="checkbox" name="nomail"<?php echo $vars['nomail']; ?>>
		</td>
	</tr>
	<tr>
		<td class="mainTable"><b><?php echo LANG_PASS; ?>:</b></td>
		<td class="mainTableAlt"><input type="password" name="password"></td>
	</tr>
	<tr>
		<td class="mainTable"><?php echo LANG_NPASS; ?>:</td>
		<td class="mainTableAlt"><input type="password" name="npassword"></td>
	</tr>
	<tr>
		<td class="mainTable"><?php echo LANG_VPASS; ?>:</td>
		<td class="mainTableAlt"><input type="password" name="vpassword"></td>
	</tr>
	<tr>
		<td class="mainTable"><?php echo LANG_SIGNATURE; ?>:</td>
		<td class="mainTableAlt"><textarea name="sig" cols="30" rows="5"><?php echo $vars['signature']; ?></textarea></td>
	</tr>
	</table>
			<br>
			<input class="inputsubmit" type="submit" name="submit" value="<?php echo LANG_SAVE_CHANGES; ?>">
</form>
</div>
