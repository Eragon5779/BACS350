<?php require("includes/config.php");
// assigns the "add new item" string to the $title variable
$title = 'Add New Item';
// put the header into the page
require("layout/header.php");
// if the user is logged in, put their name in the header
if (!$user->is_logged_in()) {
	header("Location: index.php");
}
?>

<!-- body style, HTML style -->
<body style="background-color: #333;">

<!-- form for adding new item, POST, like Google's search -->
	<form enctype="multipart/form-data" action="newitem.php" method="POST">

<!-- takes text input for title, description, reserve -->
	  Title:<br>
	  <input type="text" name="title" placeholder="Title">
	  <br>
	  
	  Description:<br>
	  <input type="text" name="description" placeholder="Description">
	  <br>
	  
	  Reserve:<br>
	  <input type="text" name="reserve" placeholder="Reserve">
	  <br>

<!-- dropdown menu to assign it a tag (for searching) -->
	  Tag:<br>
		<select>
			<option value="human">Human</option>
			<option value="pony">Pony</option>
			<option value="furry">Furry</option>
		</select>
	  <br><br><br>

<!-- actual file upload for the item itself -->
	  
	  File Upload: <br> <bR>
	  <input type="file" name="image" id="image">

	  <p>Click "Submit" to upload the file and information</p>

<!-- submits the data entered to the server -->
	  <input type="submit" value="Submit">

	</form> 


</body>
</html>
