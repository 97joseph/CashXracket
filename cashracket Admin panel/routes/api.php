<?php

use App\Http\Controllers\Api;
use App\Http\Controllers\Api\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::prefix('v1')->name('api.')->group(function () {
    Route::controller(Api\UserController::class)->group(function () {
        Route::post('/sign-up', 'maanRegistration')->name('signup');
        Route::post('/sign-in', 'maanSignIn')->name('signin');
        Route::post('/send-reset-code', [Auth\ForgotPasswordController::class, 'sendResetCode']);
        Route::post('/verify-reset-code', [Auth\ResetPasswordController::class, 'verifyCode']);
        Route::post('/user-password-reset', [Auth\ResetPasswordController::class, 'userResetPassword']);
        Route::post('authentication', [Api\AuthenticationController::class, 'authentication']);
    });
    Route::middleware('auth:sanctum')->group(function () {

        Route::apiResource('videos', Api\VideoController::class);
        Route::apiResource('spins', Api\SpinController::class)->only('index');
        Route::apiResource('watched/videos', Api\VideoWatchedController::class);
        Route::apiResource('earnings', Api\AcnooEarningController::class)->only('index', 'store');

        Route::get('delete/account', [Api\UserController::class, 'deleteAccount']);
        Route::post('complete/profile', [Api\AuthenticationController::class, 'completeProfile']);

        Route::controller(Api\UserController::class)->name('user.')->group(function () {
            Route::get('/sign-out', 'maanSignOut');
            Route::get('/user', 'userInfo')->name('info');
            Route::get('/balance', 'balanceInfo')->name('balance');
            Route::post('/profile-update', 'profileUpdate');
            Route::post('/password-update', 'passwordUpdate');
            //user refresh token ...
            Route::post('/refresh-token', 'userRefreshToken');
        });

        Route::controller(Api\AdminInfoController::class)->group(function () {
            Route::get('/category', 'categoryInfo')->name('category');
            Route::get('/quiz', 'quizInfo')->name('quiz');
            Route::get('/question', 'questionInfo')->name('question');
            Route::get('/rewards', 'rewardInfo')->name('rewards');
            Route::get('/category-quiz', 'categoryWiseQuiz')->name('category.quiz');
            Route::post('/add-point-spin', 'addPointSpin');
            Route::post('/remove-point', 'removePointSpin');
            Route::post('/add-point-quiz', 'addPointQuiz');
            //withdraw api..
            Route::get('/withdraw-method', 'whitdrawMethod');
            Route::post('/withdraw-request', 'withdrawRequest');
            Route::get('/withdraw-history', 'withdrawHistory');
            // currency api ...
            Route::get('/currency-convert', 'currencyConvert');
            //user gain history ...
            Route::get('/user-history', 'userHistory');
            // daily rewards ...
            Route::post('/daily-rewards', 'dailyRewards');
            // daily rewards ...
            Route::post('/daily-rewards', 'dailyRewards');
            //check user quiz ...
            Route::post('/check-user-quiz', 'checkUserQuiz');
            //adnetworks api..
            Route::get('/adnetworks', 'maanAdnetwork');
        });
    });
});