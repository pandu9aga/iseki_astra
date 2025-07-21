<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\PhotoAngleController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ChecklistController;
use App\Http\Controllers\Admin\RecordController;

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProfileUserController;
use App\Http\Controllers\User\TrackController;
use App\Http\Controllers\User\UserReportController;

Route::get('/', [MainController::class, 'index'])->name('/');
Route::get('/login', [MainController::class, 'index'])->name('login');
Route::post('/login/auth', [MainController::class, 'login'])->name('login.auth');
Route::get('/logout', [MainController::class, 'logout'])->name('logout');

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/area', [AreaController::class, 'index'])->name('area');
    Route::get('/area/add', [AreaController::class, 'add'])->name('area.add');
    Route::post('/area/create', [AreaController::class, 'create'])->name('area.create');
    Route::get('/area/edit/{Id_Area}', [AreaController::class, 'edit'])->name('area.edit');
    Route::put('/area/update/{Id_Area}', [AreaController::class, 'update'])->name('area.update');
    Route::delete('/area/delete/{Id_Area}', [AreaController::class, 'destroy'])->name('area.destroy');

    Route::get('/angle', [PhotoAngleController::class, 'index'])->name('angle');
    Route::get('/angle/add', [PhotoAngleController::class, 'add'])->name('angle.add');
    Route::post('/angle/create', [PhotoAngleController::class, 'create'])->name('angle.create');
    Route::get('/angle/edit/{Id_Photo_Angle}', [PhotoAngleController::class, 'edit'])->name('angle.edit');
    Route::put('/angle/update/{Id_Photo_Angle}', [PhotoAngleController::class, 'update'])->name('angle.update');
    Route::delete('/angle/delete/{Id_Photo_Angle}', [PhotoAngleController::class, 'destroy'])->name('angle.destroy');

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/add', [UserController::class, 'add'])->name('user.add');
    Route::post('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/user/edit/{Id_User}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{Id_User}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{Id_User}', [UserController::class, 'destroy'])->name('user.destroy');

    // Route::get('/type', [TypeController::class, 'index'])->name('type');
    // Route::get('/type/add', [TypeController::class, 'add'])->name('type.add');
    // Route::post('/type/create', [TypeController::class, 'create'])->name('type.create');
    // Route::get('/type/edit/{Id_Type}', [TypeController::class, 'edit'])->name('type.edit');
    // Route::put('/type/update/{Id_Type}', [TypeController::class, 'update'])->name('type.update');
    // Route::delete('/type/delete/{Id_Type}', [TypeController::class, 'destroy'])->name('type.destroy');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update/{Id_User}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::get('/report/submit', [ReportController::class, 'submit'])->name('report.submit');
    Route::get('/report/detail/{Id_Type}', [ReportController::class, 'detail'])->name('report.detail');
    // Route::put('/report/approvement/{Id_Track}', [ReportController::class, 'approvement'])->name('report.approvement');
    Route::get('/report/export/{Id_Type}', [ReportController::class, 'export'])->name('report.export');

    Route::get('/checklist', [ChecklistController::class, 'index'])->name('checklist');
    Route::get('/checklist/submit', [ChecklistController::class, 'submit'])->name('checklist.submit');
    Route::get('/checklist/detail/{Id_Type}', [ChecklistController::class, 'detail'])->name('checklist.detail');
    Route::get('/checklist/export/{Id_Type}', [ChecklistController::class, 'export'])->name('checklist.export');
    Route::get('/checklist/store', [ChecklistController::class, 'store'])->name('checklist.store');
    Route::delete('/checklist/delete/{Id_Type}', [ChecklistController::class, 'delete'])->name('checklist.delete');
    Route::post('/checklist/deleteAll', [ChecklistController::class, 'deleteAll'])->name('checklist.deleteAll');

    Route::get('/record', [RecordController::class, 'index'])->name('record');
    Route::get('/record/download/{filename}', [RecordController::class, 'download'])->name('record.download');
    // Route::get('/monthly/export', [MonthlyController::class, 'export'])->name('monthly.export');
    // Route::delete('/monthly/reset', [MonthlyController::class, 'reset'])->name('monthly.reset');
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/user_profile', [ProfileUserController::class, 'index'])->name('user_profile');
    Route::put('/user_profile/update/{Id_User}', [ProfileUserController::class, 'update'])->name('user_profile.update');

    Route::get('/track', [TrackController::class, 'index'])->name('track');
    Route::get('/track2', [TrackController::class, 'index2'])->name('track2');
    Route::post('/track', [TrackController::class, 'store'])->name('track.store');

    Route::get('/user_report', [UserReportController::class, 'index'])->name('user_report');
    Route::get('/user_report/submit', [UserReportController::class, 'submit'])->name('user_report.submit');
    Route::get('/user_report/detail/{Id_Track}', [UserReportController::class, 'detail'])->name('user_report.detail');
    Route::delete('/user_report/delete/{Id_Track}', [UserReportController::class, 'destroy'])->name('user_report.destroy');
    Route::get('/user_report/export/{Id_Track}', [UserReportController::class, 'export'])->name('user_report.export');

    // Route::get('/record', [RecordController::class, 'index'])->name('record');
    // Route::post('/record/create', [RecordController::class, 'create'])->name('record.create');
    // Route::get('/record/check', [RecordController::class, 'check'])->name('record.check');
});

// Route::get('/report', function () {
//     return view('admins.report_test.index');
// })->name('report');

// Route::get('/report/detail', function () {
//     return view('admins.report_test.detail');
// })->name('report.detail');