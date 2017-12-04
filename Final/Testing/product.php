<?php require('includes/config.php');

	$currentID = $_GET["id"];
	$stmt = $db->prepare('SELECT title, description, currentBid, op, bidHistory FROM items where id = :id');
	$stmt->execute(array(':id' => $currentID));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$item = array('title'=>$row['title'], 'description'=>$row['description'], 'currentBid'=>$row['currentBid'], 'op'=>$row['op'], 'bidHistory'=>$row['bidHistory']);

	$images = glob("media/items/" . $currentID . "/*.*");
	$title = $row['title'];
	require('layout/header.php'); 
?>

	<?php echo '<div class="product" style="background-image: url(' . $images[0] . ');" title="' . $images['title'] . '">' ?>

		<div>
		<h2><?php echo $item['title'] ?></h2>
		
		<h3>Current bid: $<?php echo number_format($item['currentBid'], 2) ?></h3>
		
		<h3><?php echo '<a href="dash-2.php?username=' . $item['op']  . '">' . $item['op'] . '</a>'?></h3>
		
		<p><?php echo $item['description'] ?></p>
		<?php
			if ($user->is_logged_in()) {
				echo '
				<form action="bid.php" method="post">
				Your Bid: $<input type="text" name="bid" id="bid" value="' . ($item['currentBid'] + .01) . '">
				<input type="hidden" name="history" id="history" value="' . $item['bidHistory'] . '">
				<input type="hidden" name="id" id="id" value="' . $currentID . '">
				<input type="submit" name="submit" id="submit" value="Bid">
			</form>';
			}
			else {
				echo 'Please sign in/register to bid<br><br>';
			}
			if ($_SESSION['username'] == $item['op']) {
				echo '<form action="edititem.php" method="POST">
					  <input type="hidden" name="id2" id="id2" value="' . $item['id'] . '">
					  <input type="submit" name="submit" id="submit" value="Edit"';
			}
			
		?>
		
		</div>
		
	</div>

	<?php require('layout/footer.php') ?>
</html>