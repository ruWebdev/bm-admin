<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\ComposerController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Контроллер при входе в систему
Route::controller(DashboardController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/dashboard', 'index')->name('dashboard'); // Отправная точка        
    }
);

Route::controller(ArtistController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/artist', 'index')->name('dashboard'); // Отправная точка        
    }
);

Route::controller(BandController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/bands', 'index')->name('dashboard'); // Отправная точка        
    }
);

Route::controller(EventController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/events', 'index')->name('dashboard'); // Отправная точка  

        Route::get('/events/view/{id}', 'viewEvent')->name('dashboard'); // Отправная точка        
        Route::post('/events/create', 'createEvent')->name('dashboard'); // Отправная точка        
        Route::post('/events/save_changes/{id}', 'updateEvent')->name('dashboard'); // Отправная точка        
    }
);

Route::controller(NewsController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/news', 'index')->name('dashboard'); // Отправная точка      

        Route::get('/news/view', 'viewItem')->name('dashboard'); // Отправная точка        
        Route::post('/news/create', 'createItem')->name('dashboard'); // Отправная точка        
    }
);

Route::controller(PublicationController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/publications', 'index')->name('dashboard'); // Отправная точка        
    }
);

Route::controller(RulesController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/rules', 'index')->name('dashboard'); // Отправная точка        
        Route::get('/politics', 'politics')->name('dashboard'); // Отправная точка        
    }
);

Route::controller(SponsorController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/sponsor', 'index')->name('dashboard'); // Отправная точка        
    }
);

Route::controller(ComposerController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/composers', 'index')->name('dashboard'); // Отправная точка      

        Route::get('/composers/view/{id}', 'viewComposer')->name('dashboard'); // Отправная точка        
        Route::post('/composers/create', 'createComposer')->name('dashboard'); // Отправная точка        
        Route::post('/composers/save_changes/{id}', 'updateComposer')->name('dashboard'); // Отправная точка        
    }
);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
