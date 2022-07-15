<?php

class UserService
{
    public function listUsersByName(PDO $pdo, string $name): void
    {
        $query = $pdo->query("SELECT id, name FROM users WHERE name LIKE '%$name%'");
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            echo $user['id'] . ' - ' . $user['name'] . PHP_EOL;
        }
    }

    public function create(PDO $pdo, string $name, string $birthdate, string $gender): void
    {
        echo '---------------------------' . PHP_EOL;
        echo 'Nome: ' . $name . PHP_EOL;
        echo 'Data de nascimento: ' . $birthdate . PHP_EOL;
        echo 'Gênero: ' . $gender . PHP_EOL;
        echo '---------------------------' . PHP_EOL;

        $pdo->query("INSERT INTO users (name, birthdate, gender) VALUES ('$name', '$birthdate', '$gender')");
    }

    public function delete(PDO $pdo, int $id): void
    {
        $pdo->query("DELETE FROM users WHERE id = $id");
    }

    public function list(PDO $pdo): void
    {
        $query = $pdo->query('SELECT id, name FROM users');
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            echo $user['id'] . ' - ' . $user['name'] . PHP_EOL;
        }
    }

}