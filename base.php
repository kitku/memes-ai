<?php 

session_start();

$settings = parse_ini_file('db.ini', TRUE);

$mysqlUser = $settings['database']['username'];
$mysqlPassword = $settings['database']['password'];
$mysqlHost = 'mysql:host='.$settings['database']['host'].'; dbname='.$settings['database']['schema'];
$pdoAttributes = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");

try {
	$pdo = new PDO($mysqlHost, $mysqlUser, $mysqlPassword, $pdoAttributes);
} catch (PDOException $e) {
	$pdo = null;
	echo 'Error: '.$e->getMessage();
}
?>
