<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TaglineController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\KnowledgesController;
use App\Http\Controllers\Admin\ConfigurationController;
use App\Http\Controllers\Admin\CategoryPortfolioController;
use App\Http\Controllers\Admin\CommentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/portfolio/detail/{slug}', [HomeController::class, 'detail'])->name('detail');
Route::post('/send-massage', [HomeController::class, 'createComment'])->name('send.massage');

Route::get('/login', [AuthController::class, 'index'])->name('auth');
Route::post('login/check', [AuthController::class, 'login'])->name('login'); 
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'web'])->group(function () {
    Route::prefix('admin-panel')->group(function () {

        // CKeditor
        Route::post('/ckeditor/upload', [CkeditorController::class, 'upload'])->name('upload');

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Configuration
        Route::resource('/configuration', ConfigurationController::class)->shallow()->only(['index', 'update']);

        // User
        // Route::resource('/user', UserController::class)->shallow()->only(['index', 'update']);
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/user/changepassword', [UserController::class, 'changepassword'])->name('user.changepassword');
        Route::patch('/user/updatepassword', [UserController::class, 'updatepassword'])->name('user.updatepassword');

        // Tagline
        Route::resource('/tagline', TaglineController::class);

        // Education
        Route::resource('/education', EducationController::class);

        // Experience
        Route::resource('/experience', ExperienceController::class);

        // Knowledges
        Route::resource('/knowledges', KnowledgesController::class);

        // Skill
        Route::resource('/skill', SkillController::class);

        // Category Portfolio
        Route::resource('/category', CategoryPortfolioController::class);

        // Portfolio
        Route::resource('/portfolio', PortfolioController::class);

        // Comment
        Route::resource('/comment', CommentController::class);
    });
});
