<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conteudo;

class ConteudoController extends Controller
{

    public function adicionar(Request $request){

        $data = $request->all();
        //pegar o usuário que está logado
        $user = $request->user();
        //return ['status'=>true, "conteudos"=>date('y-m-d H:i:s')];

        //validação

        $conteudo = new Conteudo;

        $conteudo->titulo = $data['titulo'];
        $conteudo->texto = $data['texto'];
        //If '?' vier imagem, coloca o valor que veio na imagem. Se não ':' coloca '#'
        $conteudo->link = $data['link'] ? $data['link'] : "#" ;
        $conteudo->imagem = $data['imagem'] ? $data['imagem'] : "#";
        $conteudo->data = date('y-m-d H:i:s');

        //utilizei aqui o método do relacionamento entre essas duas tabelas
        $user->conteudos()->save($conteudo);

        return ['status'=>true, "conteudos"=>$user->conteudos];

    }





}
