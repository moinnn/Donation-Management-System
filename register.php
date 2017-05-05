<?php
include_once 'include/processes.php';
$Login_Process = new Login_Process;
$New = $Login_Process->Register($_POST, $_POST['process']);
include_once 'templates/header.php'; 
?>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
             <div class="account-wall">
                <img class="profile-img" src="images/logo.jpg?sz=120" alt="">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin" >
                    <div style="color: red;">
                    <?php  echo $New; ?>
                    </div><br>
                <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                              <input type="text" class="form-control" placeholder="First Name" name="first_name" value="<?php echo $_POST['first_name']; ?>" />
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="<?php echo $_POST['last_name']; ?>" />
                                        </div>
                                         <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" placeholder="Your Email" name="email_address" value="<?php echo $_POST['email_address']; ?>" />
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Info" name="info" value="<?php echo $_POST['info']; ?>" />
                                        </div>
                                        
                                      <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" name="pass1" class="form-control" placeholder="Enter Password" />
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" name="pass2" class="form-control" placeholder="Retype Password" />
                                        </div>
                                        
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                            <input type="text" class="form-control" placeholder="User Name" name="username" value="<?php echo $_POST['username']; ?>" />
                                        </div>
                                     <input class="btn btn-lg btn-primary btn-block" type="submit" name="process" value="Register">
                                     
                                    <hr />
                                    Already Registered ?  <a href="index.php" >Login here</a>

                </form>
            </div>
           
        </div>
    </div>
</div>

