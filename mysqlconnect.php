<?php
// mysqli
$mysqli = new mysqli("example.com", "user", "password", "database");
$result = $mysqli->query("SELECT 'Hello, dear MySQL user!' AS _message FROM DUAL");
$row = $result->fetch_assoc();
echo htmlentities($row['_message']);

// PDO
$pdo = new PDO('mysql:host=example.com;dbname=database', 'user', 'password');
//5 đối số, số đầu: loại database, 2 số sau: host và database, 2 cái cuối là tên đăng nhập và mật khẩu

$statement = $pdo->query("SELECT 'Hello, dear MySQL user!' AS _message FROM DUAL");
$row = $statement->fetch(PDO::FETCH_ASSOC);
echo htmlentities($row['_message']);

// mysql
$c = mysql_connect("example.com", "user", "password");
mysql_select_db("database");
$result = mysql_query("SELECT 'Hello, dear MySQL user!' AS _message FROM DUAL");
$row = mysql_fetch_assoc($result);
echo htmlentities($row['_message']);

// source: http://php.net/manual/en/mysqlinfo.api.choosing.php
// more: http://php.net/manual/en/mysqli.quickstart.prepared-statements.php

// Recommended API

//It is recommended to use either the mysqli or PDO_MySQL extensions.
// It is not recommended to use the old mysql extension for new development, as it was deprecated in PHP 5.5.0 and was removed in PHP 7. 
// A detailed feature comparison matrix is provided below. The overall performance of all three extensions is considered to be about the same. 
// Although the performance of the extension contributes only a fraction of the total run time of a PHP web request. Often, the impact is as low as 0.1%.
?>

