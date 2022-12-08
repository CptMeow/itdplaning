<?php
use App\Http\Controllers\ProjectsController;
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
    Route::get('/project/gantt', [ProjectsController::class, 'gantt'])->name('project.gantt');
    Route::get('/project/{project}/task/create', [ProjectsController::class, 'taskCreate'])->name('project.task.create');
    Route::post('/project/{project}/task/create', [ProjectsController::class, 'taskStore'])->name('project.task.store');
    Route::get('/project/{project}/task/{task}/edit', [ProjectsController::class, 'taskEdit'])->name('project.task.edit');
    Route::PUT('/project/{project}/task/{task}/update', [ProjectsController::class, 'taskUpdate'])->name('project.task.update');
    Route::DELETE('/project/{project}/task/{task}/destroy', [ProjectsController::class, 'taskDestroy'])->name('project.task.destroy');
    Route::get('/project/{project}/task/{task}', [ProjectsController::class, 'taskShow'])->name('project.task.show');
    Route::resource('project', ProjectsController::class);

    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
