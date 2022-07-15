<?php

require ('User/UserService.php');

const CONSOLE_ADMIN = 'Vozes da minha cabeça';
const CONSOLE_USER = 'Nanda';

class Cli
{
    public function run(): void
    {
        $pdo = new PDO('mysql:host=localhost;dbname=dev_cli', 'danielhe4rt', '');
        $service = new UserService();

        while (true) {
            $this->say('Digite o comando da ação que deseja realizar.');
            $input = $this->input();

            if ($input == 'criar usuário') {
                $this->say('Insira seu nome.');
                $name = $this->input();

                $this->say('Insira sua data de nascimento.');
                $birthdate = $this->input();

                $this->say('Insira seu gênero.');
                $gender = $this->input();

                $service->create($pdo, $name, $birthdate, $gender);

                $this->say("O usuário $name foi cadastrado com sucesso!");
            }

            if ($input == 'deletar usuário') {
                $this->say('Insira o nome do usuário que pretende deletar.');
                $name = $this->input();
                $service->listUsersByName($pdo, $name);

                $this->say('Digite o ID do usuário que pretende deletar.');
                $id = $this->input();

                $service->delete($pdo, $id);

                $this->say('Usuário deletado com sucesso!');
            }

            if($input == 'listar usuários'){
                $service->list($pdo);
            }
        }
    }

    private function input(): string
    {
        echo CONSOLE_USER . ': ';
        return trim(fgets(STDIN));
    }

    private function say(string $sentence): void
    {
        echo CONSOLE_ADMIN . ': ' . $sentence . PHP_EOL;
    }
}
