<!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand" href="index.php">ABC Charitable Trust: Donations Management System</small></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
                    
                    <ul class="dropdown-menu">
                        <li><i class="fa fa-fw fa-gear"></i> Settings</li>
                        <li class="divider"></li>
                        <li>
                            <a href="edituser.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                       
                        <li>
                            <a href="forgotpassword.php"><i class="fa fa-fw fa-lock"></i> Password</a>
                        </li>
                        <li class="divider"></li>
                         <li>
                             <a href="include/processes.php?log_out=true"><i class="fa fa-fw fa-power-off"></i>Log out</a>
                            
                        </li>
                    </ul>
                </li>
            </ul>
            
            <!-- /.navbar-collapse -->
        </nav>
