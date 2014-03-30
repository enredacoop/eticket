<?php
if (!defined('ISINC')) die('serious error! File: '.__FILE__.' File line: '.__LINE__.'');
$footer = str_replace("<!--", "", $footer);
$footer = str_replace("-->", "", $footer);
if (!empty($footer)) {
    echo $footer;
    unset($footer);
}
/*
It's a violation of the license agreement to change, modify or remove the copyright. 
If you don't want to show credit back to eTicket for our hard work, then you may hide the image from the admin area.
*/
if (!show_copy(true)) {
    echo '<div class="footer"><center><font color="black" size="5"><strong>The copyright must be in the templete<br></strong></center>';
    echo 'Please notify the <a href="mailto:' . $_SERVER["SERVER_ADMIN"] . '">server administrator</a> that this site is missing the copyright for <a href="http://www.eticketsupport.com">eTicket</a> so they can fix this issue. ';
    echo 'Display of the copyright is a legal requirement to use this software. ';
    echo 'For more information on this please visit the <a href="http://www.eticketsupport.com">eTicket</a> web site.</div>';
}
?>
