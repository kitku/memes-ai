<!-- Featured shows most shown memes,
that is, it shows memes which are most frequently shown
in Find Your Favorite
--!>
<?php
include 'base.php';
$stmt = $pdo->prepare("SELECT * from featured ORDER BY timesShown DESC LIMIT :lim");
$stmt->bindParam(':lim', 20); //This might be useful for choosing number of featured memes
$stmt->execute();

while($row = $stmt->fetch()) {
	echo('<img src="images/'.$row[0].'.png" alt="'.$row[0].'"><br />');
}

include 'end.php';

?>


