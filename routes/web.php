<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accounts\Login;
use App\Http\Controllers\Accounts\Register;
use App\Http\Controllers\Admin\SystemUsers;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Member\MemberDashboard;
use App\Http\Controllers\Member\Profile;

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


});

Route::middleware(['auth'])->prefix('member')->group(function () {

    // ! Admin Dashboard routes
    Route::get('/', [MemberDashboard::class, 'index'])->name('member.dashboard');
    Route::get('/dashboard', [MemberDashboard::class, 'index'])->name('member.dashboard');

    // ! Mmeber Profile routes
    Route::get('/profile', [Profile::class, 'index'])->name('member.profile');
    Route::get('/profile/edit', [Profile::class, 'editProfile'])->name('member.editProfile');
    Route::patch('/profile/update/member/{member}', [Profile::class, 'updateProfile'])->name('member.updateProfile');


});
