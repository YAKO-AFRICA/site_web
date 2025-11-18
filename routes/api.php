<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspaceClient\OTPController;
use App\Http\Controllers\EspaceClient\RdvController;
use App\Http\Controllers\Sinistre\SinistreController;
use App\Http\Controllers\EspaceClient\CustomerController;
use App\Http\Controllers\EspaceClient\CustomerLoginController;
use App\Http\Controllers\EspaceClient\DemandePrestationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// // Groupe de routes protégées par le middleware 'auth:customer' et 'PreventBackHistory'
// Route::middleware(['auth:customer', 'PreventBackHistory'])->group(function () {
//     // Route pour récupérer les détails d'un contrat
//     Route::post('/fetch-contract-details', [CustomerController::class, 'fetchContractDetails'])
//         ->name('fetch.contract.details');
// });
// Exemple d'une route publique si vous souhaitez tester sans authentification
Route::post('/fetch-contract-details', [CustomerController::class, 'fetchContractDetails'])
    ->name('fetch.contract.details');

    
Route::post('/getPrestations', [DemandePrestationController::class, 'getPrestations'])->name('getPrestations');
Route::post('/generate-etat-cotisation', [CustomerController::class, 'generateEtatCotisationApi']);
Route::post('/get-cp', [CustomerController::class, 'getPolice']);
Route::get('/getPrestationsDoc/{idPrestation}', [DemandePrestationController::class, 'getPrestationsDoc']);
Route::get('/getSinistreDoc/{idSinistre}', [SinistreController::class, 'getSinistreDoc']);
Route::get('/getDemandeCompteDoc/{idDemandeCompte}', [CustomerLoginController::class, 'getDemandeCompteDoc']);
Route::post('/getRdv', [RdvController::class, 'getRdv'])->name('getRdv');
Route::post('/send-otpByOrangeAPI', [OTPController::class, 'sendOtpByOrangeAPI']);
Route::post('/send-otpByInfobipAPI', [OTPController::class, 'sendOtpByInfobipAPI']);
Route::post('/verify-otp', [OTPController::class, 'verifyOtp']);
Route::middleware('web')->group(function () {
    Route::get('/check-auth', function (Request $request) {
        return response()->json(['authenticated' => Auth::guard('customer')->check()]);
    });
});


// api sinistre

Route::post('/check-contrat', [SinistreController::class, 'checkContrat']);
Route::post('/get-sinistre', [SinistreController::class, 'getSinistre']);
