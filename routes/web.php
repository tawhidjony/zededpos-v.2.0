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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    try {
        DB::connection()->getPdo();
//        echo "Connected successfully to: " . DB::connection()->getDatabaseName();

    Route::get('/update-password', 'HomeController@changePasswordForm')->name('edit-password');
    Route::put('/update-password', 'HomeController@updatePassword');
    Route::get('account', 'AccountController@show');
    Route::put('account/{id}', 'AccountController@update');


    Route::get('/products/category', 'PosController@allPorduct');
    Route::get('/products/subcategory', 'PosController@subcatPorduct');
    Route::get('/products/details', 'PosController@getProductDetails');
    Route::get('/products/quantitycheck', 'PosController@quantityCheck');
    Route::get('/products/pricecheck', 'PosController@PriceCheck');
    Route::post('/products/sale', 'PosController@sale')->name('product.sell');

    Route::group(['middleware' => 'check_permission'], function () {


        Route::get('/', 'DashboardController@index')->name('/');
        //customer
        Route::get('/customer', 'CustomerController@customers')->name('customer');
        Route::resource('customers','CustomerController');
        //Category
        Route::get('categories','CategoryController@category')->name('categories.index');
        Route::resource('category','CategoryController');
        Route::resource('sub_category','SubCategoryController');
        Route::resource('pro_models','ProModelController');
        Route::resource('pro_brands','BrandController');
        Route::resource('chilTag','ChildTagController');
        //Product
        Route::get('product','ProductController@product')->name('product.home');
        Route::get('getproducts','ProductController@getEmptyProducts')->name('empty.product');
        Route::resource('products','ProductController');
        Route::resource('suppliers','SupplierController');
        Route::resource('units','UnitController');
        //Due Purchase
        Route::get('purchases','PurchaseController@home')->name('purchases.home');
        Route::get('purchase/due','DuePurchaseController@DueIndex')->name('purchase.due');
        Route::get('purchase/edit/{id}','DuePurchaseController@DueEdit')->name('purchase.dueEdit');
        Route::post('purchase/update/{purchase}','DuePurchaseController@DueUpdate')->name('purchase.DueUpdate');
        //Purchase
        Route::resource('purchase','PurchaseController');

        //Pos
        Route::get('pos','PosController@home')->name('pos.home');
        Route::get('all/sell','PosController@allSell')->name('sell.index');
        Route::delete('destroy/{id}','PosController@deleteSell')->name('sell.destroy');
        Route::get('pos/create','PosController@Create')->name('pos.create');
        Route::get('/product-search','PosController@getProductByNameKeyword')->name('product.search');
        Route::get('show/invoice/{id}','PosController@showInvoice')->name('invoice.show');
        Route::get('pdf/invoice/{id}','PosController@PdfInvoice')->name('invoice.pdf');
        //add new invoice Pos
        Route::resource('new_invoices','AddnewinvoiceController');
        Route::post('/new/invoice', 'AddnewinvoiceController@NewInvoice')->name('new.invoice');
        //return Product Pos
        Route::get('return/product','ReturnProductController@HomeIndex')->name('return.index');
        Route::post('return/product/new','ReturnProductController@edit')->name('return.edit');
        Route::POST('return-invoice','ReturnProductController@ReturnStore')->name('return.product');

        //Wastage
        Route::get('wastage','WastageController@wastage')->name('wastage.home');
        Route::resource('wastages','WastageController');
        //Expense
        Route::get('expense','ExpenseController@expense')->name('expense.home');
        Route::resource('expenses','ExpenseController');

        //Report route are here
        Route::get('report','ReportController@home')->name('report.home');

        Route::get('/sale-report','ReportController@saleReport')->name('sale.report');
        Route::get('/report-purchase','ReportController@purchase')->name('purchase.report');
        Route::get('/due-report','ReportController@dueReport')->name('due.report');
        Route::get('/supplier-report','ReportController@SupplierReport')->name('supplier.report');
        Route::get('/customer-report','ReportController@customerReport')->name('customer.report');

        // Setting Route are here
        Route::resource('roles', 'RoleController');
        Route::resource('Users', 'UserController');
        Route::get('/setting', 'SettingController@setting')->name('module_setting.home');
        Route::resource('settings', 'SettingController');
        Route::get('/invoice_setting/{id}', 'InvoiceSettingController@Invoiceedit')->name('invoice.setting');
        Route::post('/invoice_update/{id}', 'InvoiceSettingController@invoice_update')->name('invoice.update');

    });
    } catch (\Exception $e) {
        return view('welcome');
//        return redirect()->back();
    }
});
