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

    public function cadastrar(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|min:5',
            'login' => 'required|min:5',
            'email' => 'required|email',
            'senha' => 'required|min:5|required_with:confirmar_senha|same:confirmar_senha',
            'confirmar_senha' => 'required|min:5',
            'tipo' => 'required'
        ]);

    }
}
