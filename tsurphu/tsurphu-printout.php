<?php
include_once '../include/processes.php';
$Login_Process = new Login_Process;
$Login_Process->check_status($_SERVER['SCRIPT_NAME']);
include_once '../templates/tsurphu_header.php';  
?>

</head>

<body>

    <div id="wrapper">

        <?php 
         include_once '../templates/navigation.php'; 
         include_once '../templates/side-navigation.php';
         ?>
       

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1>
                            <span class="tibetan-large">འཚོལ་ཞིབ།</span> Print Receipt
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="#">Domestic Search</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Print Receipt
                            </li>
                        </ol>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6" style="margin-bottom: 20px;">
                        
                        
<div style="width: 80%">
    <form  action="tsurphu-receiptprint.php" method="post" name="myform"> 

    <strong>Enter Receipt Number to print</strong>
    <div style="margin-top: 15px; padding-bottom: 30px; width: 100%;">
    <div style="width: 20%; margin-right: 10px; float: left;">
        <input type="text" name="searchterm" id="searchterm" placeholder="Search..." class="form-control" />
    </div>  
        <div style="width: 40%; float: left;">
            <input type="submit" value="Show" name="btnSearch" class="btn btn-lg btn-primary" style="padding: 4px !important;" />
        </div>
    
</div>
								  
</form> 
</div>

</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->
           
</div>
<!-- /#page-wrapper -->

</div>
 
 <?php include_once '../templates/tsurphu_footer.php'; ?>
</body>

</html>
