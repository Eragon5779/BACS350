<?php require("includes/config.php");

$title = 'Admin Tools';
require("layout/header.php");
//Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
//Get user admin status
$stmt = $db->prepare('SELECT admin FROM users where username = :username');
$stmt->execute(array(':username' => $_SESSION['username']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userInfo = array('admin'=>$row['admin']);
//Check if user is admin
if (!$userInfo['admin']) {
    header("Location: index.php");
}
//Get all items with all information
$stmt = $db->prepare('SELECT * FROM items');
$stmt->execute();
//Item table header
echo '<body style="background-color: #333"><div style="margin-left: 1em;">';
echo '<h2>Item Management</h2><br>';
echo '<table name="items">';
echo '<tr>
      <th>ID</th>
      <th>Title</th>
      <th>Description</th>
      <th>OP</th>
      <th>Options</th>
      </tr>';
//Dynamically add each item with basic information and options
while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
    $item = array('id'=>$row['id'], 'title'=>$row['title'], 'description'=>$row['description'], 'currentBid'=>$row['currentBid'], 'op'=>$row['op'], 'tags' => $row['tags']);
    echo '<tr>
          <td>' . $item['id'] . '</td>
          <td>' . $item['title'] . '</td>
          <td>' . $item['description'] . '</td>
          <td>' . $item['op'] . '</td>
          <td>
          <form action="edititem.php" method="post">
          <input type="hidden" name="id2" value="' . $item['id'] . '">
          <input type="submit" value="Edit">
          </form>
          <form action="deleteitem.php" method="post">
          <input type="hidden" name="id3" value="' . $item['id'] . '">
          <input type="submit" value="Delete">
          </form>
          </td>
          </tr>';
}

echo '</table>';
//Get all users with all information
$stmt = $db->prepare('SELECT * FROM users');
$stmt->execute();
//User table headers
echo '<br><h2>User Management</h2><br>';
echo '<table name="users">';

echo '<tr>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Options</th>
      </tr>';
//Display all users with basic information and options
while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
    $user = array('username'=>$row['username'], 'firstName'=>$row['firstName'], 'lastName'=>$row['lastName'], 'email' => $row['email']);
    echo '<tr>
          <td>' . $user['username'] . '</td>
          <td>' . $user['firstName'] . '</td>
          <td>' . $user['lastName'] . '</td>
          <td>' . $user['email'] . '</td>
          <td>
          <form action="updateuser.php" method="post">
          <input type="hidden" name="username" value="' . $user['username'] . '">
          <input type="submit" value="Edit">
          </form>
          <form action="deleteuser.php" method="post">
          <input type="hidden" name="username2" value="' . $user['username'] . '">
          <input type="submit" value="Delete">
          </form>
          </td>
          </tr>';
}

echo '</table></div>';


?>







<?php 

require("layout/footer.php");

?>