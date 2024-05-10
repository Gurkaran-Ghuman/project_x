<?php

session_start();

$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'project_x';
$base_url = 'http://localhost/20-04-2024/project_x';
$connection = mysqli_connect($server,$user,$pass,$database);

?>