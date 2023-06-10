<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminController;


use App\Http\Controllers\RolController;

use App\Http\Controllers\ClienteController;


// DESDE AQUI INICIA LOS METODOS DEL PROYECTO GESTION DOCUMENTAL//
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\AbogadoController;
use App\Http\Controllers\JueceController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\ReporteController;


Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/home', function () { return view('home');});



/*Rutas para inicio de session */
/*Ruta de registro de usuario*/
Route::get('/register',[RegisterController::class, 'create'])->middleware('guest')->name('register.index');
Route::post('/register',[RegisterController::class, 'store'])->name('register.store');
/*ruta de inicio de la session */
Route::get('/login',[SessionsController::class, 'create'])->middleware('guest')->name('login.index');
Route::post('/login',[SessionsController::class, 'store'])->name('login.store');
/*Ruta de finalizar session */
Route::get('/logout',[SessionsController::class, 'destroy'])->middleware('auth')->name('login.destroy');

/*///////////////////////////////////
////Rutas para el administrador////// 
/////////////////////////////////////*/

Route::get('/admin',[AdminController::class,'index'])->middleware('auth.admin')->name('admin.index');

/*/////////// CLIENTE////////////////// */

/*Rutas para que el administrador registre a un cliente*/
Route::get('/admin/registrarCliente',[AdminController::class,'registrarC'])->middleware('auth.admin')->name('admin.registrarcliente');

Route::get('/admin/registrarCliente/crear',[AdminController::class,'createCliente'])->middleware('auth.admin')->name('admin.crearcliente');
Route::post('/admin/registrarCliente/crear/create',[AdminController::class,'storedCliente'])->middleware('auth.admin')->name('admin.storedCliente');

/*Ruta para que el administrador elimine a un cliente */
Route::get('/admin/registrarCliente/deleteC/{id}',[AdminController::class,'destroyCliente'])->middleware('auth.admin')->name('admin.destroycliente');

/*Ruta para que el administrador edite los datos de un cliente */
Route::get('/admin/registrarCliente/editarC/{id}',[AdminController::class,'editCliente'])->middleware('auth.admin')->name('admin.editcliente');
Route::post('/admin/registrarCliente/editarC1/{id}',[AdminController::class,'updateCliente'])->middleware('auth.admin')->name('admin.updatecliente');


/*/////////// USUARIO /////////////*/

/*Rutas para que el administrador registre a un Usuario*/
Route::get('/admin/registrarUsuario',[AdminController::class,'registrarU'])->middleware('auth.admin')->name('admin.registrarusuario');
Route::get('/admin/registrarUsuario/crear',[AdminController::class,'createUsuario'])->middleware('auth.admin')->name('admin.crearusuario');
Route::post('/admin/registrarUsuario/crear/create',[AdminController::class,'storedUsuario'])->middleware('auth.admin')->name('admin.storedusuario');

/*Ruta para que el administrador elimine a un Usuario */
Route::get('/admin/registrarUsuario/deleteU/{id}',[AdminController::class,'destroyUsuario'])->middleware('auth.admin')->name('admin.destroyusuario');

/*Ruta para que el administrador edite los datos de un Usuario*/
Route::get('/admin/registrarUsuario/editarV/{id}',[AdminController::class,'editUsuario'])->middleware('auth.admin')->name('admin.editusuario');
Route::post('/admin/registrarUsuario/editarV1/{id}',[AdminController::class,'updateUsuario'])->middleware('auth.admin')->name('admin.updateusuario');


/*///////// Rutas Rol/////*/
/*///////// Rutas Rol/////*/
// LISTAR ROLES
Route::get('/admin/roles',[RolController::class,'ListarRol'])->middleware('auth.admin')->name('admin.roles');
// CREAR ROLES
Route::get('/admin/registrarRol/crear',[RolController::class,'CreateRol'])->middleware('auth.admin')->name('admin.crearrol');
Route::post('/admin/registrarRol/crear/create',[RolController::class,'storedRol'])->middleware('auth.admin')->name('admin.storedRoles');
// EDITAR ROLES
Route::get('/admin/registrarRol/editarC/{id}',[RolController::class,'editRol'])->middleware('auth.admin')->name('admin.editRol');
Route::post('/admin/registrarRol/editarC1/{id}',[RolController::class,'updateRol'])->middleware('auth.admin')->name('admin.updaterol');
// ELIMINAR ROLES
Route::get('/admin/registrarRol/deleteC/{id}',[RolController::class,'destroyRol'])->middleware('auth.admin')->name('admin.destroyroles');







/*///////// Rutas del Personal/////*/
Route::get('/admin/registrarPersonal',[PersonalController::class,'ListarP'])->middleware('auth.admin')->name('admin.listarpersonal');
Route::get('/admin/registrarPersonal/crear',[PersonalController::class,'createPersonal'])->middleware('auth.admin')->name('admin.crearpersonal');
Route::post('/admin/registrarPersonal/crear/create',[PersonalController::class,'storedPersonal'])->middleware('auth.admin')->name('admin.storedPersonal');
Route::get('/admin/registrarPersonal/editarP/{id}',[PersonalController::class,'editPersonal'])->middleware('auth.admin')->name('admin.editpersonal');
Route::post('/admin/registrarPersonal/editarP1/{id}',[PersonalController::class,'updatePersonal'])->middleware('auth.admin')->name('admin.updatepersonal');
Route::get('/admin/registrarPersonal/deleteP/{id}',[PersonalController::class,'destroyPersonal'])->middleware('auth.admin')->name('admin.destroypersonal');

/*///////// Rutas del Abogado/////*/
Route::get('/admin/registrarAbogado',[AbogadoController::class,'ListarA'])->middleware('auth.admin')->name('admin.listarabogado');
Route::get('/admin/registrarAbogado/crear',[AbogadoController::class,'createAbogado'])->middleware('auth.admin')->name('admin.crearabogado');
Route::post('/admin/registrarAbogado/crear/create',[AbogadoController::class,'storedAbogado'])->middleware('auth.admin')->name('admin.storedAbogado');
Route::get('/admin/registrarAbogado/editarP/{id}',[AbogadoController::class,'editAbogado'])->middleware('auth.admin')->name('admin.editabogado');
Route::post('/admin/registrarAbogado/editarP1/{id}',[AbogadoController::class,'updateAbogado'])->middleware('auth.admin')->name('admin.updateabogado');
Route::get('/admin/registrarAbogado/deleteP/{id}',[AbogadoController::class,'destroyAbogado'])->middleware('auth.admin')->name('admin.destroyabogado');


/*///////// Rutas del Juez/////*/
Route::get('/admin/registrarJuez',[JueceController::class,'ListarJ'])->middleware('auth.admin')->name('admin.listarjuece');
Route::get('/admin/registrarJuez/crear',[JueceController::class,'createJuece'])->middleware('auth.admin')->name('admin.crearjuece');
Route::post('/admin/registrarJuez/crear/create',[JueceController::class,'storedJuece'])->middleware('auth.admin')->name('admin.storedJuece');
Route::get('/admin/registrarJuez/editarP/{id}',[JueceController::class,'editJuece'])->middleware('auth.admin')->name('admin.editjuece');
Route::post('/admin/registrarJuez/editarP1/{id}',[JueceController::class,'updateJuece'])->middleware('auth.admin')->name('admin.updatejuece');
Route::get('/admin/registrarJuez/deleteP/{id}',[JueceController::class,'destroyJuece'])->middleware('auth.admin')->name('admin.destroyjuece');



/*///////// Rutas administrar clientes/////*/

Route::get('/admin/registrarClientes',[ClienteController::class,'ListarC'])->middleware('auth.admin')->name('admin.listarcliente');

Route::get('/admin/registrarClientes/crear',[ClienteController::class,'createCliente'])->middleware('auth.admin')->name('admin.crearclientes');
Route::post('/admin/registrarClientes/crear/create',[ClienteController::class,'storedCliente'])->middleware('auth.admin')->name('admin.storedClientes');

/*Ruta para que el administrador elimine a un cliente */
Route::get('/admin/registrarClientes/deleteC/{id}',[ClienteController::class,'destroyCliente'])->middleware('auth.admin')->name('admin.destroyclientes');

/*Ruta para que el administrador edite los datos de un cliente */
Route::get('/admin/registrarClientes/editarC/{id}',[ClienteController::class,'editCliente'])->middleware('auth.admin')->name('admin.editclientes');
Route::post('/admin/registrarClientes/editarC1/{id}',[ClienteController::class,'updateCliente'])->middleware('auth.admin')->name('admin.updateclientes');

Route::get('/admin/registrarClientes/pdf',[ClienteController::class,'Pdf'])->middleware('auth.admin')->name('admin.pdfclientes');




/*///////// Rutas Bitacora/////*/
Route::get('/admin/bitacora',[BitacoraController::class,'ListarB'])->middleware('auth.admin')->name('admin.listarbitacora');
Route::get('/admin/bitacora/pdf',[BitacoraController::class,'Pdf'])->middleware('auth.admin')->name('admin.pdfbitacora');


                    

/*/////////////////////////////////
////////// Rutas de abogado//////
/////////////////////////////////// */
Route::get('/abogado',[AbogadoController::class,'index'])->middleware('auth.admin')->name('abogado.index');

/*/////////////////////////////////
////////// Rutas de Juez//////
/////////////////////////////////// */
Route::get('/juez',[JueceController::class,'index'])->middleware('auth.admin')->name('juece.index');


/* Rutas de documento */

Route::get('/admin/documento',[DocumentoController::class,'index'])->middleware('auth.admin')->name('documento.index');

Route::get('/admin/documento/crear',[DocumentoController::class,'crearDocumento'])->middleware('auth.admin')->name('documento.crear');
Route::post('/admin/documento/crear',[DocumentoController::class,'storedDocumento'])->middleware('auth.admin')->name('documento.store');

Route::get('/admin/documento/delete/{id}',[DocumentoController::class,'destroyDocumento'])->middleware('auth.admin')->name('documento.destroy');

Route::get('/admin/documento/editar/{id}',[DocumentoController::class,'editDocumento'])->middleware('auth.admin')->name('documento.edit');
Route::post('/admin/documento/editar/{id}',[DocumentoController::class,'updateDocumento'])->middleware('auth.admin')->name('documento.update');

Route::get('/admin/documento/{filename}',[DocumentoController::class,'showDocumento'])->middleware('auth.admin')->name('documento.show');


/* Rutas de Reporte */
// Report Generation
Route::get('/cliente/reporte', [ReporteController::class,'generateCliente'])->middleware('auth.admin')->name('reporte.generateCliente');
// Export Report
Route::post('/cliente/reporte', [ReporteController::class,'exportCliente'])->middleware('auth.admin')->name('reporte.exportCliente');

Route::get('/documento/reporte', [ReporteController::class,'generateDocumento'])->middleware('auth.admin')->name('reporte.generateDocumento');
Route::post('/documento/reporte', [ReporteController::class,'exportDocumento'])->middleware('auth.admin')->name('reporte.exportDocumento');

Route::get('/abogado/reporte', [ReporteController::class,'generateAbogado'])->middleware('auth.admin')->name('reporte.generateAbogado');
Route::post('/abogado/reporte', [ReporteController::class,'exportAbogado'])->middleware('auth.admin')->name('reporte.exportAbogado');

Route::get('/bitacora/reporte', [ReporteController::class,'generateBitacora'])->middleware('auth.admin')->name('reporte.generateBitacora');
Route::post('/bitacora/reporte', [ReporteController::class,'exportBitacora'])->middleware('auth.admin')->name('reporte.exportBitacora');
