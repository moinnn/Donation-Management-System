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
                            <span class="tibetan-large">འཚོལ་ཞིབ།</span> Search
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  Search for deceased name
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Users Search
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6" style="margin-bottom: 20px;">
                        
<div style="width: 80%">
    <form action="tsurphu-deceasedsearch.php" method="post" name="myform" > 
        <div class="form-group">
            <div style="float:left; width: 30% !important;">
                <label><span class="tibetan">ཟླ་ཚེས་འདི་ནས།</span> From: (yyyy-mm-dd)</label>
                <input class="form-control" style="width: 65% !important;" data-format="yyyy-mm-dd" type="date" name="from">
            </div>
            <div>
                <label><span class="tibetan">ཟླ་ཚེས་འདི་བར།</span> To: (yyyy-mm-dd)</label>
                <input class="form-control" style="width: 20% !important;" data-format="yyyy-mm-dd" type="date" name="to">

            </div>

        </div>
        <input type="submit" name="process" class="btn btn-primary" value="Search Button">
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
 
 <?php include_once '../templates/tsurphu_footer2.php'; ?>
</body>

</html>
