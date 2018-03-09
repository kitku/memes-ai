<?php
require 'base.php';


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


