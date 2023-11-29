<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'Sen@c2023');
define('BASE', 'livraria');
define('PORT', 3306);

$conn = new MySQLi(HOST,USER,PASS,BASE,PORT);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}


?>
