<?php require("includes/config.php");

$stmt = $db->prepare('SELECT admin FROM users where username = :username');
$stmt->execute(array(':username' => $_SESSION['username']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userInfo = array('admin'=>$row['admin']);

$id = $_POST['id3'];

$stmt = $db->prepare('SELECT op FROM items where id = :id');
$stmt->execute(array(':id'=>$id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$itemInfo = array('op'=>$row['op']);

if (!$userInfo['admin'] || $_SESSION['username'] != $itemInfo['op']) {
    header("Location: index.php");
}


$stmt = $db->prepare('DELETE FROM items where id = :id');
$stmt->execute(array(':id' => $id));

header('Location: tools.php');

?>