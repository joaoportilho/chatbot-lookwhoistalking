<?php
require_once '..' . DIRECTORY_SEPARATOR .'init.php';

$id = $_GET['id'];
$reaction = $_GET['reaction'];
if(isset($_GET['id']) and isset($_GET['reaction']))
{
    $config = parse_ini_file(PATH_CONFIG . 'config.ini');

    $conn = new PDO("mysql:host=" . $config['host_db'] . ":" . $config['port_db'] . ";dbname=" . $config['name_db'] . "", $config['username_db'], $config['password_db']);

    $stmt = $conn->prepare('update prompts set reaction = ?, dt_hr_atualizacao = ? where id_prompt = ? ;');
    if($stmt->execute(array($reaction, date('Y-m-d H:i:s'),$id)))
    {
        echo 'Success';
    }
    
}