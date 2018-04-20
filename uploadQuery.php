<!DOCTYPE html>
<html>
  <head>

  </head>
  <body>
    <form action=" " method="post">
      <?php
	include 'base.php';
	$stmt = $pdo->prepare('SHOW COLUMNS FROM min_memes WHERE type="tinyint(1)"');
        $stmt->execute();
      while($label = $stmt->fetchColumn(0)) {
      
