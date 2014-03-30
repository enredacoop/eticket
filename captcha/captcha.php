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

if (empty($_SESSION)) {
    session_start();
} // start a session
$rand = rand(10000, 99999); // generate 5 digit random number
$_SESSION['captcha'] = $rand; //debug ONLY
$_SESSION['captcha_hash'] = md5($rand); // create the hash for the random number and put it in the session
if ($rand) {
    header("Expires: Sun, 1 Jan 2000 12:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    //output the image
    header('Content-type: image/jpeg'); // tell the browser that this is an image
    //You can change the following, providing it still uses $rand
    $image = imagecreate(55, 15); // create the image
    $bgColor = imagecolorallocate($image, 255, 255, 255); // use white as the background image
    $textColor = imagecolorallocate($image, 0, 0, 0); // the text color is black
    imagestring($image, 5, 5, 0, $rand, $textColor); // write the random number
    imagejpeg($image); // send the image to the browser
    imagedestroy($image); // destroy the image to free up the memory
    
}
?>