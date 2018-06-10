<?php include "base.php"; ?>
	 
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php include "topbar.html"; ?>
	<h> Choose labels: </h>
<form action="query.php" method="post">
<?php
	$stmt = $pdo->prepare('SHOW COLUMNS FROM memes WHERE type="bit(1)"');
	$stmt->execute();
	while($label = $stmt->fetchColumn(0))
	{
		echo "<input type='checkbox' name='checklist[]' value=$label> $label <br>";
	}
?>    
<br><input type="submit" name="submit" value="Show memes">
</form>
<?php
if(isset($_POST['submit'])) 
{
	$checklist = $_POST['checklist'];
	if(empty($checklist))
	{
		echo "You didn't choose any labels";
	}
	else
	{
		$n = count($checklist);
		$sqlString = "$checklist[0] = 1";
		for($i=1; $i<$n; $i++)
		{
			$sqlString = $sqlString . " AND $checklist[$i] = 1";
		}
		$stmt = $pdo->prepare("
			SELECT id, caption FROM memes WHERE $sqlString;
			UPDATE memes SET timesShown= timesShown+1 WHERE $sqlString");
		$stmt->execute();
		while($row = $stmt->fetch())
		{
			echo('<div class="gallery"><a target="_blank" href="images/'.$row[0].'.png"><img src="images/'.$row[0].'.png" alt="'.$row[0].'"></a>');
			echo('<div class="desc">'.$row[1].'</div></div>');
		}
	}
}
include "end.php";
include "footer.html";
?>
</body>
</html>
