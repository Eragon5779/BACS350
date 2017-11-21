<?php require('includes/config.php');

	$search = $_GET["keyword"];
	$stmt = $db->prepare('SELECT id, title, description, currentBid, op FROM items where CONCAT(title, description, op) LIKE :search');
	$stmt->bindValue('search','%' . $search . '%');
	$stmt->execute();
	

	$title = 'Search: ' . $search;
	require('layout/header.php'); 
?>

	<?php 
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {

			$item = array('id'=>$row['id'], 'title'=>$row['title'], 'description'=>$row['description'], 'currentBid'=>$row['currentBid'], 'op'=>$row['op']);
			$images = glob("media/items/" . $item['id'] . "/*.*");
		
			echo '<div class="product" style="background-image: url(' . $images[0] . ');"> 

			<div>
			<h2><a href="product.php?id=' . $item['id'] . '">' . $item['title'] . '</a></h2>
			
			<h3>Current bid: $' . number_format($item['currentBid'], 2) . '</h3>
			
			<h3>' . $item['op'] . '</h3>
			
			<p>' . $item['description'] . '</p>
			
			</div>
			
			</div>';
		}
	require('layout/footer.php') ?>
</html>