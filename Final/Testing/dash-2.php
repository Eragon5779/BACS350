<?php require("includes/config.php");

$currentUser = '';

if ($_GET['username'] == NULL) {
    $currentUser = $_SESSION['username'];
}
else {
    $currentUser = $_GET['username'];
}

$stmt = $db->prepare('SELECT username, email, firstName, FROM users where username = :username');
$stmt->execute(array(':username' => $currentUser));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$user = array('username'=>$row['username'], 'email'=>$row['email'], 'firstName'=>$row['firstName']);

$stmt = $db->prepare('SELECT id, title FROM items where op = :op');
$stmt->execute(array(':op' => $currentUser));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$items = array('id'=>$row['id'], 'title'=>$row['title']);

$title = $currentUser;
require("layout/header.php");

?>

<body>

    <h1><?php echo $_SESSION['firstName'] ?>'s Profile</h1>

    <h3>Their items</h3>
    <ul>
    <?php

        foreach ($items as &$item) {
            echo '<li><a href="product.php?id=' . $item['id'] . '">' . $item['title'] . '</li>';
        }

    ?>
    </ul>

<?php

require("layout/footer.php");

?>