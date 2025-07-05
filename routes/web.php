<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ProfileController;
use App\Models\Checkout;
use App\Models\event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get("/",[PageController::class,'home'])->name('home');
Route::post("/request-event",[PageController::class,'request_event'])->name('request_event');
Route::get('/event/{id}',[PageController::class,'event'])->name('event');
Route::get('/category/{slug}',[PageController::class,'category'])->name('category');
Route::get('/compare',[PageController::class,'compare'])->name('compare');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('/khalti-callback',[CheckoutController::class,'khalti_callback'])->name('khalti_callback');

});

Route::get("/checkout/invoice/{id}", function ($id){
    $checkout = Checkout::find($id);
    return view ('checkout.invoice', compact('checkout'));
})->name('invoice');

Route::get('/google/login', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/google/callback', function () {
    $user = Socialite::driver('google')->user();

    $oldUser = User::where('email',$user->email)->first();
    if($oldUser){
        Auth::login($oldUser);
        return redirect('/');
    }
    $newUser = new User();
    $newUser->name = $user->name;
    $newUser->email = $user->email;
    $newUser->password = Hash::make (uniqid());
    $newUser->save();

    Auth::login($newUser);
    return redirect ('/');


});

require __DIR__.'/auth.php';

Route::fallback([PageController::class, 'notFound']);
