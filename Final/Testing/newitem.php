<?php require("includes/config.php");

$stmt = $db->prepare("SELECT MAX(id) AS max_id FROM items");
$stmt -> execute();
$id = $stmt -> fetch(PDO::FETCH_ASSOC);
$max_id = $id['max_id'] + 1;
mkdir('media/items/' . $max_id);

$directory = 'media/items/' . $max_id . '/';
$target = $directory . $_FILES['image']['name'];

$fileName = $_FILES['image']['name'];
echo 'Filename: ' . $fileName . '';
$fileSize = $_FILES['image']['size'];
//echo $fileSize;
$fileTmpName = $_FILES['image']['tmp_name'];
//echo $fileTmpName;
$fileType = $_FILES['image']['type'];
$fileExtension = strtolower(end(explode('.', $fileName)));
if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    $stmt = $db->prepare('INSERT INTO items (title, description, currentBid, bidHistory, endTime, reserve, op) VALUES (:title, :description, :currentBid, :bidHistory, :endTime, :reserve, :op)');
    $stmt->execute(array(
        ':title' => $_POST['title'],
        ':description' => $_POST['description'],
        ':currentBid' => $_POST['reserve'],
        ':bidHistory' => '',
        ':endTime' => NULL,
        ':reserve' => $_POST['reserve'],
        ':op' => $_SESSION['username'],
        ':tags' => $_POST['tags']
    ));
    echo '<h1>File uploaded succeeded</h1><br />' . 
         '<a href="index.php">Click here to return to home if you are not automatically redirected</a>';
         header("Location: index.php");
}
else {
    echo '<h1>Upload failed. Please try again later</h1><br />' . 
         '<a href="index.php">Click here to return to home</a>';
}
?>