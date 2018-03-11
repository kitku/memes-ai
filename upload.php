<?php
include 'base.php';

if (isset($_POST['upload'])) {
	//get last id from db
	$stmt_lastid = $pdo->prepare("SELECT max(id) as maxid FROM memes");
	$stmt_lastid->execute();
	$result_lastid = $stmt_lastid->fetch(PDO::FETCH_ASSOC);
	$nextid = $result_lastid['maxid']+1;
	//last id resides in $result_lastid['maxid'], next id in $nextid
	//upload image
	$image_caption = $_POST['caption'];
	$target = "images/".$nextid.".png";
	
	if (imagepng(imagecreatefromstring(file_get_contents($_FILES['image']['tmp_name'])), $target)) {
	//if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
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

