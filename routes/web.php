<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root to login page
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
});

// Logout Route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Home Page (Tourists)
Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $faqJson = Storage::disk('local')->get('public/data/faq.json');
        $locationsJson = Storage::disk('local')->get('public/data/locations.json');
        $reviewsJson = Storage::disk('local')->get('public/data/reviews.json');

        $faqs = json_decode($faqJson, true);
        $locations = json_decode($locationsJson, true);
        $reviews = json_decode($reviewsJson, true);

        return view('pages.home', compact('faqs', 'locations', 'reviews'));
    })->name('home');
});

// Admin Dashboard (Admins only)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Sections
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
    Route::get('/tours/ongoing', [AdminController::class, 'ongoingTours'])->name('admin.ongoingTours');
    Route::get('/tours/canceled', [AdminController::class, 'canceledTours'])->name('admin.canceledTours');
    Route::get('/history', [AdminController::class, 'history'])->name('admin.history');
    Route::get('/revenue', [AdminController::class, 'revenue'])->name('admin.revenue');
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('admin.reviews');
    Route::get('/support', [AdminController::class, 'support'])->name('admin.support');

    // User Management
    Route::get('/users/guides', [AdminController::class, 'getGuides'])->name('admin.guides');
    Route::post('/users/guides', [AdminController::class, 'addGuide'])->name('admin.addGuide');
    Route::delete('/users/guides/{id}', [AdminController::class, 'deleteGuide'])->name('admin.deleteGuide');

    Route::get('/users/tourists', [AdminController::class, 'getTourists'])->name('admin.tourists');
    Route::delete('/users/tourists/{id}', [AdminController::class, 'deleteTourist'])->name('admin.deleteTourist');

    //count on manage users
    Route::get('/users/guides-count', [AdminController::class, 'getGuideCount']);
    Route::get('/users/tourists-count', [AdminController::class, 'getTouristCount']);
    

});

// Guide Dashboard (Guides only)
Route::middleware(['auth', 'guide'])->prefix('guide')->group(function () {
    Route::get('/dashboard', function () {
        return view('guide.dashboard');
    })->name('guide.dashboard');
});

// Public Pages
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/guides', function () {
    return view('pages.guides');
})->name('guides');

Route::get('/locations', function () {
    return view('pages.locations');
})->name('locations');

//edit profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
