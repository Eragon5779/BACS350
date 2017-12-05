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
			<h2>Hayfields</h2>
			<h3>Current bid: $26.00</h3>
			<h3><a href="dash-2.php?username=eragon5779">eragon5779</a></h3>
			<p>Hayfields YCH edited</p>
			<p>Tags: pony</p>
		</div>
		<img alt="travellers YCH" class="slide" src="media/travellers.png">
		<div class="info">
			<h2>Dual Elf</h2>
			<h3>Current Bid: $10.00</h3>
			<h3><a href="dash-2.php?username=jbarker">jbarker</a></h3>
			<p>Two elves standing back to back</p>
			<p>Tags: human</p>
		</div>
		<img alt="beach playtime YCH" class="slide" src="media/beach_playtime.png">
		<div class="info">
			<h2>Beach Playtime</h2>
			<h3>Current bid: $10.00</h3>
			<h3><a href="dash-2.php?username=eragon5779">eragon5779</a></h3>
			<p>Beach Playtime YCH</p>
			<p>Tags: pony</p>
		</div>
	</div>

	<?php require('layout/footer.php') ?>

</body>


</html>
