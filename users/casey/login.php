<?php

require_once 'config.php';

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if(empty(trim($_POST["username"]))){
		
		$username_err = 'Please enter username.';
		
	}
	else {
		
		$username = trim($_POST["username"]);
		
	}
	
	if(empty(trim($_POST['password']))){
		
		$password_err = "Please enter your password.";
		
	}
	else {
		
		$password = trim($_POST['password']);
		
	}
	
	if(empty($username_err) && empty($password_err)){
		
		$sql = "SELECT username, passSalt, passHash FROM user.users WHERE username = ?";
		
		if($stmt = mysqli_prepare($link, $sql)){
			
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			
			$param_username = $username;
			
			if(mysqli_stmt_execute($stmt)){
				
				mysqli_store_result($stmt);
				
				if(mysqli_stmt_num_rows($stmt) == 1){
					
					mysqli_stmt_bind_result($stmt, $username, $pass_salt, $pass_hash);
					
					if(mysqli_stmt_fetch($stmt)){
						
						if (hash_pbkdf2('sha256', $password, $pass_salt, 1000, 32) == $pass_hash){
							
							session_start();
							$_SESSION['username'] = $username;
							header("location: welcome.php");
							
						}
						else{
							
							$password_err = 'Incorrect username/password.';
							
						}
						
					}
					
				}
				else {
					
					$username_err = 'Incorrect username/password.';
					
				}
				
			}
			else {
				
				echo "Oops! Something went wrong. Please try again later.";
				
			}
			
		}
		
		mysqli_stmt_close($stmt);
		
	}
	
	mysqli_close($link);
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username:<sup>*</sup></label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>