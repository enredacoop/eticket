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
load_buttons();
if ($login['ID'] == ADMIN) {
    checkversion();
    if (version_compare(PHP_VERSION, '5.0.0', '<')) {
        echo '<b>WARNING:</b> You are using PHP version ' . PHP_VERSION . " it is highly recommended that you use at least PHP version 5\n";
        echo "This script will continue to work but in the future you may not be able to use it.\n";
        echo "This message will go away once you upgrade to PHP 5 or higher.\n";
    }
}
if ($vars['search_include']) {
    include (INC_DIR . 'search_form.php');
}
?>
<h2><?php echo $pagetitle; ?></h2>

<div class="row">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

        <div class="col-md-12">
        <?php echo $main_table; 
        unset($main_table); ?>
        </div>
        
        <div class="col-md-4">
  	         <input class="btn btn-default btn-xs" id="checkall" type="button" onclick="checkAll(this.form)" value="<?php echo LANG_SELECT_ALL; ?>"> 
  	         <input class="btn btn-default btn-xs" id="uncheckall" type="button" onclick="uncheckAll(this.form)" value="<?php echo LANG_UNSELECT; ?>">
             <span id="tickets_found"><?php echo intval($total); ?> <em><?php echo LANG_TICKETS_FOUND; ?></em></span>
        </div>
        <div class="col-md-4">
            <input class="btn btn-danger " type="submit" id="close" name="close" title="<?php echo LANG_TIP_CLOSE; ?>" value="<?php echo LANG_CLOSE; ?>"> 
            <?php if ($_SESSION['user']['type'] == 'admin'):?>
            <input class="btn btn-default" type="submit" id="delete" name="delete" title="<?php echo LANG_TIP_DELETE; ?>" onClick='if(confirm("<?php echo LANG_DELETE_CONFIRM; ?>")) return; else return false;' value="<?php echo LANG_DELETE; ?>" />
            <input class="btn btn-success" type="submit" id="onhold" name="onhold" title="<?php echo LANG_TIP_ONHOLD; ?>" value="<?php echo LANG_ONHOLD; ?>"/> 
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <div class="input-group">
            <?php if ($_SESSION['user']['type'] == 'admin'): ?>
            <span class="input-group-btn">
                <?php echo LANG_SHOW_TICKETS; ?>
            </span>
            <select class="form-control input-sm-2" onChange="window.location=this.options[this.selectedIndex].value;" >
                <option value="<?php echo $_SERVER["PHP_SELF"]?>?a=view_all"<?php echo $_SESSION['view']['status'] == 'all' ? ' selected' : ''; ?>><?php echo LANG_ALL; ?></option>
                <option value="<?php echo $_SERVER["PHP_SELF"]?>?a=view_new"<?php echo $_SESSION['view']['status'] == 'new' ? 'selected' : ''; ?>><?php echo LANG_NEW; ?></option>
                <option value="<?php echo $_SERVER["PHP_SELF"]?>?a=view_open"<?php echo $_SESSION['view']['status'] == 'open' ? ' selected' : ''; ?>><?php echo LANG_OPEN; ?></option>
                <option value="<?php echo $_SERVER["PHP_SELF"]?>?a=view_onhold"<?php echo $_SESSION['view']['status'] == 'onhold' ? ' selected' : ''; ?>><?php echo LANG_ONHOLD; ?></option>
                <option value="<?php echo $_SERVER["PHP_SELF"]?>?a=view_awaitingcustomer"<?php echo $_SESSION['view']['status'] == 'awaitingcustomer' ? ' selected' : ''; ?>><?php echo LANG_AWAITINGCUSTOMER; ?></option>
                <option value="<?php echo $_SERVER["PHP_SELF"]?>?a=view_reopened"<?php echo $_SESSION['view']['status'] == 'reopened' ? ' selected' : ''; ?>><?php echo LANG_REOPENED; ?></option>
                <option value="<?php echo $_SERVER["PHP_SELF"]?>?a=view_closed"<?php echo $_SESSION['view']['status'] == 'closed' ? ' selected' : ''; ?>><?php echo LANG_CLOSED; ?></option>
            </select>
            <?php
            endif; ?>
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit" id="refresh" name="refresh"><i class="fa fa-refresh"></i></button>
            </span>
        </div>
        </div>
    </form>
</div>
<div class="row">
    <?php if ($pgs) { ?>
    <span class="pages"><b><?php echo LANG_PAGES; ?>:</b> <?php echo $pgs;
    unset($pgs); ?></span>
    <?php
} ?>
</div>
<!-- buttons end -->
