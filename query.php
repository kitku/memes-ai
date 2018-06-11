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
	$stmt = $pdo->prepare('SELECT name FROM labels;');
	$stmt->execute();
  echo('<table>');
	while($label = $stmt->fetch()[0])
	{
		echo("<tr><td><input type='checkbox' name='labels[]' value=$label></td><td>$label</td></tr>");
	}
?>
</table>
<br><input type="submit" name="submit" value="Show memes">
</form>
<?php
if(isset($_POST['submit'])) 
{
	$labels = $_POST['labels'];
	if(empty($labels))
	{
		echo "You didn't choose any labels";
	}
	else
	{
		$n = count($labels);
		$sqlString = "l.name LIKE \"$labels[0]\"";
		for($i=1; $i<$n; $i++)
		{
			$sqlString = $sqlString . " OR l.name LIKE \"$labels[$i]\"";
		}
		$stmt = $pdo->prepare("SELECT m.id, m.caption FROM memes m JOIN memes_labels ml ON m.id=ml.meme_id JOIN labels l ON ml.label_id=l.id WHERE $sqlString GROUP BY m.id HAVING count(*) LIKE {$n};");
		$stmt->execute();
		$stmt_updateShown = $pdo->prepare("UPDATE memes SET timesShown=timesShown+1 WHERE id LIKE :id;");
		while($row = $stmt->fetch())
		{
      $stmt_updateShown->execute(["id"=>$row['id']]);
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
