<?php
include_once '../include/processes.php';
$Login_Process = new Login_Process;
$Login_Process->check_status($_SERVER['SCRIPT_NAME']);
//$Login_Process->check_admin($_SERVER['SCRIPT_NAME']);
$Login_Process->connect_db();
$New = $Login_Process->Edit_Document($_POST, $_POST['process']);
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
                        <strong><span class="tibetan"> བཟོ་བཅོས་གཏོང་།</span> Edit </strong>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6" style="margin-bottom: 20px;">
                        <?php
                            //Check which submit button was clicked
                            //perform the function
	  
                            // $edit = false;
                            if(isset($_POST['submit'])) {
                            //if(isset($_POST['edit'])) {
                                //$edit = $_POST['edit'];
                            if(($_POST['action']=='edit') || ($_POST['action2']=='edit'))
                                {
                        ?>

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-horizontal" role="form" enctype="multipart/form-data">
                        <?php 
                            $edit_id=$_POST['selector'];
                            $N = count($edit_id);
                            for($i=0; $i<$N; $i++)
                                {
                                    $result = mysql_query("SELECT * FROM ".TSURPHU." WHERE id='$edit_id[$i]'");
                                    while($row = mysql_fetch_array($result))
                                    {
                        ?>
                            
                            <input type="hidden" name="id[]" id="id" value="<?php echo $row['id'] ?>">
                            
                            <div class="form-group">
                                <div style="float:left">
                                <label><span class="tibetan">ཨང་།</span> Receipt No:</label>
                              
                                <input type="text" class="form-control" style="width: 60% !important; color:#999999;" name="receipt_no[]" value="<?php echo $row['receipt_no']; ?>" readonly>
                                
                                </div>
                                <div>
                                     <label><span class="tibetan">* ཟླ་ཚེས།</span> Date: (yyyy-mm-dd)</label>
                                     <input class="form-control" style="width: 20% !important;" type="text" name="subDate[]" value="<?php echo $row['subDate']; ?>">
                                    
                                </div>
                            
                            </div>

                            <div class="form-group">
                                <label><span class="tibetan">* དད་དམ་མཆོག་ཏུ་ཡངས་པ།</span> Received with thanks from:</label>
                                <input class="form-control" style="width: 40% !important" type="text" name="name[]" id="name" value="<?php echo $row['name'] ?>">
                            </div>
                            <div class="form-group">
                                <label><span class="tibetan">* ཁ་བྱང་།</span> Address:</label>
                                <input class="form-control" style="width: 40% !important" type="text" name="address[]" id="address" value="<?php echo $row['address'] ?>">
                            </div>
                            <div class="form-group" style="background-color: #eee; padding: 10px;">
                                <label><span class="tibetan">* དམིགས་ཡུལ།</span> On account of </label> <br>
                                <table>
                                    <tr>
                                        <td><label class="checkbox-inline">
                                                <input type="checkbox" name="on_account[]" value="Offering for living" <?php echo ($row['on_account'] == "Offering for living") ? 'checked="checked"' : ''; ?> /><span class="tibetan">སྐྱབས་རྟེན།</span> Offering for living
                                </label></td>
                                <td><label class="checkbox-inline">
                                        <input type="checkbox" name="on_account[]" value="Offering for deceased" <?php echo ($row['on_account'] == "Offering for deceased") ? 'checked="checked"' : ''; ?> id="deceased"><span class="tibetan">བསྔོ་རྟེན།</span> Offering for deceased
                                </label></td>
                                <td> <label class="checkbox-inline">
                                    <input type="checkbox" name="on_account[]" value="Crown (Usha) offering" <?php echo ($row['on_account'] == "Crown (Usha) offering") ? 'checked="checked"' : ''; ?> /><span class="tibetan">དུབ་ཞྭའི་དོད།</span> Crown (Usha) offering
                                </label></td>
                                    </tr>
                                    
                                      <tr>
                                        
                                <td><label class="checkbox-inline">
                                    <input type="checkbox" name="on_account[]" value="Butter lamp offering" <?php echo ($row['on_account'] == "Butter lamp offering") ? 'checked="checked"' : ''; ?>><span class="tibetan">མར་མེའི་ཞལ་འདེབས།</span> Butter lamp offering
                                </label></td>
                                <td> <label class="checkbox-inline">
                                    <input type="checkbox" name="on_account[]" value="Tea" <?php echo ($row['on_account'] == "Tea") ? 'checked="checked"' : ''; ?>><span class="tibetan">མང་ཇ།</span> Tea
                                </label></td>
                                <td><label class="checkbox-inline">
                                    <input type="checkbox" name="on_account[]" value="Medical expense of sangha" <?php echo ($row['on_account'] == "Medical expense of sangha") ? 'checked="checked"' : ''; ?>><span class="tibetan">དགེ་འདུན་པའི་སྨན་དོད།</span> Medical expense of sangha
                                </label></td>
                                </tr>
                                    
                                <tr>
                                        <td><label class="checkbox-inline">
                                    <input type="checkbox" name="on_account[]" value="Meal" <?php echo ($row['on_account'] == "Meal") ? 'checked="checked"' : ''; ?>><span class="tibetan">གསོལ་ཚིགས།</span> Meal
                                </label></td>
                                <td> <label class="checkbox-inline">
                                    <input type="checkbox" name="on_account[]" value="General donation" <?php echo ($row['on_account'] == "General donation") ? 'checked="checked"' : ''; ?>><span class="tibetan">སྤྱིར་བཏང་ཞལ་འདེབས།</span> General donation
                                </label></td>
                                <td> <label class="checkbox-inline">
                                    <input type="checkbox" name="on_account[]" value="Special prayer request" <?php echo ($row['on_account'] == "Special prayer request") ? 'checked="checked"' : ''; ?>><span class="tibetan">དམིགས་བསལ་ཞབས་རིམ།</span> Special prayer request
                                </label></td>
                                    </tr>
                                    
                                <tr>
                                        <td><label class="checkbox-inline">
                                    <input type="checkbox" name="on_account[]" value="Others" id="others" <?php echo ($row['on_account'] == "Others") ? 'checked="checked"' : ''; ?>><span class="tibetan">གཞན་ཡང་།</span> Others
                                </label></td>
                                <td> </td>
                                <td> </td>
                                </tr>
                            </table>                 
                            </div>
                            <div class="form-group" id="dvDeceased">
                                <label><span class="tibetan">ཚེ་འདས་མིང་།</span> Deceased Person Name:</label> 
                                
                                <input type="text" class="form-control" name="deceased_name[]" style="width: 47% !important;" value="<?php echo $row['deceased_name']; ?>">
                            </div>
                            <div class="form-group" id="dvOthers">
                                <label><span class="tibetan">གཞན་ཡང་།</span> Others Details:</label> 
                                <input type="text" class="form-control" name="others[]" style="width: 47% !important;" value="<?php echo $row['others']; ?>">
                            </div>
                            
                            <div class="form-group">
                                <div style="float:left; width:10%;">
                               <label><span class="tibetan">* སྒོར།</span> Amount:</label> 
                               <select class="form-control" name="currency[]">
                                  <option value='AED'<?php if ($row[currency] == 'AED') echo ' selected="selected"'; ?>>United Arab Emirates Dirham</option>
                                   <option value='AFN'<?php if ($row[currency] == 'AFN') echo ' selected="selected"'; ?>>Afghan Afghani</option>
                                   <option value='ALL'<?php if ($row[currency] == 'ALL') echo ' selected="selected"'; ?>>Albanian Lek</option>
                                   <option value='AMD'<?php if ($row[currency] == 'AMD') echo ' selected="selected"'; ?>>Armenian Dram</option>
                                   <option value='ANG'<?php if ($row[currency] == 'ANG') echo ' selected="selected"'; ?>>Netherlands Antillean Guilder</option>
                                   <option value='AOA'<?php if ($row[currency] == 'AOA') echo ' selected="selected"'; ?>>Angolan Kwanza</option>
                                   <option value='ARS'<?php if ($row[currency] == 'ARS') echo ' selected="selected"'; ?>>Argentine Peso</option>
                                   <option value='AUD'<?php if ($row[currency] == 'AUD') echo ' selected="selected"'; ?>>Australian Dollar</option>
                                   <option value='AWG'<?php if ($row[currency] == 'AWG') echo ' selected="selected"'; ?>>Aruban Florin</option>
                                   <option value='AZN'<?php if ($row[currency] == 'AZN') echo ' selected="selected"'; ?>>Azerbaijani Manat</option>
                                   <option value='BAM'<?php if ($row[currency] == 'BAM') echo ' selected="selected"'; ?>>Bosnia-Herzegovina Convertible Mark</option>
                                   <option value='BBD'<?php if ($row[currency] == 'BBD') echo ' selected="selected"'; ?>>Barbadian Dollar</option>
                                   <option value='BDT'<?php if ($row[currency] == 'BDT') echo ' selected="selected"'; ?>>Bangladeshi Taka</option>
                                   <option value='BGN'<?php if ($row[currency] == 'BGN') echo ' selected="selected"'; ?>>Bulgarian Lev</option>
                                   <option value='BHD'<?php if ($row[currency] == 'BHD') echo ' selected="selected"'; ?>>Bahraini Dinar</option>
                                   <option value='BIF'<?php if ($row[currency] == 'BIF') echo ' selected="selected"'; ?>>Burundian Franc</option>
                                   <option value='BMD'<?php if ($row[currency] == 'BMD') echo ' selected="selected"'; ?>>Bermudan Dollar</option>
                                   <option value='BND'<?php if ($row[currency] == 'BND') echo ' selected="selected"'; ?>>Brunei Dollar</option>
                                   <option value='BOB'<?php if ($row[currency] == 'BOB') echo ' selected="selected"'; ?>>Bolivian Boliviano</option>
                                   <option value='BRL'<?php if ($row[currency] == 'BRL') echo ' selected="selected"'; ?>>Brazilian Real</option>
                                   <option value='BSD'<?php if ($row[currency] == 'BSD') echo ' selected="selected"'; ?>>Bahamian Dollar</option>
                                   <option value='BTC'<?php if ($row[currency] == 'BTC') echo ' selected="selected"'; ?>>Bitcoin</option>
                                   <option value='BTN'<?php if ($row[currency] == 'BTN') echo ' selected="selected"'; ?>>Bhutanese Ngultrum</option>
                                   <option value='BWP'<?php if ($row[currency] == 'BWP') echo ' selected="selected"'; ?>>Botswanan Pula</option>
                                   <option value='BYN'<?php if ($row[currency] == 'BYN') echo ' selected="selected"'; ?>>Belarusian Ruble</option>
                                   <option value='BYR'<?php if ($row[currency] == 'BYR') echo ' selected="selected"'; ?>>Belarusian Ruble (pre-2016)</option>
                                   <option value='BZD'<?php if ($row[currency] == 'BZD') echo ' selected="selected"'; ?>>Belize Dollar</option>
                                   <option value='CAD'<?php if ($row[currency] == 'CAD') echo ' selected="selected"'; ?>>Canadian Dollar</option>
                                   <option value='CDF'<?php if ($row[currency] == 'CDF') echo ' selected="selected"'; ?>>Congolese Franc</option>
                                   <option value='CHF'<?php if ($row[currency] == 'CHF') echo ' selected="selected"'; ?>>Swiss Franc</option>
                                   <option value='CLF'<?php if ($row[currency] == 'CLF') echo ' selected="selected"'; ?>>Chilean Unit of Account (UF)</option>
                                   <option value='CLP'<?php if ($row[currency] == 'CLP') echo ' selected="selected"'; ?>>Chilean Peso</option>
                                   <option value='CNY'<?php if ($row[currency] == 'CNY') echo ' selected="selected"'; ?>>Chinese Yuan</option>
                                   <option value='COP'<?php if ($row[currency] == 'COP') echo ' selected="selected"'; ?>>Colombian Peso</option>
                                   <option value='CRC'<?php if ($row[currency] == 'CRC') echo ' selected="selected"'; ?>>Costa Rican Colón</option>
                                   <option value='CUC'<?php if ($row[currency] == 'CUC') echo ' selected="selected"'; ?>>Cuban Convertible Peso</option>
                                   <option value='CUP'<?php if ($row[currency] == 'CUP') echo ' selected="selected"'; ?>>Cuban Peso</option>
                                   <option value='CVE'<?php if ($row[currency] == 'CVE') echo ' selected="selected"'; ?>>Cape Verdean Escudo</option>
                                   <option value='CZK'<?php if ($row[currency] == 'CZK') echo ' selected="selected"'; ?>>Czech Republic Koruna</option>
                                   <option value='DJF'<?php if ($row[currency] == 'DJF') echo ' selected="selected"'; ?>>Djiboutian Franc</option>
                                   <option value='DKK'<?php if ($row[currency] == 'DKK') echo ' selected="selected"'; ?>>Danish Krone</option>
                                   <option value='DOP'<?php if ($row[currency] == 'DOP') echo ' selected="selected"'; ?>>Dominican Peso</option>
                                   <option value='DZD'<?php if ($row[currency] == 'DZD') echo ' selected="selected"'; ?>>Algerian Dinar</option>
                                   <option value='EEK'<?php if ($row[currency] == 'EEK') echo ' selected="selected"'; ?>>Estonian Kroon</option>
                                   <option value='EGP'<?php if ($row[currency] == 'EGP') echo ' selected="selected"'; ?>>Egyptian Pound</option>
                                   <option value='ERN'<?php if ($row[currency] == 'ERN') echo ' selected="selected"'; ?>>Eritrean Nakfa</option>
                                   <option value='ETB'<?php if ($row[currency] == 'ETB') echo ' selected="selected"'; ?>>Ethiopian Birr</option>
                                   <option value='EUR'<?php if ($row[currency] == 'EUR') echo ' selected="selected"'; ?>>Euro</option>
                                   <option value='FJD'<?php if ($row[currency] == 'FJD') echo ' selected="selected"'; ?>>Fijian Dollar</option>
                                   <option value='FKP'<?php if ($row[currency] == 'FKP') echo ' selected="selected"'; ?>>Falkland Islands Pound</option>
                                   <option value='GBP'<?php if ($row[currency] == 'GBP') echo ' selected="selected"'; ?>>British Pound Sterling</option>
                                   <option value='GEL'<?php if ($row[currency] == 'GEL') echo ' selected="selected"'; ?>>Georgian Lari</option>
                                   <option value='GGP'<?php if ($row[currency] == 'GGP') echo ' selected="selected"'; ?>>Guernsey Pound</option>
                                   <option value='GHS'<?php if ($row[currency] == 'GHS') echo ' selected="selected"'; ?>>Ghanaian Cedi</option>
                                   <option value='GIP'<?php if ($row[currency] == 'GIP') echo ' selected="selected"'; ?>>Gibraltar Pound</option>
                                   <option value='GMD'<?php if ($row[currency] == 'GMD') echo ' selected="selected"'; ?>>Gambian Dalasi</option>
                                   <option value='GNF'<?php if ($row[currency] == 'GNF') echo ' selected="selected"'; ?>>Guinean Franc</option>
                                   <option value='GTQ'<?php if ($row[currency] == 'GTQ') echo ' selected="selected"'; ?>>Guatemalan Quetzal</option>
                                   <option value='GYD'<?php if ($row[currency] == 'GYD') echo ' selected="selected"'; ?>>Guyanaese Dollar</option>
                                   <option value='HKD'<?php if ($row[currency] == 'HKD') echo ' selected="selected"'; ?>>Hong Kong Dollar</option>
                                   <option value='HNL'<?php if ($row[currency] == 'HNL') echo ' selected="selected"'; ?>>Honduran Lempira</option>
                                   <option value='HRK'<?php if ($row[currency] == 'HRK') echo ' selected="selected"'; ?>>Croatian Kuna</option>
                                   <option value='HTG'<?php if ($row[currency] == 'HTG') echo ' selected="selected"'; ?>>Haitian Gourde</option>
                                   <option value='HUF'<?php if ($row[currency] == 'HUF') echo ' selected="selected"'; ?>>Hungarian Forint</option>
                                   <option value='IDR'<?php if ($row[currency] == 'IDR') echo ' selected="selected"'; ?>>Indonesian Rupiah</option>
                                   <option value='ILS'<?php if ($row[currency] == 'ILS') echo ' selected="selected"'; ?>>Israeli New Sheqel</option>
                                   <option value='IMP'<?php if ($row[currency] == 'IMP') echo ' selected="selected"'; ?>>Manx pound</option>
                                   <option value='INR'<?php if ($row[currency] == 'INR') echo ' selected="selected"'; ?>>Indian Rupee</option>
                                   <option value='IQD'<?php if ($row[currency] == 'IQD') echo ' selected="selected"'; ?>>Iraqi Dinar</option>
                                   <option value='IRR'<?php if ($row[currency] == 'IRR') echo ' selected="selected"'; ?>>Iranian Rial</option>
                                   <option value='ISK'<?php if ($row[currency] == 'ISK') echo ' selected="selected"'; ?>>Icelandic Króna</option>
                                   <option value='JEP'<?php if ($row[currency] == 'JEP') echo ' selected="selected"'; ?>>Jersey Pound</option>
                                   <option value='JMD'<?php if ($row[currency] == 'JMD') echo ' selected="selected"'; ?>>Jamaican Dollar</option>
                                   <option value='JOD'<?php if ($row[currency] == 'JOD') echo ' selected="selected"'; ?>>Jordanian Dinar</option>
                                   <option value='JPY'<?php if ($row[currency] == 'JPY') echo ' selected="selected"'; ?>>Japanese Yen</option>
                                   <option value='KES'<?php if ($row[currency] == 'KES') echo ' selected="selected"'; ?>>Kenyan Shilling</option>
                                   <option value='KGS'<?php if ($row[currency] == 'KGS') echo ' selected="selected"'; ?>>Kyrgystani Som</option>
                                   <option value='KHR'<?php if ($row[currency] == 'KHR') echo ' selected="selected"'; ?>>Cambodian Riel</option>
                                   <option value='KMF'<?php if ($row[currency] == 'KMF') echo ' selected="selected"'; ?>>Comorian Franc</option>
                                   <option value='KPW'<?php if ($row[currency] == 'KPW') echo ' selected="selected"'; ?>>North Korean Won</option>
                                   <option value='KRW'<?php if ($row[currency] == 'KRW') echo ' selected="selected"'; ?>>South Korean Won</option>
                                   <option value='KWD'<?php if ($row[currency] == 'KWD') echo ' selected="selected"'; ?>>Kuwaiti Dinar</option>
                                   <option value='KYD'<?php if ($row[currency] == 'KYD') echo ' selected="selected"'; ?>>Cayman Islands Dollar</option>
                                   <option value='KZT'<?php if ($row[currency] == 'KZT') echo ' selected="selected"'; ?>>Kazakhstani Tenge</option>
                                   <option value='LAK'<?php if ($row[currency] == 'LAK') echo ' selected="selected"'; ?>>Laotian Kip</option>
                                   <option value='LBP'<?php if ($row[currency] == 'LBP') echo ' selected="selected"'; ?>>Lebanese Pound</option>
                                   <option value='LKR'<?php if ($row[currency] == 'LKR') echo ' selected="selected"'; ?>>Sri Lankan Rupee</option>
                                   <option value='LRD'<?php if ($row[currency] == 'LRD') echo ' selected="selected"'; ?>>Liberian Dollar</option>
                                   <option value='LSL'<?php if ($row[currency] == 'LSL') echo ' selected="selected"'; ?>>Lesotho Loti</option>
                                   <option value='LTL'<?php if ($row[currency] == 'LTL') echo ' selected="selected"'; ?>>Lithuanian Litas</option>
                                   <option value='LVL'<?php if ($row[currency] == 'LVL') echo ' selected="selected"'; ?>>Latvian Lats</option>
                                   <option value='LYD'<?php if ($row[currency] == 'LYD') echo ' selected="selected"'; ?>>Libyan Dinar</option>
                                   <option value='MAD'<?php if ($row[currency] == 'MAD') echo ' selected="selected"'; ?>>Moroccan Dirham</option>
                                   <option value='MDL'<?php if ($row[currency] == 'MDL') echo ' selected="selected"'; ?>>Moldovan Leu</option>
                                   <option value='MGA'<?php if ($row[currency] == 'MGA') echo ' selected="selected"'; ?>>Malagasy Ariary</option>
                                   <option value='MKD'<?php if ($row[currency] == 'MKD') echo ' selected="selected"'; ?>>Macedonian Denar</option>
                                   <option value='MMK'<?php if ($row[currency] == 'MMK') echo ' selected="selected"'; ?>>Myanma Kyat</option>
                                   <option value='MNT'<?php if ($row[currency] == 'MNT') echo ' selected="selected"'; ?>>Mongolian Tugrik</option>
                                   <option value='MOP'<?php if ($row[currency] == 'MOP') echo ' selected="selected"'; ?>>Macanese Pataca</option>
                                   <option value='MRO'<?php if ($row[currency] == 'MRO') echo ' selected="selected"'; ?>>Mauritanian Ouguiya</option>
                                   <option value='MTL'<?php if ($row[currency] == 'MTL') echo ' selected="selected"'; ?>>Maltese Lira</option>
                                   <option value='MUR'<?php if ($row[currency] == 'MUR') echo ' selected="selected"'; ?>>Mauritian Rupee</option>
                                   <option value='MVR'<?php if ($row[currency] == 'MVR') echo ' selected="selected"'; ?>>Maldivian Rufiyaa</option>
                                   <option value='MWK'<?php if ($row[currency] == 'MWK') echo ' selected="selected"'; ?>>Malawian Kwacha</option>
                                   <option value='MXN'<?php if ($row[currency] == 'MXN') echo ' selected="selected"'; ?>>Mexican Peso</option>
                                   <option value='MYR'<?php if ($row[currency] == 'MYR') echo ' selected="selected"'; ?>>Malaysian Ringgit</option>
                                   <option value='MZN'<?php if ($row[currency] == 'MZN') echo ' selected="selected"'; ?>>Mozambican Metical</option>
                                   <option value='NAD'<?php if ($row[currency] == 'NAD') echo ' selected="selected"'; ?>>Namibian Dollar</option>
                                   <option value='NGN'<?php if ($row[currency] == 'NGN') echo ' selected="selected"'; ?>>Nigerian Naira</option>
                                   <option value='NIO'<?php if ($row[currency] == 'NIO') echo ' selected="selected"'; ?>>Nicaraguan Córdoba</option>
                                   <option value='NOK'<?php if ($row[currency] == 'NOK') echo ' selected="selected"'; ?>>Norwegian Krone</option>
                                   <option value='NPR'<?php if ($row[currency] == 'NPR') echo ' selected="selected"'; ?>>Nepalese Rupee</option>
                                   <option value='NZD'<?php if ($row[currency] == 'NZD') echo ' selected="selected"'; ?>>New Zealand Dollar</option>
                                   <option value='OMR'<?php if ($row[currency] == 'OMR') echo ' selected="selected"'; ?>>Omani Rial</option>
                                   <option value='PAB'<?php if ($row[currency] == 'PAB') echo ' selected="selected"'; ?>>Panamanian Balboa</option>
                                   <option value='PEN'<?php if ($row[currency] == 'PEN') echo ' selected="selected"'; ?>>Peruvian Nuevo Sol</option>
                                   <option value='PGK'<?php if ($row[currency] == 'PGK') echo ' selected="selected"'; ?>>Papua New Guinean Kina</option>
                                   <option value='PHP'<?php if ($row[currency] == 'PHP') echo ' selected="selected"'; ?>>Philippine Peso</option>
                                   <option value='PKR'<?php if ($row[currency] == 'PKR') echo ' selected="selected"'; ?>>Pakistani Rupee</option>
                                   <option value='PLN'<?php if ($row[currency] == 'PLN') echo ' selected="selected"'; ?>>Polish Zloty</option>
                                   <option value='PYG'<?php if ($row[currency] == 'PYG') echo ' selected="selected"'; ?>>Paraguayan Guarani</option>
                                   <option value='QAR'<?php if ($row[currency] == 'QAR') echo ' selected="selected"'; ?>>Qatari Rial</option>
                                   <option value='RON'<?php if ($row[currency] == 'RON') echo ' selected="selected"'; ?>>Romanian Leu</option>
                                   <option value='RSD'<?php if ($row[currency] == 'RSD') echo ' selected="selected"'; ?>>Serbian Dinar</option>
                                   <option value='RUB'<?php if ($row[currency] == 'RUB') echo ' selected="selected"'; ?>>Russian Ruble</option>
                                   <option value='RWF'<?php if ($row[currency] == 'RWF') echo ' selected="selected"'; ?>>Rwandan Franc</option>
                                   <option value='SAR'<?php if ($row[currency] == 'SAR') echo ' selected="selected"'; ?>>Saudi Riyal</option>
                                   <option value='SBD'<?php if ($row[currency] == 'SBD') echo ' selected="selected"'; ?>>Solomon Islands Dollar</option>
                                   <option value='SCR'<?php if ($row[currency] == 'SCR') echo ' selected="selected"'; ?>>Seychellois Rupee</option>
                                   <option value='SDG'<?php if ($row[currency] == 'SDG') echo ' selected="selected"'; ?>>Sudanese Pound</option>
                                   <option value='SEK'<?php if ($row[currency] == 'SEK') echo ' selected="selected"'; ?>>Swedish Krona</option>
                                   <option value='SGD'<?php if ($row[currency] == 'SGD') echo ' selected="selected"'; ?>>Singapore Dollar</option>
                                   <option value='SHP'<?php if ($row[currency] == 'SHP') echo ' selected="selected"'; ?>>Saint Helena Pound</option>
                                   <option value='SLL'<?php if ($row[currency] == 'SLL') echo ' selected="selected"'; ?>>Sierra Leonean Leone</option>
                                   <option value='SOS'<?php if ($row[currency] == 'SOS') echo ' selected="selected"'; ?>>Somali Shilling</option>
                                   <option value='SRD'<?php if ($row[currency] == 'SRD') echo ' selected="selected"'; ?>>Surinamese Dollar</option>
                                   <option value='STD'<?php if ($row[currency] == 'STD') echo ' selected="selected"'; ?>>São Tomé and Príncipe Dobra</option>
                                   <option value='SVC'<?php if ($row[currency] == 'SVC') echo ' selected="selected"'; ?>>Salvadoran Colón</option>
                                   <option value='SYP'<?php if ($row[currency] == 'SYP') echo ' selected="selected"'; ?>>Syrian Pound</option>
                                   <option value='SZL'<?php if ($row[currency] == 'SZL') echo ' selected="selected"'; ?>>Swazi Lilangeni</option>
                                   <option value='THB'<?php if ($row[currency] == 'THB') echo ' selected="selected"'; ?>>Thai Baht</option>
                                   <option value='TJS'<?php if ($row[currency] == 'TJS') echo ' selected="selected"'; ?>>Tajikistani Somoni</option>
                                   <option value='TMT'<?php if ($row[currency] == 'TMT') echo ' selected="selected"'; ?>>Turkmenistani Manat</option>
                                   <option value='TND'<?php if ($row[currency] == 'TND') echo ' selected="selected"'; ?>>Tunisian Dinar</option>
                                   <option value='TOP'<?php if ($row[currency] == 'TOP') echo ' selected="selected"'; ?>>Tongan Pa?anga</option>
                                   <option value='TRY'<?php if ($row[currency] == 'TRY') echo ' selected="selected"'; ?>>Turkish Lira</option>
                                   <option value='TTD'<?php if ($row[currency] == 'TTD') echo ' selected="selected"'; ?>>Trinidad and Tobago Dollar</option>
                                   <option value='TWD'<?php if ($row[currency] == 'TWD') echo ' selected="selected"'; ?>>New Taiwan Dollar</option>
                                   <option value='TZS'<?php if ($row[currency] == 'TZS') echo ' selected="selected"'; ?>>Tanzanian Shilling</option>
                                   <option value='UAH'<?php if ($row[currency] == 'UAH') echo ' selected="selected"'; ?>>Ukrainian Hryvnia</option>
                                   <option value='UGX'<?php if ($row[currency] == 'UGX') echo ' selected="selected"'; ?>>Ugandan Shilling</option>
                                   <option value='USD'<?php if ($row[currency] == 'USD') echo ' selected="selected"'; ?>>United States Dollar</option>
                                   <option value='UYU'<?php if ($row[currency] == 'UYU') echo ' selected="selected"'; ?>>Uruguayan Peso</option>
                                   <option value='UZS'<?php if ($row[currency] == 'UZS') echo ' selected="selected"'; ?>>Uzbekistan Som</option>
                                   <option value='VEF'<?php if ($row[currency] == 'VEF') echo ' selected="selected"'; ?>>Venezuelan Bolívar Fuerte</option>
                                   <option value='VND'<?php if ($row[currency] == 'VND') echo ' selected="selected"'; ?>>Vietnamese Dong</option>
                                   <option value='VUV'<?php if ($row[currency] == 'VUV') echo ' selected="selected"'; ?>>Vanuatu Vatu</option>
                                   <option value='WST'<?php if ($row[currency] == 'WST') echo ' selected="selected"'; ?>>Samoan Tala</option>
                                   <option value='XAF'<?php if ($row[currency] == 'XAF') echo ' selected="selected"'; ?>>CFA Franc BEAC</option>
                                   <option value='XAG'<?php if ($row[currency] == 'XAG') echo ' selected="selected"'; ?>>Silver Ounce</option>
                                   <option value='XAU'<?php if ($row[currency] == 'XAU') echo ' selected="selected"'; ?>>Gold Ounce</option>
                                   <option value='XCD'<?php if ($row[currency] == 'XCD') echo ' selected="selected"'; ?>>East Caribbean Dollar</option>
                                   <option value='XDR'<?php if ($row[currency] == 'XDR') echo ' selected="selected"'; ?>>Special Drawing Rights</option>
                                   <option value='XOF'<?php if ($row[currency] == 'XOF') echo ' selected="selected"'; ?>>CFA Franc BCEAO</option>
                                   <option value='XPD'<?php if ($row[currency] == 'XPD') echo ' selected="selected"'; ?>>Palladium Ounce</option>
                                   <option value='XPF'<?php if ($row[currency] == 'XPF') echo ' selected="selected"'; ?>>CFP Franc</option>
                                   <option value='XPT'<?php if ($row[currency] == 'XPT') echo ' selected="selected"'; ?>>Platinum Ounce</option>
                                   <option value='YER'<?php if ($row[currency] == 'YER') echo ' selected="selected"'; ?>>Yemeni Rial</option>
                                   <option value='ZAR'<?php if ($row[currency] == 'ZAR') echo ' selected="selected"'; ?>>South African Rand</option>
                                   <option value='ZMK'<?php if ($row[currency] == 'ZMK') echo ' selected="selected"'; ?>>Zambian Kwacha (pre-2013)</option>
                                   <option value='ZMW'<?php if ($row[currency] == 'ZMW') echo ' selected="selected"'; ?>>Zambian Kwacha</option>
                                   <option value='ZWL'<?php if ($row[currency] == 'ZWL') echo ' selected="selected"'; ?>>Zimbabwean Dollar</option>
                                </select>
  

                                </div>
                                <div style="float:left; margin:7px;">
                                    <label>&nbsp;</label>
                                    <input class="form-control" type="text" style="color:#999999;" name="num[]" id="num" value="<?php echo $row['amount_no']; ?>" readonly>
                                 </div> 
                                <div style="float:left; width:10%; margin: 7px;">
                                     <label>&nbsp;</label>
                                    <input type="button" class="convert-btn" name="sr1" value="In Word" onClick="numinwrd()">
                                    
                                 </div>
                                <br>
                                
                            
                            </div>
                            <div class="form-group">
                                <label><span class="tibetan">* སྒོར།</span> Amount in Word:</label> 
                                <input type="text" class="form-control" name="amount_word[]" id="number" style="width: 47% !important; color:#999999;" value="<?php echo $row['amount_word']; ?>" readonly>
                                </div>
                            
                            
                            <div class="form-group">
                                <div style="width: 50%;">
                                <label>* Payment Type </label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="payment[]" id="optionsRadiosInline1" value="Cash"<?php if ($row['payment'] == "Cash") echo " checked"; ?>><span class="tibetan">དངུལ་སྨར།</span> Cash
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment[]" id="optionsRadiosInline2" value="Cheque"<?php if ($row['payment'] == "Cheque") echo " checked"; ?>><span class="tibetan">དངུལ་འཛིན།</span> Cheque
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="payment[]" id="optionsRadiosInline3" value="Draft"<?php if ($row['payment'] == "Draft") echo " checked"; ?>><span class="tibetan">ཌབ་འཛིན།</span> Draft
                                </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div style="width:40%; margin-top: 5px; float: left;">
                                    <label><span class="tibetan"> ཟླ་ཚེས།</span> Date:</label>
                                    <input class="form-control" style="width:28% !important; font-size: 11px;" type="text" name="cheque_date[]" value="<?php echo $row['cheque_date'] ?>" />
                                </div> 
                                <div style="margin-top:5px; width: 60%;">
                                    <label><span class="tibetan"> འཛིན་ཨང་གྲང་།</span> Cheque/Draft No:</label>
                                    <input  class="form-control" type="text" style="width: 15% !important;" type="text" name="cheque_draft_no[]" value="<?php echo $row['cheque_draft_no'] ?>" />
                                </div>
                            </div>
                            <?php
	}
	echo '<strong>(Form number:</strong> ' . $i . ')' ;
	echo '<hr>';

		}
?>
                          

                            <input type="submit" name="process" class="btn btn-primary" value="Update ">
                            

                        </form>

                    </div>
<?php
	
	   }
	   else if(($_POST['action']=='delete') || ($_POST['action2']=='delete'))
	   
	    {

	//do this
	$del_id=$_POST['selector'];
		$d = count($del_id);
		for($i=0; $i<$d; $i++)
		{
		$delete = mysql_query("DELETE FROM ".TSURPHU." WHERE id='$del_id[$i]'");
		}
	if($delete){
		//If successful 
		
		echo '<div style="text-align:center; padding-top: 10px;color:#2625FF;font-size:16px; font-weight:500;">
                       "'.$d.'" Record has Successfully Deleted </div>'; 
		//Return the number or row deleted
		//header("Location: tsurphu-search.php?message2=$d Record has Successfully Deleted");
//exit;
	}
	mysql_close();
//header("Location:casedescription.php");
}
                            }
?>
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
