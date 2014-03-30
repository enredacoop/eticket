<?php if (!defined('ISINC')) die('serious error! File: '.__FILE__.' File line: '.__LINE__.''); ?>

	<?php if (isset($err)): ?>
  		<div class="alert alert-danger"><?php echo $err; ?></div>
	<?php
	endif; ?>

	 <form action="<?php echo $form_action; ?>" method="post" name="admin_login" class="form-signin" role="form">
        <h2 class="form-signin-heading"><?php echo LANG_LOGIN_PLEASE; ?></h2>
        <input type="text" class="form-control" name="login_user" placeholder="<?php echo LANG_USER; ?>" required autofocus>
        <input type="password" class="form-control" name="login_pass" placeholder="<?php echo LANG_PASS; ?>" required>

        <input type="submit" name="login" value="<?php echo LANG_LOGIN; ?>" class="btn btn-lg btn-primary btn-block" />
      </form>
