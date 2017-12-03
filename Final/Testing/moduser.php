<?php require("includes/config.php");

    // Must be logged in to update user information
    if ($_SESSION['username'] == NULL) {
        header("Location: index.php");
    }

    // The following are the correct values
    // They only return the correct values if all fields for password changing are correctly submitted
    $filled = TRUE;
    $validated = TRUE;
    $matched = FALSE;
    $confirmed = TRUE;
    
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
    }

?>

<form method="post" action="updateuser.php">

</form>