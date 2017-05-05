<?php
// Turn off all error reporting
error_reporting(0);
include_once 'constants.php';
include_once 'mail.php';

class Admin_Process {
	function check_status($page) {
		ini_set("session.gc_maxlifetime", Session_Lifetime);
		session_start();
		if(!isset($_SESSION['username'])){
			header("Location: http://".$_SERVER['HTTP_HOST'].Script_Path."index.php?page=".$page); 
		}
                if (!isset($_SESSION['user_level']) || ($_SESSION['user_level'] != 5)) {
                    //header("Location: http://".$_SERVER['HTTP_HOST'].Script_Path."index.php?page=".$page);
                    header('Location: ../index.php');
                    //exit;
                }

	}
	
	function connect_db() {
		$conn_str = mysql_connect(DBHOST, DBUSER, DBPASS);
		mysql_select_db(DBNAME, $conn_str) or die ('Could not select Database.');
	}
	
	function query($sql) {
		$this->connect_db();
		$sql = mysql_query($sql);
		$num_rows = mysql_num_rows($sql);
		$result = mysql_fetch_assoc($sql);
		
		return array("num_rows"=>$num_rows,"result"=>$result,"sql"=>$sql);
	}
	function Register($post, $process) {

		if(isset($process)) {

		$pass1			= $post['pass1'];
		$pass2			= $post['pass2'];
		$username		= $post['username'];
		$email_address	= $post['email_address'];
		$first_name		= $post['first_name'];
		$last_name		= $post['last_name'];
		$info			= $post['info'];
		
		if((!$pass1) || (!$pass2) || (!$username) || (!$email_address) || (!$first_name) || (!$last_name) || (!$info)) {
		return "Some Fields Are Missing";
		}
		if ($pass1 !== $pass2) {
		return "Passwords do not match";
		}
		$query = $this->query("SELECT username FROM ".STAFF." WHERE username = '$username'");
		if($query['num_rows'] > 0){
		return "Username unavialable, please try a new username";
		}
		$query = $this->query("SELECT email_address FROM ".STAFF." WHERE email_address = '$email_address'");
		if($query['num_rows'] > 0){
		return "Emails address registered to another account.";
		}

		$this->query("INSERT INTO ".STAFF." (first_name, last_name, email_address, username, password, info) VALUES ('$first_name', '$last_name', '$email_address', '$username', '".md5($pass1)."', '".htmlspecialchars($info)."')");
			
		return 'User was created.';
	}
	}
	
	function active_users_table() {
   
   $sql = $this->query("SELECT * FROM ".STAFF." WHERE status = 'live'");
   $result = $sql['sql'];
   $num_rows = $sql['num_rows'];
   $this->create_table($result, $num_rows);

	}

	function suspended_users_table() {
   
   $sql = $this->query("SELECT * FROM ".STAFF." WHERE status = 'suspended'");
   $result = $sql['sql'];
   $num_rows = $sql['num_rows'];
   $this->create_table($result, $num_rows);

	}
	
	function pending_users_table() {
   
   $sql = $this->query("SELECT * FROM ".STAFF." WHERE status = 'pending'");
   $result = $sql['sql'];
   $num_rows = $sql['num_rows'];
   $this->create_table($result, $num_rows);

	}

	function create_table($result, $num_rows) {
		
	   echo "<table border=\"0\" cellspacing=\"10\" cellpadding=\"10\" class=\"display dataTable\">\n"; 
	   echo "<tr class=\"odd\">
	  		 <th width=\"130px\"><strong> Name:</strong></th>
	  		 <th width=\"150px\"><strong> Email Address:</strong></th>
	  		 <th width=\"120px\"><strong> Username:</strong></th>
	  		 <th width=\"150px\"><strong> Info:</strong></th>
	  		 <th width=\"120px\"><strong> Login:</strong></th>
	  		 <th width=\"80px\"><strong> Level:</strong></th>
	  		 <th width=\"100px\" colspan=\"3\">Action</th>
	  		 </tr>\n";   
	   
	   for($i=0; $i<$num_rows; $i++){
	$userid=mysql_result($result,$i,"userid");
	
	$name=ucwords(substr(mysql_result($result,$i,"first_name")." ".mysql_result($result,$i,"last_name"),0,30));
	$email_address=ucwords(substr(mysql_result($result,$i,"email_address"),0,20));
	$info=ucwords(substr(mysql_result($result,$i,"info"),0,16));
	$username=ucwords(substr(mysql_result($result,$i,"username"),0,16));
	
	$userlevel=mysql_result($result,$i,"user_level");
	$last_loggedin=mysql_result($result,$i,"last_loggedin");
	
	echo "<tr height=\"35\" class=\"odd\">
   		  <td> $name</td>
   		  <td> $email_address</td>
    	  <td> $username</td>
    	  <td> $info</td>
    	  <td> $last_loggedin</td>
    	  <td> $userlevel</td>
    	  <td> <a href=\"admin_edituser.php?userid=$userid\"><img src=\"http://tibetwebguru.com/trms/include/icons/edit.png\" alt=\"Edit Users Details\" /></a></td>
    	  <td> <a href=\"admin_editpass.php?username=$username\"><img src=\"http://tibetwebguru.com/trms/include/icons/password.png\" alt=\"Change Users Password\" /></a></td>
    	  <td> <a href=\"admin_deleteuser.php?id=$userid\"><img src=\"http://tibetwebguru.com/trms/include/icons/delete.png\" alt=\"Delete User\" /></a></td>
		  </tr>\n";     
	}

	if($num_rows == 0) {
	
	echo "<tr height=\"35\">
	 	  <td colspan=\"9\" align=\"center\">No Members to Display</td>
    	  </tr>\n";
	}
	
	echo "</table>\n";
	
	}



function list_users() {

	   $q = "SELECT * FROM ".STAFF."";
	   $result = mysql_query($q);
	   $num_rows = mysql_numrows($result);

	echo "<select name=\"username\">";	

	for($i=0; $i<$num_rows; $i++){
		
		$name=mysql_result($result,$i,"username");
		echo "<option value=\"$name\">$name</option>"; 
	
	}
	
	echo "</select>";
	
	}
	
	function update_user($POST, $change) {

	if(isset($change)) {
	
	$username = $POST['username'];
	$level = $POST['level'];
	
		$this->query("UPDATE ".STAFF." SET user_level = '$level' WHERE username = '$username'");
	
 		return  $username."'s User level was changed to ".$level;
	
	}	
	}

	function suspend_user($POST, $suspend) {
	
	if(isset($suspend)) {
	
	$username = $POST['username'];
	$status = $POST['level'];
	$email = $this->query("SELECT email_address FROM ".STAFF." WHERE username = '$username'");
	
		$this->query("UPDATE ".STAFF." SET status = '$status' WHERE username = '$username'");
	
		if ($status == "live") {
 		 return  $username."'s User Status was changed to Live.";
			Status_Changed($username, $email, 'Approved');
	
		} else if ($status == "suspended") {
 		 return  $username."'s User Status was changed to Suspended.";
			Status_Changed($username, $email, 'Suspended');
		}
	}
	}

	function delete_user($POST, $delete) {
	
	if(isset($delete)) {
	
		$check = $POST['check'];
		$id = $POST['id'];
		
	if ($check == "yes") {	
 
	$this->query("DELETE FROM ".STAFF." WHERE userid = $id");

		return  "User was deleted.<br /><a href=\"admin_center.php\">Admin Center</a>";

	} else if ($check == "no") {
	
		return  "User was not deleted.<br /><a href=\"admin_center.php\">Admin Center</a>";
	
	}
	
	} else {
		return "Are you sure you want to delete the user?";
	}
	}
	

	function edit_user($POST, $edit) {
	
	if(isset($edit)) {
	
	$first_name = $POST['first_name'];
	$last_name = $POST['last_name'];
	$info = $POST['info'];
	$email_address = $POST['email_address'];
	$username = $POST['username'];
	$userid = $POST['userid'];
	
	
	$this->query("UPDATE ".STAFF." SET first_name='$first_name', last_name='$last_name', email_address='$email_address', info='$info', username='$username' WHERE userid='".$userid."'");

	return "User Details Updated.<br /><a href=\"admin_center.php\">Admin Center</a>";

	}
	}
	
	function edit_request($edit) {
	
	if(isset($edit)) {
	$details = $this->query('SELECT * FROM '.STAFF.' WHERE userid = '.$_GET['userid'].'');
		return $details['result'];
	} else {
	$details = $this->query('SELECT * FROM '.STAFF.' WHERE userid = '.$_GET['userid'].'');
		return $details['result'];
	}
	
	}

	function edit_pass($POST, $edit) {

	if(isset($edit)) {

	$pass1 = $POST['pass1'];
	$pass2 = $POST['pass2'];
	$username = $POST['username'];
	
	if ($pass1 !== $pass2) {
	return "Passwords do not match.";
	}
	
	$this->query("UPDATE ".STAFF." SET password = '".md5($pass1)."' WHERE username = '$username'");

		return "User password has been updated.<br /><a href=\"admin_center.php\">Admin Center</a>";
	
	}
	}
}

?>