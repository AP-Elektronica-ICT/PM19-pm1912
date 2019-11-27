<?php

$dbhosta = 'remotemysql.com';
$dbusera = 'Q6EhZWemZR';
$dbpassa = 'iEkb5TgEqO';
$dbnamea = 'Q6EhZWemZR';


$db = new PDO('mysql:host='. $dbhosta.';dbname='. $dbnamea . ';charset=utf8', $dbusera, $dbpassa);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);