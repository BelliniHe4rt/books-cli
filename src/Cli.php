<?php

const CONSOLE_ADMIN = 'Vozes da minha cabeça';
const CONSOLE_USER = 'Nanda';

class Cli
{
    public function run(): void
    {
        while (true) {
            $this->say('Digite o comando da ação que deseja realizar.');
            $input = $this->input();

            if($input == 'criar usuário') {
                $this->say('Insira seu nome.');
                $name = $this->input();

                $this->say('Insira sua data de nascimento.');
                $birthdate = $this->input();

                $this->say('Insira seu gênero.');
                $gender = $this->input();


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
