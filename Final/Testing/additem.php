<?php require("includes/config.php");

$title = 'Add New Item';
require("layout/header.php");
?>

<body>

	<form enctype="multipart/form-data" action="/action_page.php" method="POST">
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
