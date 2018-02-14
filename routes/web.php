<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('auth.login2');
});*/

Route::get('/', ['middleware' => ['auth', 'web'], function () {
    return redirect('/home');
}]);

Route::get('/home', 'HomeController@index')->middleware('auth', 'web');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['prefix' => 'acessos', 'middleware' => ['auth', 'web'], 'where' => ['id' => '[0-9]+']], function () {
    Route::get('alterarSenha/{id?}', ['as' => 'acessos.alterarsenha', 'uses' => 'UserController@prepararAlterarSenha']);
    Route::put('alterarSenha/{id}/verificarDados', ['as' => 'acessos.alterarsenha.update', 'uses' => 'UserController@alterarSenha']);
});

// Usuários e Acessos Auxiliares
Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'usuarios', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('', ['as' => 'usuarios', 'uses' => 'UserController@index']);
    Route::get('{id}/acessos', ['as' => 'usuarios.acessos', 'uses' => 'UserController@acessoUsuario']);
    Route::put('{id}/acessos/atualizar', ['as' => 'usuarios.acessos.update', 'uses' => 'UserController@atualizarAcesso']);
    Route::get('{id}/usuario/resetar', ['as' => 'usuarios.resetar_senha', 'uses' => 'UserController@prepararResetarSenha']);
    Route::put('{id}/usuario/resetando', ['as' => 'usuarios.resetando_senha', 'uses' => 'UserController@forcarSenhaPadrao']);
});

// Empresas
Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'empresas', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('', ['as' => 'empresas', 'uses' => 'EmpresaController@index']);
    Route::get('lists', ['as' => 'empresas.lists', 'uses' => 'EmpresaController@lists']);
    Route::post('adicionar', ['as' => 'empresas.add', 'uses' => 'EmpresaController@createAjax']);
    Route::put('edit/{id}', ['as' => 'empresas.edit', 'uses' => 'EmpresaController@editAjax']);
    Route::delete('excluir/{id}', ['as' => 'empresas.delete', 'uses' => 'EmpresaController@deleteAjax']);
});

// Regionais
Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'regionais', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('', ['as' => 'regionais', 'uses' => 'RegionalController@index']);
    Route::get('lists', ['as' => 'regionais.lists', 'uses' => 'RegionalController@lists']);
    Route::post('adicionar', ['as' => 'regionais.add', 'uses' => 'RegionalController@createAjax']);
    Route::put('edit/{id}', ['as' => 'regionais.edit', 'uses' => 'RegionalController@editAjax']);
    Route::delete('excluir/{id}', ['as' => 'regionais.delete', 'uses' => 'RegionalController@deleteAjax']);
});

// Distritais
Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'distritais', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('', ['as' => 'distritais', 'uses' => 'DistritalController@index']);
    Route::get('lists', ['as' => 'distritais.lists', 'uses' => 'DistritalController@lists']);
    Route::post('adicionar', ['as' => 'distritais.add', 'uses' => 'DistritalController@createAjax']);
    Route::put('edit/{id}', ['as' => 'distritais.edit', 'uses' => 'DistritalController@editAjax']);
    Route::delete('excluir/{id}', ['as' => 'distritais.delete', 'uses' => 'DistritalController@deleteAjax']);
});

// Categorias
Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'categorias', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('', ['as' => 'categorias', 'uses' => 'CategoriaController@index']);
    Route::get('lists', ['as' => 'categorias.lists', 'uses' => 'CategoriaController@lists']);
    Route::post('adicionar', ['as' => 'categorias.add', 'uses' => 'CategoriaController@createAjax']);
    Route::put('edit/{id}', ['as' => 'categorias.edit', 'uses' => 'CategoriaController@editAjax']);
    Route::delete('excluir/{id}', ['as' => 'categorias.delete', 'uses' => 'CategoriaController@deleteAjax']);
});

// Tipos de Indicador
Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'tipos', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('', ['as' => 'tipos', 'uses' => 'TipoController@index']);
    Route::get('lists', ['as' => 'tipos.lists', 'uses' => 'TipoController@lists']);
    Route::post('adicionar', ['as' => 'tipos.add', 'uses' => 'TipoController@createAjax']);
    Route::put('edit/{id}', ['as' => 'tipos.edit', 'uses' => 'TipoController@editAjax']);
    Route::delete('excluir/{id}', ['as' => 'tipos.delete', 'uses' => 'TipoController@deleteAjax']);
});

// Ano e Mês
Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'anomes', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('', ['as' => 'anomes', 'uses' => 'AnoMesController@index']);
    Route::get('lists', ['as' => 'anomes.lists', 'uses' => 'AnoMesController@lists']);
    Route::post('adicionar', ['as' => 'anomes.add', 'uses' => 'AnoMesController@createAjax']);
    Route::put('edit/{id}', ['as' => 'anomes.edit', 'uses' => 'AnoMesController@editAjax']);
    Route::delete('excluir/{id}', ['as' => 'anomes.delete', 'uses' => 'AnoMesController@deleteAjax']);
});

// Indicadores
Route::group(['middleware' => ['auth','superuser', 'web'], 'prefix' => 'indicadores', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('', ['as' => 'indicadores', 'uses' => 'IndicadorController@index']);
    Route::get('lists', ['as' => 'indicadores.lists', 'uses' => 'IndicadorController@lists']);
    Route::post('adicionar', ['as' => 'indicadores.add', 'uses' => 'IndicadorController@createAjax']);
    Route::put('edit/{id}', ['as' => 'indicadores.edit', 'uses' => 'IndicadorController@editAjax']);
    Route::delete('excluir/{id}', ['as' => 'indicadores.delete', 'uses' => 'IndicadorController@deleteAjax']);
});

// Metas
Route::group(['middleware' => ['auth','superuser', 'web'], 'prefix' => 'metas', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('', ['as' => 'metas', 'uses' => 'MetaController@index']);
    Route::get('lists', ['as' => 'metas.lists', 'uses' => 'MetaController@lists']);
    Route::post('adicionar', ['as' => 'metas.add', 'uses' => 'MetaController@createAjax']);
    Route::put('edit/{id}', ['as' => 'metas.edit', 'uses' => 'MetaController@editAjax']);
    Route::delete('excluir/{id}', ['as' => 'metas.delete', 'uses' => 'MetaController@deleteAjax']);
});

// Lancamentos
Route::group(['middleware' => ['auth','superuser', 'web'], 'prefix' => 'lancamentos', 'where' => ['id' => '[0-9]+']], function () {
    Route::get('', ['as' => 'lancamentos', 'uses' => 'LancamentoController@index']);
    Route::get('lists', ['as' => 'lancamentos.lists', 'uses' => 'LancamentoController@lists']);
    Route::post('adicionar', ['as' => 'lancamentos.add', 'uses' => 'LancamentoController@createAjax']);
    Route::put('edit/{id}', ['as' => 'lancamentos.edit', 'uses' => 'LancamentoController@editAjax']);
    Route::delete('excluir/{id}', ['as' => 'lancamentos.delete', 'uses' => 'LancamentoController@deleteAjax']);
});

Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'common', 'where' => ['id' => '[0-9]+', 'indicador' => '[0-9]+', 'ano' => '[0-9]+']], function () {
   Route::get('indicadores', ['as' => 'common.indicadores', 'uses' => 'IndicadorController@indicadoresAjax']);
   Route::get('indicador/{id}', ['as' => 'common.indicadorTemplate', 'uses' => 'IndicadorController@indicadorTemplate']);
   Route::get('categorias', ['as' => 'common.categorias', 'uses' => 'CategoriaController@categoriasAjax']);
   Route::get('tipos', ['as' => 'common.tipos', 'uses' => 'TipoController@tiposAjax']);
   Route::get('lancamentos/{indicador}/{ano}', ['as' => 'common.tipos', 'uses' => 'TipoController@tiposAjax']);
});
