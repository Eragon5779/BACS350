<?php require("includes/config.php");
//Get admin status of current user
$stmt = $db->prepare('SELECT admin FROM users where username = :username');
$stmt->execute(array(':username' => $_SESSION['username']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userInfo = array('admin'=>$row['admin']);
//Get username from POST data
$username = $_POST['username2'];
//Redirect if user is not an admin
if (!$userInfo['admin']) {
    header("Location: index.php");
}
//Delete user from database
$stmt = $db->prepare('DELETE FROM users where username = :username');
$stmt->execute(array(':username' => $username));
//Delete all items related to now-deleted user
$stmt = $db->prepare('DELETE FROM items where op = :op');
$stmt->execute(array(':op' => $username));
//Redirect back to tools page
header('Location: tools.php');

?>