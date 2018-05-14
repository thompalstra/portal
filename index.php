<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$ds = DIRECTORY_SEPARATOR;
$dir = __DIR__ . DIRECTORY_SEPARATOR;


include("{$dir}core{$ds}app.php");

( new App() );
?>
