<?php require("includes/config.php");

$stmt = $db->prepare('SELECT admin FROM users where username = :username');
$stmt->execute(array(':username' => $_SESSION['username']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userInfo = array('admin'=>$row['admin']);

$username = $_POST['username2'];

if (!$userInfo['admin']) {
    header("Location: index.php");
}

$stmt = $db->prepare('DELETE FROM users where username = :username');
$stmt->execute(array(':username' => $username));

$stmt = $db->prepare('DELETE FROM items where op = :op');
$stmt->execute(array(':op' => $username));

header('Location: tools.php');

?>