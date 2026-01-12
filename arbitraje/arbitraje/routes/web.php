<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowUpsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CotizacionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/calendario', function () {
    return view('calendario');
})->name('public.calendar');

Route::get('/api/public-events', function () {
    // Return only dates that are busy, masking details
    $tasks = \App\Models\Task::select(['id', 'due_date as start'])->get();
    $events = $tasks->map(function ($task) {
        return [
            'title' => 'Ocupado',
            'start' => $task->start,
            'allDay' => true,
            'color' => '#FF0000',
            'textColor' => '#FFFFFF',
        ];
    });
    return response()->json($events);
})->name('public.events');
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('clients/formulario', [ClientController::class, 'formulario'])->name('clients.formulario');
Route::get('cotizacions/{cotizacion}/pdf', [CotizacionController::class, 'generarPDF'])->name('cotizacions.pdf');
Route::resource('cotizacions', CotizacionController::class);



Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('clients/activate/{client}', [ClientController::class, 'activate'])->name('clients.activate');
    Route::get('clients/deleted', [ClientController::class, 'deleted'])->name('clients.deleted');

    Route::get('clients/{id}/pdf', [ClientController::class, 'generatePdf'])->name('clients.pdf');
    Route::get('clients/export/', [ClientController::class, 'exportExcel'])->name('clients.export');
    Route::get('clients/form-import/', [ClientController::class, 'formUplodClientes'])->name('clients.form-import');
    Route::post('clients/import/', [ClientController::class, 'import'])->name('clients.import');
    Route::resource('clients', ClientController::class);

    Route::prefix('clients/{client}')->name('clients.contacts.')->group(function () {
        Route::post('/', [ContactController::class, 'store'])->name('store');
        Route::get('{contact}/edit', [ContactController::class, 'edit'])->name('edit');
        Route::put('{contact}', [ContactController::class, 'update'])->name('update');
        Route::delete('{contact}', [ContactController::class, 'destroy'])->name('destroy');
    });

    Route::resource('clients.followups', FollowUpsController::class)->only(['index', 'show', 'store', 'update']);

    Route::get('/calendar', [TaskController::class, 'calendar'])->name('calendar');
    Route::get('/tasks/events', [TaskController::class, 'events'])->name('tasks.events');
    Route::resource('tasks', TaskController::class);

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'store'])->name('settings.store');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/password', [ProfileController::class, 'editPassword'])->name('profile.password');
    Route::post('profile/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::get('users/{user}/password', [UserController::class, 'editPassword'])->name('users.password.edit');
    Route::put('users/{user}/password', [UserController::class, 'updatePassword'])->name('users.password.update');

    // Asignación de permisos a usuario
    Route::get('users/{user}/permissions', [UserController::class, 'editPermissions'])
        ->name('users.permissions.edit');

    Route::post('users/{user}/permissions', [UserController::class, 'updatePermissions'])
        ->name('users.permissions.update');

    Route::resource('users', UserController::class)->except(['show']);

    // CRUD de permisos
    Route::resource('permissions', PermissionController::class)->except(['show']);

    Route::post('notifications/{id}/read', [TaskController::class, 'markAsRead'])->name('notifications.read');
});
