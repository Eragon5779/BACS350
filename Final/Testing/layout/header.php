
<?php
//Login Script
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
			header('Location: dash-2.php');
			exit;
		} else {
			$error[] = 'Wrong username or password.';
		}
	}else{
		$error[] = 'Usernames are required to be Alphanumeric, and between 3-16 characters long';
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta name="viewport" content="width-device-width, initial-scale=1"/>
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
				<div id="submitButton">
				<input type="submit" name="submit" value="Login">
				<button type="button"><a href="/users/casey/Testing/register.php">Register</a></button>
				</div>';
			
			}	
			?>
			</form>
			
		<div title="hero image, navbar">
			<nav id="nav_menu">
				<ul>
					<li>Categories
						<ul>
							<li><a href="search.php?keyword=human">Human</a></li>
							<li><a href="search.php?keyword=pony">Pony</a></li>
							<li><a href="search.php?keyword=furry">Furry</a></li>
						</ul>
					</li>
				</ul>
			</nav>
					
			<form id="r" action="search.php" method="get">
			<input style="margin-right:30%;" type="text" name="keyword" placeholder="search"></input>
			<input type="submit" id="sub" style="width:27.5%;"  name="submit2" value="Submit"></input>
			</form>
			<img alt="site logo" src="media/logo.png"></img>
		</div>
	</header>
