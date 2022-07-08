<?php

define('CONSOLE_USER', 'Nanda');
define('CONSOLE_ADMIN', 'Vozes da minha cabeça');

$pdo = new PDO('mysql:host=localhost;dbname=dev_cli', 'danielhe4rt', '');

while (true) {

    echo CONSOLE_USER . ": ";
    $input = trim(fgets(STDIN));

    if ($input == 'criar usuário') {
        echo CONSOLE_ADMIN . ': Insira seu nome' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $userName = trim(fgets(STDIN));

        echo CONSOLE_ADMIN . ': Insira sua data de nascimento' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $userBirthdate = trim(fgets(STDIN));

        echo CONSOLE_ADMIN . ': Insira seu gênero' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $userGender = trim(fgets(STDIN));

        echo '---------------------------' . PHP_EOL;
        echo 'Nome: ' . $userName . PHP_EOL;
        echo 'Data de nascimento: ' . $userBirthdate . PHP_EOL;
        echo 'Gênero: ' . $userGender . PHP_EOL;
        echo '---------------------------' . PHP_EOL;

        // TODO: criar a query de inserção de dados na tabela users
        $query = $pdo->query("INSERT INTO users (name, birthdate, gender) VALUES ('$userName', '$userBirthdate', '$userGender')");
        echo CONSOLE_ADMIN . ': Seu cadastro foi feito com sucesso!' . PHP_EOL;
    }

    if ($input == 'deletar usuário') {
        echo CONSOLE_ADMIN . ': Insira o nome do usuário que pretende deletar' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $userName = trim(fgets(STDIN));

        $query = $pdo->query("SELECT id, name FROM users WHERE name = '$userName'");

        $userName = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($userName as $users) {
            echo $users['id'] . ' - ' . $users['name'] . PHP_EOL;
        }

        echo CONSOLE_ADMIN . ': Digite o ID do usuário que pretende deletar' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $userID = trim(fgets(STDIN));

        //TODO: deletar através do ID
        $query = $pdo->query("DELETE FROM users WHERE id = $userID");

        //$userID = $query->execute();
        // ----------------------------

        echo 'Usuário deletado com sucesso!' . PHP_EOL;
    }

    if ($input == 'listar usuários') {
        $query = $pdo->query('SELECT name FROM users');

        $userName = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($userName as $users) {
            echo $users['name'] . PHP_EOL;
        }
    }

    if ($input == 'editar usuário') {
        echo CONSOLE_ADMIN . ': Insira o nome do usuário que pretende alterar informações' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $userName = trim(fgets(STDIN));

        $query = $pdo->query("SELECT id, name FROM users WHERE name LIKE '%$userName%'");

        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            echo $user['id'] . ' - ' . $user['name'] . PHP_EOL;
        }

        echo CONSOLE_ADMIN . ': Insira o ID do usuário que pretende alterar informações' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $userID = trim(fgets(STDIN));

        //TODO: fazer a query de update
        $query = $pdo->query("SELECT * FROM users WHERE id = $userID");

        $selectedUser = $query->fetch(PDO::FETCH_ASSOC);

        // var_dump($selectedUser);

        echo CONSOLE_ADMIN . ': Você deseja alterar o nome deste usuário?' . PHP_EOL;
        echo 'Caso sim, digite o nome. Caso não, deixe vazio.' . PHP_EOL;
        echo CONSOLE_USER . ": ";
        $newUserName = trim(fgets(STDIN));

        if (empty($newUserName)) {
            $newUserName = $selectedUser['name'];
        }

        echo CONSOLE_ADMIN . ': Você deseja alterar a data de nascimento deste usuário?' . PHP_EOL;
        echo 'Caso sim, digite a data. Caso não, deixe vazio.' . PHP_EOL;
        echo CONSOLE_USER . ": ";
        $newUserBirthdate = trim(fgets(STDIN));

        if (empty($newUserBirthdate)) {
            $newUserBirthdate = $selectedUser['birthdate'];
        }

        echo CONSOLE_ADMIN . ': Você deseja alterar o gênero deste usuário?' . PHP_EOL;
        echo 'Caso sim, digite o gênero. Caso não, deixe vazio.' . PHP_EOL;
        echo CONSOLE_USER . ": ";
        $newUserGender = trim(fgets(STDIN));

        if (empty($newUserGender)) {
            $newUserGender = $selectedUser['gender'];
        }
        // ----------------------------

        echo PHP_EOL . 'Edição realizada com sucesso!' . PHP_EOL;
    }

    //----------------------------------------------------------------------------------------------------------------------------

    if ($input == 'criar livro') {

        echo CONSOLE_ADMIN . ': Insira o título do livro' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $bookTitle = trim(fgets(STDIN));

        echo CONSOLE_ADMIN . ': Insira o nome do autor' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $bookAuthor = trim(fgets(STDIN));

        echo CONSOLE_ADMIN . ': Insira o gênero do livro' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $bookGenre = trim(fgets(STDIN));

        echo CONSOLE_ADMIN . ': Insira a editora do livro' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $bookPublisher = trim(fgets(STDIN));

        echo CONSOLE_ADMIN . ': Insira a quantidade de páginas do livro' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $bookPages = trim(fgets(STDIN));

        echo '---------------------------' . PHP_EOL;
        echo 'Nome do Livro: ' . $bookTitle . PHP_EOL;
        echo 'Autor: ' . $bookAuthor . PHP_EOL;
        echo 'Gênero: ' . $bookGenre . PHP_EOL;
        echo 'Editora: ' . $bookPublisher . PHP_EOL;
        echo 'Páginas: ' . $bookPages . PHP_EOL;

        //TODO: Query para printar a disponibilidade
        $query = $pdo->query('SELECT available FROM books ORDER BY id DESC LIMIT 1');

        $availability = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($availability as $books) {
            echo 'Disponibilidade: ' . $books['available'] . PHP_EOL;
        }
        echo '---------------------------' . PHP_EOL;
        //echo '---------------------------'

        echo CONSOLE_ADMIN . ': Seu livro foi cadastrado com sucesso!' . PHP_EOL;

        //TODO: criar inserção de dados na tabela livros
        $query = $pdo->query("INSERT INTO books (title, author, genre, publisher, pages) VALUES ('$bookTitle', '$bookAuthor', '$bookGenre', '$bookPublisher', '$bookPages')");
        // ----------------------------
    }

    if ($input == 'deletar livro') {
        echo CONSOLE_ADMIN . ': Insira o nome do livro que pretende deletar' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $bookTitle = trim(fgets(STDIN));

        $query = $pdo->query("SELECT id, title FROM books WHERE title = '$bookTitle'");

        $bookTitle = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($bookTitle as $books) {
            echo $books['id'] . ' - ' . $books['title'] . PHP_EOL;
        }

        echo CONSOLE_ADMIN . ': Digite o ID do livro que pretende deletar' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $bookID = trim(fgets(STDIN));

        //TODO: deletar através do ID
        $query = $pdo->query("DELETE FROM books WHERE id = $bookID");

        //$bookID = $query->execute();
        // ----------------------------

        echo 'Livro deletado com sucesso!' . PHP_EOL;
    }

    if ($input == 'listar livros') {
        $query = $pdo->query('SELECT title FROM books');

        $bookTitle = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($bookTitle as $books) {
            echo $books['title'] . PHP_EOL;
        }
    }

    if ($input == 'editar livro') {
        echo CONSOLE_ADMIN . ': Insira o título do livro que pretende alterar as informações' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $bookTitle = trim(fgets(STDIN));

        $query = $pdo->query("SELECT id, title FROM books WHERE title LIKE '%$bookTitle%'");

        $books = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            echo $book['id'] . ' - ' . $book['title'] . PHP_EOL;
        }

        echo CONSOLE_ADMIN . ': Insira o ID do livro que pretende alterar as informações' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $bookID = trim(fgets(STDIN));

        //TODO: Fazer a query de update
        $query = $pdo->query("SELECT * FROM books WHERE id = $bookID");

        $selectedBook = $query->fetch(PDO::FETCH_ASSOC);

        echo CONSOLE_ADMIN . ': Você deseja alterar o título deste livro?' . PHP_EOL;
        echo 'Caso sim, digite o título. Caso não, deixe vazio.' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $newBookTitle = trim(fgets(STDIN));

        if (empty($newUserName)) {
            $newUserName = $selectedBook['title'];
        }

        echo CONSOLE_ADMIN . ': Você deseja alterar o nome do autor deste livro?' . PHP_EOL;
        echo 'Caso sim, digite o nome do autor. Caso não, deixe vazio.' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $newAuthorName = trim(fgets(STDIN));

        if (empty($newAuthorName)) {
            $newAuthorName = $selectedBook['author'];
        }

        echo CONSOLE_ADMIN . ': Você deseja alterar o gênero deste livro?' . PHP_EOL;
        echo 'Caso sim, digite o gênero. Caso não, deixe vazio.' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $newBookGenre = trim(fgets(STDIN));

        if (empty($newBookGenre)) {
            $newBookGenre = $selectedBook['genre'];
        }

        echo CONSOLE_ADMIN . ': Você deseja alterar a editora deste livro?' . PHP_EOL;
        echo 'Caso sim, digite a editora. Caso não, deixe vazio.' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $newBookPublisher = trim(fgets(STDIN));

        if (empty($newBookPublisher)) {
            $newBookGenre = $selectedBook['publisher'];
        }

        echo CONSOLE_ADMIN . ': Você deseja alterar o número de páginas deste livro?' . PHP_EOL;
        echo 'Caso sim, digite o número de páginas. Caso não, deixe vazio.' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $newBookPages = trim(fgets(STDIN));

        if (empty($newBookPages)) {
            $newBookGenre = $selectedBook['pages'];
        }
        // ----------------------------

        echo PHP_EOL . 'Edição realizada com sucesso!' . PHP_EOL;
    }

    if ($input == 'gerenciar') {
        $query = $pdo->query('SELECT * FROM users');
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        //    var_dump($users);

        foreach ($users as $user) {
            echo 'ID: ' . $user['id'] . ' -> Nome: ' . $user['name'] . PHP_EOL;
        }
        echo CONSOLE_ADMIN . ': qual usuário você deseja gerenciar (digite apenas o id)' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $userId = trim(fgets(STDIN));

        echo CONSOLE_ADMIN . ': qual ação você deseja tomar? (ver/emprestar/devolver)' . PHP_EOL;
        echo CONSOLE_USER . ': ';
        $userAction = trim(fgets(STDIN));

        if ($userAction == 'emprestar') {
            $query = $pdo->query("SELECT * FROM user_books WHERE user_id = $userId AND devolution_at IS NULL");
            $userBooks = $query->fetchAll(PDO::FETCH_ASSOC);

            $userBorrowedBooksIds = [];
            foreach ($userBooks as $userBook) {
                $userBorrowedBooksIds[] = $userBook['book_id']; //livros que eu já tenho emprestado
            }

            if ($query->rowCount() == 0) {
                $q = 'SELECT * FROM books';
            } else {
                $q = 'SELECT * FROM books WHERE id NOT IN (' . implode(',', $userBorrowedBooksIds) . ')';
                // NOT IN livros emprestados pelo caralho do usuário - não traga a merda dos livros emprestados pelo usuários
            }

            $query = $pdo->query($q);

            if ($query->rowCount() == 0) {
                echo CONSOLE_ADMIN . ': Não há livros disponíveis para emprestar.' . PHP_EOL;
                continue;
            }

            $availableBooks = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($availableBooks as $book) {
                echo 'ID: ' . $book['id'] . ' -> Título: ' . $book['title'] . PHP_EOL; // livros disponíveis
            }

            echo CONSOLE_ADMIN . ': Qual livro você deseja emprestar?' . PHP_EOL;
            echo CONSOLE_USER . ': ';
            $bookId = trim(fgets(STDIN));

            $query = $pdo->query("INSERT INTO user_books VALUES (null, $userId, $bookId, 1, null)");
        }

        if ($userAction == 'ver') {

            $query = $pdo->query("SELECT b.id, b.title, ub.devolution_at FROM user_books ub JOIN books b ON b.id = ub.book_id WHERE user_id = $userId");
            $books = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($books as $book) {
                echo 'ID: ' . $book['id'] . ' -> Title: ' . $book['title'] . ' -> Devolução: ' . ($book['devolution_at'] ?? 'não devolveu') . PHP_EOL;
            }
        }

        if ($userAction == 'devolver') {

            $query = $pdo->query("SELECT * FROM user_books WHERE user_id = $userId AND devolution_at IS NULL");
            $userBooks = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($query->rowCount() == 0) {
                echo CONSOLE_ADMIN . ': Este usuário não possui livros para devolver.' . PHP_EOL;
                continue;
            }

            $userBorrowedBooksIds = [];
            foreach ($userBooks as $userBook) {
                $userBorrowedBooksIds[] = $userBook['book_id'];
            }

            $query = $pdo->query('SELECT * FROM books WHERE id IN (' . implode(',', $userBorrowedBooksIds) . ')');
            $borrowedBooks = $query->fetchAll(PDO::FETCH_ASSOC);

            echo 'Esses são os livros que esse usuário emprestou e não devolveu: ' . PHP_EOL;

            foreach ($borrowedBooks as $book) {
                echo 'ID: ' . $book['id'] . ' -> Título: ' . $book['title'] . PHP_EOL;
            }

            echo CONSOLE_ADMIN . ': Qual livro você deseja devolver?' . PHP_EOL;
            echo CONSOLE_USER . ': ';
            $bookDevolution = trim(fgets(STDIN));

            $query = $pdo->query("UPDATE user_books SET devolution_at = CURRENT_TIMESTAMP() WHERE user_id = $userId AND book_id = $bookDevolution");
        }
    }
}
