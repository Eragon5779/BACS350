<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<link rel="stylesheet" href="layout/index.css">
	<link rel="stylesheet" href="index.css">
	<title><?php if(isset($title)){ echo $title; }?></title>
</head>
<body>
	<header>
		<?php
			if(isset($error)){
				foreach($error as $error){
					echo '<p class="error">'.$error.'</p>';
				}
			}
		?>
		<form role="form" id="login" action="" method="post">
			<?php if ($user->is_logged_in()){
				$firstName = $_SESSION['firstName'];
				echo '<p>Hello, ' . $firstName . '</p><br>
				<a href="logout.php"><button type="button">Logout</button></a>';
				
			}
			else {
				echo '<p>Hello, Anon</p>
				<input type="text" name="username" id="name" placeholder="username"><br>
				<input type="password" name="password" id="password" placeholder="password"><br>
				<div id="KILLME">
				<input type="submit" name="submit" value="Login">
				<button type="button"><a href="/users/casey/Testing/register.php">Register</a></button>
				</div>';
			
			}	
			?>
			</form>
			
		<div>
			<nav id="l">CATEGORIES</nav>
			<form id="r">
			<input type="text" placeholder="search"></input>
			<input style="margin-top:2.5em; class="butt" type="button" value="Submit" action="search.php" method="get"></input>
			</form>
			<img src="media/logo.png"></img>
		</div>
	</header>
