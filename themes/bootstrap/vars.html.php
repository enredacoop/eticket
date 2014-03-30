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
$html = array();
$html['option'] = '<option value="%s"%s>%s</option>';
$html['input'] = '<input class="form-control" type="%s" name="%s" value="%s"%s> %s';
$html['error'] = '<div class="alert alert-danger" id="err">%s</div>';
$html['end'] = '<a name="end"></a>';
$html['open']['submitmsg'] = '
<h3>' . LANG_OPENED_TICKET_SUBJECT . '</h3>
<p>' . nl2br(LANG_OPENED_TICKET_MSG) . '</p>
<p><a href="%s">%s</a></p>
';
$html['core.js'] = '<script language="JavaScript" type="text/javascript" src="core.js"></script>';
$html['open_form']['name'] = '<input class="form-control" type="%s" name="name" id="name" value="%s">';
$html['open_form']['email'] = '<input class="form-control"  type="email" name="email" id="email" size="25" value="%s">';
$html['open_form']['options'] = '<option value="%s"%s>%s</option>';
$html['open_form']['predef_js'] = '
			<script language="javascript" type="text/javascript">
			function setMessage() {
			var newmessage = document.openForm.responses.value;
			document.openForm.answer.value += newmessage;
			document.openForm.answer.focus();
			}
			</script>';
$html['banlist']['input'] = '<input class="form-control" type="%s" name="%s" value="%s"%s>%s';
$html['banlist']['main_table_content'] = '
    <tr class="mainTableAlt"> 
      <td width="20" align="center"><input type="checkbox" name="key[]" value="%s"></td>
      <td width="30" align="center"><a href="%s">' . LANG_EDIT . '</a></td>
      <td width="30" align="center"><a href="%s">' . LANG_COPY . '</a></td>
      <td>%s</td>
    </tr>';
$html['banlist']['prev'] = '<a href="admin.php?a=banlist&amp;start=%s"><b>' . LANG_PREV . '</b></a>';
$html['banlist']['next'] = '<a href="admin.php?a=banlist&amp;start=%s"><b>' . LANG_NEXT . '</b></a>';
$html['banlist']['b'] = '<strong>%s</strong>';
$html['banlist']['ab'] = '<a href="admin.php?a=banlist&amp;start=%s"><b>%s</b></a>';
$html['main_table'] = '
<table class="table table-hover">
	  <thead><tr>
	    <td>&nbsp;</td>
	    <td title="' . LANG_TIP_TICKET . '"><a href="?s=advanced&sort=ID&status=%status&way=%way">' . LANG_TICKET . '</a></td>
	    <td title="' . LANG_TIP_DATE . '"><a href="?s=advanced&sort=timestamp&status=%status&way=%way">' . LANG_DATE . '</a></td>
	    <td title="' . LANG_TIP_SUBJECT . '"><a href="?s=advanced&sort=subject&status=%status&way=%way">' . LANG_SUBJECT . '</a></td>
	    <td title="' . LANG_TIP_CAT . '"><a href="?s=advanced&sort=cat&status=%status&way=%way">' . LANG_CAT . '</a></td>
	    <td title="' . LANG_TIP_REP . '"><a href="?s=advanced&sort=rep&status=%status&way=%way">' . LANG_REP . '</a></td>
	    <td title="' . LANG_TIP_PRIORITY . '"><a href="?s=advanced&sort=priority&status=%status&way=%way">' . LANG_PRIORITY . '</a></td>
	    <td title="' . LANG_TIP_FROM . '"><a href="?s=advanced&sort=name&status=%status&way=%way">' . LANG_FROM . '</a></td>
	    <td title="Status" align="center"><a href="?s=advanced&sort=status&way=%way">Status</a></td>
	  </tr></thead>
	  <tbody>
	  %content
	  </tbody>
</table>
';
$html['main_table_content'] = '
		  <tr class="{class}">
		   <td>{checkbox}</td>
		   <td class="ticket"><a href="{page}?a=view&amp;id={id}">{id}</a></td>
		   <td class="date">{short_time}</td>
		   <td class="subject"><a href="{page}?a=view&amp;id={id}">{subject}</a></td>
		   <td class="cat">{cat_name}</td>
		   <td class="rep">{rep_name}</td>
		   <td {pri_style}>{pri_text}</td>
		   <td class="from"><a onClick="document.search.email.value=\'{email}\';" title="{email}">{name}</a></td>
		   <td align="center" class="ticket">{status}</td>
			</tr>
';
$html['main']['currentpage'] = '<span id="currentpage">%s</span>';
$html['main']['page'] = '<a href="%s">%s</a>';
$html['main']['no_tickets'] = '<p style="text-align: center;" id="no_tickets">' . LANG_NO_TICKETS . '</p>';
$html['main']['input'] = '<input type="%s" name="%s" class="%s">';
$html['viewticket']['pri_form'] = '<form name="pri" action="%s" method="POST">
				<input type="hidden" name="a" value="priority">
				<input type="hidden" name="tid" value="%s">
				<select name="pri">
				%s
				</select>
				<input type="submit" name="submit_pri" value="' . LANG_SUBMIT . '" class="inputsubmit">
				</form>';
$html['viewticket']['input_delete'] = '<input class="btn btn-default btn-xs" type="submit" id="delete" name="delete" value="' . LANG_DELETE . '" onClick=\'if(confirm("' . LANG_DELETE_CONFIRM . '")) return; else return false;\'>';
$html['viewticket']['privmsgs'] = '
				<li class="list-group-item">
					<form name="privmsg" action="%s" method="POST">
					<input type="hidden" name="a" value="post">
					<input type="hidden" name="tid" value="%s">
					<input type="hidden" name="privid" value="%s">
					<b>%s</b> <span class="datetime">(%s)</span>
							%s
							%s
							<p class="privmsg">%s</p>
					</form>
				</li>';
$html['viewticket']['attach'] = '<span class="msgAttachments"><a href="%s">%s</a> %s</span>';
$html['href'] = '<a href="%s">%s</a> %s';
$html['viewticket']['msgreceived'] = '
<div class="panel panel-default">
	<div class="panel-heading"><span class="datetime">%s</span></div>
	<div class="panel-body">
		%s
		%s
	</div>
</div>';
$html['viewticket']['msgattach'] = '
	 <tr class="msgAttachments">
	 	<td class="msgAttachments">%s</td>
	 </tr>';
$html['viewticket']['attachment'] = '<div class="well well-sm">' . LANG_ATTACHMENT . ': %s</div>';
$html['viewticket']['headers'] = '<a class="btn btn-default btn-xs" href="admin.php?a=headers&amp;msg=%s" target="_new">' . LANG_HEADERS . '</a>';
$html['viewticket']['msganswered'] = '
<div class="panel panel-success">
	<div class="panel-heading"><b>%s</b> <span class="datetime">(%s)</div>
	<div class="panel-body"> 
		%s
		%s
	</div>
</div>';
$html['claim'] = '
<div class="alert alert-warning" id="claim-ticket">
	    <form name="claim" action="$form_action" method="POST">
	    	<input type="hidden" name="a" value="transfer_rep">
	    	<input type="hidden" name="tid" value="$ticketid">
	    	<input type="hidden" name="rid" value="$myuid">
	    	$text <input class="btn btn-default" type="submit" value="$submit_text">
	    </form>
</div>';
$html['button'] = '<li><a href="admin.php?a=%s" class="%s %s">%s</a></li>';
//            <form action="admin.php?a=%s" method="POST" style="display: inline;">
//         			<input class="btn btn-default" type="submit" id="%s" name="%s" value="%s">
//         		</form>';
$html['buttons'] = '<nav class="navbar navbar-default" ><ul class="nav navbar-nav">%s</ul></nav>';
?>
