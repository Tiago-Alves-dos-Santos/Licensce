<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Classes\Configuracao;
use Illuminate\Support\Facades\Auth;

class DevEmpregado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $acesso = ['dev_admin','dev_empregado'];
        if(Auth::check()){
            if(in_array(Auth::user()->tipo, $acesso)){
                return $next($request);
            }else{
                session([
                    'alert' => [
                        'titulo' => 'Atenção!',
                        'data' => htmlspecialchars("Acesso inacessivel! <br> Necessário ser um 'dev_empregado'!"),
                        'tipo' => Configuracao::tipoAlerta('warning')
                    ]
                ]);
            }
            return redirect()->back();     
        }else{
            session([
                'alert' => [
                    'titulo' => 'Atenção!',
                    'data' => "Usuário não está logado!",
                    'tipo' => Configuracao::tipoAlerta('warning')
                ]
            ]);
            return redirect()->route('login');  
        }
    }
}
