<?php

namespace App\Admin\Controllers;

/**
 * Sair do sistema
 */
class Logout
{


    /**
     * Instancia a classe que carregar a View e enviar os dados para View
     *
     * @return void
     */
    public function index(): void
    {
        unset(
            $_SESSION['user_id'],
            $_SESSION['user_nome'],
            $_SESSION['user_email'],
            $_SESSION['user_imagem']
        );
        $_SESSION['msg'] = "<p>Logout realizado com sucesso </p>";
        $urlRedirection = URLADM . '/login/index';
        header("Location: $urlRedirection");
    }
}
