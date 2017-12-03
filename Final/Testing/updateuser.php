<?php require("includes/config.php");

    $title = 'Update User: ' . $_SESSION['username'];
    require("layout/header.php");
    if (!$user->is_logged_in()) {
        header("Location: index.php");
    }
     // The following are the correct values
    // They only return the correct values if all fields for password changing are correctly submitted
    $filled = TRUE;
    $validated = TRUE;
    $matched = FALSE;
    $confirmed = TRUE;

    $updated = FALSE;
        
    // Does logic for updating user information if POST data is received
    if (!empty($_POST)) {

        // Get current user information
        $stmt = $db->prepare('SELECT username, passSalt, passHash, email, firstName, lastName FROM users where username = :username');
        $stmt->execute(array(':username' => $_SESSION['username']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $userInfo = array('username'=>$row['username'],'passSalt'=> $row['passSalt'],'passHash'=>$row['passHash'], 'email'=>$row['email'], 'firstName'=>$row['firstName'], 'lastName'=>$row['lastName']);

        // Set updated information appropriately
        $newFirstName = $_POST['firstName'];
        $newLastName = $_POST['lastName'];
        $newEmail = $_POST['email'];

        // If any information isn't updated, let it be the old information
        if ($newFirstName == NULL) {
            $newFirstName = $userInfo['firstName'];
        }
        if ($newLastName == NULL) {
            $newLastName = $userInfo['lastName'];
        }
        if ($newEmail == NULL) {
            $newEmail = $userInfo['email'];
        }

        if ($_POST['oldPass'] != NULL || $_POST['newPass'] != NULL || $_POST['confirmPass'] != NULL) {
            if ($_POST['oldPass'] == NULL || $_POST['newPass'] == NULL || $_POST['confirmPass'] == NULL) {
                $filled = FALSE;
            }
            else if (!password_verify($_POST['oldPass'], $userInfo['passHash'])) {
                $validated = FALSE;
            }
            else if ($_POST['oldPass'] == $_POST['newPass']) {
                $matched = TRUE;
            }
            else if ($_POST['newPass'] != $_POST['confirmPass']) {
                $confirmed = FALSE;
            }
            else {
                $options = [
                    'cost' => 12,
                    'salt' => $userInfo['passSalt']
                ];
                $newPassHash = $user->password_hash($_POST['newPass'], PASSWORD_BCRYPT, $options);
                $stmt = $db->prepare('UPDATE users SET passHash=:passHash, firstName=:firstName, lastName=:lastName, email=:email WHERE username=:username');
                $stmt->execute(array(
                    ':passHash' => $newPassHash,
                    ':firstName' => $newFirstName,
                    ':lastName' => $newLastName,
                    ':email' => $newEmail,
                    ':username' => $_SESSION['username']
                ));
                $updated = TRUE;
            }
        }
        else {
            $stmt = $db->prepare('UPDATE users SET firstName=:firstName, lastName=:lastName, email=:email WHERE username=:username');
            $stmt->execute(array(
                ':firstName' => $newFirstName,
                ':lastName' => $newLastName,
                ':email' => $newEmail,
                ':username' => $_SESSION['username']
            ));
            $updated = TRUE;
        }
    }

?>

<body style="background-color: #333;">
    <?php 
        if ($updated) {
            echo '<p style="color: green;">Information updated successfully</p>';
        }
    ?>
	<form enctype="multipart/form-data" action="updateuser.php" method="POST">
        First Name:<br>
        <input type="text" name="firstName" placeholder="First Name">
        <br>
        
        Lase Name:<br>
        <input type="text" name="lastName" placeholder="Last Name">
        <br>
        
        E-Mail:<br>
        <input type="text" name="email" placeholder="E-Mail">
        <br><br>

        <h3>The following is only required if changing your password:</h3>
        <br>

        <?php 
            if (!$filled) {
                echo 'Please fill out all of the below to change password<br>';
            }
            if (!$validated) {
                echo 'Please verify that password is correct<br>';
            }

        ?>


        Old Password:<br>
        <input type="password" name="oldPass">
        <br>
        
        <?php

            if ($matched) {
                echo 'Please enter a new password<br>';
            }

        ?>

        New Password:<br>
        <input type="password" name="newPass">
        <br>

        <?php 

            if (!$confirmed) {
                echo 'Please make sure both passwords match<br>';
            }

        ?>

        Confirm New Password:<br>
        <input type="password" name="confirmPass">
        <br>

        <input type="submit" value="Submit">

	</form> 


</body>
</html>
