<?php 

session_start();

$settings = parse_ini_file('db.ini', TRUE);
$mysqlUser = $settings['database']['username'];
$mysqlPassword = $settings['database']['password'];
$mysqlHost = 'mysql:host='.$settings['database']['host'].'dbname='.$settings['database']['schema'];
	
try {
	$pdo = new PDO($mysqlHost, $mysqlUser, $mysqlPassword);
} catch (PDOException $e) {
	echo 'Error: '.$e->getMessage();
}
?>
