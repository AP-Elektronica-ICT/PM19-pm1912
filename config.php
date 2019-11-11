<?php

DO('mysql:host='. $dbhosta.';dbname='. $dbnamea . ';charset=utf8', $dbusera, $dbpassa);
=======
$dbhost = 'remotemysql.com';
$dbuser = 'Q6EhZWemZR';
$dbpass = 'iEkb5TgEqO';
$dbname = 'Q6EhZWemZR';


$db = new PDO('mysql:host='. $dbhost.';dbname='. $dbname . ';charset=utf8', $dbuser, $dbpass);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);