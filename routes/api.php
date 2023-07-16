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

Route::get('/admin/usersall',[ApiController::class,'usersall'])->name('useralls222.index');


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

Route::get('/admin/Bitacorasall',[ApiController::class,'Bitacorasall'])->name('bitacorassall.index');
Route::get('/admin/Documentosall',[ApiController::class,'Documentosall'])->name('Documentosall.index');

//ver los archivos PDF##################################################################################
Route::get('/admin/documentoAPI/{filename}',[ApiController::class,'showDocumentoApi'])->name('showDocumentoApi.index');
Route::get('/admin/ExpedienteAPI/{filename}',[ApiController::class,'showExpedienteApi'])->name('showExpedienteApi.index');
Route::get('/admin/apelacionAPI/{filename}',[ApiController::class,'showApelacionApi'])->name('showApelacionApi.index');
Route::get('/admin/docAPI/{filename}',[ApiController::class,'showDocApi'])->name('showDocApi.index');
//ver los archivos PDF##################################################################################


// FUNCIONES CASOS 
Route::get('/admin/CasosDIVList',[ApiController::class,'ListarDApi'])->name('showapiDIC.index');
Route::get('/admin/CasosDetalleDIVList/{id}',[ApiController::class,'verDetalleDApi'])->name('verDetalleDApi.index');
//search por numerocaso - ci
Route::get('/admin/CasosDetalleDIVList/{id}',[ApiController::class,'verDetalleDApi'])->name('verDetalleDApi.index');

Route::post('/admin/verDetalleDApiSearchNumeroCI/{id}',[ApiController::class,'verDetalleDApiSearchNumeroCI'])->name('verDetalleDApiSearchNumeroCI.index');


// FUNCIONES demandas por el id del caso
Route::get('/admin/Demandasidcaso/{id}',[ApiController::class,'ListarDemandasid'])->name('ListarDemandasid.index');
 
// FUNCIONES documentos por el id del caso
Route::get('/admin/Documentosidcaso/{id}',[ApiController::class,'ListarDocumentoid'])->name('ListarDocumentoid.index');
// FUNCIONES expedientes por el id del caso
Route::get('/admin/Expedientesidcaso/{id}',[ApiController::class,'ListarExpedienteid'])->name('ListarExpedienteid.index');
// FUNCIONES apelaciones por el id del caso
Route::get('/admin/Apelacionesidcaso/{id}',[ApiController::class,'ListarApelacionid'])->name('ListarApelacionid.index');

