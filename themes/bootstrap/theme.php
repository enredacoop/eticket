<?php
// This is the current theme version you are running.
$themeversion = '1.7.0';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $db_settings['site_title']; ?></title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=<?php echo $db_settings['charset']; ?>">
<script language="JavaScript" type="text/javascript">
<!--
function popup() {
window.open ("help.php", "help","location=1,status=1,scrollbars=1,width=400,height=250");
}

//-->
</script>
<style media="screen" type="text/css">
    body {
      padding-top: 70px;
      padding-bottom: 40px;
    }

    .form-signin {
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
      margin-bottom: 10px;
    }
    .form-signin .checkbox {
      font-weight: normal;
    }
    .form-signin .form-control {
      position: relative;
      height: auto;
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
      padding: 10px;
      font-size: 16px;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
</style>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><?php echo $db_settings['site_title']; ?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li id="home"><a href="index.php">Main</a></li>
                <?php if (isset($login) && ($login != 0) && isset($_SESSION['user']['type'])) { ?>
                <li><a href="javascript:void(0)" onclick="window.open ('help.php', 'help','location=1,status=1,scrollbars=1,width=400,height=250')">Help</a></li>
                <?php if (!$db_settings['search_disp']) { ?>
                <li><a href="search.php">Search</a></li>
                <?php
                } ?>
                <li><a href="open.php">New Ticket</a></li>
              </ul>
              <a href="index.php?a=logout"><button type="button" class="navbar-right btn btn-danger navbar-btn ">Logout <i class="fa fa-power-off"></i></button></a>
              <p class="navbar-text navbar-right">
              <?php if (isset($login) && ($login != 0) && isset($_SESSION['user']['id'])) {
            echo LANG_USER . ': ' . $_SESSION['user']['id'];
            } ?> </p> 
            <?php
        } ?>
        </div>
     </div>
 </nav>


        <div class="content row">%%BODY%%</div>
    </div>
    <div class="clearfix"></div>
    <div style="padding-top: 30px;" class="container">
        <div class="row">
        <div class="footer panel panel-default">
            <div class="panel-body"><?php show_copy(); ?></div>
        </div>
    </div>
    </div>
    </body>
</html>