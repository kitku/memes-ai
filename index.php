<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8" />
	<title>Memes AI</title>
	</head>
	
<body>
	<?php 
	$settings = parse_ini_file('db.ini', TRUE);
	$mysqlUser = $settings['database']['username'];
	$mysqlPassword = $settings['database']['password'];
	$mysqlHost = 'mysql:host='.$settings['database']['host'].'dbname='.$settings['database']['schema'];
	$pdoAttributes = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 
	'utf8'");
	
	try {
		$pdo = newPDO($mysqlHost, $mysqlUser, $mysqlPassword, 
		$pdoAttributes);
		/* Zapytania */
	} catch (PDOException $e) {
		echo 'Error: '.$e->getMessage();
	} finally {
		$pdo = null;
	}
	?>
</body>
</html>

