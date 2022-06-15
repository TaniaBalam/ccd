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
//crear alumnos
Route::get('/alumno/crear', [AlumnoController::class, 'crear'])->name('crearalumno')->middleware('auth','role:alumno');

Route::POST('/alumno/store', [AlumnoController::class, 'store'])->name('storealumno')->middleware('auth','role:alumno');

//vista alumno-taller
Route::get('/alumno/talleres', [AlumnoController::class, 'vistataller'])->name('vistataller')->middleware('auth','role:alumno','Redirigir');

//inscripcion alumno-taller
Route::put('/inscripcion-alumno/update/{id}', [AlumnoController::class, 'update'])->name('inscripcionalumno')->middleware('auth','role:alumno','Redirigir');

//actualizar datos personales alumno
Route::get('/alumno/edit', [AlumnoController::class, 'edit2'])->name('alumno.edit')->middleware('auth','role:alumno','Redirigir');

Route::put('/alumno/update/{id}', [AlumnoController::class, 'update2'])->name('alumno.update')->middleware('auth','role:alumno','Redirigir');

//acreditacion
Route::get('/alumno/acreditacion', [AlumnoController::class, 'pdf'])->name('acreditacion')->middleware('auth','role:alumno','Redirigir','AlcanzaAcreditacion');

//asistencias
Route::get('/alumno/asistencias', [AlumnoController::class, 'vistaasistencia'])->name('asistenciaalumno')->middleware('auth','role:alumno','Redirigir');






//------------------------------------------------------- rutas para el maestros -----------------------------------------------------
//crear maestros
Route::get('/maestro/crear', [MaestroController::class, 'crear'])->name('crearmaestro')->middleware('auth','role:maestro');

Route::POST('/maestro/store', [MaestroController::class, 'store'])->name('storemaestro')->middleware('auth','role:maestro');

//vista maestro-taller-alumnos
Route::get('/maestro/taller', [MaestroController::class, 'vistaalumnos2'])->name('vistaalumnomaestro')->middleware('auth','role:maestro','Redirigir2');

//vista maestro-taller-alumnos
Route::get('/maestro/taller/alumnos/{id}', [MaestroController::class, 'vistaveralumnos2'])->name('vistaveralumnosmaestro')->middleware('auth','role:maestro','Redirigir2');

//actualizar datos maestro
Route::get('/maestroperfil/edit', [MaestroController::class, 'edit'])->name('maestro.edit')->middleware('auth','role:maestro','Redirigir2');

Route::put('/maestroperfil/update/{id}', [MaestroController::class, 'update'])->name('maestro.update')->middleware('auth','role:maestro','Redirigir2');

//vista maestro-asistencias-secperiodo-taller-asistencias
Route::get('/maestro/asistencias/{id}', [MaestroController::class, 'asistencias'])->name('asistenciasmaestro')->middleware('auth','role:maestro','Redirigir2');

//crear asistencias
Route::POST('/maestro/asistencias/store', [MaestroController::class, 'enviarAsistencia'])->name('enviarAsistencia')->middleware('auth','role:maestro','Redirigir2');

//vista maestro-asistencias
Route::get('/maestro/repoasistencias/{id}', [MaestroController::class, 'reporteasistencia'])->name('repoasistenciasmaestro')->middleware('auth','role:maestro','Redirigir2');

//Editar asistencias
Route::get('/maestro/asistencias/editasistencias/{id}', [MaestroController::class, 'editarasistencias'])->name('editasistenciasmaestro')->middleware('auth','role:maestro','Redirigir2');

Route::put('/maestro/asistencias/update', [MaestroController::class, 'updateasis'])->name('asis.update')->middleware('auth','role:maestro','Redirigir2');





//------------------------------------------------------- rutas para el admin -----------------------------------------------------

//vista admin-talleres
Route::get('/admin/talleres', [AdminController::class, 'vistataller2'])->name('vistatalleradmin')->middleware('auth','role:admin|coordinador');

//crear talleres
Route::get('/taller/crear', [AdminController::class, 'creartaller'])->name('creartaller')->middleware('auth','role:admin');

Route::POST('/taller/store', [AdminController::class, 'store'])->name('storetaller')->middleware('auth','role:admin');

//actualizar datos taller
Route::get('/taller/edit/{id}', [AdminController::class, 'edit'])->name('taller.edit')->middleware('auth','role:admin');

Route::put('/taller/update/{id}', [AdminController::class, 'update'])->name('taller.update')->middleware('auth','role:admin');

//vista admin-maestros
Route::get('/admin/maestros', [AdminController::class, 'vistamaestro'])->name('vistamaestroadmin')->middleware('auth','role:admin|coordinador');

//actualizar datos maestro en el admin
Route::get('/maestro/edit/{id}', [AdminController::class, 'edit2'])->name('maestro2.edit')->middleware('auth','role:admin');

Route::put('/maestro/update/{id}', [AdminController::class, 'update2'])->name('maestro2.update')->middleware('auth','role:admin');


//crear maestros en el admin
Route::get('/maestroadmin/crear', [AdminController::class, 'crear2'])->name('crearmaestroadmin')->middleware('auth','role:admin');

Route::POST('/maestroadmin/store', [AdminController::class, 'store2'])->name('storemaestroadmin')->middleware('auth','role:admin');


//vista admin-taller-alumnos
Route::get('/admin/taller', [AdminController::class, 'vistaalumnos'])->name('vistaalumnoadmin')->middleware('auth','role:admin|coordinador');

//vista admin-taller-alumnos
Route::get('/admin/taller/alumnos/{id}', [AdminController::class, 'vistaveralumnos'])->name('vistaveralumnosadmin')->middleware('auth','role:admin|coordinador');


//actualizar datos personales alumno en el admin
Route::get('/alumnoadmin/edit/{id}', [AdminController::class, 'edit3'])->name('alumnoadmin.edit')->middleware('auth','role:admin');

Route::get('/alumnoadmin/update/{id}', [AdminController::class, 'update3'])->name('alumnoadmin.update')->middleware('auth','role:admin');

//crear alumnos en el admin
Route::get('/alumnoadmin/crear', [AdminController::class, 'crear3'])->name('crearalumnoadmin')->middleware('auth','role:admin');

Route::POST('/alumnoadmin/store', [AdminController::class, 'store3'])->name('storealumnoadmin')->middleware('auth','role:admin');

//eliminar alumnos en el admin
Route::get('/alumnos/destroye/alumno={id}&user={id2}', [AdminController::class, 'destroye3'])->name('alumno.destroye')->middleware('auth','role:admin');

//vista admin inicio
Route::get('/admin/inicio', [AdminController::class, 'admininicio'])->name('admininicio')->middleware('auth','role:admin|coordinador');


//Vista admin periodos
Route::get('/admin/periodos', [AdminController::class, 'vistaperiodos'])->name('vistaperiodos')->middleware('auth','role:admin|coordinador');

//crear periodos
Route::get('/periodo/crear', [AdminController::class, 'crearperiodos'])->name('crearperiodo')->middleware('auth','role:admin');

Route::POST('/periodo/store', [AdminController::class, 'storeperiodos'])->name('storeperiodo')->middleware('auth','role:admin');

//actualizar datos periodos
Route::get('/periodo/edit/{id}', [AdminController::class, 'editperiodos'])->name('periodo.edit')->middleware('auth','role:admin');

Route::put('/periodo/update/{id}', [AdminController::class, 'updateperiodos'])->name('periodo.update')->middleware('auth','role:admin');

//actualizar datos admin
Route::get('/adminperfil/edit', [AdminController::class, 'editadmin'])->name('admin.edit')->middleware('auth','role:admin|coordinador');

Route::put('/adminperfil/update/{id}', [AdminController::class, 'updateadmin'])->name('admin.update')->middleware('auth','role:admin|coordinador');


//vista admin-taller-asistencias
Route::get('/admin/taller/asistencias/{id}', [AdminController::class, 'vistaverasis'])->name('vistaverasis')->middleware('auth','role:admin');

//crear asistencias admin
Route::POST('/asistenciasAdmin/store/', [AdminController::class, 'enviarAsistenciaAdmin'])->name('enviarAsistenciaAdmin')->middleware('auth','role:admin');

//editar asistencias admin
Route::get('/admin/taller/editasistencias/{id}', [AdminController::class, 'editarasistenciasAdmin'])->name('editarasistenciasAdmin')->middleware('auth','role:admin');

Route::put('/asistenciasAdmin/update', [AdminController::class, 'updateasisAdmin'])->name('asisAdmin.update')->middleware('auth','role:admin');

//vista admin-reporteasistencias-sectaller-asistencias
Route::get('/admin/taller/reporteasistencias/{id}', [AdminController::class, 'reporteasistenciaAdmin'])->name('reporteasistenciaAdmin')->middleware('auth','role:admin|coordinador');

//vista admins
Route::get('/admin/administradores', [AdminController::class, 'vistaadmins'])->name('vistaadmins')->middleware('auth','role:admin');

//crear administradores
Route::get('/admin/crear', [AdminController::class, 'crearadmin'])->name('crearadmin')->middleware('auth','role:admin');

Route::POST('/admin/store', [AdminController::class, 'storeadmin'])->name('storeadmin')->middleware('auth','role:admin');

//actualizar datos administradores
Route::get('/admin/edit/{id}', [AdminController::class, 'editadmins'])->name('admin.edit2')->middleware('auth','role:admin');

Route::put('/admin/update/{id}', [AdminController::class, 'updateadmins'])->name('admin.update2')->middleware('auth','role:admin');

//eliminar administradores
Route::get('/admin/destroye/admin={id}&user={id2}', [AdminController::class, 'destroyeadmin'])->name('admin.destroye')->middleware('auth','role:admin');

//eliminar maestros
Route::get('/maestro/destroye/maestro={id}&user={id2}', [AdminController::class, 'destroyemaestro'])->name('maestro.destroye')->middleware('auth','role:admin');

//eliminar talleres
Route::get('admin/taller/destroye/{id}', [AdminController::class, 'destroyetaller'])->name('taller.destroye')->middleware('auth','role:admin');

//eliminar talleres
Route::get('admin/periodo/destroye/{id}', [AdminController::class, 'destroyeperiodo'])->name('periodo.destroye')->middleware('auth','role:admin');

require __DIR__.'/auth.php';
