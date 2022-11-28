<?php
session_start();


if (isset($_GET['rep'])) {
    $_SESSION['rep'] = $_GET['rep'];
    $_SESSION['admin'] = 1;
}  

if (isset($_GET['rep'])) {
	setcookie("rep", $_GET['rep'], 0, "/");
	setcookie("admin", "1", 0, "/");
}  

 
