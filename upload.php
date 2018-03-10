<?php
require 'base.php';

if (isset($_POST['upload'])) {
	$image_caption = $_POST['caption'];
	$target = "images/".basename($_FILES['image']['name']);
	
	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
		echo "Uploaded Successfully.\n";
	} else {
		echo "Upload failed, why?\n";
	}
	echo "<hr><pre>";
	print_r($_FILES);
	print "</pre>";
	//$stmt = $conn->prepare("INSERT INTO memes VALUES (
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta encoding="UTF-8" />
</head>
<body>
<form method="POST" action="upload.php" enctype="multipart/form-data">
	<input  type="hidden" name="MAX_FILE_SIZE" value="3000000" />
	<input type="file" name="image" />
	<textarea id="text" cols="40" rows="4" name="caption"></textarea>
	<button type="submit" name="upload">Upload!</button>
</form>
</body>
</html>

<?php
include 'end.php';
?>

