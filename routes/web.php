<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomAuthentiocatedSessionController;
use App\Http\Livewire\Blogs\BlogsForm;
use App\Http\Livewire\Blogs\BlogsShow;
use App\Http\Livewire\Category\CategoryForm;
use App\Http\Livewire\Category\CategoryShow;
use App\Http\Livewire\ContactUs\ContactUsForm;
use App\Http\Livewire\ContactUs\ContactUsShow;
use App\Http\Livewire\Gallery\GalleryShow;
use App\Http\Livewire\Products\ProductForm;
use App\Http\Livewire\Products\ProductShow;
use App\Http\Livewire\Projects\ProjectsForm;
use App\Http\Livewire\Projects\ShowProjects;
use App\Http\Livewire\Services\ServicesForm;
use App\Http\Livewire\Services\ServicesShow;
use App\Http\Livewire\Settings\SettingsShow;
use App\Http\Livewire\Shipping\ShippingShow;
use App\Http\Livewire\Users\Users;
use Illuminate\Support\Facades\Route;

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

Route::get('index', [Controller::class, 'index']);
Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(
    [
        'middleware' => [
            'verified',
        ],
    ], function () {

    Route::get('/', fn() => redirect()->route('admin.blog'));
    //Users
    Route::get('/users', Users::class)->name('admin.users');
    Route::get('/user/edit', Users::class)->name('admin.users.edit');
    Route::get('/user/delete', Users::class)->name('admin.users.delete');
    Route::get('/user/create', Users::class)->name('admin.users.create');

    //Blogs
    Route::get('/news', BlogsShow::class)->name('admin.blog');
    Route::get('/news/form/{blogId?}', BlogsForm::class)->name('admin.blog.form');
    //Projects
    Route::get('/projects', ShowProjects::class)->name('admin.projects');
    Route::get('/projects/form/{projectId?}', ProjectsForm::class)->name('admin.project.form');
    //Services
    Route::get('/services', ServicesShow::class)->name('admin.service');
    Route::get('/services/form/{projectId?}', ServicesForm::class)->name('admin.service.form');

    //Contact us
    Route::get('/leads', ContactUsShow::class)->name('admin.contact_us');
    Route::get('/leads/form/{leadId?}', ContactUsForm::class)->name('admin.contact_us.form');

    //Settings
    Route::get('/settings', SettingsShow::class)->name('admin.settings');

    //Shipping
    Route::get('/shipping-details', ShippingShow::class)->name('admin.shipping');

    //Category
    Route::get('/categories', CategoryShow::class)->name('admin.category');
    Route::get('/categories/form/{categoryId?}', CategoryForm::class)->name('admin.category.form');

    //Product
    Route::get('/products', ProductShow::class)->name('admin.product');
    Route::get('/products/form/{productId?}', ProductForm::class)->name('admin.product.form');

    Route::get('/Gallery', GalleryShow::class)->name('admin.gallery');

});

$limiter = config('fortify.limiters.login');

Route::post('/login', [CustomAuthentiocatedSessionController::class, 'store'])
    ->middleware(array_filter([
        'guest:' . config('fortify.guard'),
        $limiter ? 'throttle:' . $limiter : null,
    ]));
