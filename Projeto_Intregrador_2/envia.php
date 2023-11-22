<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];

    $sql = "INSERT INTO livros (titulo, autor) VALUES ('$titulo', '$autor')";

    if ($conn->query($sql) === TRUE) {
        echo "Livro cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar livro: " . $conn->error;
    }
}

$conn->close();
?>