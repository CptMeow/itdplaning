<?php
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectsController;
/*
| Core Route
*/
require __DIR__ . '/core.php';

/*
| App Route
*/
Route::group(['middleware' => ['role:user','get.menu']], function () {
  Route::get('/project/{project}/task/create', [ProjectsController::class, 'taskCreate'])->name('project.task.create'); 
  Route::post('/project/{project}/task/create', [ProjectsController::class, 'taskStore'])->name('project.task.store'); 
  Route::get('/project/gantt', [ProjectsController::class, 'gantt'])->name('gantt'); 
  Route::resource('project',        ProjectsController::class);  

  // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');   
});
