<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    public function index(Request $request)
    {
        $page_data = [
            'menu' => 'users',
            'titulo' => 'Usuários',
            'breadcumb' => ['Usuários','Tabela']
        ];
        return view('users.index',[
            'page_data' => (object) $page_data
        ]);
    }
}
