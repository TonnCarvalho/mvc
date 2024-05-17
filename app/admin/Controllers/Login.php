<?php

namespace App\Admin\Controllers;

class Login
{
    /**
     * @var array|string|null $data recebe os dados que devem ser enviados para VIEW
     * @var array $dataForm recebe os dados do formulario.
     * 
     */
    private array|string|null $data = [];
    private array|null  $dataForm;

    /**
     * Instancia a classe que carregar a View e enviar os dados para View
     * @return void
     */
    public function index(): void
    {
        /**
         * Dados do formulario, para acessar o login, $this->dataForm['nameInput']
         */
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        /**
         * IF existe o SenLogin, salva os dados do formulario $this->dataform, em $this->data['form'].
         * 
         */
        if (!empty($this->dataForm['SendLogin'])) {
            $validarLogin = new \App\Admin\Models\Login;
            $validarLogin->login($this->dataForm);
            
            $this->data['form'] = $this->dataForm;
        }

        $loadView = new \Core\ConfigView("admin/Views/login/login", $this->data);
        $loadView->loadView();
    }
}
