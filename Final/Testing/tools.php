<?php require("includes/config.php");

$title = 'Admin Tools';
require("layout/header.php");

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
$stmt = $db->prepare('SELECT admin FROM users where username = :username');
$stmt->execute(array(':username' => $_SESSION['username']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userInfo = array('admin'=>$row['admin']);

if (!$userInfo['admin']) {
    header("Location: index.php");
}

$stmt = $db->prepare('SELECT * FROM items');
$stmt->execute();

echo '<table name="items">';

echo '<tr>
      <th>ID</th>
      <th>Title</th>
      <th>Description</th>
      <th>OP</th>
      <th>Options</th>
      </tr>';

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

?>







<?php 

require("layout/footer.php");

?>