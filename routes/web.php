<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\TouristController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔁 Redirect root to login
Route::get('/', fn () => redirect()->route('login'));

// 🔐 Guest Routes (Login / Register / Forgot Password)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
});

// 🚪 Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// 🏠 Home (Tourist Dashboard)
Route::middleware(['auth'])->get('/home', function () {
    $faqJson = Storage::disk('local')->get('public/data/faq.json');
    $locationsJson = Storage::disk('local')->get('public/data/locations.json');
    $reviewsJson = Storage::disk('local')->get('public/data/reviews.json');

    $faqs = json_decode($faqJson, true);
    $locations = json_decode($locationsJson, true);
    $reviews = json_decode($reviewsJson, true);

    return view('pages.home', compact('faqs', 'locations', 'reviews'));
})->name('home');

// 👤 Profile Management (All roles)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔒 Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Sections
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
    Route::get('/tours/ongoing', [AdminController::class, 'ongoingTours'])->name('admin.ongoingTours');
    Route::get('/tours/canceled', [AdminController::class, 'canceledTours'])->name('admin.canceledTours');
    Route::get('/history', [AdminController::class, 'history'])->name('admin.history');
    Route::get('/revenue', [AdminController::class, 'revenue'])->name('admin.revenue');
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('admin.reviews');
    Route::get('/support', [AdminController::class, 'support'])->name('admin.support');

    // 👥 Manage Users
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users');

    Route::prefix('users')->group(function () {
        // Guide Routes
        Route::get('/guides', [AdminController::class, 'getGuides'])->name('admin.guides');
        Route::post('/guides', [AdminController::class, 'addGuide'])->name('admin.addGuide');
        Route::delete('/guides/{id}', [AdminController::class, 'deleteGuide'])->name('admin.deleteGuide');

        // Tourist Routes
        Route::get('/tourists', [AdminController::class, 'getTourists'])->name('admin.tourists');
        Route::delete('/tourists/{id}', [AdminController::class, 'deleteTourist'])->name('admin.deleteTourist');

        // Stats Count
        Route::get('/guides-count', [AdminController::class, 'getGuideCount']);
        Route::get('/tourists-count', [AdminController::class, 'getTouristCount']);
    });
});

// 🧭 Guide Dashboard
Route::middleware(['auth', 'guide'])->prefix('guide')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('guide.dashboard');
    })->name('guide.dashboard');

    // Profile
    Route::get('/profile', [GuideController::class, 'profile'])->name('guide.profile');
    Route::patch('/profile', [GuideController::class, 'updateProfile'])->name('guide.profile.update');

    // Notifications
    Route::get('/notifications', [GuideController::class, 'notifications'])->name('guide.notifications');

    // Tours (create/view)
    Route::get('/tours', [GuideController::class, 'myTours'])->name('guide.tours');
    Route::get('/tours/create', [GuideController::class, 'createTour'])->name('guide.tours.create');
    Route::post('/tours/store', [GuideController::class, 'storeTour'])->name('guide.tours.store');

    // Bookings
    Route::get('/tours/ongoing', [GuideController::class, 'ongoingTours'])->name('guide.ongoingTours');
    Route::get('/tours/canceled', [GuideController::class, 'canceledTours'])->name('guide.canceledTours');

    // Other sections
    Route::get('/history', [GuideController::class, 'travelHistory'])->name('guide.travelHistory');
    Route::get('/revenue', [GuideController::class, 'revenue'])->name('guide.revenue');
    Route::get('/support', [GuideController::class, 'support'])->name('guide.support');
});

// 🌍 Public Pages
Route::view('/about', 'pages.about')->name('about');
Route::view('/guides', 'pages.guides')->name('guides');
Route::get('/locations', [TouristController::class, 'locationSelection'])->name('locations');



// 🧳 Tourist Routes
Route::middleware(['auth'])->prefix('tourist')->group(function () {
    Route::get('/dashboard', [TouristController::class, 'dashboard'])->name('tourist.dashboard');
    Route::get('/location/{location}/guides', [TouristController::class, 'guidesByLocation'])->name('tourist.guides.byLocation');
    Route::get('/guide/{id}/tours', [TouristController::class, 'viewGuideTours'])->name('tourist.guide.tours');
    Route::get('/tour/{id}/book', [TouristController::class, 'bookForm'])->name('tourist.tour.bookForm');
    Route::post('/tour/{id}/book', [TouristController::class, 'submitBooking'])->name('tourist.tour.submitBooking');

    
    // other tourist booking routes go here soon
});

// 📌 Auth Routes (Sanctum, Password Confirm, Email Verify, etc.)
require __DIR__.'/auth.php';
