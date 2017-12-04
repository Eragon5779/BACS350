<?php require("includes/config.php");

$stmt = $db->prepare('SELECT admin FROM users where username = :username');
$stmt->execute(array(':username' => $_SESSION['username']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userInfo = array('admin'=>$row['admin']);

if (!$userInfo['admin']) {
    header("Location: index.php");
}

$id = $_POST['id3'];

$stmt = $db->prepare('DELETE FROM items where id = :id');
$stmt->execute(array(':id' => $id));

header('Location: tools.php');

?>