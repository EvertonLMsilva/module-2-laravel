<?php

use App\Enums\SignatureStatus;
use App\Models\Plan;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignatureController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', [SignatureController::class, "index"]);

Route::get('/test1', function () {
    $plan = Plan::create([
        "name" => 'Last Plan',
        "short_description" => 'A terrible plan',
        "price" => 2990,
    ]);

    $client = Auth::user()->client()->create([
        'document' => "00020202002",
        'birthdate' => '1990-12-23'
    ]);

    dd(SignatureStatus::ACTIVED->value);

    $client->signatures()->create([
        'plan_id' => $plan->id,
        'status' => SignatureStatus::SUSPENDED,
    ]);

    return "hey";
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
