<?php

class Biblioteca {
    private $livros = [];

    public function cadastrarLivro($autor, $titulo) {
        $livro = new Livro($autor, $titulo);
        $this->livros[] = $livro;
    }

    public function exibirLivros() {
        echo "<h2>Livros Cadastrados:</h2>";
        echo "<ul>";
        foreach ($this->livros as $livro) {
            echo "<li>Autor: " . $livro->getAutor() . ", Título: " . $livro->getTitulo() . "</li>";
        }
        echo "</ul>";
    }
}

?>