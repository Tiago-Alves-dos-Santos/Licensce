<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpresaControl extends Controller
{
    public function index(Request $request)
    {
        $page_data = [
            'menu' => 'empresa',
            'sub_menu' => 'empresa_tabela',
            'titulo' => 'Empresas',
            'breadcumb' => ['Empresas','Tabela']
        ];
        return view('empresa.index', [
            'page_data' => (object) $page_data
        ]);
    }
}
