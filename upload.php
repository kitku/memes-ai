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
	
  if ($_FILES['image']['tmp_name']) {
	  if (imagepng(imagecreatefromstring(file_get_contents($_FILES['image']['tmp_name'])), $target)) {
	  //if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
		  echo "Uploaded Successfully.\n";
		  chmod($target, 644);
	  } else {
		  echo "Upload failed, why?\n";
	  }
  }
	//echo "<hr><pre>";
	//print_r($_FILES);
	//print "</pre>";
	$stmt = $pdo->prepare("INSERT INTO memes (id, image, caption) VALUES (:id, :image, :caption)");
	$stmt->bindParam(':id', $nextid);
	$stmt->bindParam(':image', $_FILES['image']['name']);
	$stmt->bindParam(':caption', $_POST['caption']);
	$stmt->execute();
	
	//Update to set the tags:
	//$stmt = $pdo->prepare("UPDATE memes SET :label = b'1' WHERE id= :lastid");
	//$stmt->bindParam(':lastid', $nextid);
	$stmt_listOfLabels = $pdo->prepare("SELECT labelname FROM listoflabels;");
    $stmt_listOfLabels->execute();
	$label = $stmt_listOfLabels->fetch()[0];
	while ($label) {
		//print_r("Found ".$label.", ".$_POST[$label]);
		$labelname = "l".$label;
		if(isset($_POST[$labelname])) {
			print_r("Set ".$label."!");
			$stmt = $pdo->prepare("UPDATE memes SET ".$label."=b'1' WHERE id=".$nextid);
			//$stmt->bindParam(':label', $label);
			$stmt->execute();
		}
		$label = $stmt_listOfLabels->fetch()[0];
	}
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
  <title>Upload a meme</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php include "topbar.html"; ?>
	<form method="POST" action="upload.php" enctype="multipart/form-data">
		<input  type="hidden" name="MAX_FILE_SIZE" value="3000000" />
		<input type="file" name="image" />
		<textarea id="text" cols="40" rows="4" name="caption" ><?php echo(isset($_POST["caption"]))? $_POST["caption"] : "";?></textarea>
		<h4>Please fill in the properties of this meme:</h4>

    <?php 
      
      $stmt_listOfLabels = $pdo->prepare("SELECT labelname FROM listoflabels;");
      $stmt_listOfLabels->execute();
      $label = $stmt_listOfLabels->fetch()[0];

      echo("<table>");

      while ($label) {
        echo("<tr><td><input type=\"checkbox\" name=\"l".$label."\"</td><td>".$label."</td></tr>");
        $label = $stmt_listOfLabels->fetch()[0];
      }

    ?>

    </table>
		
		<button type="submit" name="upload">Upload!</button>
		<span>In case your property is missing:</span>
		<input type="text" name="newPropertyName">
		<button type="submit" name="updateProperties">Add property!</button>

	</form>
  <?//php phpinfo();?>
	<?php include "footer.html"; ?>
</body>
</html>

<?php
include 'end.php';
?>

