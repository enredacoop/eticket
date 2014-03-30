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

$themepage = 'template.php';
$bodytag = '%%BODY%%';
if (file_exists($themepage)) {
    ob_start();
    include_once $themepage;
    $temp = ob_get_contents();
    ob_end_clean();
    if (isset($title)) $temp = preg_replace('/(<title>)(.*)(<\/title>)/is', '${1}' . $title . '$3', $temp);
    $header = eregi_replace($bodytag . '.*', '', $temp);
    $footer = eregi_replace('.*' . $bodytag, '', $temp);
}
if (!empty($header)) {
    echo $header;
    unset($header);
}
?>
