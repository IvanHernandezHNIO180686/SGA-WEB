<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComiteController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\AcuerdoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ProfesoresController;

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

Route::get('/', function () {

    if(Session()->all()){
        return view('Home');
    }else{
        return view('Auth.login');
    }

});




/*
                                    ----Rutas para el administrador----
*/

Route::get('/admin/miperfil', [AdminController::class,'perfil'])->name('Admin.MiPerfil')->middleware('auth','admin-auth');
Route::get('/admin/miperfil/edit/{user}', [AdminController::class,'editPerfil'])->name('Admin.editPerfil')->middleware('auth','admin-auth');
Route::put('/admin/miperfil/update/{user}',[AdminController::class,'update'])->name('Admin.updatePerfil')->middleware('auth','admin-auth');
/*
                                                Usuarios
*/
Route::get('/admin/user', [UserController::class,'index'])->name('User.index')->middleware('auth','admin-auth');
Route::get('/admin/user/create', [UserController::class,'create'])->name('User.create')->middleware('auth','admin-auth');
Route::post('/admin/user',[UserController::class,'store'])->name('User.store')->middleware('auth','admin-auth');
// Route::get('/admin/auditoria/show', [AuditoriaController::class,'show'])->name('Auditoria.show');
Route::get('/admin/user/{user}',[UserController::class,'asignar'])->name('User.asignar')->middleware('auth','admin-auth');
Route::post('/admin/asignar',[UserController::class,'insertarAcomite'])->name('User.insertarAcomite')->middleware('auth','admin-auth');
Route::get('/admin/user/{user}/edit',[UserController::class,'edit'])->name('User.edit')->middleware('auth','admin-auth');
Route::put('/admin/user/{user}',[UserController::class,'update'])->name('User.update')->middleware('auth','admin-auth');
Route::delete('user/{user}',[UserController::class,'destroy'])->name('User.destroy')->middleware('auth','admin-auth');

Route::put('/admin/solicitud/aceptar/{user}',[UserController::class,'aceptar'])->name('User.aceptar')->middleware('auth','admin-auth');
Route::delete('/admin/solicitud/denegar/{user}',[UserController::class,'denegar'])->name('User.denegar')->middleware('auth','admin-auth');
/*
                                                Auditorias
*/
Route::get('/admin/auditoria', [AuditoriaController::class,'index'])->name('Auditoria.index')->middleware('auth','admin-auth');
Route::get('/admin/auditoria/create', [AuditoriaController::class,'create'])->name('Auditoria.create')->middleware('auth','admin-auth');
Route::post('/admin/auditoria',[AuditoriaController::class,'store'])->name('Auditoria.store')->middleware('auth','admin-auth');
Route::get('/admin/auditoria/show/{auditoria}', [AuditoriaController::class,'show'])->name('Auditoria.show')->middleware('auth','admin-auth');
Route::get('/admin/auditoria/{auditoria}/edit',[AuditoriaController::class,'edit'])->name('Auditoria.edit')->middleware('auth','admin-auth');
Route::put('auditoria/{auditoria}',[AuditoriaController::class,'update'])->name('Auditoria.update');
Route::delete('auditoria/{auditoria}',[AuditoriaController::class,'destroy'])->name('Auditoria.destroy')->middleware('auth','admin-auth');

/*
                                                Comites
*/

Route::get('/admin/comite', [ComiteController::class,'index'])->name('Comite.index')->middleware('auth','admin-auth');
Route::get('/admin/comite/create', [ComiteController::class,'create'])->name('Comite.create')->middleware('auth','admin-auth');
Route::post('/admin/comite',[ComiteController::class,'store'])->name('Comite.store')->middleware('auth','admin-auth');
Route::get('/admin/comite/asignar/{comite}',[ComiteController::class,'asignar'])->name('Comite.asignar')->middleware('auth','admin-auth');
Route::post('/admin/comite/agregar/{comite}',[ComiteController::class,'agregarUsuario'])->name('Comite.agregarUsuario')->middleware('auth','admin-auth');
Route::get('/admin/comite/{comite}', [ComiteController::class,'show'])->name('Comite.show')->middleware('auth','admin-auth');
Route::get('/admin/comite/reuniones/{comite}', [ComiteController::class,'reuniones'])->name('Comite.reuniones')->middleware('auth','admin-auth');
Route::get('/admin/comite/{comite}/edit',[ComiteController::class,'edit'])->name('Comite.edit')->middleware('auth','admin-auth');
Route::put('comite/{comite}',[ComiteController::class,'update'])->name('Comite.update');
Route::delete('comite/{comite}',[ComiteController::class,'destroy'])->name('Comite.destroy')->middleware('auth','admin-auth');
Route::post('comite/eliminar',[ComiteController::class,'eliminarDeComite'])->name('Comite.eliminarDeComite')->middleware('auth','admin-auth');


/*
                                                Reuniones
*/

Route::get('/admin/reunion', [ReunionController::class,'index'])->name('Reunion.index')->middleware('auth','admin-auth');
Route::get('/admin/reunion/create', [ReunionController::class,'create'])->name('Reunion.create')->middleware('auth','admin-auth');
Route::post('/admin/reunion',[ReunionController::class,'store'])->name('Reunion.store')->middleware('auth','admin-auth');
Route::get('/admin/reunion/{reunion}', [ReunionController::class,'show'])->name('Reunion.show')->middleware('auth','admin-auth');
Route::get('/admin/reunion/{reunion}/edit',[ReunionController::class,'edit'])->name('Reunion.edit')->middleware('auth','admin-auth');
Route::put('reunion/{reunion}',[ReunionController::class,'update'])->name('Reunion.update')->middleware('auth','admin-auth');
Route::delete('reunion/{reunion}',[ReunionController::class,'destroy'])->name('Reunion.destroy')->middleware('auth','admin-auth');
Route::get('/admin/auditoria/acuerdo/{reunion}', [ReunionController::class,'acuerdo'])->name('Reunion.acuerdo')->middleware('auth','admin-auth');
Route::post('/admin/auditoria/acuerdo/add', [ReunionController::class,'addAcuerdo'])->name('Reunion.addAcuerdo')->middleware('auth','admin-auth');
Route::put('reunion/estatus/{reunion}',[ReunionController::class,'estatus'])->name('Reunion.estatus')->middleware('auth','admin-auth');

/*
                                                Acuerdos
*/

Route::get('/admin/acuerdo', [AcuerdoController::class,'index'])->name('Acuerdo.index')->middleware('auth','admin-auth');
Route::get('/admin/acuerdo/create', [AcuerdoController::class,'create'])->name('Acuerdo.create')->middleware('auth','admin-auth');
Route::post('/admin/acuerdo',[AcuerdoController::class,'store'])->name('Acuerdo.store')->middleware('auth','admin-auth');
Route::get('/admin/acuerdo/{acuerdo}', [AcuerdoController::class,'show'])->name('Acuerdo.show')->middleware('auth','admin-auth');
Route::get('/admin/acuerdo/{acuerdo}/edit',[AcuerdoController::class,'edit'])->name('Acuerdo.edit')->middleware('auth','admin-auth');
Route::put('acuerdo/{acuerdo}',[AcuerdoController::class,'update'])->name('Acuerdo.update')->middleware('auth','admin-auth');
Route::delete('acuerdo/{acuerdo}',[AcuerdoController::class,'destroy'])->name('Acuerdo.destroy')->middleware('auth','admin-auth');
Route::get('/admin/acuerdo/reporte/pdf/{acuerdo}',[AcuerdoController::class,'pdf'])->name('Acuerdo.pdf')->middleware('auth','admin-auth');


/*
                                                Archivos
*/
Route::post('/admin/archivo/requerimientos/{acuerdo}',[ArchivoController::class,'store'])->name('Archivo.store')->middleware('auth','admin-auth');
Route::delete('archivo/{archivo}',[ArchivoController::class,'destroy'])->name('Archivo.destroy')->middleware('auth','admin-auth');

/*
                                    ----Rutas para el profesor----
*/

Route::get('/profesor/miperfil', [ProfesoresController::class,'perfil'])->name('Profesores.MiPerfil')->middleware('auth','profe-auth');
Route::get('/profesor/miperfil/edit/{user}', [ProfesoresController::class,'editPerfil'])->name('Profesores.editPerfil')->middleware('auth','profe-auth');
Route::put('/profesor/miperfil/update/{user}',[ProfesoresController::class,'update'])->name('Profesores.updatePerfil')->middleware('auth','profe-auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profesor/reunion', [ReunionController::class,'verReunionIndividual'])->name('Reunion.reunionesIndividuales')->middleware('auth','profe-auth');
Route::get('/profesor/comites', [ComiteController::class,'misComites'])->name('Comite.misComites')->middleware('auth','profe-auth');
Route::post('/profesor/asistir/{reunion}', [AsistenciaController::class,'store'])->name('Reunion.Asistencia')->middleware('auth','profe-auth');
Route::get('/profesor/asistencias', [AsistenciaController::class,'index'])->name('Asistencia.index')->middleware('auth','profe-auth');
Route::get('/profesor/auditorias', [AuditoriaController::class,'misAuditorias'])->name('Auditoria.misAuditorias')->middleware('auth','profe-auth');
Route::get('/profesor/notificaciones', [NotificacionController::class,'index'])->name('Notificacion.misNotificaciones')->middleware('auth','profe-auth');
Route::put('/profesor/notificaciones/{notificacion}', [NotificacionController::class,'update'])->name('Notificacion.update')->middleware('auth','profe-auth');
Route::delete('/profesor/notificaciones/{notificacion}', [NotificacionController::class,'destroy'])->name('Notificacion.destroy')->middleware('auth','profe-auth');
Route::get('/profesor/acuerdo', [AcuerdoController::class,'acuerdoProf'])->name('Acuerdo.misAcuerdos')->middleware('auth','profe-auth');
Route::post('/profesor/acuerdo/requerimientos/{acuerdo}', [ArchivoController::class,'requerimientos'])->name('Archivo.requerimientos')->middleware('auth','profe-auth');

Route::get('/profesor/archivo/{archivo}', [ArchivoController::class,'subirArchivo'])->name('Archivo.subirArchivo')->middleware('auth','profe-auth');
Route::post('/profesor/archivo/{archivo}', [ArchivoController::class,'update'])->name('Archivo.update')->middleware('auth','profe-auth');
Route::get('/profesor/archivo/{uuid}/download', [ArchivoController::class,'download'])->name('Archivo.download')->middleware('auth','profe-auth');
Route::post('/profesor/confirmacion', [AsistenciaController::class,'confirmacion'])->name('Reunion.Confirmacion')->middleware('auth','profe-auth');
Route::put('/profesor/asistencias/{asistencia}',[AsistenciaController::class,'update'])->name('Asistencia.update')->middleware('auth','profe-auth');
