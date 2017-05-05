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
                        <strong><span class="tibetan">འཚོལ་ཞིབ་གྲུབ་འབྲས།</span> Search Result </strong>
                        
                    </div>
                
           <?php
                if (isset($_POST['process'])) {
                   $from = $_POST['from'];
                   $to = $_POST['to'];
                   
//$find = mysql_query("SELECT a.*, c.*, d.*, p.* FROM ".TSURPHU." a INNER JOIN ".CURRENCY." c using(currency_id) INNER JOIN ".DONATION." d using(donation_id) INNER JOIN ".PAYMENT." p using(payment_id) WHERE `subDate` >= '$from' AND `subDate` <= '$to'") or die(mysql_error());
     
                   $find = mysql_query("SELECT * FROM " . TSURPHU . " WHERE `subDate` >= '$from' AND `subDate` <= '$to'") or die(mysql_error());
                
?>
                </div>
                <div class="row" style="padding: 10px; background-color: #eee;">
                    <form method="post" action="tsurphu-edit-delete.php">
<table id="example" class="display" cellspacing="10" cellspacing="10" style="width:100% !important;">
    <p style="float:left; margin-bottom: 10px; width: 25%;" id="edit-delete">
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
        
        foreach($_POST['field'] as &$field_name) {
            switch ($field_name) {
                
                case '1':
                    echo '<td><input type="checkbox" id="selecctall"/><label for="all"> All </label></td>';
                    break;
                case '2':
                    echo '<th> Receipt No. </th>';
                    break;
                case '3':
                    echo '<th> Name </th>';
                    break;
                case '4':
                    echo '<th> On Account of</th>';
                    break;
                case '5':
                    echo '<th> Deceased Name</th>';
                    break;
                case '6':
                    echo '<th> Date </th>';
                    break;
                case '7':
                    echo '<th> Others</th>';
                    break;
                case '8':
                    echo '<th> Amount</th>';
                    break;
                case '9':
                    echo '<th> Amount in Word</th>';
                    break;
                case '10':
                    echo '<th> Currency </th>';
                    break;
                case '11':
                    echo '<th> Payment Type </th>';
                    break;
                case '12':
                    echo '<th> Cheque/Draft No. </th>';
                    break;
                
            }
        }
	echo "</tr></thead>";
?>
<tbody style="font-size:12px;">
<?php	
while ($row = mysql_fetch_array($find))
{
	$id = $row['id'];
        $receipt_no = $row['receipt_no'];
	$name = $row['name'];
	$on_account = $row['on_account'];
        $deceased_name = $row['deceased_name'];
        $subDate = $row['subDate'];
        $others = $row['others'];
	$amount_no = $row['amount_no'];
        $amount_word = $row['amount_word'];
	$currency = $row['currency'];
	$payment = $row['payment'];
	$cheque_draft_no = $row['cheque_draft_no'];
	
	
	echo '<tr>';
        foreach($_POST['field'] as &$field_value) {
            switch ($field_value) {
                case '1':
                    echo '<td><input name="selector[]" class="checkbox1" id="edit-delete" type="checkbox" value="' . $id . '"></td>';
                    break;
                case '2':
                    echo '<td>' . $receipt_no . '</td>';
                    break;
                case '3':
                    echo '<td>' . $name . '</td>';
                    break;
                case '4':
                   echo '<td>' . $on_account. '</td>';
                    break;
                case '5':
                    echo '<td>' . $deceased_name. '</td>';
                    break;
                case '6':
                    echo '<td>' . $subDate. '</td>';
                    break;
                case '7':
                    echo '<td>' . $others. '</td>';
                    break;
                case '8':
                    echo '<td>' . $amount_no. '</td>';
                    break;
                case '9':
                    echo '<td>' . $amount_word. '</td>';
                    break;
                case '10':
                    echo '<td>' . $currency. '</td>';
                    break;
                case '11':
                    echo '<td>' . $payment. '</td>';
                    break;
                case '12':
                    echo '<td>' . $cheque_draft_no. '</td>';
                    break;
                

            }
        }
	
	
	?>
    <?php echo '</tr>';
	
}
 
?>
</tbody>
</table>                      
<p style="margin-top: 10px; width: 30%;">
<p style="margin-top: 10px; width: 25%;" id="edit-delete">
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

