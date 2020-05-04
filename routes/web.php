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
Route::get('/',         'PagesController@home')->name('pages.home');
Route::get('nosotros',  'PagesController@about')->name('pages.about');
Route::get('archivos',  'PagesController@archive')->name('pages.archive');
Route::get('contacto',  'PagesController@contact')->name('pages.contact');

Route::get('blog/{post}',           'BlogController@show')->name('posts.show');;
Route::get('tags/{tag}',            'TagsController@show')->name('tags.show');
Route::get('categorias/{category}', 'CategoriesController@show')->name('categories.show');

Route::get('search', 'PagesController@search')->name('pages.search');

Auth::routes(['register' => false]);

Route::group([
    'prefix'     => 'admin',
    'middleware' => 'auth'],   
function(){    
    Route::get('/',                 'DashboardController@index')->name('dashboard');         
    Route::resource('users',        'UserController',           ['as' => 'admin']);   
    Route::resource('orders',       'OrderController',          ['as' => 'admin']); 
    Route::resource('client',       'ClientRestoreController',  ['as' => 'admin']);
    Route::resource('companies',    'CompanyController',        ['as' => 'admin']);
    Route::resource('posts',        'PostController',           ['except' => 'show', 'as' => 'admin']); 
    Route::resource('roles',        'RolesController',          ['except' => 'show', 'as' => 'admin']); 
    Route::resource('permissions',  'PermissionsController',    ['only'   => ['index', 'create', 'edit', 'update'], 'as' => 'admin']);   
    Route::resource('user',         'UserRestoreController',    ['as' => 'admin']);
    Route::resource('customers',    'ClientController',         ['as' => 'admin']);
    Route::resource('pieces',       'PieceController',          ['except' => 'destroy', 'as' => 'admin']); 
    Route::resource('times',        'TimeController',           ['except' => 'destroy', 'as' => 'admin']); 
    Route::resource('reports',      'ReportController',         ['except' => ['create', 'store', 'update', 'show', 'destroy'], 'as' => 'admin']);
    Route::resource('dashboard',    'DashboardController',      ['except' => ['create', 'store', 'update', 'show', 'destroy'], 'as' => 'admin']);       
  
    Route::get('orders/showOrder/{id}',         'OrderController@showOrder'); 
    Route::get('pieces/showMachine/{id}',       'PieceController@showMachine'); 
    Route::get('pieces/showOrder/{id}',         'PieceController@showOrder');  
    Route::get('times/showMachine/{id}',        'TimeController@showMachine');  

    Route::get('notification/get',              'NotificationController@get');

    Route::get('dashboard/selectOperator',       'DashboardController@selectOperator');
    Route::get('dashboard/selectPieces',         'DashboardController@selectPieces');  
    Route::get('dashboard/getChartPiece/{name}', 'DashboardController@getChartPiece');

    Route::get('dashboard/selectStatus',       'DashboardController@selectStatus');    
    Route::get('dashboard/getChart/{status}',  'DashboardController@getChart');
    Route::get('dashboard/getChartBar',        'DashboardController@getChartBar'); 
    Route::get('dashboard/getChartDoughnut',   'DashboardController@getChartDoughnut');

    Route::get('audits',                'AuditController@index')->name('admin.audits.index');
    Route::get('client/restore/{id}',   'ClientRestoreController@restore')->name('admin.clients.restore');  
    Route::get('user/restore/{id}',     'UserRestoreController@restore')->name('admin.users.restore');  
    
    Route::delete('photos/{photo}',     'PhotosController@destroy')->name('admin.photos.destroy');    
    Route::post('posts/{post}/photos',  'PhotosController@store')->name('admin.posts.photos.store');    
       
});

Route::get('post/table',            'PostController@dataTable')->name('post.table'); 
Route::get('users/table',           'UserController@dataTable')->name('users.table'); 
Route::get('roles/table',           'RolesController@dataTable')->name('roles.table');
Route::get('orders/table',          'OrderController@dataTable')->name('orders.table'); 
Route::get('pieces/table',          'PieceController@dataTable')->name('pieces.table'); 
Route::get('times/table',           'TimeController@dataTable')->name('times.table'); 
Route::get('customers/table',       'ClientController@dataTable')->name('customers.table');
Route::get('permissions/table',     'PermissionsController@dataTable')->name('permissions.table'); 
Route::get('client/restore/table',  'ClientRestoreController@dataTable')->name('client.restore.table'); 
Route::get('user/restore/table',    'UserRestoreController@dataTable')->name('user.restore.table'); 

// Route::get('/{any?}',      'PagesController@spa')->name('pages.home');
// Route::get('reports/selectStatus',      'ReportController@selectStatus');
// Route::get('reports/selectOperator',    'ReportController@selectOperator');
// Route::get('reports/getChart/{status}',   'ReportController@getChart');
// Route::get('dashboard/getOrders',                          'DashboardController@getOrders');
// Route::get('dashboard/getOrders/{user}/{status}/{month}',  'DashboardController@getOrders'); 
