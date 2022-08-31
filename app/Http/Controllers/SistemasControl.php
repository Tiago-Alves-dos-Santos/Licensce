<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SistemasControl extends Controller
{
    public function index(Request $request)
    {
        $page_data = [
            'menu' => 'sistemas',
            'sub_menu' => 'sistemas_tabela',
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
        $user = Auth::user();
        switch ($user->tipo) {
            case 'dev_admin':
                return view('sistemas.cadastro', [
                    'page_data' => (object) $page_data
                ]);
                break;
            
            default:
                # code...
                break;
        }
    }

    //cadastro apenas usuarios devs
    public function cadastro(Request $request)
    {
        $validacao = $request->validate([
            'licenca' => 'required|array|min:1',
        ]);
        //trbalahr dados money
        //pegar id do usuario logado
        $user_id = Auth::user()->id;
        //verficar o tipo
        $tipo_licenca = $request->licenca;
        // if(count($tipo_licenca) > 1){
            $ser = json_encode($tipo_licenca);
            dd(json_decode($ser));
        // }
        //cadastrar de acordo com o tipo
        //verficar se possui gastos
        //cadastrar gastos
        dd("aq");
    }

    //cadastro para usuarios não devs
    public function cadastroSegundaForma()
    {
    }
}
