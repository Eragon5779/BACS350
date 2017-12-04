<?php require('includes/config.php');

	$search = $_GET["keyword"];
	$stmt = $db->prepare('SELECT id, title, description, currentBid, tags, op FROM items where CONCAT(title, description, op, tags) LIKE :search');
	$stmt->bindValue('search','%' . $search . '%');
	$stmt->execute();
	

	$title = 'Search: ' . $search;
	require('layout/header.php'); 
?>

	<?php 
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {

			$item = array('id'=>$row['id'], 'title'=>$row['title'], 'description'=>$row['description'], 'currentBid'=>$row['currentBid'], 'op'=>$row['op'], 'tags' => $row['tags']);
			$images = glob("media/items/" . $item['id'] . "/*.*");
		
			echo '<div class="product" style="background-image: url(' . $images[0] . ');" title="' . $images['title'] . '"> 

			<div>
			<h2><a href="product.php?id=' . $item['id'] . '">' . $item['title'] . '</a></h2>
			
			<h3>Current bid: $' . number_format($item['currentBid'], 2) . '</h3>
			
			<h3><a href="search.php?keyword=' . $item['op'] . '">' . $item['op'] . '</a></h3>
			
			<p>' . $item['description'] . '</p>

			<p>Tags: ' . $item['tags'] . '</p>
			
			</div>
			
			</div>';
		}
	require('layout/footer.php') ?>
</html>