<?php

namespace App\Models;

use App\Classes\Configuracao;
use Exception;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    /**
     * login
     * Faz logica de login, controla as sessões e já faz o redirecionamento certo
     * @param  mixed $login
     * @param  mixed $senha
     * @param  mixed $lembrar_me
     * @return object
     */
    public static function login($login, $senha, $lembrar_me = false)
    {
        $user = null;
        $retorno = [
            'user' => null,
            'sucesso' => false
        ];
        if(User::where('login', $login)->exists()){
            $user = User::where('login', $login)->first();
            if(Hash::check($senha, $user->password)){
                //verficar lembrar-me
                if($lembrar_me){

                }
                $retorno = [
                    'user' => $user,
                    'sucesso' => true
                ];
                session([
                    'login' => true,
                    'user' => $user
                ]);
                return (object) $retorno;
            }else{//erro na senha
                session([
                    'login' => false,
                    'user' => $user,
                    'alert' => [
                        'titulo' => 'Atenção',
                        'data' => 'Senha do usuário esta incorreta!',
                        'tipo' => Configuracao::tipoAlerta('warning')
                    ]
                ]);
                return (object) $retorno;
            }
        }else{//login inexistente
            session([
                'login' => false,
                'user' => $user,
                'alert' => [
                    'titulo' => 'Atenção!',
                    'data' => 'Login inexistente na base de dados!',
                    'tipo' => Configuracao::tipoAlerta('warning')
                ]
            ]);
            return (object) $retorno;
        }
    }
}
