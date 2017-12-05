<?php require("includes/config.php");

$currentUser = '';

if ($_GET['username'] == NULL) {
    $currentUser = $_SESSION['username'];
}
else {
    $currentUser = $_GET['username'];
}

$stmt = $db->prepare('SELECT username, email, firstName, admin FROM users where username = :username');
$stmt->execute(array(':username' => $currentUser));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userInfo = array('username'=>$row['username'], 'email'=>$row['email'], 'firstName'=>$row['firstName'], 'admin'=>$row['admin']);

$stmt = $db->prepare('SELECT id, title FROM items where op = :op');
$stmt->execute(array(':op' => $currentUser));

if ($userInfo['admin'] != TRUE) {
    header("Location: index.php");
}

$title = $currentUser;
require("layout/header.php");
$currentIsLogged = ($currentUser == $_SESSION['username']);
?>

<body style="background-color: #333;">

    <h1><?php 
    if ($currentIsLogged) {
        echo 'Your'; 
    } else {
        echo $currentUser . '\'s';
    }
    ?> Profile</h1>
    <br />
    <h2><?php 
    if ($currentIsLogged) {
        echo 'Your';
    } else {
        echo $currentUser . '\'s';
    }
    ?> items</h2>
    <br />
    <ul>
    <?php

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $item = array('id'=>$row['id'], 'title'=>$row['title']);
            echo '<li><a href="product.php?id=' . $item['id'] . '">' . $item['title'] . '</a></li><br />';
        }

    ?>
    </ul>

<?php
if ($currentIsLogged) {
    echo '<h2>Update Your Profile:</h2>' . 
         '<ul>' . 
         '<li><a href="additem.php">Add New Item</a></li>' . 
         '<li><a href="updateuser.php">Change Information</a></li>' .
         '<li><a href="tools.php">Admin Tools</a></li>' .
         '</ul>';
}
require("layout/footer.php");

?>