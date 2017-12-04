<?php require("includes/config.php");

$stmt = $db->prepare("UPDATE items SET title=:title, description=:description, tags=:tags WHERE id=:id");
$stmt -> execute(array(
    ':title' => $_POST['title'],
    ':description' => $_POST['description'],
    ':tags' => $_POST['tags'],
    ':id' => $_POST['id']
));
header('Location: product.php?id=' . $_POST['id']);
?>