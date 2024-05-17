<?php

namespace Core;

/**
 * Recebe a url, manipula e carrega a Controller
 */
class ConfigController extends Config
{
    /**
     * @var string $url é minha url do browser.
     * @var arrray $urlArray é o que dentro da url sem a barra(/).
     * @var string $urlController é a url do meu controlador.
     * @var string $urlMetodo é a url dos meus metodos.
     * @var string $urlParametro é a url dos meu parametro.
     * @var string $classLoad carregar as classes dinamicamente.
     * @var array $format remove os caracteres especiais do controller
     * @var string $urlSlugController remove as letras maiuscula do controller
     * @var string $urlSlugMetodo remove as letras maiuscula do metodo
     */
    private string $url;
    private array $urlArray;
    private string $urlController;
    private string $urlMetodo;
    private string $urlParametro;
    private string $classLoad;
    private array $format;
    private string $urlSlugController;
    private string $urlSlugMetodo;

    public function __construct()
    {
        /**
         * Chama as variaveis do core\config.php
         */
        $this->configAdm();

        /**
         * verificar se a url não é vazia, se não for salva a url na variavel $url.
         */
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

            //print_r($this->url);

            /**
             * executa a clearUrl() antes de converter a url para um array
             */
            $this->clearUrl();

            /**
             * remove as barras de users/index.php 
             * a url users/index.php
             */
            $this->urlArray = explode("/", $this->url);
            //print_r($this->urlArray);

            /**
             * se indice zero do array $urlArray existe.
             * IF atribui o indice zero a $urlController.
             * slugController() remove as letras maiuscula do controller
             * ELSE se não existe, atribui a CONTROLLER do core\Config.
             */
            if (isset($this->urlArray[0])) {
                $this->urlController =  $this->slugController($this->urlArray[0]);
            } else {
                $this->urlController = $this->slugController(CONTROLLER);
            }

            /**
             * se indice um do array $urlArray existe.
             * IF atribui o indice um a $urlMetodo.
             * slugMetodo() remove as letras maiuscula do metodo
             * ELSE se não existe, atribui a METODO do core\Config.
             */
            if (isset($this->urlArray[1])) {
                $this->urlMetodo = $this->slugMetodo($this->urlArray[1]);
            } else {
                $this->urlMetodo = $this->slugMetodo(METODO);
            }

            /**
             * se indice dois do array $urlArray existe.
             * IF atribui o indice dois a $urlParametro.
             * ELSE se não existe, atribui a pagina Login.
             */
            if (isset($this->urlArray[2])) {
                $this->urlParametro = $this->urlArray[2];
            } else {
                $this->urlParametro = "";
            }
        } else {
            /**
             * se não existe nada na url, atribui os valores a baixo como padrão 
             * core\Config.
             * slugMetodo() remove as letras maiuscula do metodo

             */
            $this->urlController = $this->slugController(CONTROLLERERRO);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParametro = "";
        }
        //echo "Controller: {$this->urlController} <br>";
        //echo "Metodo: {$this->urlMetodo} <br>";
        //echo "Parametro: {$this->urlParametro} <br>";
    }

    /**
     * clearUrl() limpa a Url
     * Remove as tags da url.
     * Remove o espaço da url.
     * Remove a barra "/" do final da url.
     * Pega os caracteres especiais $format['a'].
     * Pega os caracteres especiais $format['b'].
     * Substitui os caracteres especiais de $format['a'] para $format['b'].
     * @return void.
     */
    private function clearUrl(): void
    {
        $this->url = strip_tags($this->url);
        $this->url = trim($this->url);
        $this->url = rtrim($this->url, "/");
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%¨*()_-+={}[]?;:;.\\\'<>ªº° ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr---------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']), $this->format['b']);
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

    /**
     * Carrega as Controllers
     * Instanciar as classes da controller e carrega o metodo
     * @return void
     */
    public function loadPage() : void
    {
        /**
         * Carregando controller sem precisar instanciar a classe.
         * Assim não preciso chamar o (use App\Admin\Controllers\Class)
         */
        $this->classLoad = "\\App\\Admin\\Controllers\\" . $this->urlController;
        $classPage = new $this->classLoad();
        $classPage->{$this->urlMetodo}();

    }
}
