<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\AccessoriesController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\DailyExpenseController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\WorkController;
use App\Models\DailyExpense;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('students', [\App\Http\Controllers\Admin\EmployeeController::class, 'index']);
Route::get('students/list', [\App\Http\Controllers\Admin\EmployeeController::class, 'getStudents'])->name('students.list');
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    // Login Routes...
    Route::get('/', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('login');

    // Registration Routes...
    Route::get('register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'register'])->name('register');

    // Logout Routes...
    Route::post('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

    // Password Reset Routes...
    Route::get('password/reset', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

    // Password Verify Routes...
    Route::get('email/verify', [App\Http\Controllers\Admin\Auth\VerificationController::class, 'show'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [App\Http\Controllers\Admin\Auth\VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [App\Http\Controllers\Admin\Auth\VerificationController::class, 'resend'])->name('verification.resend');

    // Password Confirmation Routes...
    Route::get('/password/confirm', [App\Http\Controllers\Admin\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('/password/confirm', [App\Http\Controllers\Admin\Auth\ConfirmPasswordController::class, 'confirm'])->name('password.confirm');

    Route::group(
        ['middleware' => ['auth:admins']],
        function () {
            Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
            Route::get('dashboards', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

            Route::get('blank-page', [App\Http\Controllers\Admin\DashboardController::class, 'blankPage'])->name('blank-page');
            Route::get('employee/salary/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'salary'])->name('employee.salary');
            Route::post('order/status/{id}', [App\Http\Controllers\Admin\OrderController::class, 'orderStatus'])->name('order.status.update');
            Route::post('online/order/status/{id}', [App\Http\Controllers\Admin\OnlineOrderController::class, 'orderStatus'])->name('onlineOrder.status.update');


            Route::resources([
                'category' => App\Http\Controllers\Admin\CategoryController::class,
                'user' => App\Http\Controllers\Admin\UserController::class,
                'subCategory' => App\Http\Controllers\Admin\SubCategoryController::class,
                'order' => App\Http\Controllers\Admin\OrderController::class,
                'onlineOrder' => App\Http\Controllers\Admin\OnlineOrderController::class,
                'product' => App\Http\Controllers\Admin\ProductController::class,
                'supplier' => App\Http\Controllers\Admin\SupplierController::class,
                'loss' => App\Http\Controllers\Admin\LossController::class,
                'sale' => App\Http\Controllers\Admin\SaleController::class,
                'purchase' => App\Http\Controllers\Admin\PurchaseController::class,
                'customer' => App\Http\Controllers\Admin\CustomerController::class,
                'unit' => App\Http\Controllers\Admin\UnitController::class,
                'employee' => App\Http\Controllers\Admin\EmployeeController::class,
                'recipe' => App\Http\Controllers\Admin\RecipeController::class,
                'dailyExpense' => DailyExpenseController::class,
                'inventory' => InventoryController::class,
                'contract' => ContractController::class,
                'work' => WorkController::class,
                'chat'=>\App\Http\Controllers\Admin\ChatController::class,
                'accessories'=>AccessoriesController::class
            ]);

        }
    );

});

//Auth::routes(['verify' => true]);
Route::group([], function () {

    Route::get('login', [App\Http\Controllers\Front\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\Front\Auth\LoginController::class, 'login'])->name('login');
    Route::get('register', [App\Http\Controllers\Front\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [App\Http\Controllers\Front\Auth\RegisterController::class, 'register'])->name('register');
    Route::post('logout', [App\Http\Controllers\Front\Auth\LoginController::class, 'logout'])->name('logout');

    // Password Reset Routes...
    Route::get('password/reset', [App\Http\Controllers\Front\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [App\Http\Controllers\Front\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [App\Http\Controllers\Front\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [App\Http\Controllers\Front\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

    // Password Confirmation Routes...
    Route::get('email/verify', [App\Http\Controllers\Front\Auth\VerificationController::class, 'show'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [App\Http\Controllers\Front\Auth\VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [App\Http\Controllers\Front\Auth\VerificationController::class, 'resend'])->name('verification.resend');

    Route::get('/password/confirm', [App\Http\Controllers\Front\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('/password/confirm', [App\Http\Controllers\Front\Auth\ConfirmPasswordController::class, 'confirm'])->name('password.confirm');

    Route::get('/', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');
    Route::group(
     ['as' => 'front.'],
        function () {
        Route::get('/calculate', [App\Http\Controllers\Front\CalculateController::class, 'index'])->name('calculate.index');
        Route::post('/calculate/watt', [App\Http\Controllers\Front\CalculateController::class, 'calculateWatt'])->name('calculate.watt');
        Route::post('/calculate/product', [App\Http\Controllers\Front\CalculateController::class, 'suggestProduct'])->name('calculate.product');
        Route::get('product', [App\Http\Controllers\Front\HomeController::class, 'showProduct'])->name('product.show');
        Route::get('home', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');
            Route::group(
               [ 'middleware' => ['auth', 'verified']],
                function () {
                        Route::get('myCart', [App\Http\Controllers\Front\HomeController::class, 'showCart'])->name('cart.show');
                        Route::get('Order', [App\Http\Controllers\Front\HomeController::class, 'showOrder'])->name('order.show');
                        Route::get('addCart/product/{id}', [App\Http\Controllers\Front\HomeController::class, 'addCart'])->name('product.cart.add');
                        Route::get('removeCart/product/{id}', [App\Http\Controllers\Front\HomeController::class, 'removeCart'])->name('product.cart.remove');
                        Route::post('addCart/product', [App\Http\Controllers\Front\HomeController::class, 'addToCart'])->name('product.cart.addTo');
                        Route::get('product/order', [App\Http\Controllers\Front\HomeController::class, 'order'])->name('product.order');
                        Route::get('show/productDetail/{id}', [App\Http\Controllers\Front\HomeController::class, 'productDetail'])->name('product.detail');
                        Route::post('cart/update', [App\Http\Controllers\Front\HomeController::class, 'updateQuantity'])->name('update.quantity');
                        Route::get('feedback/{id}',[\App\Http\Controllers\Front\HomeController::class,'productFeedback'])->name('product.feedback');
                    Route::post('send/feedback/{id}',[\App\Http\Controllers\Front\HomeController::class,'sendFeedback'])->name('feedback.send');
                        Route::group(
                            ['middleware' => ['password.confirm']],
                            function () {
                                            Route::get('paypal', [App\Http\Controllers\Front\DashboardController::class, 'testPage'])->name('paypal');
                                        }
                        );
                    }
            );
        }
    );
});
