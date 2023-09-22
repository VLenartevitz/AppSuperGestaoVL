<?php

use Illuminate\Support\Facades\Route;



Route::name('site.index')
->get('/','App\Http\Controllers\principalController@principal');

Route::get('/sobrenos', 'App\Http\Controllers\sobrenosController@sobreNos')->name('site.sobrenos');

Route::get('/contato', 'App\Http\Controllers\contatoController@contato')->name('site.contato');

Route::get('/login/{erro?}', 'App\Http\Controllers\LoginController@index' )->name('site.login');
Route::post('/login', 'App\Http\Controllers\LoginController@autenticar' )->name('site.login');




Route::middleware( 'autenticacao:padrao')
->prefix('/app')->group(function(){
    Route::get('/cliente',function(){return 'CLIENTES';})
     ->name('app.cliente');
     
    Route::get('/fornecedore', 'App\Http\Controllers\FornecedorController@index')->name('app.fornecedore');
    
    Route::get('/produto', function()
    {return 'PRODUTOS ';})->name('app.produto');

});

Route::fallback(function(){

    echo 'A rota acessada não existe. <a href="'.route('site.index').'">CLIQUE AQUI</a> para ir para a pagina inicial';
    
});






