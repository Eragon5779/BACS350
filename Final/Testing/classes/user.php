<?php
include('password.php');
class User extends Password{

    private $_db;

    function __construct($db){
    	parent::__construct();

    	$this->_db = $db;
    }
	//Gets the password hash from the database
	private function get_user_hash($username){

		try {
			$stmt = $this->_db->prepare('SELECT passHash, username, firstName FROM users WHERE username = :username');
			$stmt->execute(array('username' => $username));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}
	//Checks to make sure that the username entered is valid
	public function isValidUsername($username){
		if (strlen($username) < 3) return false;
		if (strlen($username) > 17) return false;
		if (!ctype_alnum($username)) return false;
		return true;
	}
	//Logs user in
	public function login($username,$password){
		if (!$this->isValidUsername($username)) return false;
		if (strlen($password) < 3) return false;

		$row = $this->get_user_hash($username);

		if($this->password_verify($password,$row['passHash']) == 1){

		    $_SESSION['loggedin'] = true;
			$_SESSION['username'] = $row['username'];
			$_SESSION['firstName'] = $row['firstName'];
		    return true;
		}
	}
	//Logs user out, destroys session
	public function logout(){
		session_destroy();
	}
	//Checks if user is logged in
	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}

}


?>
