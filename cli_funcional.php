<?php

$pdo = new PDO('mysql:host=localhost;dbname=dev_cli', 'danielhe4rt', '');

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

function listUsers(array $users): void
{
    foreach ($users as $user) {
        echo $user['id'] . ' - ' . $user['name'] . PHP_EOL;
    }
}

function listBooks($books): void
{
    foreach ($books as $book) {
        echo $book['id'] . ' - ' . $book['title'] . PHP_EOL;
    }
}

/**
 * @param array $userBooks // ver depois
 * @return array<string>
 */
function getBooksIds(array $userBooks): array
{
    $userBookIds = [];
    foreach ($userBooks as $userBook) {
        $userBookIds[] = $userBook['book_id'];
    }
    return $userBookIds;
}

function getQueryBasedOnUserCurrentBooks(PDOStatement $query, array $userBookIds)
{
    if ($query->rowCount() == 0) {
        return "SELECT * FROM books";
    }
    $notIn = implode(',', $userBookIds);
    return "SELECT * FROM books WHERE id NOT IN ($notIn)";
}

while (true) {
    say('Digite o comando da ação que deseja realizar.');
    $input = input();

    //--------------------------------------------------------------------------------------------------------------------------------------
    // USUÁRIOS
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
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        listUsers($users);

        say('Digite o ID do usuário que pretende deletar.');
        $id = input();

        $query = $pdo->query("DELETE FROM users WHERE id = $id");

        say('Usuário deletado com sucesso!');
    }

    if ($input == 'listar usuários') {
        $query = $pdo->query('SELECT name FROM users');
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        listUsers($users);
    }

    if ($input == 'editar usuário') {
        say('Insira o nome do usuário que pretende alterar informações.');
        $name = input();

        $query = $pdo->query("SELECT id, name FROM users WHERE name LIKE '%$name%'");
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        listUsers($users);

        say('Insira o ID do usuário que pretende alterar informações.');
        $id = input();

        $query = $pdo->query("SELECT * FROM users WHERE id = $id"); // Poderia deixar só 'SELECT FROM...'
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
    // LIVROS

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
        echo 'Nome do Livro: ' . $title . PHP_EOL;
        echo 'Autor: ' . $author . PHP_EOL;
        echo 'Gênero: ' . $genre . PHP_EOL;
        echo 'Editora: ' . $publisher . PHP_EOL;
        echo 'Páginas: ' . $pages . PHP_EOL;
        echo '---------------------------' . PHP_EOL;

        $query = $pdo->query("INSERT INTO books (title, author, genre, publisher, pages) VALUES ('$title', '$author', '$genre', '$publisher', '$pages')");

        say('Livro cadastrado com sucesso!' . PHP_EOL . 'Veja também os livros disponíveis.');
    }

    if ($input == 'deletar livro') {
        say('Insira o título do livro que pretende deletar');
        $title = input();

        $query = $pdo->query("SELECT id, title FROM books WHERE title LIKE '%$title%'");
        $books = $query->fetchAll(PDO::FETCH_ASSOC);

        listBooks($books);

        say('Digite o ID do livro que deseja deletar.');
        $id = input();

        $query = $pdo->query("DELETE FROM books WHERE id = $id");

        say('Livro deletado com sucesso!');
    }

    if ($input == 'listar livros') {
        $query = $pdo->query('SELECT title FROM books');
        $titles = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($titles as $book) {
            echo $book['title'] . PHP_EOL;
        }
    }

    if ($input == 'editar livro') {
        say('Insira o título do livro que pretende alterar as informações.');
        $title = input();

        $query = $pdo->query("SELECT id, title FROM books WHERE title LIKE '%$title%'");
        $books = $query->fetchAll(PDO::FETCH_ASSOC);

        listBooks($books);

        say('Insira o ID do livro que pretende alterar as informações');
        $id = input();

        $query = $pdo->query("SELECT * FROM books WHERE id = $id");
        $selectedBook = $query->fetch(PDO::FETCH_ASSOC);

        say('Você deseja alterar o título deste livro?' . PHP_EOL . 'Caso sim, digite o título. Caso não, deixe vazio.');
        $newTitle = trim(fgets(STDIN));

        if (empty($newTitle)) {
            $newTitle = $selectedBook['title'];
        }

        say('Você deseja alterar o nome do autor deste livro?' . PHP_EOL . 'Caso sim, digite o nome do autor. Caso não, deixe vazio.');
        $newAuthor = trim(fgets(STDIN));

        if (empty($newAuthor)) {
            $newAuthor = $selectedBook['author'];
        }

        say('Você deseja alterar o gênero deste livro?' . PHP_EOL . 'Caso sim, digite o gênero. Caso não, deixe vazio.');
        $newGenre = trim(fgets(STDIN));

        if (empty($newGenre)) {
            $newGenre = $selectedBook['genre'];
        }

        say('Você deseja alterar a editora deste livro?' . PHP_EOL . 'Caso sim, digite a editora. Caso não, deixe vazio.');
        $newPublisher = trim(fgets(STDIN));

        if (empty($newPublisher)) {
            $newPublisher = $selectedBook['publisher'];
        }

        say('Você deseja alterar o número de páginas deste livro?' . PHP_EOL . 'Caso sim, digite o número de páginas. Caso não, deixe vazio.');
        $newPages = trim(fgets(STDIN));

        if (empty($newPages)) {
            $newPages = $selectedBook['pages'];
        }

        say('Edição realizada com sucesso!');
    }

    //--------------------------------------------------------------------------------------------------------------------------------------
    // GERENCIAMENTO

    if ($input == 'gerenciar') {
        $query = $pdo->query('SELECT * FROM users');
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        listUsers($users);

        say('Qual usuário você deseja gerenciar? (digite apenas o ID).');
        $userId = input();

        say('Qual ação você deseja tomar? (devolver/emprestar/ver)');
        $userAction = input();

        if ($userAction == 'devolver') {
            $query = $pdo->query("SELECT * FROM user_books WHERE user_id = $userId AND devolution_at IS NULL");
            $userBooks = $query->fetchAll(PDO::FETCH_ASSOC);

            $userBookIds = getBooksIds($userBooks);

            if ($query->rowCount() == 0) {
                say('Não há livros emprestados por este usuário.');
                continue;
            }

            $query = $pdo->query('SELECT * FROM books WHERE id IN (' . implode(',', $userBookIds) . ')');
            $borrowedBooks = $query->fetchAll(PDO::FETCH_ASSOC);

            say('Esses são os livros que esse usuário emprestou e não devolveu: ');

            foreach ($borrowedBooks as $book) {
                echo 'ID: ' . $book['id'] . ' -> Título: ' . $book['title'] . PHP_EOL;
            }

            say('Qual livro você deseja devolver?');
            $bookDevolution = input();

            $query = $pdo->query("UPDATE user_books SET devolution_at = CURRENT_TIMESTAMP() WHERE user_id = $userId AND book_id = '$bookDevolution'");

            say('Livro devolvido com sucesso!');
        }

        if ($userAction == 'emprestar') {
            $query = $pdo->query("SELECT * FROM user_books WHERE user_id = $userId AND devolution_at IS NULL");
            $userBooks = $query->fetchAll(PDO::FETCH_ASSOC);

            $userBookIds = getBooksIds($userBooks);
            $queryFoda = getQueryBasedOnUserCurrentBooks($query, $userBookIds);

            $query = $pdo->query($queryFoda);
            $availableBooks = $query->fetchAll(PDO::FETCH_ASSOC);

            listBooks($availableBooks);

            say('Qual livro você deseja emprestar? (Digite o ID)');
            $bookId = input();

            $query = $pdo->query("INSERT INTO user_books VALUES (null, $userId, $bookId, 1, null)");

            say('Livro emprestado com sucesso!');
        }

        if ($userAction == 'ver') {
            $query = $pdo->query("SELECT b.id, b.title, ub.devolution_at FROM user_books ub JOIN books b ON b.id = ub.book_id WHERE user_id = $userId");
            $books = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($query->rowCount() == 0) {
                say('Este usuário ainda não emprestou nenhum livro!');
                continue;
            }
            foreach ($books as $book) {
                echo ('ID: ' . $book['id'] . ' -> Title: ' . $book['title'] . ' -> Devolução: ' . ($book['devolution_at'] ?? "Não devolveu!")) . PHP_EOL;
            }
        }
    }
}
