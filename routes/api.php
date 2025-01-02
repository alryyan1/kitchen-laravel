<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RequestedChildMealController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
Route::post('signup', [AuthController::class, 'signup']);
Route::get('users', [AuthController::class, 'users']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('meals', MealController::class);
Route::apiResource('costs',\App\Http\Controllers\CostController::class);
Route::post('getAllCosts',[\App\Http\Controllers\CostController::class,'getAllCosts']);
Route::apiResource('CostCategories',\App\Http\Controllers\CostCategoryController::class);
Route::apiResource('orderMeals',\App\Http\Controllers\OrderMealsController::class);
Route::post('RequestedChild/{orderMeal}',[RequestedChildMealController::class,'store']);
Route::patch('RequestedChild/{requestedChildMeal}',[RequestedChildMealController::class,'update']);
Route::post('RequestedChildAddAll/{orderMeal}',[RequestedChildMealController::class,'storeAll']);
Route::get('ordersInfoGraphic',[\App\Http\Controllers\OrderMealsController::class,'ordersInfoGraphic']);
Route::apiResource('customers',\App\Http\Controllers\CustomerController::class);
Route::apiResource('mealReservations',\App\Http\Controllers\CustomerController::class);
Route::get('info',[\App\Http\Controllers\CustomerController::class,'info']);
Route::apiResource('reservations', ReservationController::class);
Route::apiResource('childMeals', \App\Http\Controllers\ChildMealController::class);
Route::post('settings',[SettingsController::class,'update']);
Route::get('settings',[SettingsController::class,'index']);
Route::get('services',[\App\Http\Controllers\ServiceController::class,'index']);
Route::get('service/{service}',[\App\Http\Controllers\ServiceController::class,'show']);

Route::patch('services/{service}',[\App\Http\Controllers\ServiceController::class,'update']);
Route::post('services',[\App\Http\Controllers\ServiceController::class,'store']);
Route::post('defineServices/{meal}',[\App\Http\Controllers\ServiceController::class,'defineServices']);
Route::get('categories',[\App\Http\Controllers\CategoryController::class,'index']);
Route::patch('categories/{category}',[\App\Http\Controllers\CategoryController::class,'update']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store']);
});

Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('orders', OrderController::class);

});
Route::post('orderConfirmed/{order}',[OrderController::class,'orderConfirmed']);
Route::post('orders/pagination/{page}',[OrderController::class,'pagination']);
Route::get('orders/pagination/{page}',[OrderController::class,'pagination']);

Route::get('/printSale',[\App\Http\Controllers\PDFController::class,'printSale']);
Route::post('orderMealsStats',[\App\Http\Controllers\OrderController::class,'orderMealsStats']);
Route::post('send/{order}',[\App\Http\Controllers\OrderController::class,'send']);
Route::post('sendMsg/{order}',[\App\Http\Controllers\OrderController::class,'sendMsg']);
Route::post('deposits',[\App\Http\Controllers\DepositController::class,'store']);
Route::post('deducts/{customer}',[\App\Http\Controllers\DeductController::class,'store']);
Route::get('arrival',[\App\Http\Controllers\OrderController::class,'arrival']);
Route::patch('arrival/{order}',[\App\Http\Controllers\OrderController::class,'notify']);

Route::get('orderById/{order}',[OrderController::class,'orderById']);

Route::post('saveImage/{meal}',[MealController::class,'saveImage']);
Route::get('fileNames',[MealController::class,'getFileNamesFromPublicFolder']);
Route::post('sendMsgWa/{order}',[\App\Http\Controllers\WaController::class,'sendMsg']);
Route::post('sendMsgWaLocation/{order}',[\App\Http\Controllers\WaController::class,'sendLocation']);
Route::post('sendMsgWaDocument/{order}',[\App\Http\Controllers\WaController::class,'senDocument']);
Route::middleware('auth:sanctum')-> patch('routes',[UserController::class,'editRoutes']);
Route::middleware('auth:sanctum')-> patch('subRoutes',[UserController::class,'editSubRoutesRoutes']);
Route::middleware('auth:sanctum')-> get('routes',[UserController::class,'routes']);