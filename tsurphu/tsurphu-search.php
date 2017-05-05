<?php
include_once '../include/processes.php';
$Login_Process = new Login_Process;
$Login_Process->check_status($_SERVER['SCRIPT_NAME']);
include_once '../templates/tsurphu_header.php';  
?>
<script type="text/javascript">
    function select()
    {
     var1=document.getElementById("radio1");
     var2=document.getElementById("radio2");
     var3=document.getElementById("radio3");
     var4=document.getElementById("radio4");
     var5=document.getElementById("radio5");
     var6=document.getElementById("radio6");
     if(var1.checked==true)
     {
        document.myform.action="tsurphu-receiptsearch.php";
     }
     else if (var2.checked==true)
     {
        document.myform.action="tsurphu-namesearch.php";
     }
	  else if (var3.checked==true)
     {
        document.myform.action="tsurphu-chequesearch.php";
     }
	 else if (var4.checked==true)
     {
        document.myform.action="tsurphu-onaccount.php";
     }  
        else if (var5.checked==true)
     {
        document.myform.action="tsurphu-currency.php";
     }
	  else 
     {
        document.myform.action="tsurphu-payment.php";
     }
	
   }
  </script>

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
                            <span class="tibetan-large"> འཚོལ་ཞིབ།</span> Search
                        </h1>
                        <ol class="breadcrumb">
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
                        
                        
<div style="width: 80%">
<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="myform" onSubmit="select()" > 

<p style="padding: 10px; margin-top: 30px; background-color: #EEE;">
<input type="radio" id="radio1" name="colorRadio" value="receipt_no" style="margin-left: 20px;"  /> Receipt Number
<input type="radio" id="radio2" name="colorRadio" value="name" style="margin-left: 20px;"  /> Name
<input type="radio" id="radio3" name="colorRadio" value="chequeno" style="margin-left: 20px;"  /> Cheque/Draft Number
<input type="radio" id="radio4" name="colorRadio" value="onaccount" style="margin-left: 20px;"  /> On account of
<input type="radio" id="radio5" name="colorRadio" value="currency" style="margin-left: 20px;"  /> Currency
<input type="radio" id="radio6" name="colorRadio" value="payment" style="margin-left: 20px;"  /> Payment Type
</p>
<div style="margin-top: 15px; padding-bottom: 30px;">
<p><input type="text" name="searchterm" id="searchterm" placeholder="Search..." class="form-control" /></p>
<p style="text-align: center; padding:10px;">
    <input type="submit" value="Search" name="btnSearch" class="btn btn-lg btn-primary" /></p>
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
