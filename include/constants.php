<?php

#Database Information
//Define database Server (localhost)
define("DBHOST","localhost");

//Define database Username
define("DBUSER", "YOUR_DATABASE_USERNAME");
//Define database Password
define("DBPASS","YOUR_DATABASE_PASSWORD");
//Define database Name
define("DBNAME","YOUR_DATABASE_NAME");


//Database Tabel
define("STAFF","users");
define("DBTABLE","table_name");
define("CURRENCY","table_currencies");


//Location Information

//Path of script with trailing slashes
define("Script_Path","/trms/");


// Path in your webfiles with directory name uploads
define("Upload_Path","../uploads/");


//URL of script (no trailing slash)
define("Script_URL","http://tibetwebguru.com/trms");
//define("Script_URL","http://tibetwebguru.com/trms/");

#System Information

//System Name
define("Site_Name","ABC Charitable Trust");
//Name on system emails
define("Email_From","ABC Office");
//Webmaster email address
define("Email_Address","mail@abc.com");
//Dont Reply email address
define("Non_Reply","dontreply@gmail.com");

#Session and Cookie Information
//Session Lifetimr in Seconds
define("Session_Lifetime", 60*60);
//Cookie names
define("CKIEUS","USERNAME");
define("CKIEPS","PASSWORDMD5");

#System Settings
// Require admin approvial for new users
define("Admin_Approval", true); //true or false
