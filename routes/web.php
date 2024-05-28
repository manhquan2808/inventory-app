<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AddEmployee;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\employee_prod\CheckDetail;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScanController;
use Livewire\Livewire;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
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

// Login Routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('request-reset', function () {
    return view('auth.request_reset');
})->name('request.reset.form');

Route::post('request-reset', [ResetPasswordController::class, 'sendOtp'])->name('request.reset');
Route::get('verify-otp', [ResetPasswordController::class, 'showVerifyOtpForm'])->name('verify.otp.form');
Route::post('verify-otp', [ResetPasswordController::class, 'verifyOtp'])->name('verify.otp');
Route::get('reset-password', [ResetPasswordController::class, 'showResetForm'])->name('reset.form');
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('reset.password');

// ADMIN
Route::group(['prefix' => 'admin', "middleware" => "admin"], function () {


    Route::get('/chat', [ChatController::class, 'index'])->name('admin.chat');
    Route::get('messages/{employee_id}', [ChatController::class, 'getMessages']);
    Route::post('broadcast', [ChatController::class, 'broadcast']);
    Route::post('receive', [ChatController::class, 'receive']);

    Route::get('/dashboard', [App\Http\Controllers\admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [App\Http\Controllers\admin\ProfileController::class, 'index'])->name('admin.profile');
    Route::get('reset-password', [App\Http\Controllers\admin\ResetPasswordController::class, 'index'])->name('reset.form');
    Route::post('reset-password', [App\Http\Controllers\admin\ResetPasswordController::class, 'resetPassword'])->name('reset.password');

    Route::get('/addEmployee', [App\Http\Controllers\admin\AddEmployee::class, 'showAddEmployee'])->name('admin.addEmployee');
    Route::post('/addEmployee', [App\Http\Controllers\admin\AddEmployee::class, 'addEmployee'])->name('admin.addEmployee.submit');

    Route::get('/addAdmin', [App\Http\Controllers\admin\AddAdmin::class, 'showAddAdmin'])->name('admin.addAdmin');
    Route::post('/addAdmin', [App\Http\Controllers\admin\AddAdmin::class, 'addAdmin'])->name('admin.addAdmin.submit');

    Route::get('/addManager', [App\Http\Controllers\admin\AddManager::class, 'showAddManager'])->name('admin.addManager');
    Route::post('/addManager', [App\Http\Controllers\admin\AddManager::class, 'addManager'])->name('admin.addManager.submit');


    // Route::get('/addSupplier', [App\Http\Controllers\admin\AddSupplier::class, 'showAddSupplier'])->name('admin.addSupplier');
    // Route::post('/addSupplier', [App\Http\Controllers\admin\AddSupplier::class, 'addSupplier'])->name('admin.addSupplier.submit');

    Route::get('/addProduction', [App\Http\Controllers\admin\AddProduction::class, 'showAddProduction'])->name('admin.addProduction');
    Route::post('/addProduction', [App\Http\Controllers\admin\AddProduction::class, 'addProduction'])->name('admin.addProduction.submit');

    // Route để hiển thị trang có bảng danh sách nhân viên
    Route::get('/accounts', [App\Http\Controllers\admin\EmployeesController::class, 'index'])->name('admin.employee');

    // Route để xử lý AJAX requests cho dữ liệu nhân viên
    // Route::get('/employees/data', [EmployeesController::class, 'data'])->name('admin.employee.data');

    Route::get('/role', [App\Http\Controllers\admin\RoleController::class, 'showRole'])->name('admin.role');
    Livewire::component('/role', \App\Http\Livewire\RoleDatatable::class);

    Route::get('/inventory', [App\Http\Controllers\admin\InventoryController::class, 'index'])->name('admin.inventory');

});



// Material Manager
Route::group(['prefix' => 'material-management', "middleware" => "material"], function () {

    Route::get('/chat', [ChatController::class, 'index'])->name('material-management.chat');
    Route::get('messages/{employee_id}', [ChatController::class, 'getMessages']);
    Route::post('broadcast', [ChatController::class, 'broadcast']);
    Route::post('receive', [ChatController::class, 'receive']);
    Route::get("/dashboard", [App\Http\Controllers\material\DashboardController::class, "index"])->name("material-management.dashboard");

    Route::get("/materials", [App\Http\Controllers\material\MaterialController::class, "index"])->name("material-management.materials");

    Route::get("/receive", [App\Http\Controllers\material\ReceiveRequire::class, "index"])->name('material-management.receive');

    Route::get("/inventory", [App\Http\Controllers\material\InventoryController::class, "index"])->name('material-management.inventory');

    Route::get("/require", [App\Http\Controllers\material\RequireMaterial::class, "index"])->name('material-management.require');
    Route::post("/require", [App\Http\Controllers\material\RequireMaterial::class, "requireMaterial"])->name('material-management.submit');


    Route::get("/requirelist", [App\Http\Controllers\material\TableRequire::class, "index"])->name('material-management.requirelist');
    Route::get("/profile", [App\Http\Controllers\material\ProfileController::class, "index"])->name("material-management.profile");


});

// Product Manager
Route::group(['prefix' => 'product-management', "middleware" => "product"], function () {
    Route::get("/dashboard", [App\Http\Controllers\product\DashboardController::class, "index"])->name("product-management.dashboard");

    Route::get("/products", [App\Http\Controllers\product\ProductsController::class, "index"])->name("product-management.products");

    Route::get("/require", [App\Http\Controllers\product\RequireProdution::class, "index"])->name("product-management.require");
    Route::post("/require", [App\Http\Controllers\product\RequireProdution::class, "requireProdution"])->name("product-management.submit");

    Route::get("/requirelist", [App\Http\Controllers\product\TableRequire::class, "index"])->name("product-management.requirelist");
    Route::get("/inventory", [App\Http\Controllers\product\InventoryController::class, "index"])->name('product-management.inventory');

    Route::get('/chat', [ChatController::class, 'index'])->name('product-management.chat');
    Route::get('messages/{employee_id}', [ChatController::class, 'getMessages']);
    Route::post('broadcast', [ChatController::class, 'broadcast']);
    Route::post('receive', [ChatController::class, 'receive']);

    Route::get("/profile", [App\Http\Controllers\product\ProfileController::class, "index"])->name("product-management.profile");


});


// Material Employee 
Route::group(['prefix' => 'employee', "middleware" => "employee"], function () {
    Route::get("/", [App\Http\Controllers\Employee\DashboardController::class, "index"])->name("employee");

    // EMPLOYEE CHECK
    Route::get('/material/accept/{id}', [App\Http\Controllers\Employee\CheckController::class, 'accept'])->name('employee.check.accept');
    // Route::get('/material/return/{id}', [App\Http\Controllers\Employee\CheckController::class, 'return'])->name('employee.check.return');

    Route::get("materialList", [App\Http\Controllers\Employee\MaterialList::class, "index"])->name("employee.materialList");

    Route::get('/chat', [ChatController::class, 'index'])->name('employee.chat');
    Route::get('messages/{employee_id}', [ChatController::class, 'getMessages']);
    Route::post('broadcast', [ChatController::class, 'broadcast']);
    Route::post('receive', [ChatController::class, 'receive']);


});

// Product Employee 
Route::group(['prefix' => 'employee_prod', "middleware" => "employee_prod"], function () {
    Route::get("/", [App\Http\Controllers\employee_prod\DashboardController::class, "index"])->name("employee_prod");
    Route::get("/product/accept/{id}", [App\Http\Controllers\employee_prod\CheckController::class, "accept"])->name("employee_prod.accept");
    Route::get("productList", [App\Http\Controllers\employee_prod\ProductList::class, "index"])->name("employee_prod.productList");

    Route::get("/product/{product_id}/{index}", [App\Http\Controllers\employee_prod\CheckDetail::class, "index"])->name("employee_prod.detail");
    Route::post('/product/accept/{product_id}/{sequence}', [App\Http\Controllers\employee_prod\CheckDetail::class, 'accept'])->name('inventory.accept');
    Route::post('/product/reject/{product_id}/{sequence}', [App\Http\Controllers\employee_prod\CheckDetail::class, 'reject'])->name('inventory.reject');
    
    Route::get('/chat', [ChatController::class, 'index'])->name('employee_prod.chat');
    Route::get('messages/{employee_id}', [ChatController::class, 'getMessages']);
    Route::post('broadcast', [ChatController::class, 'broadcast']);
    Route::post('receive', [ChatController::class, 'receive']);
});

// Production
Route::group(['prefix' => 'production', "middleware" => "production"], function () {
    Route::get("/", [App\Http\Controllers\production\DashboardController::class, "index"])->name("production");
    Route::get("/producing", [App\Http\Controllers\production\Producing::class, "index"])->name("production.producing");
    Route::get("/completed", [App\Http\Controllers\production\Completed::class, "index"])->name("production.completed");
    Route::get('completed/{id}', [App\Http\Controllers\production\CompletedDetail::class, 'index'])->name('production.completedDetail');
    Route::get('/return', [App\Http\Controllers\production\ReturnController::class, 'index'])->name('production.return');
    
    Route::get('/chat', [ChatController::class, 'index'])->name('production.chat');
    Route::get('messages/{employee_id}', [ChatController::class, 'getMessages']);
    Route::post('broadcast', [ChatController::class, 'broadcast']);
    Route::post('receive', [ChatController::class, 'receive']);
});



// Supplier
Route::group(['prefix' => 'supp', "middleware" => "supp"], function () {
    Route::get("/dashboard", [App\Http\Controllers\supp\DashboardController::class, "index"])->name("supp.dashboard");

    Route::get("/require", [App\Http\Controllers\supp\RequireController::class, "index"])->name("supp.require");
    Route::get("/accepted", [App\Http\Controllers\supp\AcceptedController::class, "index"])->name("supp.accepted");

    

});



// Route::get('chat', [ChatController::class, 'index']);
// Route::post('broadcast', [ChatController::class, 'broadcast']);
// Route::post('receive', [ChatController::class, 'receive']);
