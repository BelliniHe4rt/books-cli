<?php
$user = 'Nanda';
$admin = 'Vozes da minha cabeça';

$pdo = new PDO('mysql:host=localhost;dbname=dev_cli', 'nandaknwls', '');

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

        $users = $query->execute();
        // ----------------------------
        echo "$admin: Seu cadastro foi feito com sucesso!" . PHP_EOL;
    }

    if ($input == 'listar usuários') {
        $query = $pdo->query('select name from users');

        $userName = $query->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($userName as $users) {
            echo $users['name'] . PHP_EOL;
        }
    }

    if ($input == 'criar livro') {

        echo "$admin: Insira o nome do livro" . PHP_EOL;
        echo "$user: ";
        $bookName = trim(fgets(STDIN));

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
        echo 'Nome do Livro: ' . $bookName . PHP_EOL;
        echo 'Autor: '  . $bookAuthor . PHP_EOL;
        echo 'Gênero: '  . $bookGenre . PHP_EOL;
        echo 'Editora: '  . $bookPublisher . PHP_EOL;
        echo 'Páginas: '  . $bookPages . PHP_EOL;
        // echo 'Disponibilidade: ' . 
        echo '---------------------------' . PHP_EOL;
        echo "$admin: Seu livro foi cadastrado com sucesso!" . PHP_EOL;
    }
}
