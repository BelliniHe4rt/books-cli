<?php

// O source file DEVE ter o mesmo nome da classe, principalmente se ela for declarada pública

const CONSOLE_ADMIN = 'Vozes da minha cabeça';
const CONSOLE_USER = 'Nanda';

class Cli // Source file - A classe já é padronizada como pública, não precisa declarar
{
    public function run(): void
    {
        while (true) { // Métodos, funções ou procedimentos - Onde o código é declarado
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

    // Uma classe pode ter vários métodos, diferente do source file
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
