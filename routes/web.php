<?php
use App\Products;

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


$this->get('/', 'FrontController@index');
$this->post('call', 'FrontController@add_call_query');
$this->get('/category/{slug}', 'FrontController@category');
$this->get('/product/{slug}', 'FrontController@product');

$this->get('/card/{product_type}/{slug}',  'FrontController@card');
// Post method choosed for higher security level , not to allow to hack money amount from the url.
$this->post('/card', 'FrontController@licProd_card');
$this->post('/feedback', 'FrontController@add_feedback');
$this->post('/add_order', 'FrontController@add_order');
$this->get('/confirmation', 'FrontController@confirmation');
$this->get('/packages', 'FrontController@packages');
$this->get('/package/{slug}', 'FrontController@package');
$this->get('/license-products', 'FrontController@licenseProducts');
$this->get('/license-product/{slug}', 'FrontController@licenseProduct');

$this->get('/error', 'FrontController@error');
$this->get('/paymentSuccess', 'FrontController@success');
$this->get('/paymentFail', 'FrontController@fail');



Route::get('/check', function() {
    return view('emails.pay_check');
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});



Auth::routes();
Route::group(['prefix' => 'admin'], function() {


    $this->get('/', function () {
        return view('auth.login');
    });

    // Authentication Routes...
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');
//$this->get('register', 'Auth\LoginController@showLoginForm')->name('register');
//$this->post('register', 'Auth\LoginController@showLoginForm');

    $this->get('/stats', 'HomeController@stats')->name('home');


    $this->get('/orders', 'HomeController@orders');
    $this->get('/edit_order/{id}', array('uses' => 'HomeController@edit_order', 'as' => 'edit.order'));
    $this->post('/update_order', array('uses' => 'HomeController@update_order', 'as' => 'update.order'));
    $this->get('/delete_order/{id}', array('uses' => 'HomeController@delete_order', 'as' => 'delete.order'));
    $this->post('/sendDocs', array('uses' => 'HomeController@sendDocs', 'as' => 'sendDocs'));
    $this->post('/sendRoboCheck', array('uses' => 'HomeController@sendRoboCheck', 'as' => 'sendRoboCheck'));

    $this->get('/pages', 'HomeController@pages');
    $this->get('/create_page', array('uses' => 'HomeController@create_page', 'as' => 'create.page'));
    $this->post('/pages', array('uses' => 'HomeController@add_page', 'as' => 'add.page'));
    $this->get('/edit_page/{id}', array('uses' => 'HomeController@edit_page', 'as' => 'edit.page'));
    $this->post('/update_page', array('uses' => 'HomeController@update_page', 'as' => 'update.page'));
    $this->get('/delete_page/{id}', array('uses' => 'HomeController@delete_page', 'as' => 'delete.page'));

    $this->get('/manufacturers', 'HomeController@manufacturers');
    $this->get('/create_manufacturer', array('uses' => 'HomeController@create_manufacturer', 'as' => 'create.manufacturer'));
    $this->post('/manufacturers', array('uses' => 'HomeController@add_manufacturer', 'as' => 'add.manufacturer'));
    $this->get('/edit_manufacturer/{id}', array('uses' => 'HomeController@edit_manufacturer', 'as' => 'edit.manufacturer'));
    $this->post('/update_manufacturer', array('uses' => 'HomeController@update_manufacturer', 'as' => 'update.manufacturer'));
    $this->get('/delete_manufacturer/{id}', array('uses' => 'HomeController@delete_manufacturer', 'as' => 'delete.manufacturer'));


    $this->get('/productGroups', 'HomeController@productGroups');
    $this->get('/create_productGroup', array('uses' => 'HomeController@create_productGroup', 'as' => 'create.productGroup'));
    $this->post('/productGroups', array('uses' => 'HomeController@add_productGroup', 'as' => 'add.productGroup'));
    $this->get('/edit_productGroup/{id}', array('uses' => 'HomeController@edit_productGroup', 'as' => 'edit.productGroup'));
    $this->post('/update_productGroup', array('uses' => 'HomeController@update_productGroup', 'as' => 'update.productGroup'));
    $this->get('/delete_productGroup/{id}', array('uses' => 'HomeController@delete_productGroup', 'as' => 'delete.productGroup'));


    $this->get('/products', 'HomeController@products');
    $this->get('/create_product', array('uses' => 'HomeController@create_product', 'as' => 'create.product'));
    $this->post('/products', array('uses' => 'HomeController@add_products', 'as' => 'add.products'));
    $this->get('/edit_product/{id}', array('uses' => 'HomeController@edit_product', 'as' => 'edit.product'));
    $this->post('/update_product', array('uses' => 'HomeController@update_product', 'as' => 'update.product'));
    $this->get('/delete_product/{id}', array('uses' => 'HomeController@delete_product', 'as' => 'delete.product'));

    $this->get('/delete_image/{id}/{path_name}', array('uses' => 'HomeController@delete_image', 'as' => 'delete.image'));

    $this->get('/license_products', 'HomeController@license_products');
    $this->get('/create_license_product', array('uses' => 'HomeController@create_licenseProducts', 'as' => 'create.licenseProducts'));
    $this->post('/license_products', array('uses' => 'HomeController@add_licenseProducts', 'as' => 'license.products'));
    $this->get('/edit_license_product/{id}', array('uses' => 'HomeController@edit_licenseProduct', 'as' => 'edit.licenseProduct'));
    $this->post('/update_license_product', array('uses' => 'HomeController@update_licenseProduct', 'as' => 'update.licenseProduct'));

    $this->get('/license_packages', 'HomeController@license_packages');
    $this->get('/create_license_package', array('uses' => 'HomeController@create_licensePackages', 'as' => 'create.licensePackage'));
    $this->post('/license_packages', array('uses' => 'HomeController@add_licensePackages', 'as' => 'license.packages'));
    $this->get('/edit_license_package/{id}', array('uses' => 'HomeController@edit_licensePackage', 'as' => 'edit.licensePackage'));
    $this->post('/update_license_package', array('uses' => 'HomeController@update_licensePackage', 'as' => 'update.licensePackage'));
    $this->get('/delete_license_package/{id}', array('uses' => 'HomeController@delete_licensePackage', 'as' => 'delete.licensePackage'));


    $this->get('/call_queries', 'HomeController@call_queries');
    $this->get('/update_call_query/{id}', array('uses' => 'HomeController@update_callQuery', 'as' => 'update.callQuery'));

    $this->get('/feedback', 'HomeController@feedback');
    $this->get('/edit_feedback/{id}', array('uses' => 'HomeController@edit_feedback', 'as' => 'edit.feedback'));
    $this->post('/update_feedback', array('uses' => 'HomeController@update_feedback', 'as' => 'update.feedback'));
    $this->get('/delete_feedback/{id}', array('uses' => 'HomeController@delete_feedback', 'as' => 'delete.feedback'));


    $this->get('/related_products', 'HomeController@related_products');
    $this->get('/create_related_products', array('uses' => 'HomeController@create_relatedProduct', 'as' => 'create.relatedProduct'));
    $this->post('/related_product', array('uses' => 'HomeController@add_relatedProduct', 'as' => 'add.relatedProduct'));
    $this->get('/edit_related_product/{id}', array('uses' => 'HomeController@edit_relatedProduct', 'as' => 'edit.relatedProduct'));
    $this->post('/update_related_product', array('uses' => 'HomeController@update_relatedProduct', 'as' => 'update.relatedProduct'));
    $this->get('/delete_related_product/{id}', array('uses' => 'HomeController@delete_relatedProduct', 'as' => 'delete.relatedProduct'));

    $this->get('/error', 'HomeController@error');


    $this->get('/order_check', 'HomeController@order_check');
    $this->get('/feedback_check', 'HomeController@feedback_check');
    $this->get('/call_check', 'HomeController@call_check');


});