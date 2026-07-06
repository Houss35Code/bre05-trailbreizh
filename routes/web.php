<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RandonneeController;
use App\Http\Controllers\FavoriController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Randonnee;
use App\Models\User;
use App\Models\Avis;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'nbRandonnees' => Randonnee::count(),
        'nbMembres'    => User::count(),
        'nbAvis'       => Avis::count(),
        'populaires'   => Randonnee::where('statut', 'publie')
            ->latest()
            ->take(3)
            ->get(),
    ]);
});

Route::get('/randonnees', [RandonneeController::class, 'index'])->name('randonnees.index');
Route::get('/randonnees/create', [RandonneeController::class, 'create'])->middleware('auth')->name('randonnees.create');
Route::get('/randonnees/{randonnee}', [RandonneeController::class, 'show'])->name('randonnees.show');

// Forum — create DOIT être avant {topic}
Route::get('/forum', [TopicController::class, 'index'])->name('forum.index');
Route::get('/forum/create', [TopicController::class, 'create'])->middleware('auth')->name('forum.create');
Route::get('/forum/{topic}', [TopicController::class, 'show'])->name('forum.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/guides', [GuideController::class, 'index'])->name('guides.index');
Route::get('/guides/{slug}', [GuideController::class, 'show'])->name('guides.show');

Route::get('/mentions-legales', [PageController::class, 'mentions'])->name('pages.mentions');
Route::get('/cgu', [PageController::class, 'cgu'])->name('pages.cgu');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/randonnees', [RandonneeController::class, 'store'])->name('randonnees.store');

    Route::post('/favoris', [FavoriController::class, 'store'])->name('favoris.store');
    Route::delete('/favoris', [FavoriController::class, 'destroy'])->name('favoris.destroy');

    Route::post('/avis', [AvisController::class, 'store'])->name('avis.store');
    Route::delete('/avis/{avis}', [AvisController::class, 'destroy'])->name('avis.destroy');

    Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
    Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');

    Route::post('/forum', [TopicController::class, 'store'])->name('forum.store');
    Route::post('/forum/{topic}/reponses', [TopicController::class, 'storeReponse'])->name('forum.reponses.store');
    Route::delete('/reponses/{reponse}', [TopicController::class, 'destroyReponse'])->name('reponses.destroy');
});

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/randonnees', [AdminController::class, 'randonnees'])->name('randonnees');
    Route::delete('/randonnees/{randonnee}', [AdminController::class, 'deleteRandonnee'])->name('randonnees.delete');
    Route::get('/utilisateurs', [AdminController::class, 'utilisateurs'])->name('utilisateurs');
    Route::delete('/utilisateurs/{user}', [AdminController::class, 'deleteUtilisateur'])->name('utilisateurs.delete');
    Route::get('/avis', [AdminController::class, 'avis'])->name('avis');
    Route::delete('/avis/{avis}', [AdminController::class, 'deleteAvis'])->name('avis.delete');
});

require __DIR__ . '/auth.php';
