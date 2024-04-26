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
use App\Http\Controllers\MusicalInstrumentController;
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
        Route::get('/artists', 'index')->name('artists'); // Отправная точка       

        Route::get('/artists/view/{id}', 'viewArtist')->name('artists.view'); // Отправная точка       
        Route::post('/artists/save_changes/{id}', 'updateArtist')->name('artist.update'); // Отправная точка  

        Route::post('/artist/accept_moderation/{id}', 'acceptModeration')->name('artist.accept_moderation'); // Отправная точка 
        Route::post('/artist/deny_moderation/{id}', 'denyModeration')->name('artist.deny_moderation'); // Отправная точка 

    }
);

Route::controller(BandController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/bands', 'index')->name('bands'); // Отправная точка        
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

        Route::get('/news/view/{id}', 'viewItem')->name('news.view'); // Отправная точка        
        Route::post('/news/create', 'createItem')->name('news.create'); // Отправная точка     

        Route::post('/news/save_changes/{id}', 'updateNews')->name('news.update'); // Отправная точка        
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

Route::controller(MusicalInstrumentController::class)->middleware(['auth', 'verified'])->group(
    function () {
        Route::get('/instruments', 'index')->name('instruments'); // Отправная точка      

        Route::get('/instruments/view/{id}', 'viewMusicalInstrument')->name('instruments.view'); // Отправная точка        
        Route::post('/instruments/create', 'createMusicalInstrument')->name('instruments.create'); // Отправная точка        
        Route::post('/instruments/save_changes/{id}', 'updateMusicalInstrument')->name('instruments.update'); // Отправная точка  

        Route::post('/musical_instruments/get_all', 'getAllInstruments')->name('musical_instruments.get_all'); // Отправная точка        
        Route::post('/musical_instruments/create_from_select', 'createInstrumentFromSelect')->name('musical_instruments.get_all');
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
        Route::post('/upload/instrument_photo/{id}', 'uploadMusicalInstrumentPhoto')->name('uploads.instrument_photo'); // Отправная точка  

        Route::post('/upload/artist_photo/{id}', 'uploadArtistPhoto')->name('uploads.artist_photo');
        Route::post('/upload/artist_photo/{id}/delete', 'deleteArtistPhoto')->name('uploads.delete_artist_photo'); // Отправная точка        

        Route::post('/upload/band_photo/{id}', 'uploadBandPhoto')->name('uploads.band_photo'); // Отправная точка        
        Route::post('/upload/band_photo/{id}/delete', 'deleteBandPhoto')->name('uploads.delete_band_photo'); // Отправная точка  

        Route::post('/upload/event_photo/{id}', 'uploadEventPhoto')->name('uploads.event_photo');
        Route::post('/upload/event_photo/{id}/delete', 'deleteEventPhoto')->name('uploads.delete_event_photo'); // Отправная точка        

        Route::post('/upload/news_photo/{id}', 'uploadNewsPhoto')->name('uploads.news_photo');
        Route::post('/upload/news_photo/{id}/delete', 'deleteNewsPhoto')->name('uploads.delete_news_photo'); // Отправная точка        

        Route::post('/upload/publication_photo/{id}', 'uploadPublicationPhoto')->name('uploads.publication_photo');
        Route::post('/upload/publication_photo/{id}/delete', 'deletePublicationPhoto')->name('uploads.delete_publication_photo');
    }
);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/mailable', function () {


    return new App\Mail\ArtistModerationAccept();
});

require __DIR__ . '/auth.php';
