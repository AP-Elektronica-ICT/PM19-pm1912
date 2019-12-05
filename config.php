<?php

$dbhosta = 'eu-sql.pebblehost.com';
$dbusera = 'customer_93889';
$dbpassa = '64a2b900dd';
$dbnamea = 'customer_93889';

$db = new PDO('mysql:host='. $dbhosta.';dbname='. $dbnamea . ';charset=utf8', $dbusera, $dbpassa);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
