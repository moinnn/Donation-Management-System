<?php
include_once '../include/processes.php';
$Login_Process = new Login_Process;
$Login_Process->check_status($_SERVER['SCRIPT_NAME']);
$Login_Process->connect_db();
include_once '../templates/tsurphu_header.php';
?>
<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css" />
</head>

<body>
    <div id="wrapper">
 <?php 
         include_once '../templates/navigation.php'; 
         include_once '../templates/side-navigation.php';
         ?>

        <div id="page-wrapper" style="padding:20px;">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12" style="margin-bottom: 10px; padding: 0px;">
                        <strong><span class="tibetan-large">འཚོལ་ཞིབ་གྲུབ་འབྲས།</span> Search Result of Deceased Person </strong>
                        
                    </div>
                
           <?php
                if (isset($_POST['process'])) {
                   $from = $_POST['from'];
                   $to = $_POST['to'];
                   
//$find = mysql_query("SELECT a.*, c.*, d.*, p.* FROM ".TSURPHU." a INNER JOIN ".CURRENCY." c using(currency_id) INNER JOIN ".DONATION." d using(donation_id) INNER JOIN ".PAYMENT." p using(payment_id) WHERE `subDate` >= '$from' AND `subDate` <= '$to'") or die(mysql_error());
     
                   $find = mysql_query("SELECT * FROM " . TSURPHU . " WHERE `subDate` >= '$from' AND `subDate` <= '$to' AND `deceased_name` !=''") or die(mysql_error());
                
?>
                </div>
                <div class="row" style="padding: 10px; background-color: #eee;">
                    <form method="post" action="tsurphu-edit-delete.php">

<table id="example" class="display" cellspacing="10" cellspacing="10" style="width:100% !important;">
<p style="float:left; margin-bottom: 10px; width: 25%;">
<?php 
if($_SESSION['user_level'] >= 5) {
?>	
<select name="action" class="form-control3" id="no-print">
<option selected>Bulk Actions</option>
<option value="edit">Edit</option>
<option value="delete">Delete</option>
</select>
<input type="submit" name="submit" value="Apply" class="btn btn-default" id="no-print">
<?php
}
?>
</p>
<?php
	
	echo '<thead style="font-size:12px;"><tr style="background:#FFF; color:#333;">';
	echo '<td width="5%" id="no-print"><input type="checkbox" id="selecctall"/><label for="all"> All </label></td>';
	echo '<th width="10%"> Receipt No. </th>';
        echo '<th width="10%"> Entry Date </th>';
	echo '<th width="40%"> Deceased Name </th>';
        
	
	echo '</tr></thead>';
	
	echo '<tfoot style="font-size:12px;"><tr style="background:#FFF; color:#333;">';
	echo '<th width="5%" id="no-print"> # </th>';
	echo '<th width="10%"> Receipt No. </th>';
        echo '<th width="10%"> Entry Date </th>';
	echo '<th width="40%"> Deceased Name </th>';
        
	echo '</tr></tfoot>';
?>
<tbody style="font-size:12px;">
<?php	
while ($row = mysql_fetch_array($find))
{
	$id = $row['id'];
        $receipt_no = $row['receipt_no'];
	$subDate = $row['subDate'];
	$deceased_name = $row['deceased_name'];
	
	echo '<tr>';
	echo '<td id="no-print"><input name="selector[]" class="checkbox1" type="checkbox" value="' . $id . '"></td>';
	echo '<td>' . $receipt_no . '</td>';
        echo '<td>' . $subDate . '</td>';
        echo '<td>' . $deceased_name . '</td>';
        
	?>
    <?php echo '</tr>';
	
}
 
?>
</tbody>
</table>
<p style="margin-top: 10px; width: 30%;">
<?php 
if($_SESSION['user_level'] >= 5) {
?>	
<select name="action2" class="form-control3" id="no-print">
<option selected>Bulk Actions</option>
<option value="edit">Edit</option>
<option value="delete">Delete</option>
</select>
    <input type="submit" name="submit" value="Apply" id="no-print" class="btn btn-default">
<?php
}
?>
  
</p>

</form>
  &nbsp;&nbsp;<button onClick="window.print();" id="no-print" class="btn btn-default">Print</button>                    
<?php

}
else {
	echo '<div style="text-align:center; padding-top: 10px;color:#FF9900;font-size:26px; font-weight:500;">Sorry, no records were found!</div>';
}

//}
?>

                
            <!-- /.container-fluid -->

        </div><!-- #row -->
                
        <!-- /#page-wrapper -->
            </div>
    </div>

 <?php include_once '../templates/tsurphu_footer2.php'; ?>
</body>

</html>

