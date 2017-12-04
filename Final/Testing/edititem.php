<?php require("includes/config.php");

$id = $_POST['id2'];
require("layout/header.php");
if (!$user->is_logged_in()) {
	header("Location: index.php");
}
?>

<body style="background-color: #333;">

	<form enctype="multipart/form-data" action="moditem.php" method="POST">
	  Title:<br>
	  <input type="text" name="title" placeholder="Title">
	  <br>
	  
	  Description:<br>
	  <input type="text" name="description" placeholder="Description">
      <br>

      Tags:<br>
      <input type="text" name="tags" placeholder="Tags">
      <br>

      <input type="hidden" name="id" value="<?php echo $id ?>">
      
	  <p>Click "Submit" to update information</p>

	  <input type="submit" value="Submit">

	</form>

</body>
</html>
