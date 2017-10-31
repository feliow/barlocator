<?php 
$url = $_SERVER['REQUEST_URI'];
$strings = explode('/', $url);
$current_page = end($strings);
$dbname = 'barlocator';
$dbuser = 'root';
$dbpass = 'root';
$dbserver = 'localhost';
error_reporting(-1);
?>