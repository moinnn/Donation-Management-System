<?php

include_once '../include/processes.php';
$Login_Process = new Login_Process;
$Login_Process->check_status($_SERVER['SCRIPT_NAME']);
$Login_Process->connect_db();
$New = $Login_Process->Add_Document($_POST, $_POST['process']);
include_once '../templates/tsurphu_header.php'; 

?>
<script src="../js/conversion.js"></script>
</head>

<body>

    <div id="wrapper">
 <?php 
         include_once '../templates/navigation.php'; 
         include_once '../templates/side-navigation.php';
         ?>
       

        <div id="page-wrapper" style="padding: 20px">

            <div class="container-fluid">
             <div class="row">
                    <div class="col-lg-12" style="margin-bottom: 10px; padding: 0px;">
                        <strong><span class="tibetan-large"> ཞལ་འདེབས།</span> Add Donation </strong>
                        
                        <ol class="breadcrumb">
                            <li>
                                <span style="color:red;"><?php echo $New; ?></span>
                            </li>
                            <li>
                                <span style="color:green;"><?php
                                    $msg = $_GET['message'];
                                    echo $msg;
                                    ?></span>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6" style="margin-bottom: 20px;">

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">
                            
                            <div class="form-group">
                                <div style="float:left">
                                <label><span class="tibetan">ཨང་།</span> Receipt No:</label>
                              
                                <input type="text" class="form-control" style="width: 60% !important; color:#999999;" name="receipt_no" value="<?php
                                $query = mysql_query("SELECT `receipt_no` FROM tsurphus");
                                if(mysql_num_rows($query)>0){
                                $data = mysql_query("SELECT max(receipt_no)+1 FROM tsurphus");
                                $res = mysql_fetch_row($data);
                                echo $res[0];
                                echo $_POST['$res'];
                                }
                                else {
                                    echo 1;
                                }
                                ?>" readonly>
                                
                                </div>
                                <div>
                                     <label><span class="tibetan">* ཟླ་ཚེས།</span> Date: (yyyy-mm-dd)</label>
                                     <input class="form-control" style="width: 20% !important;" type="text" name="subDate" value="<?php $subDate = date("Y-m-d");
echo "$subDate"; echo $_POST['$subDate']; ?>">
                                    
                                </div>
                            
                            </div>

                            <div class="form-group">
                                <label><span class="tibetan">* དད་དམ་མཆོག་ཏུ་ཡངས་པ།</span> Received with thanks from:</label>
                                <input class="form-control" placeholder="Donar Name" style="width: 40% !important" type="text" name="name" id="name" value="<?php echo $_POST['name']; ?>">
                            </div>
                            <div class="form-group">
                                <label><span class="tibetan"> ཁ་བྱང་།</span> Address:</label>
                                <input class="form-control" placeholder="Address" style="width: 40% !important" type="text" name="address" id="name" value="<?php echo $_POST['address']; ?>">
                            </div>
                            <div class="form-group" style="width:45% !important; background-color:#eee; padding: 10px;">
                                <label>* Choose File: </label> 
                                <input type="file" class="file_input" name="proof_doc" />
                            </div> 
                            <div class="form-group" style="background-color: #eee; padding: 10px;">
                                <label><span class="tibetan">* དམིགས་ཡུལ།</span> On account of </label> <br>
                                <table>
                                    <tr>
                                        <td><label class="checkbox-inline">
                                                <input type="checkbox" name="on_account" value="སྐྱབས་རྟེན། Offering for living"><span class="tibetan">སྐྱབས་རྟེན།</span> Offering for living
                                </label></td>
                                <td><label class="checkbox-inline">
                                        <input type="checkbox" name="on_account" value="བསྔོ་རྟེན། Offering for deceased" id="deceased"><span class="tibetan">བསྔོ་རྟེན།</span> Offering for deceased
                                </label></td>
                                <td> <label class="checkbox-inline">
                                    <input type="checkbox" name="on_account" value="དབུ་ཞྭའི་དོད། Crown Usha offering"><span class="tibetan">དབུ་ཞྭའི་དོད།</span> Crown (Usha) offering
                                </label></td>
                                    </tr>
                                    
                                      <tr>
                                        
                                <td><label class="checkbox-inline">
                                    <input type="checkbox" name="on_account" value="མར་མེའི་ཞལ་འདེབས། Butter lamp offering"><span class="tibetan">མར་མེའི་ཞལ་འདེབས།</span> Butter lamp offering
                                </label></td>
                                <td> <label class="checkbox-inline">
                                    <input type="checkbox" name="on_account" value="མང་ཇ། Tea"><span class="tibetan">མང་ཇ།</span> Tea
                                </label></td>
                                <td><label class="checkbox-inline">
                                    <input type="checkbox" name="on_account" value="དགེ་འདུན་པའི་སྨན་དོད། Medical expense of sangha"><span class="tibetan">དགེ་འདུན་པའི་སྨན་དོད།</span> Medical expense of sangha
                                </label></td>
                                </tr>
                                    
                                <tr>
                                        <td><label class="checkbox-inline">
                                    <input type="checkbox" name="on_account" value="གསོལ་ཚིགས། Meal"><span class="tibetan">གསོལ་ཚིགས།</span> Meal
                                </label></td>
                                <td> <label class="checkbox-inline">
                                    <input type="checkbox" name="on_account" value="སྤྱིར་བཏང་ཞལ་འདེབས། General donation"><span class="tibetan">སྤྱིར་བཏང་ཞལ་འདེབས། </span>General donation
                                </label></td>
                                <td> <label class="checkbox-inline">
                                    <input type="checkbox" name="on_account" value="དམིགས་བསལ་ཞབས་རིམ། Special prayer request"><span class="tibetan">དམིགས་བསལ་ཞབས་རིམ།</span> Special prayer request
                                </label></td>
                                    </tr>
                                    
                                <tr>
                                        <td><label class="checkbox-inline">
                                    <input type="checkbox" name="on_account" value="གཞན་ཡང་།" id="others"><span class="tibetan">གཞན་ཡང་།</span> Others
                                </label></td>
                                <td> </td>
                                <td> </td>
                                </tr>
                            </table>                 
                            </div>
                            <div class="form-group" id="dvDeceased" style="display: none">
                                <label><span class="tibetan"> ཚེ་འདས་མིང་།</span> Deceased Person Name:</label> 
                                <input type="text" class="form-control" name="deceased_name" style="width: 47% !important;"value="<?php echo $_POST['deceased_name']; ?>">
                            </div>
                            <div class="form-group" id="dvOthers" style="display: none">
                                <label><span class="tibetan">གཞན་ཡང་།</span> Others Details:</label> 
                                <input type="text" class="form-control" name="others" style="width: 47% !important;" value="<?php echo $_POST['others']; ?>">
                            </div>
                            
                            <div class="form-group">
                                <div style="float:left; width:15%; margin-right: 10px;">
                                    <label><span class="tibetan">* སྒོར།</span> Amount:</label> 
                               <select class="form-control" name="currency">
                                   <?php $query = "SELECT `currency_shortname`,`currency_fullname` FROM currencies";
        $result = mysql_query($query) or die('error found');
        while ($row = mysql_fetch_array($result)) {
            //$currency_id = $row['currency_id'];
            $currency_shortname = $row['currency_shortname'];
            $currency_fullname = $row['currency_fullname'];

            //echo '<option value=$case_cat_id>' . $case_cat_id . ' '  . $case_type . '</option>';
            echo "<option value='$currency_shortname'>" . $currency_fullname . "</option>";
        } ?>
                               </select>
                                </div>
                                <div style="float:left; width:20%; margin-top: 10px;">
                                    <label><br></label>
                                    <input class="form-control" type="text" placeholder="e.g. 1000" name="num" id="num" value="<?php echo $_POST['num']; ?>">
                                </div> 
                                <div style="float:left; width:10%; margin: 10px;">
                                     <label>&nbsp;</label>
                                    <input type="button" class="convert-btn" name="sr1" value="In Word" onClick="numinwrd()">
                                    
                                 </div>
                                <br>
                                
                            
                            </div>
                            <div class="form-group">
                                <label><span class="tibetan">* དངུལ་ཚིག</span> Amount in Word:</label> 
                                <input type="text" class="form-control" name="amount_word" id="number" style="width: 47% !important;" value="<?php echo $_POST['amount_word']; ?>">
                                </div>
                            
                            
                            <div class="form-group">
                                <div>
                                <label>* Payment Type </label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="payment" id="optionsRadiosInline1" value="Cash" checked="checked"><span class="tibetan">དངུལ་སྨར།</span> Cash
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment" id="optionsRadiosInline2" value="Cheque"><span class="tibetan">དངུལ་འཛིན།</span> Cheque
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment" id="optionsRadiosInline3" value="Draft"><span class="tibetan">ཌབ་འཛིན།</span> Draft
                                </label>
                                </div>
                            </div>
                             <div class="form-group">
                                <div style="width:60%; margin-top: 5px;">
                                    
                                    <input class="form-control" style="width:28% !important; display:none; float: left; margin-right: 10px;" type="text" placeholder="yyyy-mm-dd" name="cheque_date" id="cheque_date" value="<?php echo $_POST['cheque_date']; ?>">
                                    <input  class="form-control" type="text" placeholder="Cheque/Draft No.." style="width: 30% !important; display:none;" name="cheque_draft_no" id="cheque_draft_no" value="<?php echo $_POST['cheque_draft_no']; ?>" />
                                </div> 
                                
                            </div>
                            
                          

                            <input type="submit" name="process" class="btn btn-primary" value="Submit Button">
                            <input type="reset" class="btn btn-red" value="Reset Button">
                           

                        </form>

                    </div>
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
           
        </div>
        <!-- /#page-wrapper -->

    </div>
  <script type="text/javascript">
    $("input[type='radio']").change(function(){
        if(($(this).val()=="Cheque") || ($(this).val()=="Draft"))
        {
            $("#cheque_draft_no").show();
            $("#cheque_date").show();
        }
        else {
            $("#cheque_draft_no").hide();
            $("#cheque_date").hide();
        }
    });
</script>

<script type="text/javascript">
    $(function () {
        $("#deceased").click(function () {
            if ($(this).is(":checked")) {
                $("#dvDeceased").show();
            } else {
                $("#dvDeceased").hide();
            }
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $("#others").click(function () {
            if ($(this).is(":checked")) {
                $("#dvOthers").show();
            } else {
                $("#dvOthers").hide();
            }
        });
    });
</script>

 <?php include_once '../templates/tsurphu_footer.php'; ?>
</body>

</html>
