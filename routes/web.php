<?php
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ProjectController;
// use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
| Core Route
 */
require __DIR__ . '/core.php';

/*
| App Route
 */
Route::group(['middleware' => ['role:user', 'get.menu']], function () {

    //Project
    Route::get('/project/gantt', [ProjectController::class, 'gantt'])->name('project.gantt');
    Route::get('/project/{project}/task/create', [ProjectController::class, 'taskCreate'])->name('project.task.create');
    Route::post('/project/{project}/task/create', [ProjectController::class, 'taskStore'])->name('project.task.store');
    Route::get('/project/{project}/task/{task}/edit', [ProjectController::class, 'taskEdit'])->name('project.task.edit');
    Route::PUT('/project/{project}/task/{task}/update', [ProjectController::class, 'taskUpdate'])->name('project.task.update');
    Route::DELETE('/project/{project}/task/{task}/destroy', [ProjectController::class, 'taskDestroy'])->name('project.task.destroy');
    Route::get('/project/{project}/task/{task}', [ProjectController::class, 'taskShow'])->name('project.task.show');
    Route::resource('project', ProjectController::class);

    //Contract
    Route::resource('contract', ContractController::class);

    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
