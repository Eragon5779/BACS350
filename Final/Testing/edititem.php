<?php require("includes/config.php");

$title = 'Edit Item';
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

      Tags:<br>
      <input type="text" name="tags" placeholder="Tags">
      <br>
      
	  <p>Click "Submit" to update information</p>

	  <input type="submit" value="Submit">

	</form> 


</body>
</html>
