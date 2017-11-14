<?php
///include config
require_once('includes/config.php');

//check if already logged in move to home page
//if( $user->is_logged_in() ){ header('Location: index.php'); exit(); }

//process login form if submitted
if(isset($_POST['submit'])){

	if (!isset($_POST['username'])) $error[] = "Please fill out all fields";
	if (!isset($_POST['password'])) $error[] = "Please fill out all fields";

	$username = $_POST['username'];
	if ( $user->isValidUsername($username)){
		if (!isset($_POST['password'])){
			$error[] = 'A password must be entered';
		}
		$password = $_POST['password'];

		if($user->login($username,$password)){
			$_SESSION['username'] = $username;
			header('Location: dash.php');
			exit;

		} else {
			$error[] = 'Wrong username or password.';
		}
	}else{
		$error[] = 'Usernames are required to be Alphanumeric, and between 3-16 characters long';
	}



}//end if submit

//define page title
$title = 'YCH';

//include header template
require('layout/header.php'); 
?>

	<div id="slideshow">
		<img class="slide" src="media/hayfields.png">
		<div class="info">
			Hayfields<br>
			The path of the righteous man is beset on all sides by the iniquities of the selfish and the tyranny of evil men. Blessed is he who, in the name of charity and good will, shepherds the weak through the valley of darkness, for he is truly his brother's keeper and the finder of lost children.
		</div>
		<img class="slide" src="media/travellers.png">
		<div class="info">
			Explorers!<br>
			Just think about these things in your mind - then bring them into your world. Let your heart take you to wherever you want to be. I thought today we would do a happy little picture. Use what happens naturally, don't fight it. Now we can begin working on lots of happy little things. No pressure.
		</div>
		<img class="slide" src="media/beach_playtime.png">
		<div class="info">
			Beach Playtime<br>
			Bacon ipsum dolor amet adipisicing tail esse tenderloin magna beef ribs, incididunt pork chop shankle cupidatat leberkas consectetur. Brisket occaecat sint, picanha cupim sunt commodo ball tip porchetta anim dolore spare ribs. Ea flank eiusmod, andouille reprehenderit enim brisket boudin veniam picanha adipisicing.
		</div>
	</div>

	<div id="copy">
	<h1>About YCH</h1>
	<p>YCH, which stands for Your Character Here, is a form of art auction where the artist creates a piece of art where the characters in the artpiece are sketched roughly; a person can then place a bid, requesting their character be placed in the rough sketch's place. Winning the auction allows the buyer to have a character or persona drawn and depicted in that specific area and pose. The concept is also known as "TCBY," This Could Be You.</p>
	</div>

</body>


</html>
