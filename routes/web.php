<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\MaestroController;
use App\Http\Controllers\AdminController;



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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



//------------------------------------------------------- rutas para el alumno -----------------------------------------------------
// ------------------------------------------------------  utilizandas -------------------------------------------------------------
//vista alumno-taller
Route::get('/alumno/talleres', [AlumnoController::class, 'vistataller'])->name('vistataller')->middleware('auth','role:alumno','Redirigir');

//asistencias
Route::get('/alumno/asistencias', [AlumnoController::class, 'vistaasistencia'])->name('asistenciaalumno')->middleware('auth','role:alumno','Redirigir');

//acreditacion
Route::get('/alumno/acreditacion', [AlumnoController::class, 'pdf'])->name('acreditacion')->middleware('auth','role:alumno','Redirigir','AlcanzaAcreditacion');

//actualizar datos personales alumno
Route::get('/alumno/edit', [AlumnoController::class, 'edit2'])->name('alumno.edit')->middleware('auth','role:alumno','Redirigir');

//crear alumnos
Route::get('/alumno/crear', [AlumnoController::class, 'crear'])->name('crearalumno')->middleware('auth','role:alumno');

Route::POST('/alumno/store', [AlumnoController::class, 'store'])->name('storealumno')->middleware('auth','role:alumno');



//------------------------------------------------------- rutas para el maestros -----------------------------------------------------
// ------------------------------------------------------  utilizandas ---------------------------------------------------------------
//vista maestro-taller-alumnos
Route::get('/maestro/taller', [MaestroController::class, 'vistaalumnos2'])->name('vistaalumnomaestro')->middleware('auth','role:maestro','Redirigir2');

//vista maestro-taller-alumnos
Route::get('/maestro/taller/alumnos/{id}', [MaestroController::class, 'vistaveralumnos2'])->name('vistaveralumnosmaestro')->middleware('auth','role:maestro','Redirigir2');

//vista maestro-asistencias
Route::get('/maestro/repoasistencias/{id}', [MaestroController::class, 'reporteasistencia'])->name('repoasistenciasmaestro')->middleware('auth','role:maestro','Redirigir2');

//vista maestro-asistencias-secperiodo-taller-asistencias
Route::get('/maestro/asistencias/{id}', [MaestroController::class, 'asistencias'])->name('asistenciasmaestro')->middleware('auth','role:maestro','Redirigir2');

//crear asistencias
Route::POST('/maestro/asistencias/store', [MaestroController::class, 'enviarAsistencia'])->name('enviarAsistencia')->middleware('auth','role:maestro','Redirigir2');

//Editar asistencias
Route::get('/maestro/asistencias/editasistencias/{id}', [MaestroController::class, 'editarasistencias'])->name('editasistenciasmaestro')->middleware('auth','role:maestro','Redirigir2');

Route::put('/maestro/asistencias/update', [MaestroController::class, 'updateasis'])->name('asis.update')->middleware('auth','role:maestro','Redirigir2');

//actualizar datos maestro
Route::get('/maestroperfil/edit', [MaestroController::class, 'edit'])->name('maestro.edit')->middleware('auth','role:maestro','Redirigir2');

//crear maestros
Route::get('/maestro/crear', [MaestroController::class, 'crear'])->name('crearmaestro')->middleware('auth','role:maestro');

Route::POST('/maestro/store', [MaestroController::class, 'store'])->name('storemaestro')->middleware('auth','role:maestro');


//------------------------------------------------------- rutas para el admin -----------------------------------------------------
// ------------------------------------------------------  utilizandas ------------------------------------------------------------
//vista admin inicio
Route::get('/admin/inicio', [AdminController::class, 'admininicio'])->name('admininicio')->middleware('auth','role:admin|coordinador');

//vista admin-taller-alumnos
Route::get('/admin/taller', [AdminController::class, 'vistaalumnos'])->name('vistaalumnoadmin')->middleware('auth','role:admin|coordinador');

//vista admin-taller-alumnos
Route::get('/admin/taller/alumnos/{id}', [AdminController::class, 'vistaveralumnos'])->name('vistaveralumnosadmin')->middleware('auth','role:admin|coordinador');

//vista admin-maestros
Route::get('/admin/maestros', [AdminController::class, 'vistamaestro'])->name('vistamaestroadmin')->middleware('auth','role:admin|coordinador');

//vista admin-talleres
Route::get('/admin/talleres', [AdminController::class, 'vistataller2'])->name('vistatalleradmin')->middleware('auth','role:admin|coordinador');

//Vista admin periodos
Route::get('/admin/periodos', [AdminController::class, 'vistaperiodos'])->name('vistaperiodos')->middleware('auth','role:admin|coordinador');

//actualizar datos admin
Route::get('/adminperfil/edit', [AdminController::class, 'editadmin'])->name('admin.edit')->middleware('auth','role:admin|coordinador');

//vista admin-taller-asistencias
Route::get('/admin/taller/asistencias/{id}', [AdminController::class, 'vistaverasis'])->name('vistaverasis')->middleware('auth','role:admin');

//vista admins
Route::get('/admin/administradores', [AdminController::class, 'vistaadmins'])->name('vistaadmins')->middleware('auth','role:admin');

//crear asistencias admin
Route::POST('/asistenciasAdmin/store/', [AdminController::class, 'enviarAsistenciaAdmin'])->name('enviarAsistenciaAdmin')->middleware('auth','role:admin');

//editar asistencias admin
Route::get('/admin/taller/editasistencias/{id}', [AdminController::class, 'editarasistenciasAdmin'])->name('editarasistenciasAdmin')->middleware('auth','role:admin');

Route::put('/asistenciasAdmin/update', [AdminController::class, 'updateasisAdmin'])->name('asisAdmin.update')->middleware('auth','role:admin');

//vista admin-reporteasistencias-sectaller-asistencias
Route::get('/admin/taller/reporteasistencias/{id}', [AdminController::class, 'reporteasistenciaAdmin'])->name('reporteasistenciaAdmin')->middleware('auth','role:admin|coordinador');

require __DIR__.'/auth.php';
