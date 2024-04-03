<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BlogsController;
use App\Http\Controllers\Api\PricesController;
use App\Http\Controllers\Api\BookingsController;
use App\Http\Controllers\Api\ContactsController;
use App\Http\Controllers\Api\BlogStateController;
use App\Http\Controllers\Api\TripsController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\SightseeingController;
use App\Http\Controllers\Api\SightseeingPriceController;
use App\Http\Controllers\Api\TripsPriceController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\Api\AdditionalInfoController;
use App\Http\Controllers\Api\DiscountsController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\UserTypesController;
use App\Http\Controllers\Api\ServiceablesController;
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
//Create Group of Routes with Auth Token
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    //API Resources convert all CRUD Function of the Controller to CRUD Routes
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/bookings', BookingsController::class);
    Route::apiResource('/cars', CarsController::class);
    Route::apiResource('/blogs', BlogsController::class);
    Route::apiResource('/blog_states', BlogStateController::class);
    Route::apiResource('/contacts', ContactsController::class);
    Route::apiResource('/prices', PricesController::class);
    Route::apiResource('/payment_methods', PaymentMethodController::class);
    Route::apiResource('/sightseeings', SightseeingController::class);
    Route::apiResource('/sightseeings_price', SightseeingPriceController::class);
    Route::apiResource('/trips', TripsController::class);
    Route::apiResource('/trips_prices', TripsPriceController::class);
    Route::apiResource('/categories', CategoriesController::class);
    Route::apiResource('/services', ServicesController::class);
    Route::apiResource('/additional_info', AdditionalInfoController::class);
    Route::apiResource('/discounts', DiscountsController::class);
    Route::apiResource('/payments', PaymentController::class);
    Route::apiResource('/user_types', UserTypesController::class);
    Route::apiResource('/servicables', ServiceablesController::class);

});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/confirm-email', [AuthController::class, 'confirmEmail']);
Route::post('/confirm-code', [AuthController::class, 'confirmCode']);
Route::get('/trips_filters', [TripsController::class,'index']);
Route::get('/all_trip_prices', [TripsPriceController::class,'index']);
Route::get('/cars_filters', [CarsController::class,'index']);
Route::get('/all_payment_methods', [PaymentMethodController::class,'index']);
Route::get('/all_sightseeings', [SightseeingController::class,'index']);
Route::get('/all_sightseeings_prices', [SightseeingPriceController::class,'index']);
Route::get('/all_categories', [CategoriesController::class,'index']);
Route::get('/all_services', [ServicesController::class,'index']);
Route::get('/all_additional_info', [AdditionalInfoController::class,'index']);
Route::get('/all_contacts', [ContactsController::class,'index']);
Route::get('/all_discounts', [DiscountsController::class,'index']);
Route::get('/all_payments', [PaymentController::class,'index']);
Route::get('/all_user_types', [UserTypesController::class,'index']);
Route::get('/all_servicables', [ServiceablesController::class,'index']);
Route::get('/all_bookings', [BookingsController::class,'index']);