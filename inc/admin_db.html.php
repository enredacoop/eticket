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
if (empty($_POST['suba'])) {
    ?>
    <div class="admin" id="db">
    <table border="0" width="100%" class="TableMsg">
    <tr>
        <td class="TableHeaderText" colspan="3"><b><?php echo LANG_DB_OPS;?></b></td>
    </tr>
    <tr>
        <td class="mainTable"><form action="<?php echo $form_action; ?>" method="post">
        <input type="hidden" name="suba" value="backup">
        <input class="inputsubmit" type="submit" name="submit" value="<?php echo LANG_DB_BACKUP; ?>">
        </form></td>
        <td class="mainTable"><form action="<?php echo $form_action; ?>" method="post">
        <input type="hidden" name="suba" value="status">
        <input class="inputsubmit" type="submit" name="submit" value="<?php echo LANG_DB_STATUS; ?>">
        </form></td>
        <td class="mainTable"><form action="<?php echo $form_action; ?>" method="post">
        <input type="hidden" name="suba" value="optimize">
        <input class="inputsubmit" type="submit" name="submit" value="<?php echo LANG_DB_OPTIMIZE; ?>">
        </form></td>
    </tr>
    </table> 
    </div>
<?php    
} elseif ($_POST['suba'] == "status") {
?>
    <div class="admin" id="db">
    <?php 
    foreach($db_table as $table) {
    ?>
    <table border="0" width="100%" class="TableMsg">
        <tr>
            <td class="TableHeaderText" colspan="2"><b><?php echo $table;?></b></td>
        </tr>
        <tr>
            <td class="mainTable"><?php echo LANG_DB_TOTALSPACE;?></td>
            <td class="mainTableAlt"><?php echo number_format(table_status($table, 'Total_space'), 2);?> <?php echo LANG_DB_USEDKB;?></td>
        </tr>
        <?php
        if (table_status($table, 'Data_free') != 0) {
        ?>
        <tr>
            <td class="mainTable"><?php echo LANG_DB_OVERHEAD;?></td>
            <td class="mainTableAlt"><?php echo table_status($table, 'Data_free');?> <?php echo LANG_DB_USEDB;?></td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td class="mainTable"><?php echo LANG_DB_STATUS;?></td>
            <td class="mainTableAlt"><?php echo sql_ok($table);?></td>
        </tr>
        <tr>
            <td class="mainTable"><?php echo LANG_DB_VERSION;?></td>
            <td class="mainTableAlt"><?php echo table_status($table, 'Comment');?></td>
        </tr>
    </table>
    <br><br>
    <?php
    }
    ?>
    </div>
<?php
} elseif ($_POST['suba'] == 'optimize') {
?>
    <div class="admin" id="db">
    <?php
    foreach($vars['optimize'] as $result) {
        echo $result ."<br>";
    }
    ?>
    </div>
<?php
}
?>