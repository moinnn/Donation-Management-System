<?php
include_once 'include/processes.php';
$Login_Process = new Login_Process;
$Check = $Login_Process->Forgot_Password($_GET, $_POST);
$Request = $Login_Process->Request_Password($_POST, $_POST['Request']);
$Reset = $Login_Process->Reset_Password($_POST, $_POST['Reset']);
include_once 'templates/header.php'; 
?>
</head>
<body>
<?php 
switch($Check) {
	case "<!-- !-->":
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <img class="profile-img" src="images/logo.jpg?sz=120" alt="">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin" >
                <h2>Reset Password</h2>
                <div style="color:red;"><?php  echo $Check.$Reset; ?></div>
      <br />
        <p>
        <label for="inputPassword" class="sr-only">New Password</label>
        <input name="pass1" type="password" id="inputPassword" class="form-control" placeholder="Password" required autofocus>
       </p>
       <p>
        <label for="inputPassword" class="sr-only">Confirm Password</label>
        <input name="pass2" type="password" id="inputPassword" class="form-control" placeholder="Confirm Password" required>
        </p>
        
        <input name="username" type="hidden" id="username" value="<?php echo $_GET['username']; ?>" />
        <input name="code" type="hidden" id="code" value="<?php echo $_GET['code']; ?>" />
        <input class="btn btn-lg btn-primary btn-block" type="submit" name="Reset" value="Reset Password" id="Reset">
                </form>
                <div class="center">
		<a href="index.php">Login</a>
		</div>
            </div>
           
        </div>
    </div>
</div>
<?php 
	break;
	default:
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <img class="profile-img" src="images/logo.jpg?sz=120" alt="">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin" >
                <h2 style="text-align:center; color:#333;">Request Password Reset</h2>
                <div style="color:red;"><?php  echo $Check.$Request; ?></div>
      <br />
        <p>
        <label for="inputUsername" class="sr-only">Email Address</label>
        <input name="email" type="text" id="inputUsername" class="form-control" placeholder="Email Address" required>
       </p>
       <p>
        <label for="inputUsername" class="sr-only">Username</label>
        <input name="username" type="text" id="inputUsername" class="form-control" placeholder="User Name" required>
        </p>
        
        
        <input class="btn btn-lg btn-primary btn-block" type="submit" name="Request" value="Request Reset Email" id="Request">

                </form>
            </div>
           
        </div>
    </div>
</div>
    <?php

}
?>
</body>
</html>
<?php
	include('include/logs.php');
?>
