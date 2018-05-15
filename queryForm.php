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
    $stmt = $pdo->prepare("SELECT image FROM memes JOIN labels ON memes.id=labels.id WHERE $sqlString");
    $stmt->execute();
    while($row = $stmt->fetch())
    {
	echo('<img src="images/' . $row[0] . '" alt="' . $row[0] . '"><br>');
    }
    
}
include "end.php";
?>
