<?php

use Illuminate\Support\Facades\{Route, Auth};
use App\Http\Controllers\{SeriesController, TemporadasController, EpisodiosController, EntrarController};

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

Route::get('/', [SeriesController::class, 'index'])->name("listar_series")
    ->middleware('auth');
//Route::get('/series', [SeriesController::class, 'index'])->name("listar_series")->middleware('auth');
Route::get('/series/criar', [SeriesController::class, 'create'])->name("form_criar_serie")
    ->middleware('auth');
Route::post('/series/criar', [SeriesController::class, 'store'])
    ->middleware('auth');
Route::delete('/series/{id}', [SeriesController::class, 'destroy'])
    ->middleware('auth');
Route::post('/series/{id}/editaNome', [SeriesController::class, 'editaNome'])->name("edita_nome")
    ->middleware('auth');

Route::get('/series/{serieId}/temporadas', [TemporadasController::class, 'index'])->name("listar_temporadas")
    ->middleware('auth');

Route::get('/temporadas/{temporada}/episodios', [EpisodiosController::class, 'index'])->name("listar_episodios")
    ->middleware('auth');;
Route::post('/temporadas/{temporada}/episodios/assistir', [EpisodiosController::class, 'assistir'])->name("assistir_episodios")
    ->middleware('auth');;

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/entrar', [EntrarController::class, 'index'])->name('entrar');
Route::post('/entrar', [EntrarController::class, 'entrar'])->name('acao_entrar');
