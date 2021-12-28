<?php
$db_user = 'root';
$db_pass = '12345678';
$db_name = 'portfoliodb';

$conn = new PDO('mysql:host=localhost; dbname='.$db_name, $db_user, $db_pass);

$conn->query('SET NAMES UTF8');

date_default_timezone_set('Asia/Bangkok');
?>