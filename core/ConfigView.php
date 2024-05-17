<?php

namespace  Core;

/**
 * Carregar as páginas da View
 */
class ConfigView
{

    /**
     * Undocumented variable
     *
     * @var string
     */
    private string $nameView;
    private array | string | null $data;

    /**
     * Undocumented function
     *
     * @param [type] $nameView
     * @param [type] $data
     */
    public function __construct($nameView, $data)
    {
        $this->nameView = $nameView;
        $this->data = $data;
    }

    /**
     * Carrega a VIEW.
     *Verifica se o arquivo existe, e carrega caso exista, não existindo apresenta a mensagem de erro
     * @return void
     */
    public function loadView(): void
    {
        if (file_exists('app/' . $this->nameView . '.php')) {
            include 'app/' . $this->nameView . '.php';
        } else {
            die('ERROR PAGINA NÃO ENCONTRADA. CONTATO: ' . EMAIL);
        }
        //print_r($this->nameView);
    }
}
