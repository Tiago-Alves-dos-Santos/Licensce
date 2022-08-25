<?php

namespace App\Http\Controllers;

use App\Models\SessionDb;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function login(Request $request)
    {
        $validacao = $request->validate([
            'login' => 'required',
            'senha' => 'required',
        ]);

        $login = User::login($request->login, $request->senha, (bool)$request->lembrar_me);
        if($login->sucesso){
            switch ($login->user->tipo) {
                case 'dev_admin':
                    return redirect()->route('view.devAdmin.home');
                    break;
                // case 'dev_empregado':
                //     return redirect()->route('view.devAdmin.home');
                //     break;
                
                default:
                    throw new \Exception('Tipo de usuário não indentificado: '. $login->user->tipo);
                    break;
            }
        }else{
            return redirect()->back();
        }

    }
    public function registrar(Request $request)
    {
        //verficar tipo de usuario que ta fazendo registro
    }
    public function logout(Request $request)
    {
        SessionDb::where('user_id', Auth::user()->id)->forceDelete();
        session()->flush();
        return redirect()->route('login');
    }
}
