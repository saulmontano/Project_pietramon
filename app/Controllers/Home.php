<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if($this->session->issetGran){
            header("Location: registros");
        }
        else{
            echo view('login/login');
        }
    }
}
