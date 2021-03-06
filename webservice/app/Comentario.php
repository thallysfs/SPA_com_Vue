<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'conteudo_id', 'texto', 'data',
    ];

    //relacionamentos de comentário e usuário
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //relacionamentos de conteúdo e comentário (comentário vai pertencer a um contaúdo)
    public function conteudo()
    {
        return $this->belongsTo('App\Conteudo');
    }

    public function getDataAttribute($value){
        //pegar valor da data, cpnverter da string para data e formatar no formato brasileiro
        return date('H:i d/m/Y',strtotime($value));
     }


}
