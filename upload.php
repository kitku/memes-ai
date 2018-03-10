<?php
require 'base.php';

if (isset($_POST['upload'])) {
	$image = $_FIELS['image']['name'];
	$image_caption = $_POST['caption'];
	$target = "images/".basename($image);
	
	$stmt = $conn->prepare("INSERT INTO memes VALUES (

?>

<!DOCTYPE html>
<html>
<head>
	<meta encoding="UTF-8" />
</head>
<body>
<form method="POST" action="upload.php" enctype="multipart/form-data">
	<input type="file" name="image" />
	<textarea id="text" cols="40" rows="4" name="caption"></textarea>
	<button type="submit" name="upload">Upload!</button>
</form>
</body>
</html>


