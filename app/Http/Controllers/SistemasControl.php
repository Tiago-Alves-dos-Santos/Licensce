<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SistemasControl extends Controller
{
    public function index(Request $request)
    {
        $page_data = [
            'menu' => 'sistemas',
            'sub_menu' => 'xxxx',
            'titulo' => 'Sitemas',
            'breadcumb' => ['Sistemas','Tabela']
        ];
        return view('sistemas.index', [
            'page_data' => (object) $page_data
        ]);
    }

    public function viewCadastro(Request $request)
    {
        $page_data = [
            'menu' => 'sistemas',
            'sub_menu' => 'sistemas_cadastro',
            'titulo' => 'Sitemas',
            'breadcumb' => ['Sistemas','Novo']
        ];
        return view('sistemas.cadastro', [
            'page_data' => (object) $page_data
        ]);
    }
}
