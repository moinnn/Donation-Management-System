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
                        <h2>
                            <span class="tibetan-large">འཚོལ་ཞིབ།</span> Search
                        </h2>
                        <ol class="breadcrumb">
                            
                            <li class="active">
                                <i class="fa fa-edit"></i> Advance Search
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6" style="margin-bottom: 20px;">
                        
                     
<div style="width: 80%">
    <form action="tsurphu-datesearch.php" method="post" name="myform" > 
 <div class="form-group">
<div style="float:left; width: 30% !important;">
    <label><span class="tibetan"> ཟླ་ཚེས་འདི་ནས།</span> From:</label>
<input class="form-control" style="width: 65% !important;" data-format="yyyy-mm-dd" type="date" name="from">
                                </div>
                                <div>
                                    <label><span class="tibetan"> ཟླ་ཚེས་འདི་བར།</span> To:</label>
                                     <input class="form-control" style="width: 20% !important;" data-format="yyyy-mm-dd" type="date" name="to">
                                    
                                </div>
                            
                            </div>

                          
                            <div class="form-group" style="background-color: #eee; padding: 10px;">
                                <label>Show Fields:</label> <br>
                                <table>
                                    <tr>
                                        <td><label class="checkbox-inline">
                                                <input type="checkbox" name="field[]" value="1" checked="checked"><span class="tibetan">ཨང་།</span> ID
                                </label></td> 
                                        <td><label class="checkbox-inline">
                                                <input type="checkbox" name="field[]" value="2"><span class="tibetan">ཨང་།</span> Receipt No
                                </label></td>
                                <td><label class="checkbox-inline">
                                        <input type="checkbox" name="field[]" value="3" id="deceased"><span class="tibetan">མིང་།</span> Name
                                </label></td>
                                
                                    </tr>
                                    
                                      <tr>
                                        <td> <label class="checkbox-inline">
                                    <input type="checkbox" name="field[]" value="4"><span class="tibetan">དམིགས་ཡུལ།</span> On Account of
                                </label></td>
                                <td><label class="checkbox-inline">
                                    <input type="checkbox" name="field[]" value="5"><span class="tibetan">ཚེ་འདས་མིང་།</span> Deceased Name
                                </label></td>
                                <td> <label class="checkbox-inline">
                                    <input type="checkbox" name="field[]" value="6"><span class="tibetan">ཟླ་ཚེས།</span> Date
                                </label></td>
                                
                                </tr>
                                    
                                <tr><td><label class="checkbox-inline">
                                    <input type="checkbox" name="field[]" value="7"><span class="tibetan">གཞན་ཡང་།</span> Others
                                </label></td>
                                        <td><label class="checkbox-inline">
                                    <input type="checkbox" name="field[]" value="8"><span class="tibetan">སྒོར།</span> Amount
                                </label></td>
                                <td><label class="checkbox-inline">
                                    <input type="checkbox" name="field[]" value="9"><span class="tibetan"> དངུལ་ཚིག</span> Amount in Word
                                </label></td>
                                
                                
                                    </tr>
                                    
                                <tr>
                                    <td> <label class="checkbox-inline">
                                    <input type="checkbox" name="field[]" value="10"><span class="tibetan">དངུལ།</span> Currency
                                </label></td>
                                    <td> <label class="checkbox-inline">
                                            <input type="checkbox" name="field[]" value="11"><span class="tibetan">སྤྲོད་འབབ།</span> Payment Type
                                </label></td>
                                        <td><label class="checkbox-inline">
                                                <input type="checkbox" name="field[]" value="12" id="others"><span class="tibetan">གཞན་ཡང་།</span> Cheque/Draft No.
                                </label></td>
                                
                                <td> </td>
                                </tr>
                            </table>                 
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
