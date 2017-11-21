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

	<?php echo '<div class="product" style="background-image: url(' . $images[0] . ');">' ?>

		<div>
		<h2><?php echo $item['title'] ?></h2>
		
		<h3>Current bid: $<?php echo number_format($item['currentBid'], 2) ?></h3>
		
		<h3><?php echo $item['op'] ?></h3>
		
		<p><?php echo $item['description'] ?></p>

		<form action="includes/bid.php" method="post">
			<?php echo 'Your Bid: $<input type="text" name="bid" placeholder="' . ($item['currentBid'] + .01) . '">' ?>
			<input type="hidden" name="history" value=<?php echo '"' . $item['bidHistory'] . '"' ?>>
			<input type="hidden" name="id" value=<?php echo '"' . $currentID . '"' ?>>
			<input type="submit">
		</form>
		
		</div>
		
	</div>

	<?php require('layout/footer.php') ?>
</html>