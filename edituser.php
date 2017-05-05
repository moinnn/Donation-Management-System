<?php
include_once 'include/processes.php';
$Login_Process = new Login_Process;
$Login_Process->check_status($_SERVER['SCRIPT_NAME']);
$Edit = $Login_Process->edit_details($_POST, $_POST['process']);
include_once 'templates/header.php';   
?>
</head>

<body>

    <div id="wrapper">

         <?php 
         include_once 'templates/nav.php'; 
         include_once 'templates/side-nav.php';
         ?>
       

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1>
                            ཉིན་རེའི་ལྟོ་ཆས། Edit Account Details
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> Edit Account Details
                            </li>
                            
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6" style="margin-bottom: 20px;">

                    
                        
                        
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="width: 400px;">


    <div style="color:green; font-size:20px;">
<?php  echo $Edit; ?>
</div><br>
<div class="form-group input-group">
 <span class="input-group-addon">First Name</span>
                              <input type="text" class="form-control" placeholder="First Name" name="first_name" value="<?php echo $_SESSION['first_name']; ?>" />
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon">Last Name</span>
                                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="<?php echo $_SESSION['last_name']; ?>"  />
                                        </div>
                                         <div class="form-group input-group">
                                            <span class="input-group-addon">Email ID&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <input type="text" class="form-control" placeholder="Your Email" name="email_address" value="<?php echo $_SESSION['email_address']; ?>" />
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Brief Info&nbsp;&nbsp;&nbsp;</span>
                                            <input type="text" class="form-control" placeholder="Info" name="info" value="<?php echo $_SESSION['info']; ?>" />
                                        </div>
                                        
                                      
                                        
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">User Name</span>
                                            <input type="text" class="form-control" placeholder="User Name" name="username" value="<?php echo $_SESSION['username']; ?>" />
                                        </div>
                                     <input class="btn btn-lg btn-primary btn-block" type="submit" name="process" id="process" value="Save">
                                     
                                    <hr />
                                    Already Registered ?  <a href="index.php" >Login here</a>
                                    </form>
                            

                    </div>
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
           
        </div>
        <!-- /#page-wrapper -->

    </div>
 
<?php include_once 'templates/footer.php'; ?>
</body>

</html>
