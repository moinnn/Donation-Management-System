<?php
include_once 'include/processes.php';
$Login_Process = new Login_Process;
$Login_Process->check_status($_SERVER['SCRIPT_NAME']);
include_once 'templates/header.php';   
?>
 <!-- Custom CSS -->
 <link href="css/round-about.css" rel="stylesheet">
</head>
<body style="background-color: #ffffff">

        <?php include_once 'templates/nav.php'; ?>

<!-- Page Content -->
    <div class="container">

       

<!-- Team Members Row -->
        <div class="row">
            <div class="col-lg-12">
                &nbsp;
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                 <p><a href="tsurphu/tsurphu-dashboard.php" style="text-decoration: none;"><i class="fa fa-university fa-5x"></i></a></p>
              
                <p>ABC CHARITABLE TRUST</p>
            </div>
            
            <div class="col-lg-4 col-sm-6 text-center">
                <p><a href="currency/add_currency.php" style="text-decoration: none;"><i class="fa fa-money fa-5x"></i></a></p>
                 
                <p>ADD CURRENCY</p>
            </div>
            
        </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p style="text-align: center;">Copyright &copy; 2016:  All Right Reserved</p> 
                     <p style="text-align: center;">Developed by: <a href="mailto:tasam21@gmail.com">Tashi Samphel</a></p> 
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div> 
<!-- jQuery -->    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
