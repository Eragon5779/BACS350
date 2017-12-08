<?php require("includes/config.php");
//Prepares and executes the SELECT to get admin status of current user
$stmt = $db->prepare('SELECT admin FROM users where username = :username');
$stmt->execute(array(':username' => $_SESSION['username']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userInfo = array('admin'=>$row['admin']);
//Get ID of item from POST
$id = $_POST['id3'];
//Get the OP of the item
$stmt = $db->prepare('SELECT op FROM items where id = :id');
$stmt->execute(array(':id'=>$id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$itemInfo = array('op'=>$row['op']);
//Check if current user is OP or an admin, redirect without execution if not
if (!$userInfo['admin'] || $_SESSION['username'] != $itemInfo['op']) {
    header("Location: index.php");
}
//Delete item if above is correct
$stmt = $db->prepare('DELETE FROM items where id = :id');
$stmt->execute(array(':id' => $id));
//Go back to the tools page
header('Location: tools.php');

?>