<!-- Featured shows most shown memes,
that is, it shows memes which are most frequently shown
in Find Your Favorite
!-->
<?php
//include 'base.php';
$featuredMemesAmount = 10;
$stmt = $pdo->prepare("SELECT * from memes ORDER BY timesShown DESC LIMIT :lim");
$stmt->bindParam(':lim', $featuredMemesAmount); //This might be useful for choosing number of featured memes
//$stmt->execute();
//print_r($stmt);
while($row = $stmt->fetch()) {
	print_r(1);
	echo('<div class="gallery"><a target="_blank" href="images'.$row[0].'.png"><img src="images/'.$row[0].'.png" alt="'.$row[0].'"></a>');
	echo('<div class="desc">'.$row[2].'</div></div>');
}
//phpinfo();
//include 'end.php';

?>


