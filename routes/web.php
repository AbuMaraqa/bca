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
        Route::group(['prefix'=>'freezing_subscription'],function (){
            Route::post('add_freezing_subscription', [App\Http\Controllers\ClientsController::class, 'add_freezing_subscription'])->name('clients.freezing_subscription.add_freezing_subscription');
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
        Route::get('edit/{id}', [App\Http\Controllers\ProductsController::class, 'edit'])->name('product.edit');
        Route::post('update', [App\Http\Controllers\ProductsController::class, 'update'])->name('product.update');
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
    Route::group(['prefix'=>'program'],function (){
        Route::group(['prefix'=>'program_category'],function (){
            Route::get('index', [App\Http\Controllers\ProgramCategoryController::class, 'index'])->name('program.program_category.index');
            Route::post('list_program_category', [App\Http\Controllers\ProgramCategoryController::class, 'list_program_category'])->name('program.program_category.list_program_category');
            Route::post('create', [App\Http\Controllers\ProgramCategoryController::class, 'create'])->name('program.program_category.create');
            Route::get('add', [App\Http\Controllers\ProgramCategoryController::class, 'add'])->name('program.program_category.add');
            Route::get('edit/{id}', [App\Http\Controllers\ProgramCategoryController::class, 'edit'])->name('program.program_category.edit');
            Route::post('update', [App\Http\Controllers\ProgramCategoryController::class, 'update'])->name('program.program_category.update');
        });
        Route::group(['prefix'=>'meal_type'],function (){
            Route::get('index', [App\Http\Controllers\MealTypeController::class, 'index'])->name('program.meal_type.index');
            Route::post('list_meal_type', [App\Http\Controllers\MealTypeController::class, 'list_meal_type'])->name('program.meal_type.list_meal_type');
            Route::post('create', [App\Http\Controllers\MealTypeController::class, 'create'])->name('program.meal_type.create');
            Route::get('add', [App\Http\Controllers\MealTypeController::class, 'add'])->name('program.meal_type.add');
            Route::get('edit/{id}', [App\Http\Controllers\MealTypeController::class, 'edit'])->name('program.meal_type.edit');
            Route::post('update', [App\Http\Controllers\MealTypeController::class, 'update'])->name('program.meal_type.update');
        }); 
        Route::group(['prefix'=>'instructions'],function (){
            Route::get('index', [App\Http\Controllers\InstructionsController::class, 'index'])->name('program.instructions.index');
            Route::post('list_instructions', [App\Http\Controllers\InstructionsController::class, 'list_instructions'])->name('program.instructions.list_instructions');
            Route::post('create', [App\Http\Controllers\InstructionsController::class, 'create'])->name('program.instructions.create');
            Route::get('add', [App\Http\Controllers\InstructionsController::class, 'add'])->name('program.instructions.add');
            Route::get('edit/{id}', [App\Http\Controllers\InstructionsController::class, 'edit'])->name('program.instructions.edit');
            Route::post('update', [App\Http\Controllers\InstructionsController::class, 'update'])->name('program.instructions.update');
        });
        Route::group(['prefix'=>'program'],function (){
            Route::get('index', [App\Http\Controllers\ProgramController::class, 'index'])->name('program.program.index');
            Route::post('list_programs', [App\Http\Controllers\ProgramController::class, 'list_programs_ajax'])->name('program.program.list_programs');
            Route::post('create', [App\Http\Controllers\ProgramController::class, 'create'])->name('program.program.create');
            Route::get('add', [App\Http\Controllers\ProgramController::class, 'add'])->name('program.program.add');
            Route::get('edit/{id}', [App\Http\Controllers\ProgramController::class, 'edit'])->name('program.program.edit');
            Route::post('update', [App\Http\Controllers\ProgramController::class, 'update'])->name('program.program.update');
            Route::group(['prefix'=>'program_meal'],function (){
                Route::get('index/{program_id}', [App\Http\Controllers\ProgramMealController::class, 'index'])->name('program.program_meal.index');
                Route::post('list_programs', [App\Http\Controllers\ProgramMealController::class, 'program_meal_list'])->name('program.program_meal.program_meal_list');
                Route::post('meal_type_list', [App\Http\Controllers\ProgramMealController::class, 'meal_type_list'])->name('program.program_meal.meal_type_list');
                Route::post('add_meal_type_for_program', [App\Http\Controllers\ProgramMealController::class, 'add_meal_type_for_program'])->name('program.program_meal.add_meal_type_for_program');
                Route::post('program_meal_suplement', [App\Http\Controllers\ProgramMealController::class, 'program_meal_suplement'])->name('program.program_meal.program_meal_suplement');
                Route::post('add_supplement_for_meal_type', [App\Http\Controllers\ProgramMealController::class, 'add_supplement_for_meal_type'])->name('program.program_meal.add_supplement_for_meal_type');
            });
        }); 
    });
    Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/migrate', function(){
        \Illuminate\Support\Facades\Artisan::call('migrate');
        dd('migrated!');
    });

});

