<?php if (!defined('ISINC')) die('serious error! File: '.__FILE__.' File line: '.__LINE__.''); ?>

<?php if (isset($err)): ?>
   <div class="alert alert-danger"><?php echo $err; ?></div>
<?php endif; ?>

<div class="row">
  <div class="col-md-6 col-md-offset-3">
  <form action="<?php echo $form_action ?>" class="form-inline" method="post" name="user_login">
    <h2 class="form-signin-heading"><?php echo LANG_LOGIN_PLEASE; ?>:</h2>
    <div class="input-group input-group-lg">
      <input class="form-control"  type="text" name="login_email" placeholder="<?php echo LANG_EMAIL; ?>" value="<?php echo $e; ?>" required />
      <span class="input-group-btn" style="width:0px;"></span>
      <input style="margin-left: -1px;" class="form-control" type="text" name="login_ticket" placeholder="<?php echo LANG_TICKET_ID; ?>" value="<?php echo $t; ?>">
      <div class="input-group-btn">
         <button class="btn btn-success" type="submit" name="login"><?php echo LANG_VIEW_STATUS; ?></button>
      </div>
    </div>
  </form>
</div>
</div>