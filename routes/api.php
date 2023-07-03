<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;



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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('/admin/documentoapi',[ApiController::class,'apiindex'])->name('documentoapi.index');



Route::post('/admin/crearusuarioapi',[ApiController::class,'storedUsuario'])->name('usuarioscreateindex.index');

Route::post('/admin/login',[ApiController::class,'login'])->name('loginapp.index');

//estos dos no se usan porque no aceptan el token
Route::post('/admin/logout',[ApiController::class,'logout'])->name('logoutapp.index');
Route::get('/admin/user',[ApiController::class,'user'])->name('user.index');
//-----


Route::middleware('auth:sanctum')->group(function () 
{
    Route::post('/admin/logoutsactum',[ApiController::class,'logout'])->name('logoutsactum.index');
    Route::get('/admin/usersactum',[ApiController::class,'user'])->name('usersactum.index');
    Route::get('/admin/usersall22',[ApiController::class,'usersall'])->name('useralls1.index');
});

Route::get('/admin/usuario/delete/{id}',[ApiController::class,'destroyUsuario'])->name('admin.destroyUsuarioapi');
Route::post('/admin/usuario/update/{id}',[ApiController::class,'updateUsuario'])->name('admin.updateUsuarioapi');

Route::get('/admin/usersall',[ApiController::class,'usersall'])->name('useralls2.index');


//##################################################################################################
//##################################################################################################
//                                FUNCIONES DEL ADMINISTRAR ABOGADO
//##################################################################################################
//##################################################################################################
Route::get('/admin/abogadosall',[ApiController::class,'Abogadosall'])->name('Abogadosall.index');
Route::post('/admin/createAbogado',[ApiController::class,'createAbogado'])->name('createAbogado.index');
Route::post('/admin/abogado/update/{id}',[ApiController::class,'updateAbogado'])->name('admin.updateAbogado');
Route::get('/admin/abogado/delete/{id}',[ApiController::class,'destroyAbogado'])->name('admin.destroyAbogado');

//##################################################################################################
//##################################################################################################
//                                FUNCIONES DEL ADMINISTRAR JUEZ
//##################################################################################################
//##################################################################################################
Route::get('/admin/Juecesall',[ApiController::class,'Juecesall'])->name('Juecesall.index');
Route::post('/admin/createJuece',[ApiController::class,'createJuece'])->name('createJuece.index');
Route::post('/admin/juece/update/{id}',[ApiController::class,'updateJuece'])->name('admin.updateJuece');
Route::get('/admin/juece/delete/{id}',[ApiController::class,'destroyJuece'])->name('admin.destroyJuece');


//##################################################################################################
//##################################################################################################
//                                FUNCIONES DEL ADMINISTRAR CLIENTE
//##################################################################################################
//##################################################################################################
Route::get('/admin/Clientesall',[ApiController::class,'Clientesall'])->name('Clientesall.index');
Route::post('/admin/createCliente',[ApiController::class,'createCliente'])->name('createCliente.index');
Route::post('/admin/cliente/update/{id}',[ApiController::class,'updateCliente'])->name('admin.updateCliente');
Route::get('/admin/cliente/delete/{id}',[ApiController::class,'destroyCliente'])->name('admin.destroyCliente');

//##################################################################################################
//##################################################################################################
//                                FUNCIONES DEL ADMINISTRAR DOCUMENTOS todos
//##################################################################################################
//##################################################################################################


Route::get('/admin/Documentosall',[ApiController::class,'Documentosall'])->name('Documentosall.index');