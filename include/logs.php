<?php

//ASSIGN THE BASIC VARIABLES FOR YOUR VISITOR
$time = date("M j G:i:s Y"); 
$ip = $_SERVER['REMOTE_ADDR'];
$userAgent = getenv('HTTP_USER_AGENT');
$referrer = $_SERVER['HTTP_REFERER'];
$query = $_SERVER['QUERY_STRING'];
$user = $_SESSION['username'];

//COMBINE VARS INTO OUR LOG ENTRY
$msg = "IP: " . $ip . " USER: " . $user . " TIME: " . $time . " REFERRER: " . $referrer . " USER-QUERY: " . $query . " USERAGENT: " . $userAgent;

//CALL THE CENTRAL FUNCTION TO WRITE TO THE LOG FILE
writeToLogFile($msg);

function writeToLogFile($msg)
{
      $today = date("Y_m_d"); 
      $logfile = $today."_log.txt";
      $dir = 'logs/';
      $saveLocation=$dir . '/' . $logfile;
      if (!$handle = @fopen($saveLocation, "a"))
      {
           exit;
      }
      else
      {
           if(@fwrite($handle,"$msg\r\n")===FALSE) 
           {
                exit;
           }

           @fclose($handle);
      }
}

?> 