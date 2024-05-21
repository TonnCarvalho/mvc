<?php

namespace App\Admin\Models\helper;

/**
 * Importa o PDO e PDOException
 */

use PDO;
use PDOException;

/**
 * Classe para conexão com o Banco de Dados
 * Classe abstrata não pode ser instanciada, apenas herdada.
 */
abstract class Conn
{
    /**
     * Os dados do banco de dados estão em core/Config
     */
    private string $host = HOST;
    private string $user = USER;
    private string $pass = PASS;
    private string $dbname = DBNAME;
    private object $connect;

    /**
     * try conect
     * catch se der erro
     * @return object
     */
    protected function connectDb(): object
    {
        try {
            $this->connect = new PDO("mysql:host={$this->host};
            dbname=" . $this->dbname, $this->user, $this->pass);

            return $this->connect;
        } catch (PDOException $err) {
            die('ERROR 001 PAGINA NÃO ENCONTRADA. CONTATO: ' . EMAIL);
        }
    }
}
