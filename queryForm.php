<?php
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
    $stmt = $pdo->prepare("SELECT id FROM labels WHERE $sqlString");
    $stmt->execute();
    while($row = $stmt->fetch())
    {
		//$stmtimg = $pdo->prepare("SELECT id
		echo('<img src="images/' . $row[0] . '.png" alt="' . $row[0] . '"><br>');
    }
    
}
include "end.php";
?>
