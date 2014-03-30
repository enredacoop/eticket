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
if ($e == 'edit') {
    $ab = 'U';
}
if ($e == 'add') {
    $ab = 'A';
}
if ($e == 'edit') {
    $action_title = LANG_EDIT_BANNED;
} else {
    $action_title = LANG_ADD_COPY_BANNED;
}
?>

<script language="JavaScript" type="text/javascript">
function validateForm(form) {
	var isValid = true;
	// Check each field individually
	if(form.x_value.value.length == 0) {
		msg = "<?php echo LANG_ERROR_VALUE_EMPTY; ?>";
		isValid = false;
	}
	// Show the error message to the user
	if(!isValid) alert(msg);
	return isValid;
}
</script>

<form name="form" action="<?php echo $form_action; ?>" method="post" onsubmit="return validateForm(this);">
  <input type="hidden" name="a" value="<?php echo $a ? $a : 'banlist'; ?>">
  <input type="hidden" name="e" value="<?php echo $e ? $e : 'add'; ?>">
  <input type="hidden" name="ab" value="<?php echo $ab; ?>">
  <?php if (($e == 'edit') && ($key)): ?>
  <input type="hidden" name="key" value="<?php echo $key; ?>">
  <?php
endif; ?>
  <table border="0" cellspacing="0" cellpadding="4">
    <tr> 
      <td><b><?php echo $action_title; ?>:</b></td>
      <td><input type="text" name="x_value" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_value); ?>"></td>
		<td><input class="inputsubmit" type="submit" name="Action" value="<?php echo LANG_SUBMIT; ?>"></td>
    </tr>
  </table>
</form>
<a href="admin.php?a=banlist"><?php echo LANG_BACK_TO_LIST; ?></a>
