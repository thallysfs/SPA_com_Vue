<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conteudo;use Illuminate\Support\Facades\Validator;

class ConteudoController extends Controller
{


    public function lista(Request $request){

        $conteudos = Conteudo::with('user')->orderBy('data', 'DESC')->paginate(5);

        //a variável 'conteudos' será recebida no vue pelo response
        return ['status'=>true, "conteudos"=>$conteudos];

    }

    public function adicionar(Request $request){

        $data = $request->all();
        //pegar o usuário que está logado
        $user = $request->user();
        //return ['status'=>true, "conteudos"=>date('y-m-d H:i:s')];

        //validação
        $validacao = Validator::make($data, [
            'titulo' => 'required',
            'texto' => 'required'
            ]);

        if($validacao->fails()){
            return ['status'=>false, "validacao"=>true, "erros"=>$validacao->errors()];
        }


        $conteudo = new Conteudo;

        $conteudo->titulo = $data['titulo'];
        $conteudo->texto = $data['texto'];
        //If '?' vier imagem, coloca o valor que veio na imagem. Se não ':' coloca '#'
        $conteudo->link = $data['link'] ? $data['link'] : "#" ;
        $conteudo->imagem = $data['imagem'] ? $data['imagem'] : "#";
        $conteudo->data = date('y-m-d H:i:s');

        //utilizei aqui o método do relacionamento entre essas duas tabelas
        $user->conteudos()->save($conteudo);

        $conteudos = Conteudo::with('user')->orderBy('data', 'DESC')->paginate(5);

        //a variável 'conteudos' será recebida no vue pelo response. abaixo listo todos os conteúdos inclusive o que acabou de ser cadastrado.
        return ['status'=>true, "conteudos"=>$conteudos];

    }




}
