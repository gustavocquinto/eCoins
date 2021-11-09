<?php

$bd_dsn = 'mysql:host=localhost;port=3306;dbname=ecoins';
$bd_user = 'root';
$bd_pass = '';

$bd = new PDO($bd_dsn, $bd_user, $bd_pass);