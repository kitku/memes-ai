<?php
include 'base.php';
include 'addNewProperty.php';

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
	$stmt = $pdo->prepare("INSERT INTO memes (id, image, caption) VALUES (:id, :image, :caption)");
	$stmt->bindParam(':id', $nextid);
	$stmt->bindParam(':image', $_FILES['image']['name']);
	$stmt->bindParam(':caption', $_POST['caption']);
	$stmt->execute();
	//$stmt->execute('id'=>$nextid, 'image'=>$_FILES['image']['name'], 'caption'=>$_POST['caption']);
	/* TODO:
	-> check for filetype, filesize
	-> add title box
	-> redirect to questionarre
	-> handle empty database table
	
	*/
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
		<textarea id="text" cols="40" rows="4" name="caption" ><?php echo(isset($_POST["caption"]))? $_POST["caption"] : "";?></textarea>
		<h4>Please fill in the properties of this meme:</h4>
		
		
		<button type="submit" name="upload">Upload!</button>
		<span>In case your property is missing:</span>
		<input type="text" name="newPropertyName">
		<button type="submit" name="updateProperties">Add property!</button>
	</form>
</body>
</html>

<?php
include 'end.php';
?>

