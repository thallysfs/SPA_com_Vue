<?php


use Illuminate\Http\Request;
use App\User;
use App\Conteudo;
use App\Comentario;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/cadastro', "UsuarioController@cadastro");
Route::post('/login', "UsuarioController@login");
//Route::middleware('auth:api')->get('/usuario', "UsuarioController@usuario");
Route::middleware('auth:api')->put('/perfil', "UsuarioController@perfil");

Route::middleware('auth:api')->post('/conteudo/adicionar', "ConteudoController@adicionar");
Route::middleware('auth:api')->get('/conteudo/lista', "ConteudoController@lista");
Route::middleware('auth:api')->put('/conteudo/curtir/{id}', "ConteudoController@curtir");
Route::middleware('auth:api')->put('/conteudo/comentar/{id}', "ConteudoController@comentar");

Route::get('/testes', function(){



    /*
    $user = User::find(1);
    $user2 = User::find(2);

    $conteudos = Conteudo::all();
    foreach ($conteudos as $key =>$valeu){
        $valeu->delete();
    }

    $user = User::find(1);
    $user->conteudos()->create([
        'titulo' => 'Conteudo 3',
        'texto' => 'Aqui o texto',
        'imagem'=> 'url da imagem',
        'link' => 'Link',
        'data' => '2018-05-29'
    ]);

    return $user->conteudos;

    //add amigos
    $user = User::find(1);
    $user2 = User::find(2);

    //$user->amigos()->attach($user2->id);
    //$user->amigos()->detach($user2->id);
    //toggle - se não tiver o relacionamento ele adicionará, se já estiver, o toggle irá remover
    //$user->amigos()->toggle($user2->id);
    return $user->amigos;

    //add curtidas
    $user = User::find(1);
    $conteudo = Conteudo::find(1);
    //toggle - se não tiver o relacionamento ele adicionará, se já estiver, o toggle irá remover
    $user->curtidas()->toggle($conteudo->id);
    return $conteudo->curtidas()->count();
    return $conteudo->curtidas();

    //add comentarios
    $user = User::find(1);
    $user2 = User::find(2);
    $conteudo = Conteudo::find(1);

    $user->comentarios()->create([
        'conteudo_id' => $conteudo->id,
        'texto' => 'Show de bola!',
        'data' => date('Y-m-d')
    ]);
    $user2->comentarios()->create([
        'conteudo_id' => $conteudo->id,
        'texto' => 'Não gostei!',
        'data' => date('Y-m-d')
    ]);

    return $conteudo->comentarios; */




});


