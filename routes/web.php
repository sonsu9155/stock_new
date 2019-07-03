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

// Route::get('/', function () {
//     return view('welcome');
// });

use Jenssegers\Agent\Agent;


Route::get('/','HomeController@index')->name('home');
Route::get('/neirong','HomeController@neirong')->name('neirong');
Route::get('/about','HomeController@about')->name('about');
Route::get('/rule','HomeController@rule')->name('rule');
//Route::get('/auth/login','Auth\LoginController@index')->name('login');



Route::get('/super', 'Auth\LoginController@super');

// Session Routes
    Route::get('login', 'SessionsController@login')->name('login');
    Route::post('login', 'SessionsController@doLogin');
    Route::get('logout', 'SessionsController@logout');
    Route::get('forgot_password', 'SessionsController@forgot');
    Route::post('forgot_password', 'SessionsController@doForgot');
    Route::get('password/reset/{token}', 'SessionsController@passwordReset');
    Route::post('password/reset/{token}', 'SessionsController@doPasswordReset');

Route::group(
    ['middleware' => 'auth'], function () {
        Route::get('dashboard', ['uses' => 'DashboardsController@dashboard', 'middleware' => ['role:superadministrator']]);
        Route::get('buyhistory', ['uses' => 'BuyHistoryController@index', 'middleware' => ['role:superadministrator']]);
        Route::get('sellhistory', ['uses' => 'SellHistoryController@index', 'middleware' => ['role:superadministrator']]);
        Route::post('sellhistory/delete/{id}', ['uses' => 'SellHistoryController@delete', 'middleware' => ['role:superadministrator']]);

        Route::get('deposithistory', ['uses' => 'DepositController@index', 'middleware' => ['role:superadministrator']]);
        Route::get('stockgraph', ['uses' => 'StockGraphController@index', 'middleware' => ['role:superadministrator']]);
        
        
        Route::get('users', ['uses' => 'UserController@index', 'middleware' => ['role:superadministrator']]);
        Route::get('users/create', ['uses' => 'UserController@create', 'middleware' => ['role:superadministrator']]);
        Route::post('users/create', ['uses' => 'UserController@docreate', 'middleware' => ['role:superadministrator']]);
        Route::get('users/edit/{id}', ['uses' => 'UserController@edit', 'middleware' => ['role:superadministrator']]);
        Route::post('users/update/{id}', ['uses' => 'UserController@update', 'middleware' => ['role:superadministrator']]);
        Route::post('users/delete/{id}', ['uses' => 'UserController@delete', 'middleware' => ['role:superadministrator']]);
        Route::get('users/detail/{id}', ['uses' => 'UserController@detail', 'middleware' => ['role:superadministrator']]);

        Route::get('moneywallets', ['uses' => 'MoneyWalletsController@index', 'middleware' => ['role:superadministrator']]);
        Route::get('moneywallets/edit', ['uses' => 'MoneyWalletsController@edit', 'middleware' => ['role:superadministrator']]);       
        Route::post('moneywallets/update', ['uses' => 'MoneyWalletsController@update', 'middleware' => ['role:superadministrator']]);
        Route::get('moneywallets/delete/{id}', ['uses' => 'MoneyWalletsController@delete', 'middleware' => ['role:superadministrator']]);
        Route::get('moneywallets/detail', ['uses' => 'MoneyWalletsController@detail', 'middleware' => ['role:superadministrator']]);

        Route::get('withdrawhistory', ['uses' => 'WithdrawController@index', 'middleware' => ['role:superadministrator']]);
        Route::get('withdrawhistory/delete/{id}', ['uses' => 'WithdrawController@delete', 'middleware' => ['role:superadministrator']]);

        Route::get('stocktype', ['uses' => 'StockTypeController@index', 'middleware' => ['role:superadministrator']]);
        Route::get('stocktype/create', ['uses' => 'StockTypeController@create', 'middleware' => ['role:superadministrator']]);
        Route::post('stocktype/create', ['uses' => 'StockTypeController@postCreate', 'middleware' => ['role:superadministrator']]);
        Route::get('stocktype/edit/{id}', ['uses' => 'StockTypeController@edit', 'middleware' => ['role:superadministrator']]);   
        Route::post('stocktype/update/{id}', ['uses' => 'StockTypeController@update', 'middleware' => ['role:superadministrator']]); 
        Route::post('stocktype/delete/{id}', ['uses' => 'StockTypeController@delete', 'middleware' => ['role:superadministrator']]); 

        Route::get('onlineuser', ['uses' => 'OnlineUserController@index', 'middleware' => ['role:superadministrator']]);
        Route::post('onlineuser/delete/{id}', ['uses' => 'OnlineUserController@delete', 'middleware' => ['role:superadministrator']]);

        Route::get('message', ['uses' => 'MessagesController@message', 'middleware' => ['role:superadministrator']]);
        Route::post('message/delete/{id}', ['uses' => 'MessagesController@delete', 'middleware' => ['role:superadministrator']]);

        Route::get('setting', ['uses' => 'SettingController@setting', 'middleware' => ['role:superadministrator']]);
        Route::post('setting/dosetting', ['uses' => 'SettingController@dosetting', 'middleware' => ['role:superadministrator']]);

        Route::get('fundrequest', ['uses' => 'FundRequestController@index', 'middleware' => ['role:superadministrator']]);
        Route::post('fundrequest/delete/{id}', ['uses' => 'FundRequestController@delete', 'middleware' => ['role:superadministrator']]);

        Route::get('news', ['uses' => 'NewsController@index', 'middleware' => ['role:superadministrator']]);
        Route::get('news/create', ['uses' => 'NewsController@create', 'middleware' => ['role:superadministrator']]);
        Route::post('news/create', ['uses' => 'NewsController@postCreate', 'middleware' => ['role:superadministrator']]);
        Route::get('news/edit/{id}', ['uses' => 'NewsController@edit', 'middleware' => ['role:superadministrator']]);   
        Route::post('news/update/{id}', ['uses' => 'NewsController@update', 'middleware' => ['role:superadministrator']]); 
        Route::post('news/delete/{id}', ['uses' => 'NewsController@delete', 'middleware' => ['role:superadministrator']]); 
    }
);

Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'web'], function(){
        $agent = new Agent();
        if($agent->isDesktop()) { 
            Route::get('index', 'WebController@index');
            Route::get('operate', 'WebController@operate');
            Route::get('stockdata','WebController@stockdata');
            Route::get('stock_detail','WebController@stock_detail');
            Route::get('payment','WebController@payment');
            Route::get('payment_log','WebController@payment_log');
            Route::post('pay_page','WebController@pay_page');
            Route::get('selforder','WebController@selforder');
            Route::get('order','WebController@order');
            Route::get('getstock','WebController@getstock');
            Route::get('user','WebController@user');
            Route::get('atm','WebController@atm');
            Route::post('add_atm','WebController@add_atm');
            Route::get('atm_log','WebController@atm_log');
            Route::get('report_day','WebController@report_day');
            Route::get('report_week','WebController@report_week');
            Route::get('trade_detail','WebController@trade_detail');
            Route::get('cancash','WebController@cancash');
            Route::get('atmpwd','WebController@atmpwd');
            Route::post('save_atmpwd','WebController@save_atmpwd');
            Route::get('pwd','WebController@pwd');
            Route::post('save_pwd','WebController@save_pwd');
            Route::get('rules','WebController@rules');
            Route::get('news','WebController@news');
            Route::get('deal','WebController@deal');
        }
    });
});