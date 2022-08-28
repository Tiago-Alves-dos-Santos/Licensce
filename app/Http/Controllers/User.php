<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Configuracao;
use App\Models\User as UserDb;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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
        $logo = $request->file('logo');
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
        if(!empty($logo)){
            $user->uploadLogo($logo);
        }
        session([
            'alert' => [
                'titulo' => 'Sucesso!',
                'data' => "Usuário: {$user->name} cadastrado com sucesso!",
                'tipo' => Configuracao::tipoAlerta('info')
            ]
        ]);

        return redirect()->back();
    }

    public function editar(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|min:5',
            'login' => 'required|min:5',
            'email' => 'required|email',
            'senha' => 'confirmed|nullable|min:5|required_with:confirmar_senha|same:confirmar_senha',
            'confirmar_senha' => 'nullable|required_with:senha|min:5',
            'tipo' => 'required'
        ]);
        $logo = $request->file('logo');
        $email = $request->email;
        $login = $request->login;
        $user_alter_id = base64_decode($request->id);
        //verficar login
        if(UserDb::where('id','!=', $user_alter_id)->where('login',$login)->exists()){
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
        if(UserDb::where('id','!=', $user_alter_id)->where('email',$email)->exists()){
            session([
                'alert' => [
                    'titulo' => 'Atenção!',
                    'data' => "Email: $email, já existente na base de dados!",
                    'tipo' => Configuracao::tipoAlerta('warning')
                ]
            ]);
            return redirect()->back();
        }
        UserDb::where('id', $user_alter_id)->update([
            'name' => mb_strtoupper($request->nome),
            'email' => $email,
            'login' => $login,
            'tipo' => $request->tipo,
            'ativo' => 'Y',
            'password' => Hash::make($request->senha)
        ]);
        $user = UserDb::find($user_alter_id);
        //caso tenha foto e logo do form não veio nula
        if(!empty($user->logo) && !empty($logo)){
            //apagar antiga
            $user->deleteLogo();
            //colocar nova
            $user->uploadLogo($logo);
        }else if(empty($user->logo) && !empty($logo)){//cadastrar uma nova
            $user->uploadLogo($logo);
        }
        
        //cadastrar foto
        
        session([
            'alert' => [
                'titulo' => 'Sucesso!',
                'data' => "Usuário: {$user->name} atualizado com sucesso!",
                'tipo' => Configuracao::tipoAlerta('info')
            ]
        ]);

        return redirect()->back();
    }
}
