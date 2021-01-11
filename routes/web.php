<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{SeriesController, TemporadasController, EpisodiosController, HomeController};

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

Route::get('/', [SeriesController::class, 'index'])->name("listar_series");
//Route::get('/series', [SeriesController::class, 'index'])->name("listar_series")->middleware('auth');
Route::get('/series/criar', [SeriesController::class, 'create'])->name("form_criar_serie");
Route::post('/series/criar', [SeriesController::class, 'store']);
Route::delete('/series/{id}', [SeriesController::class, 'destroy']);
Route::post('/series/{id}/editaNome', [SeriesController::class, 'editaNome'])->name("edita_nome");

Route::get('/series/{serieId}/temporadas', [TemporadasController::class, 'index'])->name("listar_temporadas");

Route::get('/temporadas/{temporada}/episodios', [EpisodiosController::class, 'index'])->name("listar_episodios");
Route::post('/temporadas/{temporada}/episodios/assistir', [EpisodiosController::class, 'assistir'])->name("assistir_episodios");

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
