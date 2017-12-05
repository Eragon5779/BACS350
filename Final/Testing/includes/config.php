<?php
ob_start();
if(session_status() != PHP_SESSION_ACTIVE)
{
    session_start();
}


//set timezone
date_default_timezone_set('America/Denver');

//database credentials
define('DBHOST','192.185.4.38');
define('DBUSER','eragon57_readdb');
define('DBPASS','Ce2GoMCdneDEQGAv5dKVQl95XiTHD0QM');
define('DBNAME','eragon57_bacs350');

//application address
define('DIR','http://localhost/Final/Testing/');
define('SITEEMAIL','webmaster@dragonfirecomputing.com');

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";charset=utf8mb4;dbname=".DBNAME, DBUSER, DBPASS);
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);//Suggested to uncomment on production websites
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/user.php');
//include('classes/phpmailer/mail.php');
$user = new User($db);
?>
