<?php require("config.php");

$stmt = $db->prepare('INSERT INTO items (title, description, currentBid, bidHistory, endTime, reserve, op) VALUES (:title, :description, :currentBid, :bidHistory, :endTime, :reserve, :op)');
$stmt->execute(array(
    ':title' => $_POST['title'],
    ':description' => $_POST['description'],
    ':currentBid' => $_POST['reserve'],
    ':bidHistory' => '',
    ':endTime' => NULL,
    ':reserve' => $_POST['reserve'],
    ':op' => $_SESSION['username']
));

$stmt = $db->prepare("SELECT MAX(id) AS max_id FROM items");
$stmt -> execute();
$id = $stmt -> fetch(PDO::FETCH_ASSOC);
$max_id = $id['max_id'];

mkdir('../media/items/' . $max_id);

$directory = '../media/items/' . $max_id;

$fileName = $_FILES['myfile']['name'];
$fileSize = $_FILES['myfile']['size'];
$fileTmpName = $_FILES['myfile']['tmp_name'];
$fileType = $_FILES['myfile']['type'];
$fileExtension = strtolower(end(explode('.', $fileName)));
move_uploaded_file($fileTempName, $directory);

?>