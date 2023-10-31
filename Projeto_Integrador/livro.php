<?php

class Livro {
    private $autor;
    private $titulo;

    public function __construct($autor, $titulo) {
        $this->autor = $autor;
        $this->titulo = $titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getTitulo() {
        return $this->titulo;
    }
}

?>