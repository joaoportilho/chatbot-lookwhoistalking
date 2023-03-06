<?php

require_once '..' . DIRECTORY_SEPARATOR .'init.php';

$config = parse_ini_file(PATH_CONFIG . 'config.ini');

$conn = new PDO("mysql:host=" . $config['host_db'] . ":" . $config['port_db'] . ";dbname=" . $config['name_db'] . "", $config['username_db'], $config['password_db']);


$username = $_POST['user'];
$password = $_POST['password'];

if($username == 'admin' and $password == 'j02pp12si99l')
{
    session_start();

    $_SESSION['authenticated'] = true;
    $_SESSION['username'] = 'admin';
    
}
header('location:../index.php');