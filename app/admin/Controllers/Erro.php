<?php

namespace App\Admin\Controllers;

class Erro
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
        echo 'Pagina de ERRO <br>';

        $this->data = "<p style='color: #f00;'>Pagina não encontrada</p>";

        $loadView = new \Core\ConfigView("admin/Views/erro/erro", $this->data);
        $loadView->loadView();
    }
}
