<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UrlManagerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TeamMemberController;




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

Route::get('/', [AuthenticateController::class, 'login'])->name('login');
Route::post('signIn', [AuthenticateController::class, 'signIn'])->name('signIn');


Route::group(['middleware'=> ['auth.login']],  function(){

   Route::match(array('GET','POST'),'dashboard', [DashboardController::class, 'index'])->name('dashboard');
   Route::get('logout', [DashboardController::class, 'logout'])->name('logout');
   Route::post('genrateurl', [DashboardController::class, 'genrateurl'])->name('genrateurl');

   Route::match(array('GET','POST'),'client', [ClientController::class, 'index'])->name('client');

   Route::post('inviteClient', [ClientController::class, 'inviteClient'])->name('inviteClient');

   Route::match(array('GET','POST'),'team-member', [TeamMemberController::class, 'index'])->name('team-member');
   Route::post('inviteTeamMember', [TeamMemberController::class, 'inviteTeamMember'])->name('inviteTeamMember');
    
});

Route::get('/semx/{code}', [UrlManagerController::class, 'redirectToMainUrl'])->name('redirectToMainUrl');
