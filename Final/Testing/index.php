<?php
require_once('includes/config.php');
//PHP script initialized into the webpage
///include config

//check if already logged in move to home page
//if( $user->is_logged_in() ){ header('Location: index.php'); exit(); }

//process login form if submitted
//if(isset($_POST['submit'])){

//	if (!isset($_POST['username'])) $error[] = "Please fill out all fields";
//	if (!isset($_POST['password'])) $error[] = "Please fill out all fields";
//
//	$username = $_POST['username'];
//	if ( $user->isValidUsername($username)){
//		if (!isset($_POST['password'])){
//			$error[] = 'A password must be entered';
//		}
//		$password = $_POST['password'];
///
//		if($user->login($username,$password)){
///			$_SESSION['username'] = $username;
//			header('Location: dash-2.php');
//			exit;
//
//		} else {
//			$error[] = 'Wrong username or password.';
//		}
//	}else{
//		$error[] = 'Usernames are required to be Alphanumeric, and between 3-16 characters long';
//	}
//
//
//
//}///end if submit

//define page title
$title = 'YCH';

//include header template
require('layout/header.php'); 
?>
	<!--Holds the slideshow that is used to display recent items and items on display-->

	<div id="slideshow">
		<img alt="hayfields YCH" class="slide" src="media/hayfields.png">
		<div class="info">
			Hayfields</br>
			Current bid: $26.00</br>
			Hayfields YCH edited</br>
			Tags: pony
		</div>
		<img alt="dual elf YCH" class="slide" src="media/dual_elf.png">
		<div class="info">
			Dual Elf</br>
			Current Bid: $10.00</br>
			Two elves standing back to back</br>
			Tags: human
		</div>
		<img alt="beach playtime YCH" class="slide" src="media/beach_playtime.png">
		<div class="info">
			Beach Playtime</br>
			Current bid: $10.00</br>
			Beach Playtime YCH</br>
			Tags: pony
		</div>
	</div>

	<?php require('layout/footer.php') ?>

</body>


</html>
