<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{


    public function login(Request $request){

        $data = $request->all();


        $validacao = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if($validacao->fails()){
            //padrão de retorno
            return ['status'=>false, "validacao"=>true, "erros"=>$validacao->errors()];
            //return $validacao->errors();
        }

        if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
            //auth() é um helper que retorna a instância do autenticador
            $user = auth()->user();
            $user->token = $user->createToken($user->email)->accessToken;
            //$user->imagem = asset($user->imagem);
            return ['status'=>true, "usuario"=>$user];
            return $user;
        }else{
            return ['status'=>false];
        }

    }//fim do /login


    public function cadastro(Request $request){
        $data = $request->all();

        $validacao = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validacao->fails()){
            return ['status'=>false, "validacao"=>true, "erros"=>$validacao->errors()];
        }

        $imagem ="/perfils/padrao.png";


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'imagem' =>$imagem
        ]);
        //aqui estou criando o token para o usuário utilizando o e-mail como base
        $user->token = $user->createToken($user->email)->accessToken;
        //$user->imagem = asset($user->imagem);

        return ['status'=>true, "usuario"=>$user];
    }//fim do /cadastro



    //rota para atualizar perfil
    public function perfil(Request $request){
        $user = $request->user();
        $data = $request->all();

        if(isset($data['password'])){
            $validacao = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'password' => 'required|string|min:6|confirmed',
            ]);
            if($validacao->fails()){
                return ['status'=>false, "validacao"=>true, "erros"=>$validacao->errors()];
            }
            $user->password =  Hash::make($data['password']);

        }else{
            $validacao = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],

            ]);

            if($validacao->fails()){
                return ['status'=>false, "validacao"=>true, "erros"=>$validacao->errors()];
            }
            $user->name = $data['name'];
            $user->email = $data['email'];
        }


        if(isset($data['imagem'])){

            //regras para validar imagem
            Validator::extend('base64image', function ($attribute, $value, $parameters, $validator) {
                $explode = explode(',', $value);
                $allow = ['png', 'jpg', 'svg','jpeg'];
                $format = str_replace(
                    [
                        'data:image/',
                        ';',
                        'base64',
                    ],
                    [
                        '', '', '',
                    ],
                    $explode[0]
                );
                // check file format
                if (!in_array($format, $allow)) {
                    return false;
                }
                // check base64 format
                if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {
                    return false;
                }
                return true;
            });

            $valiacao = Validator::make($data, [
                'imagem' => 'base64image',

            ],['base64image'=>'Imagem inválida']);

            if($valiacao->fails()){
                return ['status'=>false, "validacao"=>true, "erros"=>$validacao->errors()];
            }


            $time = time();
            $diretorioPai = 'perfils';
            //Essa lógica serve para nomear o arquivo e inseri-lo em um diretório. Ex= perfil\perfil_id1
            $diretorioImagem = $diretorioPai.DIRECTORY_SEPARATOR.'perfil_id'.$user->id;
            $ext = substr($data['imagem'], 11, strpos($data['imagem'], ';')- 11);
            $urlImagem = $diretorioImagem.DIRECTORY_SEPARATOR.$time.'.'.$ext;

            //aqui irei remover "'data:imagem/'.$ext.';base64," e inserir espaço vazio na varável $data['imagem']
            $file = str_replace('data:image/'.$ext.';base64,','',$data['imagem']);
            $file = base64_decode($file);

            //testando se existe o diretório pai, se não existir eu crio
            if(!file_exists($diretorioPai)){
                mkdir($diretorioPai, 0700);
            }

            //verifico se existe caminho de imagem e apago a imagem antiga
            if($user->imagem){
                //abaixo estou substituindo a / da url por nada, estou tirando ela
                $imgUser = str_replace(asset('/'),'',$user->imagem);
                if(file_exists($imgUser)){
                    //função para apagar arquivos
                    unlink($imgUser);
                }
            }

            //testando se existe o diretório filho, se não existir eu crio
            if(!file_exists($diretorioImagem)){
                mkdir($diretorioImagem, 0700);
            }

            //salvado o arquivo
            file_put_contents($urlImagem, $file);

            //salvando a url na base de dados
            $user->imagem = $urlImagem;


        }


        $user->save();

        //o helper asset monta a url da imagem
        //$user->imagem = asset($user->imagem);
        $user->token = $user->createToken($user->email)->accessToken;
        return ['status'=>true, "usuario"=>$user];

    }//fim do /perfil


}
