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

<div class="row">
	<div class="col-md-6 col-md-offset-3">
	<form name="openForm" action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data" role="form">
		<div class="form-group">
    		<label for="name"><?php echo LANG_NAME; ?></label>
    		<input type="text" class="form-control" name="name" id="name" placeholder="Your name" required autofocus />
  		</div>

  		<div class="row">
  			<div class="col-md-6">
		  		<div class="form-group">
		    		<label for="email"><?php echo LANG_EMAIL; ?></label>
		    		<input type="email" class="form-control" name="email" id="email" placeholder="Your e-mail" required />
		  		</div>
		  	</div>
		  	<div class="col-md-6">
		  		<div class="form-group">
		    		<label for="email_confirm"><?php echo LANG_EMAIL_CONFIRM; ?></label>
		    		<input type="email" class="form-control" name="email_confirm" id="email_confirm" placeholder="Confirm your e-mail" value="<?php echo $vars['email_confirm']; ?>" required />
		  		</div>
		  	</div>
		</div>

		<div class="form-group">
    		<label for="phone"><?php echo LANG_PHONE; ?></label>
    		<input type="tel" class="form-control" name="phone" id="phone" placeholder="Your telephone (optional)"/>
  		</div>

  		<?php if ($db_settings['force_category']): ?>
    		<input type="hidden" name="cat" value="<?php echo $db_settings['default_category']; ?>">
    	<?php else: ?>
    		<div class="form-group">
    			<label for="cat"><?php echo LANG_DEPT; ?></label>
    			<select class="form-control" id="cat" name="cat">
				<?php echo $vars['cat_options']; ?>
				</select>
			</div>
		<?php endif; ?>

		<div class="form-group">
    		<label for="subject"><?php echo LANG_SUBJECT; ?></label>
    		<input type="text" class="form-control" name="subject" id="subject" value="<?php echo $vars['subject']; ?>" placeholder="Subject" required />
  		</div>

  		<div class="form-group">
    		<label for="message"><?php echo LANG_SUBJECT; ?></label>
    		<textarea class="form-control" name="message" id="message" rows="6" required><?php echo $vars['message']; ?></textarea>
  		</div>

  		<?php if ($login && $_SESSION['user']['type'] === 'admin'): ?>
  			<div class="form-group">
  				<label for="message"><?php echo LANG_ANSWER; ?></label>
				<textarea class="form-control" name="answer" id="answer" rows="6" required><?php echo $vars['answer']; ?></textarea>
			</div>
		<?php endif; ?>

		<?php
    	//Predefined answer responses MOD START
    	if ((!empty($db_table['answers'])) && ($_SESSION['user']['type'] === 'admin')): ?>
		
		<select class="form-control" name="responses" onChange="setMessage()">
			<option value="">[<?php echo LANG_PREDEFINED; ?>]</option>
			<?php echo $vars['response_options'] ?>
		</select>
		<?php endif; //Predefined answer responses MOD END ?>


  		<div class="row">
  			<div class="col-md-6">
  				<div class="form-group">
		    		<label for="pri"><?php echo LANG_PRIORITY; ?></label>
		    		<select class="form-control" name="pri" id="pri">
						<?php echo $vars['pri_options']; ?>
					</select>
				</div>
			</div>
			<div class="col-md-6">
  				<div class="form-group">
  					<?php
					//CAPTCHA MOD - START
					if ((file_exists('captcha/' . $db_settings['captcha_file'])) && ($_SESSION['user']['type'] != 'admin') && $db_settings['accept_captcha'] == 1):
						if ($db_settings['captcha_file'] == 'captcha.php'): ?>
							<label for="captcha_input"><?php echo LANG_CAPTCHA_TITLE; ?></label>
							<img src="captcha/<?php echo $db_settings['captcha_file']; ?>" alt="<?php echo LANG_CAPTCHA_TITLE; ?>">
								
						<?php elseif ($db_settings['captcha_file'] == 'mathguard/ClassMathGuard.php'): ?>
							<label for="captcha_input"><?php echo LANG_CAPTCHA_QUESTION_TITLE; ?></label>
							<?php require ("captcha/" . $db_settings['captcha_file']);
					        MathGuard::insertQuestion(); ?>			 
						<?php elseif ($db_settings['captcha_file'] == 'securimage/securimage_show.php'): ?>
							<label for="captcha_input"><?php echo LANG_CAPTCHA_TITLE; ?></label>
							<img src="captcha/<?php echo $db_settings['captcha_file']; ?>?sid=<?php echo md5(uniqid(time())); ?>" alt="<?php echo LANG_CAPTCHA_TITLE; ?>">
						<?php elseif ($db_settings['captcha_file'] == 'questcha/questcha.php'): ?>
							<label for="captcha_input"><?php echo LANG_CAPTCHA_QUESTION_TITLE ?></label>
							<?php require ("captcha/" . $db_settings['captcha_file']); ?>
						<?php elseif ($db_settings['captcha_file'] == 'securityimages/captchasecurityimages.php'): ?>
							<label for="captcha_input"><?php echo LANG_CAPTCHA_TITLE; ?></label>
							<img src="captcha/<?php echo $db_settings['captcha_file']; ?>?width=100&height=40&characters=5" />
					    <?php endif; ?>
						<input class="form-control" id="captcha_input" name="captcha_input" type="text" value="" onClick="document.forms[0].captcha_input.value='';" required/>
					<?php endif; //CAPTCHA MOD - END ?>
				</div>
			</div>
  		</div>

  		<?php if ($db_settings['accept_attachments']): ?>
  		<div class="form-group">
			<label for="captcha_input"><?php echo LANG_ATTACHMENT; ?></label>
			<input class="form-control" type="file" name="attachment" id="attachment" onchange="document.getElementById('moreUploadsLink').style.display = 'block';" />
			<div id="moreUploads"></div>
			<button id="moreUploadsLink" class="btn btn-default btn-xs" style="display:none;"><a href="javascript:addFileInput('moreUploads');">Attach another File</a></button>
		</div>
		<?php endif; // end accept attachments ?>

		<button class="btn btn-success btn-lg" type="submit" name="submit_x" ><?php echo LANG_OPEN_TICKET; ?></button>
		<button class="btn btn-default btn-xs" type="reset" ><?php echo LANG_RESET; ?></button>
	</form>
  	</div>
</div>
