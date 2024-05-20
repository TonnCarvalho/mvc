<?php

namespace App\Admin\Controllers;

class Dashboard
{
    /**
     * @var array|string|null $data recebe os dados que devem ser enviados para VIEW
     */
    private array | string | null $data;

    /**
     * Instancia a classe que carregar a View e enviar os dados para View
     *
     * @return void
     */
    public function index() : void
    {
        $this->data = "Bem vindo <br>";

        $loadView = new \Core\ConfigView("admin/Views/dashboard/dashboard", $this->data);
        $loadView->loadView();
    }
}
