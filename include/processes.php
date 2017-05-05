<?php
//error_reporting (E_ERROR | 0);
include 'constants.php';
include 'mail.php';

if(isset($_GET['log_out'])) {
	$Login_Process = new Login_Process;
	$Login_Process->log_out($_SESSION['username'], $_SESSION['password']); }

class Login_Process {

	var $cookie_user = CKIEUS;
	var $cookie_pass = CKIEPS;

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
	function welcome_note() {
			
		ini_set("session.gc_maxlifetime", Session_Lifetime); 
		session_start();
			
		if(isset($_COOKIE[$this->cookie_user]) && isset($_COOKIE[$this->cookie_pass])) {		
			$this->log_in($_COOKIE[$this->cookie_user], $_COOKIE[$this->cookie_pass], 'true', 'false', 'cookie'); 
		}
		if(isset($_SESSION['username'])) { 
			//return "<a href=\"".Script_URL.Script_Path."main.php\">Welcome ".$_SESSION['first_name']."</a>";
			return "<a href=\""."main.php\">Welcome ".$_SESSION['first_name']."</a>";
		} else {
			return "Welcome Guest, <a href=\""."index.php\">Please Login</a>";
			//return "<a href=\"".Script_URL.Script_Path."index.php\">Welcome Guest, Please Login</a>";
		}	
	}
	
	function check_login($page) {

		ini_set("session.gc_maxlifetime", Session_Lifetime); 
		session_start();

		if(isset($_COOKIE[$this->cookie_user]) && isset($_COOKIE[$this->cookie_pass])){
			$this->log_in($_COOKIE[$this->cookie_user], $_COOKIE[$this->cookie_pass], 'true', $page, 'cookie'); 
		} else if(isset($_SESSION['username'])) { 	
			if(!$page) { $page = Script_Path."main.php"; }
					header("Location: http://".$_SERVER['HTTP_HOST'].$page); 
		} else {
		    return true;
		}
	}

	function check_status($page) {

		ini_set("session.gc_maxlifetime", Session_Lifetime); 
		session_start();

		if(!isset($_SESSION['username'])){
			header("Location: http://".$_SERVER['HTTP_HOST'].Script_Path."index.php?page=".$page); 
		}
	}
        
        function check_admin($page) {
           
		if (!isset($_SESSION['user_level']) || ($_SESSION['user_level'] != 5)) {
                    //header("Location: http://".$_SERVER['HTTP_HOST'].Script_Path."index.php?page=".$page);
                    header('Location: ../index.php');
                    //exit;
                }
        }

	function log_in($username, $password, $remember, $page, $submit) {
		
		if(isset($submit)) {

		if($submit !== "cookie") {
			$password = md5($password);
		}

		$query = $this->query("SELECT * FROM ".STAFF." WHERE username='$username' AND password='$password'");

		if($query['num_rows'] == 1) {

			if ($query['result']['status'] == "suspended") {
				return "Account Suspended, <br /> Contact System Administrator.";
			}
			if ($query['result']['status'] == "pending") {
				return "Account Pending, <br /> Administrator has not yet approved your account.";
			}
				$this->set_session($username, $password);	
				if(isset($remember)) 
				{ $this->set_cookie($username, $password, '+');	}
							
		} else {
				return "Username or Password not recognised.";
		}			
			$this->query("UPDATE ".STAFF." SET last_loggedin = '".date ("d/m/y G:i:s")."' WHERE username = '$username'");
		
		if(!$page) { $page = Script_Path."main.php"; }
			
		if ($page == 'false') {
				return true;
		} else {
				header("Location: http://".$_SERVER['HTTP_HOST'].$page); 
		}
		
		}
	}
	
	function set_session($username, $password) {
	
			$query = $this->query("SELECT * FROM ".STAFF." WHERE username='$username' AND password='$password'");
	
			ini_set("session.gc_maxlifetime", Session_Lifetime); 
			session_start();

			$_SESSION['first_name']    = $query['result']['first_name'];
			$_SESSION['last_name']     = $query['result']['last_name'];
			$_SESSION['email_address'] = $query['result']['email_address'];
			$_SESSION['username']      = $query['result']['username'];
			$_SESSION['info']          = $query['result']['info'];
			$_SESSION['user_level']    = $query['result']['user_level'];
			$_SESSION['password']      = $query['result']['password'];

	}	
	
	function set_cookie($username, $password, $set) {

			if($set == "+")
				{ $cookie_expire = time()+60*60*24*30; }
			else 
				{ $cookie_expire = time()-60*60*24*30; }		
	
			setcookie($this->cookie_user, $username, $cookie_expire, '/');
			setcookie($this->cookie_pass, $password, $cookie_expire, '/');
	
	} 

	function log_out($username, $password, $header) {

	session_start();
	session_unset();
	session_destroy();
    	$this->set_cookie($username, $password, '-');

		if(!isset($header)) {
			header('Location: ../index.php');
		} else {
			return true;
		}
	
	}
        
    
    function edit_details($post, $process) {

		if(isset($process)) {
			
		$first_name		= strip_tags($post['first_name']);
		$last_name		= strip_tags($post['last_name']);
		$email_address	= strip_tags($post['email_address']);
		$info			= strip_tags($post['info']);
		$username		= strip_tags($post['username']);
		$password		= $_SESSION['password'];
		
		if((!$first_name) || (!$last_name) || (!$email_address) || (!$info)) {
			return "Please enter all details.";
		}

		$this->query("UPDATE ".STAFF." SET first_name = '$first_name', last_name = '$last_name', 
		email_address = '$email_address', info = '$info' WHERE username = '$username'");		

				$this->set_session($username, $password);		
				if(isset($_COOKIE[$this->cookie_pass])) 
				{ $this->set_cookie($username, $pass, '+'); }

				return "Details sucessfully changed.";
		}
	}

	function edit_password($post, $process) {

		if(isset($process)) {

		$pass1		= $post['pass1'];
		$pass2		= $post['pass2'];
		$password	= $post['pass'];
		$username	= $post['username'];
		
		if ((!$password) || (!$pass1) || (!$pass2)) {
			return "Missing required details.";
		} 
		if (md5($password) !== $_SESSION['password']) {
			return "Current password is incorrect.";
		}
		if ($pass1 !== $pass2) {
			return "New passwords do not match.";
		}

		$new = md5($pass1);
		$this->query("UPDATE ".STAFF." SET password = '$new' WHERE username = '$username'");

				$this->set_session($username, $new);		
				if(isset($_COOKIE[$this->cookie_pass])) 
				{ $this->set_cookie($username, $pass, '+'); }

			return "Password update successfull.";
		}
	}

	function Register($post, $process) {

		if(isset($process)) {

		$pass1			= strip_tags($post['pass1']);
		$pass2			= strip_tags($post['pass2']);
		$username		= strip_tags($post['username']);
		$email_address	= strip_tags($post['email_address']);
		$first_name		= strip_tags($post['first_name']);
		$last_name		= strip_tags($post['last_name']);
		$info			= strip_tags($post['info']);
		
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
		
		if(Admin_Approvial == true) {
		$status = "pending";
		} else {
		$status = "live";
		}
		
		$this->query("INSERT INTO ".STAFF." (first_name, last_name, email_address, username, password, info, status) VALUES ('$first_name', '$last_name', '$email_address', '$username', '".md5($pass1)."', '".htmlspecialchars($info)."', '$status')");
		
		User_Created($username, $email);

		if(Admin_Approvial == true) {
		return '<span style="color:#009900 !important;">Sign up was sucessful, your account must be reviewed by the administrator before you can login.</span>';
		} else {
		return '<span style="color:#009900 !important;">Sign up was sucessful, you may now log in.</span>';
		} 	
	}
	
	} 

//Add Data
	function Add_Document($post, $process)
	{
		if(isset($process)) {
			$receipt_no			= strip_tags($post['receipt_no']);
			
            $name			= strip_tags($post['name']);
			$address			= strip_tags($post['address']);
			$on_account		= strip_tags($post['on_account']);
			$proof_doc                      = $_FILES['proof_doc'];
			$deceased_name                  = strip_tags($post['deceased_name']);
            $others                         = strip_tags($post['others']);
			$amount_no			= strip_tags($post['num']);
			$amount_word			= strip_tags($post['amount_word']);
			$currency                    = strip_tags($post['currency']);
			$payment			= strip_tags($post['payment']);
			$cheque_draft_no		= strip_tags($post['cheque_draft_no']);
            $cheque_date		= strip_tags($post['cheque_date']);
            $subDate		= strip_tags($post['subDate']);
		
            if ((!$receipt_no) || (!$name) || (!$on_account) || (!$amount_no) || (!$amount_word) || (!$payment) || (!$subDate)) {
                return '<span style="color:#F00 !important; font-size:20px;">Fields with astrick(*) sign are mandatory</span>';
            }
            /* if (empty($_FILES["case_doc_path"]["name"])) {
              return '<span style="color:#F00 !important; font-size:20px;">* Choose File..</span>';
              }
             */
            $query = $this->query("SELECT receipt_no FROM ".TABLE_NAME." WHERE receipt_no = '$receipt_no'");
		if($query['num_rows'] > 0){
		return "Receipt No. '".$receipt_no."' already exists, it is now updated please continue..";
		}

            function GetFileExtension($filetype) {
                if (empty($filetype)) {
                  return false;   
                }
                 switch ($filetype) {
                    case 'image/bmp': return '.bmp';
                    case 'image/gif': return '.gif';
                    case 'image/jpeg': return '.jpg';
                    case 'image/png': return '.png';
                    case 'application/pdf': return '.pdf';
                    //case 'application/msword': return '.doc';
                    //case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document': return '.docx';
                    default: return false;
               
                }    
                
            }

            if (!empty($_FILES["proof_doc"]["name"])) {

                //$file_name = $_FILES["proof_doc"]["name"];
                $temp_name = $_FILES["proof_doc"]["tmp_name"];
                $filtype = $_FILES["proof_doc"]["type"]; //type of file
                $ext = GetFileExtension($filtype);
                //$filename=date("d-m-Y")."-".time().$ext;
                //$filesize = $_FILES["casedocument"]["size"]; //file size in bytes
                $filename = $_FILES["proof_doc"]["name"];
                //$target_path = Script_URL.Script_Path.Upload_Path.$filename;
                $target_path = "uploads/" . $filename;

                if ((is_file($target_path)) && (file_exists($target_path))) {
                    return '<span style="color:#F00 !important; font-size:20px;">* File with that name already exists</span>';
                }

                $moveResult = move_uploaded_file($temp_name, $target_path);


                //Check to make sure the move result is true before continuing
                if ($moveResult != true) {
                    return "Error: File not uploaded. Try again.";
                    unlink($temp_name); //Remove the uploaded file from the php temp folder
                    exit();
                } 
            
            else {
                    $this->query("INSERT INTO " . TABLE_NAME . " (receipt_no, name, address, on_account, proof_doc, deceased_name, others, amount_no, amount_word, currency, payment, cheque_draft_no, cheque_date, subDate, user) VALUES ('$receipt_no', '$name', '$address', '$on_account', '" . $target_path . "', '$deceased_name', '$others', '$amount_no', '$amount_word', '$currency', '$payment', '$cheque_draft_no', '$cheque_date', '$subDate', '" . $_SESSION['username'] . "')");


                    //return '<span style="color:#009900 !important;">Data successfully upload.</span>';
                    // form processing is finished without any errors 
                    
                   //header("Location: {$_SERVER['SCRIPT_NAME']}?message=Successfully added"); // redirect to the base page to clear the form data 
                   header("Location: TABLE_NAME_getprintout.php?receipt_no={$receipt_no}");
                  

                   exit;
                    
                }
             }
             else {
                    $this->query("INSERT INTO " . TABLE_NAME . " (receipt_no, name, address, on_account, proof_doc, deceased_name, others, amount_no, amount_word, currency, payment, cheque_draft_no, cheque_date, subDate, user) VALUES ('$receipt_no', '$name', '$address', '$on_account', '" . $target_path . "', '$deceased_name', '$others', '$amount_no', '$amount_word', '$currency', '$payment', '$cheque_draft_no', '$cheque_date', '$subDate', '" . $_SESSION['username'] . "')");


                    //return '<span style="color:#009900 !important;">Data successfully upload.</span>';
                    // form processing is finished without any errors 
                    
                    //header("Location: {$_SERVER['SCRIPT_NAME']}?message=Successfully added"); // redirect to the base page to clear the form data 
                   header("Location: TABLE_NAME_getprintout.php?receipt_no={$receipt_no}");

                    exit;
                    
                    
                }
                
                
        }
    }

//Add Currency
	function Add_Currency($post, $process)
	{
		if(isset($process)) {
			$currency_shortname			= strip_tags($post['currency_shortname']);
                        $currency_fullname			= strip_tags($post['currency_fullname']);
			
		
              if ((!$currency_shortname) || (!$currency_fullname)) {
                return '<span style="color:#F00 !important; font-size:20px;">Fields with astrick(*) sign are mandatory</span>';
            }
            /* if (empty($_FILES["case_doc_path"]["name"])) {
              return '<span style="color:#F00 !important; font-size:20px;">* Choose File..</span>';
              }
             */
            

            
             else {
                    $this->query("INSERT INTO " . CURRENCY . " (currency_shortname, currency_fullname) VALUES ('$currency_shortname', '$currency_fullname')");


                    //return '<span style="color:#009900 !important;">Data successfully upload.</span>';
                    // form processing is finished without any errors 
                    
                    header("Location: {$_SERVER['SCRIPT_NAME']}?message=Successfully added"); // redirect to the base page to clear the form data 
                    exit;
                    
                    
                }
                
                
        }
    }


//Edit Currency Data
function Edit_Currency($post, $process)
	{
		if(isset($process)) {
			$id=$_POST['id'];
                        $currency_shortname=$_POST['currency_shortname'];
                        $currency_fullname=$_POST['currency_fullname'];
		$N = count($id);
		for($i=0; $i < $N; $i++)
		{
			$this->query("UPDATE currencies SET currency_shortname='$currency_shortname[$i]', currency_fullname='$currency_fullname[$i]' WHERE id='$id[$i]'")or die(mysql_error());
		}
		header("Location: currency_search.php?message=$N Record has Successfully updated");
		exit;
	}
}		

//Edit the Data
function Edit_Document($post, $process)
	{
		if(isset($process)) {
			$id=$_POST['id'];
                        $receipt_no=$_POST['receipt_no'];
                        $subDate=$_POST['subDate'];
			$name=$_POST['name'];
                        $address=$_POST['address'];
			$on_account=$_POST['on_account'];
			$deceased_name=$_POST['deceased_name'];
			$others=$_POST['others'];
			$currency=$_POST['currency'];
			$amount_no=$_POST['num'];
			$amount_word=$_POST['amount_word'];
			$payment=$_POST['payment'];
			$cheque_draft_no=$_POST['cheque_draft_no'];
                        $cheque_date=$_POST['cheque_date'];
		$N = count($id);
		for($i=0; $i < $N; $i++)
		{
			$this->query("UPDATE TABLE_NAMEs SET name='$name[$i]', address='$address[$i]', on_account='$on_account[$i]', deceased_name='$deceased_name[$i]', others='$others[$i]', currency='$currency[$i]', amount_no='$amount_no[$i]', amount_word='$amount_word[$i]', subDate='$subDate[$i]', payment='$payment[$i]', cheque_draft_no='$cheque_draft_no[$i]', cheque_date='$cheque_date[$i]' WHERE id='$id[$i]'")or die(mysql_error());
		}
		header("Location: TABLE_NAME-search.php?message=$N Record has Successfully updated");
		exit;
	}
}

/
//Forgot Password
function Forgot_Password($get, $post) {
	
	$username = $post['username'];
	if(!$username) { 
	$username = $get['username']; } 
	
	$code = $post['code'];
	if(!$code) { 
	$code = $get['code']; } 

		if (isset($code)) {
			$query = $this->query("SELECT * FROM ".STAFF." WHERE username='$username' AND forgot='$code'");
		
		if($query['num_rows'] == 1) {		
				return "<!-- !-->";
		} else {
		if(isset($code) && isset($username)) {
				return "Link Invalid, Please Request a new link.";
		} else {
				return false;
		}
	}
	}
}


//Request for Password
	function Request_Password($post, $process) {
		
		$username = $post['username'];
		$email = $post['email'];
			
		if(isset($process)) {

		$query = $this->query("SELECT * FROM ".STAFF." WHERE username='$username' AND email_address = '$email'");

			if((!$username) || (!$email)) {
				return "Please enter all details.";
			}

			if($query['num_rows'] == 0){
				return "Matching details were not found.";
			}

		    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
		    srand((double)microtime()*1000000);
		    $i = 0;
		    $pass = '' ;

   			while ($i <= 7) {
   			    $num = rand() % 33;
        		$tmp = substr($chars, $num, 1);
        		$pass = $pass . $tmp;
        		$i++;
    		}
			$code = md5($pass);
			$this->query("UPDATE ".STAFF." SET forgot = '$code' WHERE username='$username' AND email_address='$email'");

			Mail_Reset_Password($username, $code, $email);
				return "We have sent an email to your address, this will allow you to reset your password.";
			
		}
	}

//Reset Password
	function Reset_Password($post, $process) {

		if(isset($process)) {
		
		$pass1 = $post['pass1'];
		$pass2 = $post['pass2'];
		$username = $post['username'];
		
		if ($pass1 !== $pass2) {
			return "New passwords do not match";
		}
		
			$password = md5($pass1);

		$query = $this->query("UPDATE ".STAFF." SET password = '$password', forgot = 'NULL' WHERE username = '$username'");
		
		Mail_Reset_Password_Confirmation($username, $email);
			return "Password Reset Sucsessfull, You may now login.";

		}
	} 
        
} //end of class Login_Process