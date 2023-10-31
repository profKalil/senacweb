<?php

include 'livro.php';
include 'biblioteca.php';

$biblioteca = new Biblioteca();

$biblioteca->cadastrarLivro("Autor 1", "Título 1");
$biblioteca->cadastrarLivro("Autor 2", "Título 2");
$biblioteca->cadastrarLivro("Autor 3", "Título 3");

$biblioteca->exibirLivros();

?>
