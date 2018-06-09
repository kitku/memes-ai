<!DOCTYPE html>
<html>
	<head>
		<title>Your Memes</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		
<?php
include "topbar.html";
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
    include "base.php";
    //Will this work? If not, review code above
    //UPDATE: It works, but not elegantly
    //$stmt = $pdo->prepare("SELECT id FROM memes JOIN labels ON memes.id=labels.id WHERE $sqlString");
    $stmt = $pdo->prepare("SELECT id, caption, timesShown FROM memes WHERE $sqlString");
    $stmt->execute();
    $stmt_views = $pdo->prepare("UPDATE memes SET timesShown = :numofv WHERE id = :id");
    while($row = $stmt->fetch())
    {
		//$stmtimg = $pdo->prepare("SELECT id
		echo('<div class="gallery"><a target="_blank" href="images/'.$row[0].'.png"><img src="images/'.$row[0].'.png" alt="'.$row[0].'"></a>');
		echo('<div class="desc">'.$row[1].'</div></div>');
		$newTimesShown = $row[2]+1;
		$stmt_views->bindParam(':numofv', $newTimesShown);
		$stmt_views->bindParam(':id', $row[0]);
		$stmt_views->execute();
    }
    
}
include "end.php";
include "footer.html"
?>
</body></html>
