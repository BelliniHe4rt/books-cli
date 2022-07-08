<?php

$pdo = new PDO('mysql:host=localhost;dbname=dev_cli', 'nandaknwls', '');

const CONSOLE_USER = 'Nanda';
const CONSOLE_ADMIN = 'Vozes da minha cabeça';

function input(): string
{
    echo CONSOLE_USER . ': ';
    return trim(fgets(STDIN));
}

function say(string $sentence): void
{
    echo CONSOLE_ADMIN . ': ' . $sentence . PHP_EOL;
}

while (true) {
    say('Digite o comando da ação que deseja realizar.');
    $input = input();

    if ($input == 'criar usuário') {
        say('Insira seu nome.');
        $name = input();

        say('Insira sua data de nascimento.');
        $birthdate = input();

        say('Insira seu gênero.');
        $gender = input();

        echo '---------------------------' . PHP_EOL;
        echo 'Nome: ' . $name . PHP_EOL;
        echo 'Data de nascimento: ' . $birthdate . PHP_EOL;
        echo 'Gênero: ' . $gender . PHP_EOL;
        echo '---------------------------' . PHP_EOL;

        $query = $pdo->query("INSERT INTO users (name, birthdate, gender) VALUES ('$name', '$birthdate', '$gender')");
        say("O usuário $name foi cadastrado com sucesso!");
    }

    if ($input == 'deletar usuário') {
        say('Insira o nome do usuário que pretende deletar.');
        $name = input();

        $query = $pdo->query("SELECT id, name FROM users WHERE name LIKE '%$name%'");
        $name = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($name as $users) {
            echo $users['id'] . ' - ' . $users['name'] . PHP_EOL;
        }

        say('Digite o ID do usuário que pretende deletar.');
        $id = input();

        $query = $pdo->query("DELETE FROM users WHERE id = $id");

        say('Usuário deletado com sucesso!');
    }

    if ($input == 'listar usuários') {
        $query = $pdo->query('SELECT name FROM users');
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            echo $user['name'] . PHP_EOL;
        }
    }

    if ($input == 'editar usuário') {
        say('Insira o nome do usuário que pretende alterar informações.');
        $name = input();

        $query = $pdo->query("SELECT id, name FROM users WHERE name LIKE '%$name%'");
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            echo $user['id'] . ' - ' . $user['name'] . PHP_EOL;
        }

        say('Insira o ID do usuário que pretende alterar informações.');
        $id = input();

        $query = $pdo->query("SELECT * FROM users WHERE id = $id");
        $selectedUser = $query->fetch(PDO::FETCH_ASSOC);

        say('Você deseja alterar o nome deste usuário?' . PHP_EOL . 'Caso sim, digite o nome. Caso não, deixe vazio.');
        $newName = input();

        if (empty($newName)) {
            $newName = $selectedUser['name'];
        }

        say('Você deseja alterar a data de nascimento deste usuário?' . 'Caso sim, digite a data. Caso não, deixe vazio.');
        $newBirthdate = input();

        if (empty($newBirthdate)) {
            $newBirthdate = $selectedUser['birthdate'];
        }

        say('Você deseja alterar o gênero deste usuário?' . PHP_EOL . 'Caso sim, digite o gênero. Caso não, deixe vazio.');
        $newGender = input();

        if (empty($newGender)) {
            $newGender = $selectedUser['gender'];
        }

        say('Edição realizada com sucesso!');
    }

    //--------------------------------------------------------------------------------------------------------------------------------------

    if ($input == 'criar livro') {
        say('Insira o título do livro.');
        $title = input();

        say('Insira o nome do autor.');
        $author = input();

        say('Insira o gênero do livro.');
        $genre = input();

        say('Insira a editora do livro.');
        $publisher = input();

        say('Insira a quantidade de páginas do livro.');
        $pages = input();

        echo '---------------------------' . PHP_EOL;
        echo 'Nome do Livro: ' . $bookTitle . PHP_EOL;
        echo 'Autor: ' . $bookAuthor . PHP_EOL;
        echo 'Gênero: ' . $bookGenre . PHP_EOL;
        echo 'Editora: ' . $bookPublisher . PHP_EOL;
        echo 'Páginas: ' . $bookPages . PHP_EOL;
        echo '---------------------------' . PHP_EOL;

        $query = $pdo->query("INSERT INTO books (title, author, genre, publisher, pages) VALUES ('$title', '$author', '$genre', '$publisher', '$pages')");

        say('Livro cadastrado com sucesso!' . PHP_EOL . 'Veja também os livros disponíveis.');

        $query = $pdo->query('SELECT available FROM books ORDER BY id DESC LIMIT 1');
        $availability = $query->fetchAll(PDO::FETCH_ASSOC);

        echo '---------------------------' . PHP_EOL;
        foreach ($availability as $books) {
            echo 'Disponibilidade: ' . $books['available'] . PHP_EOL;
        }
        echo '---------------------------' . PHP_EOL;
    }

    if ($input == 'deletar livro') {
        say('Insira o título do livro que pretende deletar');
        $title = input();

        $query = $pdo->query("SELECT id, title FROM books WHERE title LIKE '%$title%'");
        $books = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            echo $book['id'] . ' - ' . $book['title'] . PHP_EOL;
        }

        say('Digite o ID do livro que deseja deletar.');
        $id = input();

        $query = $pdo->query("DELETE FROM books WHERE id = $id");

        say('Livro deletado com sucesso!');
    }
}
