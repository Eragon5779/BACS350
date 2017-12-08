<?php require('includes/config.php');
	//Get the ID from GET		
	$currentID = $_GET["id"];
	//Get item information from database
	$stmt = $db->prepare('SELECT title, description, currentBid, op, tags, bidHistory FROM items where id = :id');
	$stmt->execute(array(':id' => $currentID));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	//Export the SQL row into a usable array
	$item = array('title'=>$row['title'], 'description'=>$row['description'], 'currentBid'=>$row['currentBid'], 'op'=>$row['op'], 'bidHistory'=>$row['bidHistory'], 'tags'=>$row['tags']);
	//Get the item images (should only be 1)
	$images = glob("media/items/" . $currentID . "/*.*");
	$title = $row['title'];
	require('layout/header.php'); 
?>
	<!-- Set the image based on the ID (always selects image 0) -->
	<?php echo '<div class="product" style="background-image: url(' . $images[0] . ');" title="' . $images['title'] . '">' ?>

		<div>
		<h2><?php echo $item['title'] ?></h2>
		
		<h3>Current bid: $<?php echo number_format($item['currentBid'], 2) ?></h3>
		
		<h3><?php echo '<a href="dash-2.php?username=' . $item['op']  . '">' . $item['op'] . '</a>'?></h3>
		
		<p><?php echo $item['description'] ?></p>

		<p>Tags: <?php echo $item['tags'] ?></p>
		<?php
		//Shows bid information if user is logged in and the user is not the OP
			if ($user->is_logged_in() && $_SESSSION['username'] != $item['op']) {
				echo '
				<form action="bid.php" method="post">
				Your Bid: $<input type="text" name="bid" id="bid" value="' . ($item['currentBid'] + .01) . '">
				<input type="hidden" name="history" id="history" value="' . $item['bidHistory'] . '">
				<input type="hidden" name="id" id="id" value="' . $currentID . '">
				<input type="submit" name="submit" id="submit" value="Bid">
			</form>';
			}
			else if (!$user->is_logged_in()){
				echo 'Please sign in/register to bid<br><br>';
			}
			if ($_SESSION['username'] == $item['op']) {
				echo '<form action="edititem.php" method="post">
					  <input type="hidden" name="id2" id="id2" value="' . $currentID . '">
					  <input type="submit" name="submit2" id="submit2" value="Edit">
					  </form>';
			}
			
		?>
		
		</div>
		
	</div>

	<?php require('layout/footer.php') ?>
</html>