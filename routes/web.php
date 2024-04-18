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
use App\Http\Controllers\QuoteController;

use App\Http\Controllers\UploadController;

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
        Route::get('/artist', 'index')->name('artist'); // Отправная точка        
    }
);

Route::controller(BandController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/bands', 'index')->name('band'); // Отправная точка        
    }
);

Route::controller(EventController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/events', 'index')->name('events'); // Отправная точка  

        Route::get('/events/view/{id}', 'viewEvent')->name('events.view'); // Отправная точка        
        Route::post('/events/create', 'createEvent')->name('events.create'); // Отправная точка        
        Route::post('/events/save_changes/{id}', 'updateEvent')->name('events.update'); // Отправная точка        
    }
);

Route::controller(NewsController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/news', 'index')->name('news'); // Отправная точка      

        Route::get('/news/view', 'viewItem')->name('news.view'); // Отправная точка        
        Route::post('/news/create', 'createItem')->name('news.create'); // Отправная точка        
    }
);

Route::controller(PublicationController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/publications', 'index')->name('publications'); // Отправная точка        
    }
);

Route::controller(RulesController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/rules', 'index')->name('rules'); // Отправная точка        
        Route::get('/politics', 'politics')->name('politics'); // Отправная точка        
    }
);

Route::controller(SponsorController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/sponsor', 'index')->name('sponsor'); // Отправная точка        
    }
);

Route::controller(ComposerController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/composers', 'index')->name('composers'); // Отправная точка      

        Route::get('/composers/view/{id}', 'viewComposer')->name('composers.view'); // Отправная точка        
        Route::post('/composers/create', 'createComposer')->name('composer.create'); // Отправная точка        
        Route::post('/composers/save_changes/{id}', 'updateComposer')->name('composers.update'); // Отправная точка        
    }
);

Route::controller(QuoteController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/quotes', 'index')->name('quotes'); // Отправная точка      

        Route::get('/quotes/view/{id}', 'viewQuote')->name('quotes.view'); // Отправная точка        
        Route::post('/quotes/create', 'createQuote')->name('quotes.create'); // Отправная точка        
        Route::post('/quotes/save_changes/{id}', 'updateQuote')->name('quotes.update'); // Отправная точка        
    }
);

Route::controller(UploadController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::post('/upload/composer_photo/{id}', 'uploadComposerPhoto')->name('uploads.composer_photo'); // Отправная точка        
    }
);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
