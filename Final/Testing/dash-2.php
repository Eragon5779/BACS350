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

if ($userInfo['admin'] == TRUE) {
    header("Location: admin.php");
}

$title = $currentUser;
require("layout/header.php");

?>

<body style="background-color: #333;">

    <h1><?php 
    if ($currentUser == $_SESSION['username']) {
        echo 'Your'; 
    } else {
        echo $currentUser . '\'s';
    }
    ?> Profile</h1>
    <br />
    <h3><?php 
    if ($currentUser == $_SESSION['username']) {
        echo 'Your';
    } else {
        echo $currentUser . '\'s';
    }
    ?> items</h3>
    <ul>
    <?php

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $item = array('id'=>$row['id'], 'title'=>$row['title']);
            echo '<li><a href="product.php?id=' . $item['id'] . '">' . $item['title'] . '</a></li><br />';
        }

    ?>
    </ul>

<?php

require("layout/footer.php");

?>