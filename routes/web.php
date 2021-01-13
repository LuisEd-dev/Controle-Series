<?php

use Illuminate\Support\Facades\{Route, Auth, Mail};
use App\Http\Controllers\{SeriesController, TemporadasController, EpisodiosController, EntrarController, RegistroController};
use App\Mail\NovaSerie;

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
Route::get('/series/criar', [SeriesController::class, 'create'])->name("form_criar_serie")
    ->middleware('autenticador');
Route::post('/series/criar', [SeriesController::class, 'store'])
    ->middleware('autenticador');
Route::delete('/series/{id}', [SeriesController::class, 'destroy'])
    ->middleware('autenticador');
Route::post('/series/{id}/editaNome', [SeriesController::class, 'editaNome'])->name("edita_nome")
    ->middleware('autenticador');

Route::get('/series/{serieId}/temporadas', [TemporadasController::class, 'index'])->name("listar_temporadas");

Route::get('/temporadas/{temporada}/episodios', [EpisodiosController::class, 'index'])->name("listar_episodios");

Route::post('/temporadas/{temporada}/episodios/assistir', [EpisodiosController::class, 'assistir'])->name("assistir_episodios")
    ->middleware('autenticador');

//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Rotas de Login */
Route::get('/entrar', [EntrarController::class, 'index'])->name('entrar');
Route::post('/entrar', [EntrarController::class, 'entrar'])->name('acao_entrar');

Route::get('/registrar', [RegistroController::class, 'create'])->name('registrar');
Route::post('/registrar', [RegistroController::class, 'store'])->name('acao_registrar');

Route::get('/sair', function () {
    Auth::logout();
    return redirect()->route('entrar');
});

/* Rotas de Email */
Route::get('/email', function () {
    return new NovaSerie('Arrow', '5', '25');
});

Route::get('/enviar-email', function () {
    $user = (object)['email' => 'luis@teste.com', 'name' => 'Luis Eduardo'];

    $email = new NovaSerie('Arrow', '5', '25');
    $email->subject = 'Nova Série Adicionada';



    return 'Email Enviado!';
});
