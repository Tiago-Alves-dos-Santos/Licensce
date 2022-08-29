<?php

namespace App\Models;

use Exception;
use App\Classes\Configuracao;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    protected $paginationTheme = 'bootstrap';


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
                    $tempo = strtotime("+1 year");
                    Cookie::queue(Cookie::make('login', $login, $tempo));
                    Cookie::queue(Cookie::make('senha', $senha, $tempo));
                    Cookie::queue(Cookie::make('lembrar_me', $lembrar_me, $tempo));
                }else if(Cookie::has('login')){//apagar cookie, caso exista
                    Cookie::queue(Cookie::forget('login'));
                    Cookie::queue(Cookie::forget('senha'));
                    Cookie::queue(Cookie::forget('lembrar_me'));
                }
                //seta user na classe auth
                Auth::login($user);
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

    /*** Não static */

    public function uploadLogo($file)
    {
        $image = Image::make($file->getRealPath());
        $image->resize(90,90);
        $image->save(Configuracao::setPathIntervetion('perfil')."{$this->id}.".$file->extension());
        $this->logo = "{$this->id}.".$file->extension();
        $this->save();
    }

    public function deleteLogo()
    {
        if(!empty($this->logo) && Storage::exists(Configuracao::getPath('perfil').'/'.$this->logo)){
            Storage::delete(Configuracao::getPath('perfil').'/'.$this->logo);
            $this->logo = null;
            $this->save();
        }
    }
}
