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



Route::get('/', function () {
    return view('welcome');
});

Route::get('/user','RoleController@index');
Route::post('/check','RoleController@login');
Route::delete('/delete/{id}', 'RoleController@destroy');


// Route::get('/fdashboard', function () {
//     return view('fdashboard');
// });


Route::get('/napproval', function () {
    return view('napproval');
});


// Route::get('/gigs', function () {
//     return view('gigs');
// });

// Route::get('/cdashboard', function () {
//     return view('cdashboard');
// });


Route::get('/messages', 'ChatController@chat');
Route::post('/send', 'ChatController@send');
Route::post('/saveToSession','ChatController@saveToSession');
Route::post('deleteSession', 'ChatController@deleteSession');
Route::post('/getOldMessage','ChatController@getOldMessage');

Route::get('/check',function(){
	return session('chat');
});
 Route::group(['middleware'=>'freelancer'],function(){

    Route::get('/fdashboard','FreelancerController@index');
  });
Route::get('/freelancer', 'FreelancerController@create');
Route::post('/store', 'FreelancerController@store');
Route::get('/frshow/{id}','FreelancerController@show')->name('freelancer.show');
Route::get('/fdashboard/{id}', 'FreelancerController@mount');
Route::get('/milestones', 'FreelancerController@milestones');
Route::post('/fchecked', 'FreelancerController@fchecked');
Route::group(['middleware'=>'client'],function(){
Route::get('/cdashboard','ClientController@index');
});
Route::get('/client', 'ClientController@create');
Route::post('/cinfo', 'ClientController@store');
Route::get('/gig/{id}','ClientController@approval');


Route::get('/cshow','GigsController@index');
Route::get('/gigs','GigsController@create');

Route::post('/gigstore','GigsController@store');
Route::get('/show/{id}','GigsController@show')->name('gig.show');
Route::get('/gshow/{id}','GigsController@gshow')->name('g.show');
Route::get('/cedit/{id}', 'GigsController@edit');
Route::put('/update/{id}','GigsController@update');
Route::delete('/cdelete/{id}','GigsController@destroy');


Route::get('/fbids', 'BidController@index');

Route::get('/bid/{id}', 'BidController@create');
Route::post('/bids','BidController@store');

Route::get('/bshow', 'BidController@show');
Route::get('/ebid/{id}','BidController@edit');
Route::put('/bupdate/{id}','BidController@update');
Route::delete('/edelete/{id}','BidController@destroy');
Route::get('/fportfolio/{id}','BidController@fportfolio');

Route::get('/todos', 'ChecklistController@index');
Route::get('/todo/create', 'ChecklistController@create');
Route::post('/todo','ChecklistController@store');
Route::post('/checked','ChecklistController@checked');
Route::post('/submit', 'ChecklistController@submit');
Route::delete('/mdelete/{id}','ChecklistController@destroy');
Route::get('/download/{id}','ChecklistController@download');









Route::group(['middleware'=>'freelancer'],function(){

Route::get('/vportfolio','PortfolioController@index');

});
Route::get('/portfolio', 'PortfolioController@create');
Route::post('/details', 'PortfolioController@store');
Route::delete('/pdelete/{id}','PortfolioController@destroy');

Route::post('/search','SearchController@search');
Route::post('/fsearch','SearchController@fsearch');
Route::post('/gsearch','SearchController@gsearch');

// Route::post('/mpesa-callback','PaymentController@callback');
Route::post('/requestpay', 'PaymentController@pay');
// Route::post('/mpesa-confirm', 'PaymentController@confirmPayment');

Route::get('/gigscompleted', 'PDFController@getgigscompleted');
Route::get('/gigsclass','PDFController@gigclassification');
Route::get('/reqcompleted','PDFController@requirementscompleted');
Route::get('/skills', 'PDFController@skillsclassification');


//Route::post('/callback','ConfirmCallbackController@storeResults');


Route::get('/payment', function () {
    return view('payment');
});

Route::get('/completed', function () {
    return view('completed');
});
Route::get('/charts', 'ChartController@index');
Auth::routes();



// Route::resource('gigs', 'GigsController');

// Route::get('/portfolio', 'FreelancerController@create');

Route::get('/mount/{id}', 'FreelancerController@mount');

// Route::group(['middleware'=>'App\Http\Middleware\Approved'],function(){

//     Route::get('/fdashboard',function(){
//         return view('fdashboard');
//     });

// });



// Route::get('/cdashboard', 'ClientController@create');




Route::get('/home', 'HomeController@index')->name('home');

Route::get('{path}','HomeController@index')->where( 'path', '([A-z\d-/_.]+)?' );
