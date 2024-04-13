<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Customers_ReportController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\Invoices_ReportController;
use App\Http\Controllers\InvoicesArchiveController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use Mcamara\LaravelLocalization\LaravelLocalization;

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


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('/login', function () {
        // return view('welcome');
        return view('auth.login');
    });

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'invoices'], function () {

        Route::get('index', [InvoicesController::class, 'index'])->name('invoices.index');
        Route::get('show', [InvoicesController::class, 'show'])->name('invoices.show');
        Route::post('create', [InvoicesController::class, 'create'])->name('invoices.create');
        Route::get('edit/{id}', [InvoicesController::class, 'edit'])->name('invoices.edit');
        Route::post('update/{id}', [InvoicesController::class, 'update'])->name('invoices.update');
        Route::get('showStatus/{id}', [InvoicesController::class, 'showStatus'])->name('invoices.showStatus');
        Route::post('updateStatus/{id}', [InvoicesController::class, 'updateStatus'])->name('invoices.updateStatus');
        Route::get('delete/{id}', [InvoicesController::class, 'delete'])->name('invoices.delete');
        Route::get('paid', [InvoicesController::class, 'paid'])->name('invoices.paid');
        Route::get('unpaid', [InvoicesController::class, 'unpaid'])->name('invoices.unpaid');
        Route::get('partial', [InvoicesController::class, 'partial'])->name('invoices.partial');
        Route::get('archive/{id}', [InvoicesController::class, 'archive'])->name('invoices.archive');
        Route::get('showPrint/{id}', [InvoicesController::class, 'showPrint'])->name('invoices.showPrint');
        Route::get('MarkAsRead_all', [InvoicesController::class, 'MarkAsRead_all'])->name('invoices.MarkAsRead_all');
    });


    Route::group(['prefix' => 'invoices_details'], function () {
        Route::get('/download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'get_file'])->name('invoices_details.download');
        Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file'])->name('invoices_details.View_file');
        Route::post('delete_file', [InvoicesDetailsController::class, 'destroy'])->name('invoices_details.delete_file');
    });

    Route::group(['prefix' => 'invoice_attachments'], function () {
        Route::post('create', [InvoiceAttachmentsController::class, 'create'])->name('invoice_attachments.create');
    });

    Route::group(['prefix' => 'Archive'], function () {
        Route::get('index', [InvoicesArchiveController::class, 'index'])->name('Archive.index');
        Route::get('transfer/{id}', [InvoicesArchiveController::class, 'transfer'])->name('Archive.transfer');
        Route::get('delete/{id}', [InvoicesArchiveController::class, 'delete'])->name('Archive.delete');
    });

    Route::group(['prefix' => 'invoices_report'], function () {
        Route::get('index', [Invoices_ReportController::class, 'index'])->name('invoices_report.index');
        Route::get('search', [Invoices_ReportController::class, 'search'])->name('invoices_report.search');
    });

    Route::group(['prefix' => 'customers_report'], function () {
        Route::get('index', [Customers_ReportController::class, 'index'])->name('customers_report.index');
        Route::get('search', [Customers_ReportController::class, 'search'])->name('customers_report.search');
    });

    Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);
    Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class, 'edit'])->name('InvoicesDetails');


    Route::group(['prefix' => 'sections'], function () {

        Route::get('index', [SectionsController::class, 'index'])->name('sections.index');
        Route::get('show', [SectionsController::class, 'show'])->name('sections.show');
        Route::get('create', [SectionsController::class, 'create'])->name('sections.create');
        Route::get('edit/{id}', [SectionsController::class, 'edit'])->name('sections.edit');
        Route::post('update/{id}', [SectionsController::class, 'update'])->name('sections.update');
        Route::get('delete/{id}', [SectionsController::class, 'delete'])->name('sections.delete');
    });

    Route::group(['prefix' => 'products'], function () {

        Route::get('index', [ProductsController::class, 'index'])->name('products.index');
        Route::get('show', [ProductsController::class, 'show'])->name('products.show');
        Route::get('create', [ProductsController::class, 'create'])->name('products.create');
        Route::get('edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
        Route::post('update/{id}', [ProductsController::class, 'update'])->name('products.update');
        Route::get('delete/{id}', [ProductsController::class, 'delete'])->name('products.delete');
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    });


    Route::group(['middleware' => ['auth']], function () {
        Route::resource('roles', RoleController::class);
        // Route::resource('users', UserController::class);

        Route::group(['prefix' => 'users'], function () {
            Route::get('index', [UserController::class, 'index'])->name('users.index');
            Route::get('create', [UserController::class, 'create'])->name('users.create');
            Route::post('store', [UserController::class, 'store'])->name('users.store');
            Route::get('show/{id}', [UserController::class, 'show'])->name('users.show');
            Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
            Route::post('update/{id}', [UserController::class, 'update'])->name('users.update');
            Route::post('destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        });
    });


    Route::post('/addimage', [App\Http\Controllers\AddImageController::class, 'update'])->name('addimage.update');


    Route::get('/{page}', [AdminController::class, 'index']);
});
