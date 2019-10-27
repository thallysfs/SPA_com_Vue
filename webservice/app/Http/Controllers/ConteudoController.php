<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conteudo;use Illuminate\Support\Facades\Validator;

class ConteudoController extends Controller
{


    public function lista(Request $request){

        $conteudos = Conteudo::with('user')->orderBy('data', 'DESC')->paginate(5);
        //aqui pego o usuário logado
        $user = $request->user();

        foreach($conteudos as $key => $conteudo){
            $conteudo->total_curtidas = $conteudo->curtidas()->count();
            $conteudo->comentarios = $conteudo->comentarios;
            $curtiu = $user->curtidas()->find($conteudo->id);
            //se o usuário tiver curtido o conteúdo, a variável curtiu terá dados
            if($curtiu){
               $conteudo->curtiu_conteudo = true;
            }else{
                $conteudo->curtiu_conteudo = false;
            }
        }

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

    }//fim do adicionar

    public function curtir($id, Request $request){
        //aqui pego o id do conteúdo
        $conteudo = Conteudo::find($id);

        if($conteudo){
            //aqui pego o usuário logado
            $user = $request->user();
            //toggle - se não tiver o relacionamento ele adicionará, se já estiver, o toggle irá remover
            $user->curtidas()->toggle($conteudo->id);
            //return $conteudo->curtidas()->cout irá retonar o número de curtidas desse conteúdo
            //a variável "curtidas" => abaixo é que irá retornar no fronte pelo 'response.data.curtidas'
            return ['status'=>true,
                    "curtidas"=>$conteudo->curtidas()->count(),
                    // 'lista' está retornando todo o método acima 'lista()'
                    'lista' => $this->lista($request)];
        }else{
            return ['status'=>false, "erro"=>"Conteúdo não existe"];
        }

    }






}
