<?php

namespace App\Admin\Models;

use App\Admin\Models\helper\Conn;

class Login extends Conn
{
    private array|null $data;

    public function login(array $data = null)
    {
        $this->data = $data;
        var_dump($this->data);
        // Intancia a classe quando é publica.
        //$connect = new \App\Admin\Models\helper\Conn();
        //var_dump($connect->connectDb());   

        //Intancia o metodo quando é abstract
        $conn = $this->connectDb();
        var_dump($conn);
    }
}
