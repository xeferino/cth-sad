<?php

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

Route::get('/', function () {
    return redirect('login');
});
Route::get('/reset/password', 'Auth\LoginController@showLoginFormReset')->name('reset');
Route::post('/password', 'Auth\LoginController@resetPassword')->name('password');
Route::get('/password/recovery', 'Auth\LoginController@showLoginFormRecover')->name('recovery.get');
Route::post('/password/recovery', 'Auth\LoginController@recoverPassword')->name('recovery.post');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::resource('/users', 'UserController');
Route::put('/users/profile/{user}', 'UserController@profile');
Route::resource('/customers', 'CustomerController');
Route::get('/polls/all', 'PollController@all');
Route::get('/polls/customer/pdf/{poll}/{period}/{customer}/{pollster}', 'PollController@pdfPollCustomer')->name('polls.pdf.customer');
Route::resource('/polls', 'PollController');
Route::resource('/sections', 'SectionController');
Route::resource('/questions', 'QuestionController');
Route::get('/questions/options/{option}', 'QuestionController@getShowQuestionOption');
Route::get('/questions/options/items/{option}', 'QuestionController@getShowQuestionOptionItem');
Route::post('/questions/options/store', 'QuestionController@storeQuestionOption');
Route::post('/questions/update', 'QuestionController@updateQuestion');
Route::post('/questions/delete', 'QuestionController@deleteQuestion');
Route::get('/routes/all', 'RouteController@all');
Route::get('/routes/cantons', 'RouteController@cantons')->name('routes.cantons');
Route::resource('/routes', 'RouteController');
Route::resource('/cantons', 'CantonController');
Route::post('/assignments/cantons/customer/pollster/route', 'AssignmentController@routeCustomerPoll')->name('assignments.route');
Route::get('/assignments/route/canton/{canton}', 'AssignmentController@routesCanton');
Route::resource('/assignments', 'AssignmentController');
Route::resource('/openings', 'OpeningController');
Route::get('/tabs/pdf/indexes', 'TabController@tabPollCantonIndexes')->name('tabs.pdf.index');
Route::get('/tabs/pdf/questions', 'TabController@tabPollCantonQuestion')->name('tabs.pdf.question');
Route::post('/tabs/history/period/canton/customer', 'TabController@tabHistory')->name('tabs.history');
Route::get('/tabs/test/{poll}/{canton}', 'TabController@test');
Route::get('/tabs/single', 'TabController@reportSingle')->name('tabs.single');
Route::get('/tabs/question', 'TabController@forQuestion')->name('tabs.question');
Route::get('/tabs/indexes', 'TabController@index')->name('tabs.index');
