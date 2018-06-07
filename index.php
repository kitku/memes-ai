<?php include "base.php"; ?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8" />
	<title>Memes AI</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<?php include "topbar.html"; ?>
	  <h1>Memes-AI Temporary Main Page</h1>
	  [<a href="query.php">Find Your Favourites</a>][<a href="upload.php">Submit a meme</a>]
	  <!--
TODO:
- "Featured" memes in here
- better layout and theme
!-->
		<?php include "featured.php";
			  include "footer.html";?>
	</body>
</html>
<?php include "end.php"; ?>
