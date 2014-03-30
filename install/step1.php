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

if (!isset($step)) {
    header('Location: install.php');
    die();
} 
$output = '<p>eTicket - The Support Ticket System<br>
Copyright (C) 2008 Digital Frontiers, UTO<br>
<a href="http://www.eticketsupport.com/">http://www.eticketsupport.com</a><br>
<br>
<b>Definitions</b><br>
</p>
<hr>
<ol>
    <li type="i">This Package is defined as all of the files within any archive 
    file or any group of files released in conjunction by eTicket, eTicketSupport, 
    Digital Frontiers UTO, or a derived or modified work based on such files.</li>
    <li type="i">A Modification, or a Mod, is defined as instructions, to be performed 
    manually or in an automated manner, that alter any part of this Package.</li>
    <li type="i">A Modified Package is defined as this Package or a derivative of 
    it with one or more Modification applied to it.</li>
    <li type="i">Distribution is defined as allowing one or more other people to 
    in any way download or receive a copy of this Package, a Modified Package, or 
    a derivative of this Package.</li>
    <li type="i">The Software is defined as an installed copy of this Package, a 
    Modified Package, or a derivative of this Package. </li>
    <li type="i">The eTicket Website is defined as
    <a href="http://www.eticketsupport.com/">http://www.eticketsupport.com/</a>.</li>
</ol>
<br>
<b>Agreement</b><hr>
<ol>
    <li>Permission is hereby granted to use, copy, modify and/or distribute this 
    Package, provided that:<ol>
        <li type="a">All copyright notices within source files and as generated 
        by the Software as output are retained, unchanged.</li>
        <li type="a">Any Distribution of this Package, whether as a Modified Package 
        or not, includes this file and is released under the terms of this Agreement. 
        This clause is not dependent upon any measure of changes made to this Package.</li>
        <li type="a">This Package, Modified Packages, and derivative works may not 
        be sold or released under any paid license. Copying fees for the transport 
        of this Package, support fees for installation or other services, and hosting 
        fees for hosting the Software may, however, be imposed.</li>
        <li type="a">Any Distribution of this Package, whether as a Modified Package 
        or not, requires the registration of the Distributor at eTicket website.</li>
    </ol>
    </li>
    <li>You may make Modifications to this Package or a derivative of it, and distribute 
    your Modifications in a form that is separate from the Package, such as patches. 
    The following restrictions apply to Modifications:<ol>
        <li type="a">A Modification must not alter or remove any copyright notices 
        in the Software or Package, generated or otherwise.</li>
        <li type="a">When a Modification to the Package is released, a non-exclusive 
        royalty-free right is granted to Digital Frontiers UTO to distribute the 
        Modification in future versions of the Package provided such versions remain 
        available under the terms of this Agreement in addition to any other license(s) 
        of the initial developer.</li>
        <li type="a">Any Distribution of this Package, whether as a Modified Package 
        or not, requires the registration of the Distributor at eTicket website.</li>
    </ol>
    </li>
    <li>Permission is hereby also granted to distribute programs which depend on 
    this Package, provided that you do not distribute any Modified Package without 
    being a Registered Distributor.</li>
    <li>Digital Frontiers UTO reserves the right to change the terms of this Agreement 
    at any time, although those changes are not retroactive to past releases. Changes 
    to this document will be announced via email using the eTicket email notification 
    list. Failure to receive notification of a change does not make those changes 
    invalid. A current copy of this Agreement can be found on the eTicket Website.</li>
    <li>This Agreement will terminate automatically if you fail to comply with the 
    limitations described herein. <b>Upon termination, you must destroy all copies 
    of this Package, the Software, and any derivatives immediately.</b></li>
</ol>
<hr><b>THIS PACKAGE IS PROVIDED &quot;AS IS&quot; AND WITHOUT ANY WARRANTY. ANY EXPRESS OR<br>
IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF<br>
MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO<br>
EVENT SHALL THE AUTHORS BE LIABLE TO ANY PARTY FOR ANY DIRECT, INDIRECT,<br>
INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES ARISING IN ANY WAY<br>
OUT OF THE USE OR MISUSE OF THIS PACKAGE.</b><br>
<br>
<a href="http://www.eticketsupport.com/about/license.php">http://www.eticketsupport.com/about/license.php</a>
<p></p>
<form id="license" name="license" method="post">
    <p><input type="submit" value="I Agree">
    <input type="reset" value="I Do Not Agree" onclick="alert(\'You must accept the license agreement to install eTicket\n\n\n\nIf you do not agree you must remove eTicket immediately.\');"></p>
    <input type="hidden" name="step" value="2" />
</form>';
echo $output; 
