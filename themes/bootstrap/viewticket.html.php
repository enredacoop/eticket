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
?>


<!-- ticket details start -->

<div class="panel panel-primary">
  <div class="panel-heading"><h3><i class="fa fa-info-circle"></i> <b><?php echo LANG_TICKET_ID; ?>:</b> <?php echo $ticket->id ?></h3></div>
  <div class="panel-body">
   <dl class="dl-horizontal">
  		<dt><?php echo LANG_STATUS; ?></dt>
  		<dd><?php echo get_real_status_name($ticket->status); ?></dd>
  		<dt><?php echo LANG_DATE; ?></dt>
		<dd><?php echo $ticket->short_time; ?></dd>
		<dt><?php echo LANG_SUBJECT; ?></dt>
		<dd><?php echo htmlspecialchars(stripslashes($ticket->subject)); ?></dd>
		
		<?php if ($ticket->name !== $ticket->email): ?>
			<dt><?php echo LANG_NAME; ?></dt>
			<dd><?php echo htmlspecialchars(stripslashes($ticket->name)); ?></dd>
		<?php endif; ?>
		
		<dt><?php echo LANG_EMAIL; ?></dt>
		<dd><?php echo htmlspecialchars($ticket->email); ?> <a class="btn btn-default btn-xs" href="open.php?email=<?php echo htmlspecialchars($ticket->email); ?>"><?php echo LANG_NEW_TICKET; ?></a></dd>
		
		<?php if ($ticket->ip): ?>
			<dt><?php echo LANG_IP; ?></dt>
			<dd><a href="http://whoisx.co.uk/<?php echo $ticket->ip; ?>"><?php echo $ticket->ip; ?></a></dd>
		<?php endif; ?>
	
		<?php if ($ticket->phone): ?>
			<dt><?php echo LANG_PHONE; ?></dt>
			<dd><?php echo $ticket->phone; ?></dd>
		<?php endif; ?>
	</dl>
  </div>
  <?php if ($pri): ?>
  <div class="panel-footer">
	<dl class="dl-horizontal" style="margin-bottom: 0px; padding-bottom: 0px;">
  		<dt><i class="fa fa-exclamation-triangle"></i> <?php echo LANG_PRIORITY; ?></dt>
		<dd><?php echo $pri; ?></dd>
	</dl>
  </div>
  <?php endif; ?>
</div>

<div class="panel panel-info">
	 <div class="panel-heading">Tranfer ticket</div>
	<dl class="dl-horizontal">
  		<dt><?php echo LANG_REP; ?></dt>
  		<dd>
  		<?php if ($vars['reps']): ?>
	    <form class="form-inline" name="rep" action="<?php echo $form_action; ?>" method="POST">
	     	<input type="hidden" name="a" value="transfer_rep">
       		<input type="hidden" name="tid" value="<?php echo $ticket->id; ?>">
         	<select class="form-control" name="rid">
            	<option value="0"></option>
             	<?php echo $vars['reps']; ?>
         	</select>
         	<input class="form-control" type="checkbox" title="<?php echo LANG_SEND_ALERT; ?>" name="trans_alert" checked />
         	<input class="btn btn-default btn-sm" type="submit" name="submit_rep" value="<?php echo LANG_TRANSFER; ?>" />
     	</form>
     	<?php else: ?>
     		<?php echo $rep_row['name']; ?>
		<?php endif; ?>
  		</dd>
  		<dt><?php echo LANG_CAT; ?></dt>
  		<dd>
  		<?php if ($vars['cats']): ?>
		<form class="form-inline" name="transfer" action="<?php echo $form_action; ?>" method="POST">
			<input type="hidden" name="a" value="transfer">
			<input type="hidden" name="tid" value="<?php echo $ticket->id; ?>">	
	        <select class="form-control" name="cid">
	    		<?php echo $vars['cats']; ?>
	    	</select>
  			<?php echo LANG_OPT_MSG; ?>
  			<input class="form-control" type="text" size="20" name="add_msg">
			<?php echo LANG_SEND_ALERT; ?>
  			<input class="form-control" type="checkbox" title="<?php echo LANG_SEND_ALERT; ?>" name="trans_alert" checked>
  			<input class="btn btn-default" type="submit" name="transfer" value="<?php echo LANG_TRANSFER; ?>">
		</form>
		<?php else: ?>
   	 		<?php echo $cat_row['name']; ?>
		<?php endif; ?>
  		</dd>
  	</dl>
</div>


<!-- transfer start -->
<?php
if ($ticket_row['trans_msg']): ?>
	<table align="center" class="msgBorder" cellspacing="1" cellpadding="3" width="100%" border="0">
		<tr>
			<td width="100" class="mainTable"><b><?php echo LANG_TRANS_NOTE; ?>:</b></td>
			<td class="mainTable"><?php echo $ticket_row['trans_msg']; ?></td>
		</tr>
	</table>
<?php
endif; // $ticket_row['trans_msg']
?>
<!-- transfer end -->

<!-- private messages start -->
<?php
if ($_SESSION['user']['type'] == 'admin'):
    if ($vars['privmsg']):
?>
	<div class="panel panel-danger">
		<div class="panel-heading"><?php echo LANG_PRIV_MSGS; ?></div>
	 	<ul class="list-group">
 			<?php echo $vars['privmsg']; ?>
 	 	</ul>
 	</div>
	<?php endif; // $vars['privmsg'] ?>

	<div class="panel panel-danger">
		<div class="panel-body">
		<form name="privmsgs" action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="a" value="post">
			<input type="hidden" name="tid" value="<?php echo $ticket->id; ?>">
			<div class="input-group">
				<input class="form-control" type="text" name="priv" id="priv" size="42">
				<div class="input-group-btn">
					<input class="btn btn-danger" type="submit" name="submit" value="<?php echo LANG_ADD; ?> <?php echo LANG_PRIV_MSG; ?>">
				</div>
			</div>
			<input type="file" name="attachment" id="attachment">
		</form>
	</div>
	</div>
<?php
endif; //is admin

?>
<!-- private messages end -->

<!-- messages start -->
<?php echo $vars['messages'] ?>
<!-- messages end -->

<!-- replyform start -->
<div class="row">
	<form name="replyForm" action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data">
	<div class="col-md-6">
		<input type="hidden" name="a" value="post">
		<input type="hidden" name="id" value="<?php echo $lastid; ?>">
		<textarea class="form-control" name="message" id="d" cols="60" rows="8" wrap="soft"></textarea>
		<div class="btn-group">
			<a class="btn btn-default btn-xs" href="javascript:resizer(1,'d')" id="bigger"><?php echo LANG_BIGGER; ?></a>
			<a class="btn btn-default btn-xs"  href="javascript:resizer(-1,'d')" id="smaller"><?php echo LANG_SMALLER; ?></a>
		</div>
		<input type="hidden" id="textarea_next_time" name="textarea_next_time" value="8">

<?php
//Predefined answer responses
if ($vars['predef']): ?>
<!-- predef start -->
<script language="javascript" type="text/javascript">
	function setMessage() {
		var newmessage = document.replyForm.responses.value;
		document.replyForm.message.value += newmessage;
		document.replyForm.message.focus();
	}
</script>
	<br>
	<select class="form-control" name="responses" onChange="setMessage()">
  		<option value="">[<?php echo LANG_PREDEFINED; ?>]</option>
  		<?php echo $vars['predef']; ?>
	</select>
<!-- predef end -->
<?php endif; //Predefined answer responses ?>

<?php if ($db_settings['accept_attachments']): ?>
<!-- attachments start -->
<br/>
	<input type="file" name="attachment" id="attachment" onchange="document.getElementById('moreUploadsLink').style.display = 'block';" />
	<div id="moreUploads"></div>
	<div id="moreUploadsLink" style="display:none;"><a class="btn btn-default btn-xs" href="javascript:addFileInput('moreUploads');">Attach another File</a></div>
<!-- attachments end -->
<?php endif; ?>
	</div>
	<div class="col-md-6">
<?php if ($_SESSION['user']['type'] === 'admin'): ?>
	
		<?php echo LANG_NEWSTATUS; ?> <select class="fomr-control" size="1" name="newstatus">
            <option value="awaitingcustomer"><?php echo LANG_AWAITINGCUSTOMER; ?></option>
            <option value="onhold"><?php echo LANG_ONHOLD; ?></option>
            <option value="closed"><?php echo LANG_CLOSED; ?></option>
        </select>
		
        <input class="btn btn-default" type="submit" name="change_status" value="<?php echo LANG_CHANGE_TICKET_STATUS; ?>">
<?php endif; // user admin ?>

	<input class="btn btn-default" type="submit" name="submit" value="<?php echo LANG_REPLY_TO_MSG; ?>">

<?php if (($_SESSION['user']['type'] == 'admin') && ($login[$a] || $login['ID'] == ADMIN)): ?>
	<input class="btn btn-default" class="inputsubmit" type="submit" name="delete" value="<?php echo LANG_DELETE; ?>" onClick='if(confirm("<?php echo LANG_DELETE_CONFIRM; ?>")) return; else return false;'>
<?php endif; // user admin and access ?>

<?php if ($_SESSION['user']['type'] == 'client' && get_real_status_name($ticket->status) == 'Closed'): ?>
		
		<input class="btn btn-default" class="inputsubmit" type="submit" name="reopen" value="<?php echo LANG_REOPEN; ?>">
<?php endif; ?>
	</div>
	</form>
</div>

<div id="backtomain" style="margin: auto; text-align: center;"><a href="<?php echo $vars['backurl']; ?>"><?php echo LANG_BACK_TO_MAIN; ?></a></div>
<a name="end"></a>
