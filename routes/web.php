<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['prefix'=>'users'],function (){
        Route::get('index', [App\Http\Controllers\UsersController::class, 'index'])->name('users.index');
        Route::post('users_table_ajax', [App\Http\Controllers\UsersController::class, 'users_table_ajax'])->name('users.users_table_ajax');
        Route::post('create', [App\Http\Controllers\UsersController::class, 'create'])->name('users.create');
        Route::post('update', [App\Http\Controllers\UsersController::class, 'update'])->name('users.update');
        Route::post('update_status', [App\Http\Controllers\UsersController::class, 'update_status'])->name('users.update_status');
    });
    Route::group(['prefix'=>'clients'],function (){
        Route::get('index', [App\Http\Controllers\ClientsController::class, 'index'])->name('clients.index');
        Route::get('add', [App\Http\Controllers\ClientsController::class, 'add'])->name('clients.add');
        Route::post('create', [App\Http\Controllers\ClientsController::class, 'create'])->name('clients.create');
        Route::get('edit/{id}', [App\Http\Controllers\ClientsController::class, 'edit'])->name('clients.edit');
        Route::post('update', [App\Http\Controllers\ClientsController::class, 'update'])->name('clients.update');
        Route::post('list_clients_ajax', [App\Http\Controllers\ClientsController::class, 'list_clients_ajax'])->name('clients.list_clients_ajax');
        Route::group(['prefix'=>'customers_debt'],function (){
            Route::get('index/{client_id}', [App\Http\Controllers\CustomerDebtController::class, 'index'])->name('customers_debt.index');
            Route::get('add/{client_id}', [App\Http\Controllers\CustomerDebtController::class, 'add'])->name('customers_debt.add');
            Route::post('create', [App\Http\Controllers\CustomerDebtController::class, 'create'])->name('customers_debt.create');
            Route::get('delete/{id}', [App\Http\Controllers\CustomerDebtController::class, 'delete'])->name('customers_debt.delete');
        });
        Route::group(['prefix'=>'subscriptions'],function (){
            Route::get('index/{client_id}', [App\Http\Controllers\SubscriptionsClientController::class, 'index'])->name('clients.subscriptions.index');
            Route::get('add/{client_id}', [App\Http\Controllers\SubscriptionsClientController::class, 'add'])->name('clients.subscriptions.add');
            Route::post('create', [App\Http\Controllers\SubscriptionsClientController::class, 'create'])->name('clients.subscriptions.create');
        });
    });
    Route::group(['prefix'=>'category'],function (){
        Route::get('index', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
        Route::post('create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
        Route::get('edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
        Route::post('update', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
    });
    Route::group(['prefix'=>'product'],function (){
        Route::get('index', [App\Http\Controllers\ProductsController::class, 'index'])->name('product.index');
        Route::post('list_products_ajax', [App\Http\Controllers\ProductsController::class, 'list_products_ajax'])->name('product.list_products_ajax');
        Route::get('add', [App\Http\Controllers\ProductsController::class, 'add'])->name('product.add');
        Route::post('create', [App\Http\Controllers\ProductsController::class, 'create'])->name('product.create');
    });
    Route::group(['prefix'=>'subscriptions'],function (){
        Route::get('index', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions.index');
        Route::get('add', [App\Http\Controllers\SubscriptionController::class, 'add'])->name('subscriptions.add');
        Route::post('create', [App\Http\Controllers\SubscriptionController::class, 'create'])->name('subscriptions.create');
        Route::get('edit/{id}', [App\Http\Controllers\SubscriptionController::class, 'edit'])->name('subscriptions.edit');
        Route::put('update', [App\Http\Controllers\SubscriptionController::class, 'update'])->name('subscriptions.update');
    });
    Route::group(['prefix'=>'rooms'],function (){
        Route::get('index', [App\Http\Controllers\RoomsControllers::class, 'index'])->name('rooms.index');
        Route::get('add', [App\Http\Controllers\RoomsControllers::class, 'add'])->name('rooms.add');
        Route::post('create', [App\Http\Controllers\RoomsControllers::class, 'create'])->name('rooms.create');
        Route::get('edit/{id}', [App\Http\Controllers\RoomsControllers::class, 'edit'])->name('rooms.edit');
        Route::post('update', [App\Http\Controllers\RoomsControllers::class, 'update'])->name('rooms.update');
    });
    Route::group(['prefix'=>'reception'],function (){
        Route::get('index', [App\Http\Controllers\ReceptionController::class, 'index'])->name('reception.index');
        Route::get('room/{id}', [App\Http\Controllers\ReceptionController::class, 'room'])->name('reception.room');
        Route::get('add_appointment/{room_id}', [App\Http\Controllers\ReceptionController::class, 'add_appointment'])->name('reception.add_appointment');
        Route::post('create_appointment', [App\Http\Controllers\ReceptionController::class, 'create_appointment'])->name('supplements.create_appointment');
    });
    Route::group(['prefix'=>'supplements'],function (){
        Route::get('index', [App\Http\Controllers\SupplementsController::class, 'index'])->name('supplements.index');
        Route::post('create', [App\Http\Controllers\SupplementsController::class, 'create'])->name('supplements.create');
        Route::get('add', [App\Http\Controllers\SupplementsController::class, 'add'])->name('supplements.add');
        Route::get('edit/{id}', [App\Http\Controllers\SupplementsController::class, 'edit'])->name('supplements.edit');
        Route::post('update', [App\Http\Controllers\SupplementsController::class, 'update'])->name('supplements.update');
    });
    Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/migrate', function(){
        \Illuminate\Support\Facades\Artisan::call('migrate');
        dd('migrated!');
    });

});

