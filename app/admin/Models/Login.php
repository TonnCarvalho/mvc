<?php

namespace App\Admin\Models;

use App\Admin\Models\helper\Conn;
use PDO;

/**
 * CLASSE que pegar os dados do formulario, conecta com o BD, faz o SELECT no BD
 */
class Login extends Conn
{
    /**
     * Atributos
     * @var array|null $data, são os dados do formulario de login.
     * @var object $conn é o atributo que recebe a conexão do banco de dados.
     * $resultBd é o atributo que recebe o resultado do banco de dados que esta em $result_val_login.
     * $$result é o atributo que recebe o resultado de $resultBd é true ou false.
     */
    private array|null $data;
    private object $conn;
    private $resultBd;
    private $result;

    /**
     * Metodo que recebe o resultado final.
     * @return void
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Recebe os dados do 
     * @param array|null $data
     * @return void
     */
    public function login(array $data = null)
    {
        $this->data = $data;

        /**
         * $conn recebe o metodo connectDb da CLASSE Conn()
         */
        $this->conn = $this->connectDb();

        /**
         * Query que valida o login com o banco de dados.
         * Query faz a busca na tabela users do banco de dados.
         * Onde nome recebe uma bind, nome da bind :user porque no formulario o name é user.
         * Limitando a 1.
         */
        $query_val_login = "SELECT IDUSER, nome, email, senha, imagem
            FROM users
            WHERE nome = :user 
            LIMIT 1";

        /**
         * $result_val_login recebe a conexão e prepara a variavel $query_val_login.
         * $result_val_login bindParam vai informar :user, se refere a $this->data['user'], e PDO é uma string.
         * $result_val_login executa no banco de dados
         */
        $result_val_login = $this->conn->prepare($query_val_login);
        $result_val_login->bindParam(':user', $this->data['user'], PDO::PARAM_STR);
        $result_val_login->execute();

        /**
         * $resultBd recebe os dados dentro de $result_val_login que faz um fetch nos dados .
         */
        $this->resultBd = $result_val_login->fetch();

        /**
         * SE resultBd for verdadeiro, valida a senha
         * SE NÃO retorna false.
         */
        if ($this->resultBd) {
            $this->valSenha();
        } else {
            $_SESSION['msg'] = "<p style='color: red'>Erro: usuario não encontrado!</p>";
            $this->result = false;
        }
    }

    /**
     * CLASSE que verifica se a senha do formulario é igual ao do banco de dados.
     * Metodo private não pode ser instanciado fora da classe.
     * @return void
     */
    private function valSenha()
    {
        /**
         * SE, verifica se a senha em $data['senha'], é igual a $resultBd['senha'] no banco de dados.
         * Salva na SESSION os valores do resultBd
         * e atribui o resultado a $result = true.
         * SE NÂO, atribui $result = false.
         */
        if (password_verify($this->data['senha'], $this->resultBd['senha'])) {
            $_SESSION['user_id'] = $this->resultBd['IDUSER'];
            $_SESSION['user_nome'] = $this->resultBd['nome'];
            $_SESSION['user_email'] = $this->resultBd['email'];
            $_SESSION['user_imagem'] = $this->resultBd['imagem'];
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: red'>Erro: senha não encontrado!</p>";
            $this->result = false;
        }
    }
}
