<?php
/******* Description **************/
/**This is a custom build web based Donation Management System for Charitable Organization and trust to easily handle their donation computerized, create by Tashi Samphel*********/


include_once 'include/processes.php';
$Login_Process = new Login_Process;
$Login_Process->check_login($_GET['page']);
$Login = $Login_Process->log_in($_POST['user'], $_POST['pass'], $_POST['remember'], $_POST['page'], $_POST['submit']); 

include_once 'templates/header.php'; 
?>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div style="text-align:center; font-size:16px !important;">ABC Charitable Trust: Donations Management System</div>
            <h1 class="text-center login-title"><?php echo $Login; ?></h1>
            <div class="account-wall">
                <div style="text-align:center"><i class="fa fa-university fa-5x"></i></div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin" >
                <input type="text" class="form-control" placeholder="Username" name="user" required autofocus>
                <input type="password" class="form-control" placeholder="Password" name="pass" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" style="margin-top:10px;">
                    Sign in</button>
                
                <input name="page" type="hidden" value="<?php echo $_GET['page']; ?>" />
                <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
           
        </div>
        
    </div>
    <div style="text-align:center"><br />
   <p> <strong>For DEMO purpose use the following credentials</strong>
    <div>Staff: demo | demo <br />
    Admin: admin | admin</div></p>
    </div>
</div>
</body>
</html>

<?php
	include('include/logs.php');
?>
