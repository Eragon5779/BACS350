<?php require("includes/config.php");

$title = 'Add New Item';
require("layout/header.php");
if (!$user->is_logged_in()) {
	header("Location: index.php");
}
?>

<body style="background-color: #333;">

	<form enctype="multipart/form-data" action="newitem.php" method="POST">
	  Title:<br>
	  <input type="text" name="title" placeholder="Title">
	  <br>
	  
	  Description:<br>
	  <input type="text" name="description" placeholder="Description">
	  <br>
	  
	  Reserve:<br>
	  <input type="text" name="reserve" placeholder="Reserve">
	  <br><br><br>
	  
	  File Upload: <br> <bR>
	  <input type="file" name="image" id="image">

	  <p>Click "Submit" to upload the file and information</p>

	  <input type="submit" value="Submit">

	</form> 


</body>
</html>
