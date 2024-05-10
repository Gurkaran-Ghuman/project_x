<?php

session_start();
session_destroy();
header("Location:http://localhost/20-04-2024/project_x/login.php");
exit;

?>