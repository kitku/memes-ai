<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h> Choose labels: </h>
	<form action="queryForm.php" method="post">
	<?php
	    $label = array("label1", "label2", "label3");
	    $numLabels = count($label);
	    
	    for($i=0; $i<$numLabels; $i++)
	    {
		echo "<input type='checkbox' name='checklist[]' value=$label[$i]> $label[$i] <br>";
	    }
	?>    
	<br><input type="submit" value="Show memes">
	</form>
    </body>
</html>
