<?php
include_once '../include/processes.php';
$Login_Process = new Login_Process;
$Login_Process->check_status($_SERVER['SCRIPT_NAME']);
$Login_Process->check_admin($_SERVER['SCRIPT_NAME']);
$Login_Process->connect_db();
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
                           
                            <li class="active">
                                <i class="fa fa-edit"></i> Search result of each user
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
               


                <div class="row">
                    <div class="col-lg-6" style="margin-bottom: 20px;">
                       
<div style="width: 80%">
    <form action="tsurphu-usersearch.php" method="post" name="myform" > 
        <div class="form-group">
            <div style="float:left; width: 30% !important;">
                <label><span class="tibetan">ཟླ་ཚེས་འདི་ནས།</span> From:</label>
                <input class="form-control" style="width: 65% !important;" data-format="yyyy-mm-dd" type="date" name="from">
            </div>
            <div>
                <label><span class="tibetan">ཟླ་ཚེས་འདི་བར།</span> To:</label>
                <input class="form-control" style="width: 20% !important;" data-format="yyyy-mm-dd" type="date" name="to">

            </div>
            
            <div style="margin-top: 15px; padding-bottom: 30px;">
                <label><span class="tibetan">བཀོལ་བདག </span> Select User:</label>
<p><select class="form-control" name="searchterm" style="width: 18%">
        <?php $query = "SELECT `username` FROM users";
        $result = mysql_query($query) or die('error found');
        while ($row = mysql_fetch_array($result)) {
            //$currency_id = $row['currency_id'];
            $username = $row['username'];
           //$currency_fullname = $row['currency_fullname'];

            //echo '<option value=$case_cat_id>' . $case_cat_id . ' '  . $case_type . '</option>';
            echo "<option value='$username'>" . $username . "</option>";
        } ?>
                               </select></p>
</div>

        </div>
        <input type="submit" name="btnSearch" class="btn btn-lg btn-primary" value="Search Button">
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
