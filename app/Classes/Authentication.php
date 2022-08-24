<?php
namespace App\Classes;

class Authentication
{
    public static function check()
    {
        if(!session()->has('login')){
            return false;
        }else if(session()->has('login') && !session('login')){
            return false;
        }else if(session()->has('login') && session('login')){
            return true;
        }
    }

    public static function user()
    {
        return session('user');
    }

    public function checkPermissao($permissao)
    {
        
    }
}

//middleware login com a classe acima
/*
public function handle(Request $request, Closure $next)
{
    if (!Authentication::check()) {
        //cria uma msg vazia ou null, nenhuma msg de aviso é criada
            session(['msg' => [
                'type' => 'warning',
                'msg' => 'Realize o login para ter acesso ao sistema!'
            ]]);
        //
        return redirect()->route('login');
    }
    return $next($request);
}
*/
