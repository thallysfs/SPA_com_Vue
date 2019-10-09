<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    //use Notifiable;
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'imagem',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //usuário terá muitos comentários
    public function comentarios()
    {
        return $this->hasMany('App\Comentario');
    }

    //usuário terá muitos conteúdos
    public function conteudos()
    {
        return $this->hasMany('App\Conteudo');
    }

    //relação de muito para muitos (usuário pode ter muitos conteúdos e conteúdo pode ter muitas curtidas)
    public function curtidas(){
        return $this->belongsToMany('App\Conteudo', 'curtidas', 'user_id', 'conteudo_id');
    }


    public function amigos(){
        return $this->belongsToMany('App\User', 'amigos', 'user_id', 'amigo_id');
    }

    public function getImagemAttribute($value){
        //estou pegando o dado da tabela imagem e forçando a retornar a URL completa
        return asset($value);
    }




}
