<?php

namespace App\Admin\Controllers;


/**
 * Undocumented class
 */
class ViewUsers
{
    /**
     * @var array|string|null $data recebe os dados que devem ser enviados para VIEW
     */
    private array|string|null $data;

    /**
     * Instancia a classe que carregar a View e enviar os dados para View
     * @return void
     */
    public function index() : void
    {
        echo 'CONTROLLER pagina de ViewUsers <br>';

        /**
         * 
         */
        $this->data = [];
        $loadView = new \Core\ConfigView("admin/Views/users/viewUser", $this->data);
        $loadView->loadView();
    }
}
