<?php
session_start();

$_SESSION['user'] = NULL;
$_SESSION['admin'] = NULL;

header("Location: index.php");
die();

?>
