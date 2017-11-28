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

$title = $currentUser;
require("layout/header.php");

?>

<body style="background-color: #333;">

    <h1><?php echo $userInfo['firstName'] ?>'s Profile</h1>
    <br />
    <h3>Their items</h3>
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