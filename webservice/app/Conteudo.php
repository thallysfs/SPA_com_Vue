<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    protected $fillable = [
        'titulo', 'texto', 'imagem', 'link', 'data'
    ];

    //conteúdo terá vários comentários
    public function comentarios()
    {
        return $this->hasMany('App\Comentario');
    }

    //cada contéudo pertence apenas um usuário
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //relação de muito para muitos (usuário pode ter muitos conteúdos e conteúdo pode ter muitas curtidas)
    public function curtidas(){
        return $this->belongsToMany('App\User', 'curtidas', 'conteudo_id', 'user_id');
    }

    public function getDataAttribute($value){
        //pegar valor da data, cpnverter da string para data e formatar no formato brasileiro
        return date('H:i d/m/Y',strtotime($value));
     }
}
