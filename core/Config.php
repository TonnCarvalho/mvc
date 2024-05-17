<?php

namespace Core;

abstract class Config
{
    protected function configAdm()
    {
        /**
         * 'URL' é a url padrão.
         * URLADM é a url padrão da pasta admin.
         * CONTROLLER é a pagina inicial.
         * METODO é metodo inicial.
         * CONTROLLERERRO quando não conseguir encontrar a pagina
         * EMAIL é o email padrão
         * Essas variaveis são enviadas para ConfigController
         */
        define('URL', 'http://localhost:81/Curso%20Celke/MVC');
        define('URLADM', 'http://localhost:81/Curso%20Celke/MVC/admin');

        define('CONTROLLER', 'Login');
        define('METODO', 'index');
        define('CONTROLLERERRO', 'Erro');
        define('EMAIL', 'cleiton_601@hotmail.com');

        /**
         * Dados para acessar o banco de dados
         */
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('DBNAME', 'celke');
    }
}
