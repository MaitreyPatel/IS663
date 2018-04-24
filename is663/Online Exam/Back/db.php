<?php

define ('DB_HOST','*************');
define ('DB_USER','****');
define ('DB_PASS','********');
define ('DB_NAME','****');


$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
$db = new PDO($dsn, DB_USER, DB_PASS);
?>
