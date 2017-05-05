<?php
include_once '../include/processes.php';
$Login_Process = new Login_Process;
$Login_Process->check_status($_SERVER['SCRIPT_NAME']);
$Login_Process->connect_db();
include_once '../templates/tsurphu_header.php'; 
?>

</head>

<body style="margin: 0px !important;">
    
 <?php
                if (isset($_POST['btnSearch'])) {
                    $search = stripslashes($_POST['searchterm']);
                    $search = mysql_real_escape_string(trim($_POST['searchterm']));
//$find = mysql_query("SELECT a.*, c.*, d.*, p.* FROM ".TSURPHU." a INNER JOIN ".CURRENCY." c using(currency_id) INNER JOIN ".DONATION." d using(donation_id) INNER JOIN ".PAYMENT." p using(payment_id) WHERE `name` LIKE '%$search%'") or die(mysql_error());
     
                    $find = mysql_query("SELECT * FROM " . TSURPHU . " WHERE `receipt_no` = '$search'") or die(mysql_error());
                
?>


                   


<?php	
while ($row = mysql_fetch_array($find))
{
	//$id = $row['id'];
        $receipt_no = $row['receipt_no'];
	$name = $row['name'];
        $address = $row['address'];
        $on_account = $row['on_account'];
        $deceased_name = $row['deceased_name'];
        $others = $row['others'];
	
	$amount_no = $row['amount_no'];
        $amount_word = $row['amount_word'];
	$currency = $row['currency'];
	
	$payment = $row['payment'];
	$cheque_draft_no = $row['cheque_draft_no'];
        $cheque_date = $row['cheque_date'];
	$subDate = $row['subDate'];
        $user = $row['user'];
		
}
 
?>
<div id="page-wrapper">
    
<table>
                            <tr>
                                <td></td><br>
                                <td style="width: 100px;">&nbsp;</td><br>
                                <td style="text-align: center;"><span class="tibetan-large"></span> <br> <br><span class="english"> <br> </span></td>
                                
                            </tr>
<tr>
</tr>
                        </table> 
    <br>
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 30%;"><span class="tibetan">ཨང་།</span> No. <span class="underline_text"><?php echo $receipt_no; ?></span></td>
                                <td style="width: 30%;"><strong><span class="tibetan"></span></strong></td>
                                <td style="width: 20%; text-align: left;"><span class="tibetan">ཟླ་ཚེས། </span>Date: <span class="address_underline_text"><?php echo $subDate; ?></span></td>
                            </tr>
                        </table>
    <br>

                        <table>

                            <tr style="margin-top: 60px;">
                                <td style="width: 90%;"><span class="tibetan">དད་དམ་མཆོག་ཏུ་ཡངས་པ་ </span><span style="line-height: 2%;">Received with thanks from:</span> <span class="tibetan-line">&nbsp; <?php echo $name; ?>&nbsp;&nbsp;</span></td>
                                <td style="width: 10%;"></td>
                            </tr>
                           
                            <tr style="margin-top: 60px;">
                                <td style="width: 90%;"><span class="tibetan">དམིགས་ཡུལ། </span>On account of: <span class="tibetan-line">&nbsp;&nbsp; <?php echo $on_account; ?> &nbsp;&nbsp;&nbsp;</span> <span class="tibetan-line"><?php echo $deceased_name; ?><?php echo $others; ?></span></td>
                                <td></td>
                            </tr>
                            
                        </table>
                        <table>

                            <tr style="margin-top: 60px;">
                                <td style="width: 30%;"><span class="tibetan">སྒོར། </span>Currency <span class="underline_text"><?php echo $currency; ?>&nbsp;<?php echo $amount_no; ?> </span></td>
                                <td style="width: 70%;">&nbsp;&nbsp;(In Word) <span class="underline_text">&nbsp; <?php echo $amount_word; ?> &nbsp;&nbsp;</span></td>
                            </tr>
                        </table>
                        
                        <table>
                        <tr style="margin-top: 60px;">
                                <td style="width: 80%;"><span class="tibetan"> དངུལ་སྨར། དངུལ་འཛིན། ཌབ་འཛིན། </span> Cash / Cheque / Draft No. <span class="underline_text">&nbsp; <?php echo $payment; ?> <?php echo $cheque_draft_no; ?> </span></td>
                        </tr>
                            <tr style="margin-top: 60px;"> 
                            <td style="width: 80%;"><span class="tibetan">འཛིན་གྱི་ཟླ་ཚེས། </span>Cheque/Draft Date: <span class="underline_text"> <?php echo $cheque_date; ?> </span></td>
                            </tr>
                        </table>
    <br>
                        <table>
                           
                        <tr style="margin-top: 60px;">
                                <td style="width: 90%;"><span class="tibetan-small">དད་འབུལ་བའི་བློ་མོས་བཞིན་དད་རྫས་རྣམས་ཆུད་མི་འཛའ་བར་ཆོས་ཕྱོགས་དང་འབྲེལ་བའི་དགེ་རྩ་ཁོ་ནའི་ཕྱིར་སྨིན་གཏོང་གང་དགེ་ཞུ་རྒྱུ་བཅས། སྤྱི་ལས་ཁང་ནས། </span></td>
                                
                            </tr>
                         
                            <tr style="margin-top: 60px;">
                                <td style="width: 90%;"><span class="english-small">Offerings will be used for charitable & religious purposes and to sustain Institutes under the ABC Charitable Trust or according to the specific wishes of the donor.</span></td>
                         </tr>
<tr>

                                
                            </tr>
                        </table>
                        
                        <table width="100%">
                        <tr style="margin-top: 50px;"><br>
<td style="width: 20%; text-align: left; color: #ccc;"><span class="english">Staff: <?php echo $user; ?></span></td>

                            <td style="width:80%;"></td>
                            <td style="width:20%;"><div style="text-align: right; float: Sright; font-size: 11px;”></div></td>
                             </tr>
                             <tr>
                                <td style="width:80%;"></td>
                              <td style="width:20%;"><div style="float: right; font-size: 11px; padding-top: 10px;"></div></td>
                            </tr>
                        </table>
  
                        <table><tr><td><button onClick="window.location='tsurphu-donation.php';" id="no-print"><< Back</button></td><td>&nbsp;&nbsp;&nbsp;</td><td><button onClick="window.print();" id="no-print">Print Receipt</button></td></tr></table>
                        </div>
            <!-- /.container-fluid --> 
<?php

}
else {
	echo '<div style="text-align:center; padding-top: 10px;color:#FF9900;font-size:26px; font-weight:500;">Sorry, no records were found!</div>';
}

//}
?>

</body>

</html>

