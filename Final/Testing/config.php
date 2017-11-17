<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('America/Denver');

//database credentials
define('DBHOST','localhost');
define('DBUSER','eragon57_readdb');
define('DBPASS','XVb8@H8%E#1@uvN2!G&dnwqNjyw@^0#u*');
define('DBNAME','eragon57_bacs350');

//application address
define('DIR','http://localhost/');
define('SITEEMAIL','burk0683@bears.unco.edu');

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
include('classes/phpmailer/mail.php');
$user = new User($db);
?>
