<?php

namespace Core;

/**
 * Verifica se existe a classe e o metodo.
 * Pagina publica e privadas.
 * Verifica se existe o login.
 */

class CarregarPgAdm
{
    /**
     * 
     * @var string $classLoad Controller que deve ser carregada
     * @var string $urlSlugController remove as letras maiuscula do controller
     * @var string $urlSlugMetodo remove as letras maiuscula do metodo
     * @var string
     */
    private string $urlController;
    private string $urlMetodo;
    private string $urlParametro;
    private string $classLoad;
    private string $urlSlugController;
    private string $urlSlugMetodo;
    private array $listPgPublic;
    private array $listPgPrivate;

    /**
     * Undocumented function
     *
     * @param string|null $urlController
     * @param string|null $urlMetodo
     * @param string|null $urlParametro
     * @return void
     */
    public function loadingPage(string|null $urlController, string|null $urlMetodo, string|null $urlParametro): void
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParametro = $urlParametro;

        /**
         * Verifica se a pagina é publica.
         * Verifica se a pagina é privada.
         * Verifica se existe login.
         */
        $this->pgPublic();

        /**
         * Verificar ase a classe existe
         * SE
         * SE NÃO enviar para o CONTROLLER 'login';
         */
        if (class_exists($this->classLoad)) {
            $this->loadingMetodo();
        } else {
            die("Erro: Por favor tente novamente.");
            // $this->urlController = $this->slugController(CONTROLLER);
            // $this->urlMetodo = $this->slugMetodo(METODO);
            // $this->urlParametro = "";
            // $this->loadingPage($this->urlController, $this->urlMetodo, $this->urlParametro);
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function loadingMetodo(): void
    {
        $classLoad = new $this->classLoad();
        if (method_exists($classLoad, $this->urlMetodo)) {
            $classLoad->{$this->urlMetodo}();
        } else {
            die("Erro: Por favor tente novamente.");
        }
    }

    /**
     * Verifica se a pagina é publica
     */
    private function pgPublic(): void
    {
        /**
         * Array da pagina publica
         */
        $this->listPgPublic = ["Login", "Erro", "Logout"];

        /**
         * Verifica se a pagina é publica
         * Se existir um array em ListPgPublic no Controller, a pagina é publica
         * SE NÃO, é privada
         */
        if (in_array($this->urlController, $this->listPgPublic)) {
            $this->classLoad = "\\App\\Admin\\Controllers\\" . $this->urlController;
        } else {
            $this->pgPrivate();
        }
    }
    /**
     * Verifica se a pagina é privada
     */
    private function pgPrivate(): void
    {
        $this->listPgPrivate = ["Dashboard", "Users"];

        if (in_array($this->urlController, $this->listPgPrivate)) {
            $this->verificarLogin();
        } else {
            $_SESSION['msg'] = "<p> Erro: pagina não encontrada! </p>";
            $urlRedirect = URLADM . '/login/index';
            header("Location: $urlRedirect");
        }
    }
    /**
     * Verifica se esta logado.
     *
     * @return void
     */
    private function verificarLogin(): void
    {
        if (isset($_SESSION['user_id'])) {
            $this->classLoad = "\\App\\Admin\\Controllers\\" . $this->urlController;
        } else {
            $_SESSION['msg'] = "<p> Erro: faça o login para acessar a página </p>";
            $urlRedirect = URLADM . '/login/index';
            header("Location: $urlRedirect");
        }
    }
    /**
     * Converte o valor obtido da URL "view-users" e converte no formado da classe "ViewUsers".
     * Converte tudo para minusculo
     * Converte o traço "-" para espaço " ".
     * Converte a primeira letra para maiusculo.
     * Remove o espaço em branco " " para nada "".
     * @param string $slugController nome da classe.
     * @return string retorna a controller "view-users" convertido para o nome da classe "ViewUsers".
     */
    private function slugController($slugController): string
    {
        //Converte para tudo menusculo.
        $this->urlSlugController = $slugController;
        $this->urlSlugController = strtolower($this->urlSlugController);

        //Converte o traço para branco.
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);

        //Converte a primeira letra de cada palavra para maiusculo.
        $this->urlSlugController = ucwords($this->urlSlugController);

        //Remover o espaço em branco para nada.
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);
        return $this->urlSlugController;
    }

    /**
     * Atribui as a função de slugController() para slugMetodo().
     * Chama a função slugController() e atribui a $urlSlugMetodo.
     * Converte a primeira letra para minuscula.
     * @param string $slugMetodo
     * @return string
     */
    private function slugMetodo($urlSlugMetodo): string
    {
        $this->urlSlugMetodo = $this->slugController($urlSlugMetodo);
        //Converte a primeira letra para minuscula
        $this->urlSlugMetodo = lcfirst($this->urlSlugMetodo);
        return $this->urlSlugMetodo;
    }
}
