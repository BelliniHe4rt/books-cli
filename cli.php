<?php
$user = 'Nanda';
$admin = 'Vozes da minha cabeça';

$pdo = new PDO('mysql:host=localhost;dbname=dev_cli', 'danielhe4rt', '');

// $query = $pdo->query('select * from users');

// $users = $query->fetchAll(PDO::FETCH_ASSOC);

// foreach ($users as $user) {
//     var_dump($user['name']);
// }

while (true) {
    
    echo "$user: ";
    $input = trim(fgets(STDIN));

    if($input == 'criar usuário') {
        echo "$admin: Insira seu nome" . PHP_EOL;
        echo "$user: ";
        $userName = trim(fgets(STDIN));

        echo "$admin: Insira sua data de nascimento" . PHP_EOL;
        echo "$user: ";
        $userBirthdate = trim(fgets(STDIN));

        echo "$admin: Insira seu gênero" . PHP_EOL;
        echo "$user: ";
        $userGender = trim(fgets(STDIN));

        echo '---------------------------' . PHP_EOL;
        echo 'Nome: ' . $userName . PHP_EOL;
        echo 'Data de nascimento: '  . $userBirthdate . PHP_EOL;
        echo 'Gênero: '  . $userGender . PHP_EOL;
        echo '---------------------------' . PHP_EOL;
        
        // TODO: criar a query de inserção de dados na tabela users
        $query = $pdo->query("insert into users (name, birthdate, gender) values ('$userName', '$userBirthdate', '$userGender')");

        //$users = $query->execute();
        // ----------------------------
        
        echo "$admin: Seu cadastro foi feito com sucesso!" . PHP_EOL;
    }

    if($input == 'deletar usuário') {
        echo "$admin: Insira o nome do usuário que pretende deletar" . PHP_EOL;
        echo "$user: ";
        $userName = trim(fgets(STDIN));

        $query = $pdo->query("select id, name from users where name = '$userName'");

        $userName = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($userName as $users) {
            echo $users['id'] . ' - ' . $users['name'] . PHP_EOL;
        }

        echo "$admin: Digite o ID do usuário que pretende deletar" . PHP_EOL;
        echo "$user: ";
        $userID = trim(fgets(STDIN));
        
        //TODO: deletar através do ID
        $query = $pdo->query("delete from users where id = $userID");

        $userID = $query->execute();
        // ----------------------------

        echo "Usuário deletado com sucesso!" . PHP_EOL;
    }

    if ($input == 'listar usuários') {
        $query = $pdo->query('select name from users');

        $userName = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($userName as $users) {
            echo $users['name'] . PHP_EOL;
        }
    }

    //----------------------------------------------------------------------------------------------------------------------------

    if ($input == 'criar livro') {

        echo "$admin: Insira o título do livro" . PHP_EOL;
        echo "$user: ";
        $bookTitle = trim(fgets(STDIN));

        echo "$admin: Insira o nome do autor" . PHP_EOL;
        echo "$user: ";
        $bookAuthor = trim(fgets(STDIN));

        echo "$admin: Insira o gênero do livro" . PHP_EOL;
        echo "$user: ";
        $bookGenre = trim(fgets(STDIN));

        echo "$admin: Insira a editora do livro" . PHP_EOL;
        echo "$user: ";
        $bookPublisher = trim(fgets(STDIN));

        echo "$admin: Insira a quantidade de páginas do livro" . PHP_EOL;
        echo "$user: ";
        $bookPages = trim(fgets(STDIN));

        echo '---------------------------' . PHP_EOL;
        echo 'Nome do Livro: ' . $bookTitle . PHP_EOL;
        echo 'Autor: '  . $bookAuthor . PHP_EOL;
        echo 'Gênero: '  . $bookGenre . PHP_EOL;
        echo 'Editora: '  . $bookPublisher . PHP_EOL;
        echo 'Páginas: '  . $bookPages . PHP_EOL;

        //TODO: Query para printar a disponibilidade
        $query = $pdo->query('select available from books order by id desc limit 1');

        $availability = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($availability as $books) {
            echo 'Disponibilidade: ' . $books['available'] . PHP_EOL;
        }
        echo '---------------------------' . PHP_EOL;
        //echo '---------------------------'

        echo "$admin: Seu livro foi cadastrado com sucesso!" . PHP_EOL;

        //TODO: criar inserção de dados na tabela livros
        $query = $pdo->query("insert into books (title, author, genre, publisher, pages) values ('$bookTitle', '$bookAuthor', '$bookGenre', '$bookPublisher', '$bookPages')");
        // ----------------------------
    }
    
    if($input == 'deletar livro') {
        echo "$admin: Insira o nome do livro que pretende deletar" . PHP_EOL;
        echo "$user: ";
        $bookTitle = trim(fgets(STDIN));

        $query = $pdo->query("select id, title from books where title = '$bookTitle'");

        $bookTitle = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach($bookTitle as $books) {
            echo $books['id'] . ' - ' . $books['title'] . PHP_EOL;
        }

        echo "$admin: Digite o ID do livro que pretende deletar" . PHP_EOL;
        echo "$user: ";
        $bookID = trim(fgets(STDIN));

        //TODO: deletar através do ID
        $query = $pdo->query("delete from books where id = $bookID");

        $bookID = $query->execute();
        // ----------------------------

        echo "Livro deletado com sucesso!" . PHP_EOL;
    }

    if ($input == 'listar livros') {
        $query = $pdo->query('select title from books');

        $bookTitle = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($bookTitle as $books) {
            echo $books['title'] . PHP_EOL;
        }
    }
}

