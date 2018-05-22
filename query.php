<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h> Choose labels: </h>
	<form action="queryForm.php" method="post">
	<?php
	    include 'base.php';
	    $stmt = $pdo->prepare('SHOW COLUMNS FROM labels WHERE type="bit(1)"');
	    $stmt->execute();
	    while($label = $stmt->fetchColumn(0))
	    {
		echo "<input type='checkbox' name='checklist[]' value=$label> $label <br>";
	    }
	    include 'end.php';
	?>    
	<br><input type="submit" value="Show memes">
	</form>
    </body>
</html>
