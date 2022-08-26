<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Configuracao;
use App\Models\User as UserDb;
use Illuminate\Support\Facades\Hash;

class User extends Controller
{
    public function index(Request $request)
    {
        $page_data = [
            'menu' => 'users',
            'titulo' => 'Usuários',
            'breadcumb' => ['Usuários','Tabela']
        ];
        $users = UserDb::get();
        return view('users.index',[
            'page_data' => (object) $page_data,
            'users' => $users
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
        $email = $request->email;
        $login = $request->login;
        //verficar login
        if(UserDb::where('login',$login)->exists()){
            session([
                'alert' => [
                    'titulo' => 'Atenção!',
                    'data' => "Login: $login, já existente na base de dados!",
                    'tipo' => Configuracao::tipoAlerta('warning')
                ]
            ]);
            return redirect()->back();
        }
        //verficar email
        if(UserDb::where('email',$email)->exists()){
            session([
                'alert' => [
                    'titulo' => 'Atenção!',
                    'data' => "Email: $email, já existente na base de dados!",
                    'tipo' => Configuracao::tipoAlerta('warning')
                ]
            ]);
            return redirect()->back();
        }
        $user = UserDb::create([
            'name' => mb_strtoupper($request->nome),
            'email' => $email,
            'login' => $login,
            'tipo' => $request->tipo,
            'ativo' => 'Y',
            'password' => Hash::make($request->senha)
        ]);
        //cadastrar foto

        return redirect()->back();
    }
}
