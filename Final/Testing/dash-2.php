<?php require("includes/config.php");

$currentUser = '';
//See if user looking at own profile
if ($_GET['username'] == NULL) {
    $currentUser = $_SESSION['username'];
}
else {
    $currentUser = $_GET['username'];
}
//Get information of user
$stmt = $db->prepare('SELECT username, email, firstName, admin FROM users where username = :username');
$stmt->execute(array(':username' => $currentUser));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userInfo = array('username'=>$row['username'], 'email'=>$row['email'], 'firstName'=>$row['firstName'], 'admin'=>$row['admin']);
//Get user posts
$stmt = $db->prepare('SELECT id, title FROM items where op = :op');
$stmt->execute(array(':op' => $currentUser));
//Check if logged in and user is admin, if so redirect to proper page
$currentIsLogged = ($currentUser == $_SESSION['username']);
if ($userInfo['admin'] == TRUE && $currentIsLogged) {
    header("Location: admin.php");
}
//Set title
$title = $currentUser;
require("layout/header.php");
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
        //Display user items
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $item = array('id'=>$row['id'], 'title'=>$row['title']);
            echo '<li><a href="product.php?id=' . $item['id'] . '">' . $item['title'] . '</a></li><br />';
        }

    ?>
    </ul>

    <br />
    <?php

        if ($currentIsLogged) {
            echo '<h2>Update Your Profile:</h2>' . 
                 '<ul>' . 
                 '<li><a href="additem.php">Add New Item</a></li>' . 
                 '<li><a href="updateuser.php">Change Information</a></li>' .
                 '</ul>';
        }

    ?>

<?php

require("layout/footer.php");

?>