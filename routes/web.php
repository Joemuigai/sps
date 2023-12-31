<?php

use App\Http\Controllers\Member\Cars;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accounts\Login;
use App\Http\Controllers\Member\Profile;
use App\Http\Controllers\Accounts\Register;
use App\Http\Controllers\Admin\ParkingLots;
use App\Http\Controllers\Admin\SystemUsers;
use App\Http\Controllers\Member\ParkingLogs;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\RegisteredCars;
use App\Http\Controllers\Admin\RegisteredLogs;
use App\Http\Controllers\Admin\StudentMembers;
use App\Http\Controllers\Member\MemberDashboard;
use App\Http\Controllers\Security\SecurityDashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Login::class, 'index'])->name('account.login');
Route::get('/auth/login', [Login::class, 'index'])->name('account.login');
Route::post('/auth/user/login', [Login::class, 'login2'])->name('login.user');

Route::get('/auth/logout', [Login::class, 'logout'])->name('account.logout');

Route::get('/auth/register', [Register::class, 'index'])->name('account.register');
Route::post('/auth/register/user', [Register::class, 'register'])->name('account.registerUser');

Route::get('/auth/forgot_password', [Login::class, 'forgotPassword'])->name('account.forgotPassword');
Route::post('/auth/forgot_password/send_password_reset_link', [Login::class, 'sendResetPasswordLink'])->name('account.sendResetPasswordLink');
Route::get('/auth/reset_password/{token}', [Login::class, 'resetPassword'])->name('password.reset');
Route::post('/auth/reset_password/password/update', [Login::class, 'updatePassword'])->name('password.change');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // ! Admin Dashboard routes
    Route::get('/', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

    // ! System users accounts management routes
    Route::get('/systemusers', [SystemUsers::class, 'index'])->name('admin.systemUsers');
    Route::get('/systemusers/add', [SystemUsers::class, 'create'])->name('admin.createSystemUser');
    Route::post('/systemusers/user/add', [SystemUsers::class, 'store'])->name('add.systemUser');
    Route::get('/systemusers/user/view/{user}', [SystemUsers::class, 'view'])->name('admin.viewuser');
    Route::get('/systemusers/user/show/{user}', [SystemUsers::class, 'show'])->name('systemuser.showUser');
    Route::patch('/systemusers/user/update/{user}', [SystemUsers::class, 'update'])->name('systemuser.updateUser');
    Route::patch('/systemusers/user/password/update/{user}', [SystemUsers::class, 'updatePassword'])->name('systemuser.updateUserPassword');
    Route::delete('/systemusers/remove/{user}', [SystemUsers::class, 'remove'])->name('remove.systemuser');


    // Student Mmebers Routes
    Route::get('/students', [StudentMembers::class, 'index'])->name('admin.students');
    Route::get('/students/view/{student}', [StudentMembers::class, 'view'])->name('admin.viewStudent');
    Route::get('/students/profile/edit/member/{member}', [StudentMembers::class, 'editProfile'])->name('admin.editProfile');
    Route::patch('/students/profile/update/member/{member}', [StudentMembers::class, 'updateProfile'])->name('admin.updateProfile');
    Route::get('/students/profile/download/file/{document}', [StudentMembers::class, 'download'])->name('admin.downloadNationalId');

    // Student Mmebers Routes
    Route::get('/registered_cars', [RegisteredCars::class, 'index'])->name('admin.cars');
    Route::get('/registered_cars/{car}', [RegisteredCars::class, 'show'])->name('admin.showcars'); // Show parking car
    Route::patch('/registered_cars/update/{car}', [RegisteredCars::class, 'update'])->name('admin.updatecars'); // Edit parking lot

    // Student Mmebers Routes
    Route::get('/parking_logs', [RegisteredLogs::class, 'index'])->name('admin.logs');

    // Student Mmebers Routes
    Route::get('/parking_lots', [ParkingLots::class, 'index'])->name('admin.parkingLots'); // List all parking lots
    Route::post('/parking_lots/add', [ParkingLots::class, 'store'])->name('admin.addParkingLot'); // Add parking lot
    Route::get('/parking_lots/{lot}', [ParkingLots::class, 'show'])->name('admin.showParkingLot'); // Show parking lot
    Route::patch('/parking_lots/update/{lot}', [ParkingLots::class, 'update'])->name('admin.updateParkingLot'); // Edit parking lot
    Route::delete('/parking_lots/remove/{lot}', [ParkingLots::class, 'remove'])->name('admin.removeParkingLot'); // Delete parking lot
});

Route::middleware(['auth'])->prefix('member')->group(function () {

    // ! Admin Dashboard routes
    Route::get('/', [MemberDashboard::class, 'index'])->name('member.dashboard');
    Route::get('/dashboard', [MemberDashboard::class, 'index'])->name('member.dashboard');

    // ! Mmeber Profile routes
    Route::get('/profile', [Profile::class, 'index'])->name('member.profile');
    Route::get('/profile/edit', [Profile::class, 'editProfile'])->name('member.editProfile');
    Route::patch('/profile/update/member/{member}', [Profile::class, 'updateProfile'])->name('member.updateProfile');
    Route::get('/profile/download/file/{document}', [Profile::class, 'download'])->name('member.downloadNationalId');

    // Registered Car Routes
    Route::get('/registered_cars', [Cars::class, 'index'])->name('member.cars');
    Route::post('/registered_cars/add', [Cars::class, 'store'])->name('member.addCar');

    // Registered Car Routes
    Route::get('/parking_logs', [ParkingLogs::class, 'index'])->name('member.parkingLoogs');
});

Route::middleware(['auth'])->prefix('secuurity')->group(function () {

    // ! Admin Dashboard routes
    Route::get('/', [SecurityDashboard::class, 'index'])->name('security.dashboard');
    Route::get('/dashboard', [SecurityDashboard::class, 'index'])->name('security.dashboard');

    Route::post('/logs/add', [SecurityDashboard::class, 'store'])->name('security.addParkingLog');

});
