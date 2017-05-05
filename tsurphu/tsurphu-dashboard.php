<?php
include_once '../include/processes.php';
$Login_Process = new Login_Process;
$Login_Process->check_status($_SERVER['SCRIPT_NAME']);
$Login_Process->connect_db();

include_once '../templates/tsurphu_header.php'; 
$sth = mysql_query("SELECT on_account, SUM(`amount_no`) `amount_no` FROM tsurphus GROUP BY on_account");

$rows = array();
$table = array();
$table['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'On Account of', 'type' => 'string'),
    array('label' => 'Amount', 'type' => 'number')

);
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    //$temp = array('k' => (string) $r['on_account'],'v' => (int) $r['amount_no']);
    //$rows[] = $temp;
  
    
    $temp = array();
    // the following line will be used to slice the Pie chart
    $temp[] = array('v' => (string) $r['on_account']); 

    // Values of each slice
    $temp[] = array('v' => (int) $r['amount_no']);
    
    $rows[] = array('c' => $temp);
}



//$table['result'] = $result;
$table['rows'] = $rows;
$jsonTable = json_encode($table);
//echo $jsonTable;
?>
<?php
$rth = mysql_query("SELECT on_account, COUNT(`on_account`) `count` 
FROM tsurphus
GROUP BY on_account 
HAVING count > 0");
$rows = array();
$table = array();
$table['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'On Account of', 'type' => 'string'),
    array('label' => 'Count', 'type' => 'number')

);
$rows = array();
while($rs = mysql_fetch_assoc($rth)) {
    //$temp = array('k' => (string) $r['on_account'],'v' => (int) $r['amount_no']);
    //$rows[] = $temp;
    
    $temp = array();
    // the following line will be used to slice the Pie chart
    $temp[] = array('v' => (string) $rs['on_account']); 

    // Values of each slice
    $temp[] = array('v' => (int) $rs['count']);
    
    $rows[] = array('c' => $temp);
}


//$table['result'] = $result;
$table['rows'] = $rows;
$jsonTables = json_encode($table);
//echo $jsonTable;

//No graph
$nograph = mysql_query("SELECT on_account, SUM(`amount_no`) `amount_no` FROM tsurphus GROUP BY on_account ORDER BY `amount_no` DESC");
$nograph2 = mysql_query("SELECT on_account, COUNT(`on_account`) `count` 
FROM tsurphus
GROUP BY on_account 
HAVING count > 0 ORDER BY `count` DESC");

?>
<!--Load the Ajax API-->
<script type="text/javascript" src="../js/jsapi.js"></script>
 <script type="text/javascript" src="../js/uds_api_contents.js"></script>   
    <script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(<?php echo $jsonTable?>);
      var options = {
           title: 'Offering Amounts in Percentage(%)',
          is3D: 'true',
          width: 650,
          height: 400
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    </script>
    
    <script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(<?php echo $jsonTables?>);
      var options = {
           title: 'List of Offerings in Percentage(%)',
          is3D: 'true',
          width: 650,
          height: 400
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
      chart.draw(data, options);
    }
    </script>
    <link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css" />
</head>

<body>

    <div id="wrapper">

         <?php 
         include_once '../templates/navigation.php'; 
         include_once '../templates/side-navigation.php';
         ?>
       

        <div id="page-wrapper">

            <div class="container-fluid" style="margin-bottom: 20px;">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1>
                            ཉིན་རེའི་ལྟོ་ཆས། Dashboard
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Details..
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12" style="margin-bottom: 10px;">
<?php
//echo '<pre>';
//print_r($rows);
//print_r($table);
?>
                     <!--this is the div that will hold the pie chart-->
                     <table>
                         
                         <tr>
                             <td>
                         <div id="chart_div" class="col-sm-6"></div>
                             </td>
                              <td>
                                  <table class="display dataTable">
                                      <tr class="odd">                                     
<th style="background-color: #999; color: #FFF;">Towards</th>
       <th style="background-color: #999; color: #FFF;">Total Amount</th>
                                      </tr>
                                          <?php
                         while ($row = mysql_fetch_array($nograph))
{
	
	$on_account = $row['on_account'];
	$amount_no = $row['amount_no'];

?>
                                      
<?php
	echo '<tr class="odd">';
       
	echo '<td>' . $on_account. '</td>';
	echo '<td>' . $amount_no . '</td>';
	echo '</tr>';
}
?>
                               
                                      
                                  </table>
                         

                             </td>
                         </tr>
                         
                         <tr><td><hr></td><td><hr></td></tr>
                     <tr>
                         <td>
                          <div id="chart_div2" class="col-sm-6"></div> 
                             </td>
                             
                             <td>
                                  <table class="display dataTable">
                                      <tr class="odd">                                     
                                          <th style="background-color: #999; color: #FFF;">Towards</th>
       <th style="background-color: #999; color: #FFF;">Total Count</th>
                                      </tr>
                                          <?php
                         while ($row2 = mysql_fetch_array($nograph2))
{
	
	$on_account2 = $row2['on_account'];
	$count = $row2['count'];

?>
                                      
<?php
	echo '<tr class="odd">';
       
	echo '<td>' . $on_account2. '</td>';
	echo '<td>' . $count . '</td>';
	echo '</tr>';
}
?>
                               
                                      
                                  </table>
                         

                         </tr>
                     </table>
  
 
 
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
