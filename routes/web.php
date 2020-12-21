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
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    return "Cache is cleared";
});

Route::get('/','Auth\LoginController@showLoginForm');

Route::get('new_registration/{id}/{status}/{type}','AttendeeController@attendee');

Route::get('/registergroup/{id}/{status}/{type}','RegisterController@registergroup');
Route::get('/showdata','RegisterController@showdata');
Route::get('/edit_regis/{id}','RegisterController@edit_regis');
Route::post('/AddRegister','RegisterController@AddRegister');
Route::get('/DeleteRegister/{id}','RegisterController@DeleteRegister');
Route::put('/UpdateRegister','RegisterController@UpdateRegister');
Route::get('/thankyou', 'RegisterController@thankyou');
Route::post('registrat_storage', 'RegisterController@storageform');
Route::resource('registrat', 'RegisterController');
Route::post('/Registration', 'RegisterController@showregistergroup');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard','Homecontroller@dashboard');
    Route::post('/changeproject', 'ProjectController@changeproject');
    Route::get('/selectproject', function () {
        return view('backoffice.selectproject');
    });

    Route::resource('tempalte', 'TempalteController');

    // Route::get('/agenda/{id}','TempalteController@formagenda');
    // Route::post('/addagenda','TempalteController@addagenda');
    // Route::delete('/delagenda/{id}','TempalteController@delagenda');

    Route::resource('input', 'InputController');

    Route::resource('project', 'ProjectController');

    Route::resource('event', 'EventController');

    Route::resource('eventtemplate', 'AttendeeController');
    Route::post('showdateandttime','AttendeeController@showdateandttime');
    Route::get('showdateandttime','AttendeeController@showlist');
    Route::post('showcolor','AttendeeController@showcolor');
    Route::post('showlink','AttendeeController@showlink');
    Route::get('CreateBG/{id}','AttendeeController@CreateBG');
    Route::post('AddBG','AttendeeController@AddBG');
    Route::put('EditBG','AttendeeController@EditBG');


    Route::resource('country', 'CountryController');

    Route::resource('typeperson', 'TypePersonalController');

    Route::resource('registered', 'RegisteredController');
    Route::post('deleteregister', 'RegisteredController@deleteregister');

    Route::get('PrintBadge/{id}', 'RegisteredController@PrintBadge');
    Route::get('PrintGala/{id}', 'RegisteredController@PrintGala');

    Route::post('uploadimport', 'RegisteredController@upload');
    Route::post('UploadUpdate', 'RegisteredController@UploadUpdate');
    Route::get('CreateForm/{id}', 'RegisteredController@createform');
    Route::get('showlist/{id}', 'RegisteredController@showlist');
    Route::get('checkread/{id}', 'RegisteredController@checkread');

    Route::resource('ticket', 'TicketController');
    // Route::post('Addticket', 'TicketController@Addticket');


    Route::resource('badge', 'BadgeController');
    Route::get('PreviewBadge', 'BadgeController@PreviewBadge');

    Route::resource('agenda', 'AgendaController');

    Route::resource('email', 'MailController');

    Route::resource('checkin', 'CheckInController');
    Route::get('CheckPoint/{event}/{id}', 'CheckInController@checkin');
    Route::get('CheckInMan/{id}/{event}/{status}', 'CheckInController@checkinman');
    Route::post('resendmail', 'CheckInController@resendmail');

    Route::resource('gala', 'GalaDinnerController');

    Route::resource('seatplanning', 'SeatPlanningController');
    Route::post('addseat', 'SeatPlanningController@addseat');
    Route::get('updateseat/{no}/{x}/{y}', 'SeatPlanningController@updateseat');
    Route::post('addseat_register', 'SeatPlanningController@addseat_register');
    Route::get('setsession/{no}', 'SeatPlanningController@setsession');
    Route::get('AddRegisterSeat/{no}', 'SeatPlanningController@AddRegisterSeat');
    Route::post('sorting_seat', 'SeatPlanningController@sorting_seat');
    Route::get('deletetable/{id}', 'SeatPlanningController@deletetable');
    Route::get('editseat/{id}', 'SeatPlanningController@editseat');
    Route::get('updateseat2/{id}/{limit}/{name}', 'SeatPlanningController@updateseat2');
    Route::get('deleteseat/{id}/{seat}', 'SeatPlanningController@deleteseat');

    Route::get('ShowRegister', 'ShowDataController@ShowRegister');
    Route::get('ShowCheckIn/{id}', 'ShowDataController@ShowCheckIn');
    Route::get('ShowNotCheckIn/{id}', 'ShowDataController@ShowNotCheckIn');
    Route::get('ShowTypePersonal/{id}', 'ShowDataController@ShowTypePersonal');
    Route::get('ShowLink/{id}', 'ShowDataController@ShowLink');
    Route::get('ShowEvent/{id}', 'ShowDataController@ShowEvent');
});

Route::get('ViewPDF/{id}', 'TicketController@showPDF');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
