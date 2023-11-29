<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Biblioteca</title>
</head>

<body style="background-color: #ccc;">

    <div class="container m-5 mx-auto" style="border: solid 2px; background-color: #FFF;">
        <div class="container m-2" style="border: solid 1px">
            <h2>Cadastro de Livros</h2>

            <form id="livroForm">
                <label class="form-label" for="index">Index:</label>
                <input type="text" id="index" required><br>

                <label class="form-label" for="titulo">Título do Livro:</label>
                <input type="text" id="titulo" required><br>

                <label for="autor">Autor:</label>
                <input type="text" id="autor" required><br>

                <button type="button" class="btn btn-primary btn-sm mb-2 mt-2" onclick="cadastrarLivro()">Cadastrar
                    Livro</button>
            </form>
        </div>
        <div class="container m-2" style="border: solid 1px">
            <br>
            <h2>Lista de Livros</h2>
            <ul id="listaLivros"></ul>

            <?php
                include 'busca.php';
            ?>

        </div>

        <div class="container m-2" style="border: solid 1px">
            <br>
            <h2>Empréstimo de Livros</h2>
            <form id="emprestimoForm">
                <button type="button" class="btn btn-primary btn-sm mb-2" onclick="realizarEmprestimo()">Emprestar
                    Livros
                    Selecionados</button>
                <button type="button" class="btn btn-primary btn-sm mb-2" onclick="encerrarEmprestimo()">Devolver
                    Livros
                    Selecionados</button>
            </form>
        </div>
    </div>

    <script>
        class Livro {
            constructor(index, titulo, autor) {
                this.index = index;
                this.titulo = titulo;
                this.autor = autor;
                this.emprestado = false;
                this.dataEmprestimo = null;
                this.dataDevolucao = null;
            }
        }

        class Biblioteca {
            constructor() {
                this.livros = [];
            }

            cadastrarLivro(livro) {
                this.livros.push(livro);
            }

            emprestarLivro(index) {
                const livro = this.livros.find(l => l.index === index);

                if (livro && !livro.emprestado) {
                    livro.emprestado = true;
                    livro.dataEmprestimo = new Date();
                    livro.dataDevolucao = null;
                    return `Livro "${livro.titulo}" emprestado com sucesso.`;
                } else if (livro && livro.emprestado) {
                    return `O livro "${livro.titulo}" já está emprestado.`;
                } else {
                    return `Livro "${livro.titulo}" não encontrado.`;
                }
            }

            devolverLivro(index) {
                const livro = this.livros.find(l => l.index === index);

                if (livro && livro.emprestado) {
                    livro.emprestado = false;
                    livro.dataDevolucao = new Date();
                    return `Livro "${livro.titulo}" devolvido com sucesso.`;
                } else if (livro && !livro.emprestado) {
                    return `O livro "${livro.titulo}" não está emprestado.`;
                } else {
                    return `Livro "${livro.titulo}" não encontrado.`;
                }
            }

            listarLivros() {
                return this.livros.map(l => `
                    <h3>
                        <input type="checkbox" id="${l.index}" value="${l.index}">
                        <label for="${l.index}">  ${l.titulo}, ${l.autor}, Emprestado? : ${l.emprestado}</label>
                    </h3>
                `).join('');
            }
        }

        const minhaBiblioteca = new Biblioteca();

        // function cadastrarLivro() {
        //     const titulo = document.getElementById('titulo').value;
        //     const autor = document.getElementById('autor').value;

        //     const novoLivro = new Livro(titulo, autor);
        //     minhaBiblioteca.cadastrarLivro(novoLivro);

        //     atualizarListaLivros();
        // }

        function realizarEmprestimo() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

            checkboxes.forEach(checkbox => {
                const index = checkbox.value;
                const mensagem = minhaBiblioteca.emprestarLivro(index);
                alert(mensagem);
            });

            atualizarListaLivros();
        }

        function encerrarEmprestimo() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

            checkboxes.forEach(checkbox => {
                const index = checkbox.value;
                const mensagem = minhaBiblioteca.devolverLivro(index);
                alert(mensagem);
            });

            atualizarListaLivros();
        }

        function atualizarListaLivros() {
            const listaLivrosElement = document.getElementById('listaLivros');
            const livros = minhaBiblioteca.listarLivros();

            listaLivrosElement.innerHTML = livros;
        }

        function cadastrarLivro() {
            const index = document.getElementById('index').value;
            const titulo = document.getElementById('titulo').value;
            const autor = document.getElementById('autor').value;

            const novoLivro = new Livro(index, titulo, autor);
            minhaBiblioteca.cadastrarLivro(novoLivro);

            atualizarListaLivros();

            const params = new URLSearchParams();
            params.append('titulo', titulo);
            params.append('autor', autor);

            // Enviar dados para o servidor usando fetch
            fetch('envia.php', {
                method: 'POST',
                body: params,
            })
            
        }
    </script>

</body>

</html>