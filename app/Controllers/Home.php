<?php

namespace App\Controllers;

class Home extends BaseController
{
    
    
    public function index(): string
    {
        return view('index');
    }
    
    public function luis(): string
    {
        return view('luis');
    }
}
