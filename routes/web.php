<?php

use Illuminate\Support\Facades\Route;


Route::get('download-android', function () {
	return '';
	// return response()->download(storage_path('app/files/atp.apk'));
})->name('download-android-apk');


Route::get('/', 'WelcomeController@index');



Route::group(['prefix' => 'admin'] , function () {

	Route::get('login', 'Auth\AdminLoginController@login')->name('admin.auth.login');
	Route::post('login', 'Auth\AdminLoginController@loginAdmin')->name('admin.auth.loginAdmin');
	Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.auth.logout');


	Route::group(['middleware' => ['auth:admin', 'fetch_covid_update' ]], function () {


		Route::get('/profile/update', 'Admin\ProfileController@edit')->name('admin.profile.edit');
		Route::put('/profile/update/account/{id}', 'Admin\ProfileController@updateAccount')->name('admin.profile.update.account');
		Route::put('/profile/update/info/{id}', 'Admin\ProfileController@updateInfo')->name('admin.profile.update.info');

        Route::post('/persons/track/send/sms', 'Admin\TrackController@notify')->name('other.person.notify');
        Route::get('/persons/track/others/{log}', 'Admin\TrackController@track');

        Route::get('/persons/track', 'Admin\TrackController@find');

        Route::resource('track', 'Admin\TrackController');


		Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
		Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

		Route::get('/{id}/print/qr', 'PrintQRController@show')->name('admin.print.qr');

		Route::get('persons/list/{filter}', 'Admin\PersonnelController@list')->name('persons.list');

		Route::resource('personnel', 'Admin\PersonnelController');

        Route::get('/personnel/{id}/logs', 'Admin\PersonnelLogController@show')->name('personnel.logs');
        Route::put('/personnel/{id}/logs', 'Admin\PersonnelLogController@update')->name('personnel.logs.update');

		Route::get('list/barangay', 'Admin\BarangayController@list');
		Route::resource('barangay', 'Admin\BarangayController');

		Route::get('province/list', 'Admin\ProvinceController@list');
		Route::resource('province', 'Admin\ProvinceController');

		Route::get('/list/city', 'Admin\CityController@list')->name('city.list');
		Route::resource('city', 'Admin\CityController');

		Route::resource('municipal-account', 'Admin\MunicipalAccountController');


		Route::resource('/checker', 'Admin\CheckerController');

		Route::get('/establishment/list', 'Admin\EstablishmentController@list');
        Route::resource('establishment', 'Admin\EstablishmentController');
        Route::put('/establishment/{id}/edit', 'Admin\EstablishmentController@update')->name('establishment.edit');

		Route::get('/accounts/administrator', 'Admin\AccountController@index')->name('administrator.index');
		Route::get('/accounts/administrator/create', 'Admin\AccountController@create')->name('administrator.create');
		Route::post('/accounts/administrator/create', 'Admin\AccountController@store')->name('administrator.store');
		Route::get('/accounts/administrator/{admin}/edit', 'Admin\AccountController@edit')->name('administrator.edit');
		Route::put('/accounts/administrator/{admin}/edit', 'Admin\AccountController@update')->name('administrator.update');

		Route::resource('user', 'Admin\UserController');
        Route::resource('request', 'Admin\RequestUpdateController');

	});

});


Route::group(['prefix' => 'municipal'] , function () {
	Route::get('/', 'Municipal\DashboardController@index')->name('municipal.dashboard');
    Route::get('dashboard', 'Municipal\DashboardController@index')->name('municipal.dashboard');
	Route::get('login', 'Auth\MunicipalLoginController@login')->name('municipal.auth.login');
	Route::post('login', 'Auth\MunicipalLoginController@loginMunicipal')->name('municipal.auth.loginMunicipal');
    Route::post('logout', 'Auth\MunicipalLoginController@logout')->name('municipal.auth.logout');

		Route::group(['middleware' => 'auth:municipal'], function () {

            Route::get('update/profile', 'Municipal\UpdateProfileController@edit')->name('account.edit');
            Route::post('update/profile', 'Municipal\UpdateProfileController@update')->name('account.update');
			Route::get('people/list/{filter}', 'Municipal\PersonnelController@list')->name('municipal-people-list');

            Route::get('/modification/request/{person}', 'Municipal\PersonnelController@request')->name('modification.request');
            Route::put('/modification/request/{person}/update', 'Municipal\PersonnelController@submitToAdmin')->name('request.to.admin');

            Route::resource('municipal-personnel', 'Municipal\PersonnelController');

            Route::get('person/logs/{id}', 'Municipal\PersonLogController@show')->name('municipal.personnel.logs');

			Route::get('/{id}/print/qr', 'PrintQRController@show')->name('municipal.print.qr');

            Route::get('list/province', 'Municipal\ProvinceController@list')->name('m-province.list');
            Route::get('/m-province', 'Municipal\ProvinceController@index')->name('m-province.index');

            Route::get('barangay/list', 'Municipal\BarangayController@list');
            Route::get('barangay', 'Municipal\BarangayController@index')->name('m-barangay.index');


            Route::get('/people/track', 'Municipal\TrackController@find');
            Route::get('/track/people', 'Municipal\TrackController@index')->name('people.track.index');
            Route::get('/track/people/{id}', 'Municipal\TrackController@show')->name('people.track.show');
            Route::get('/track/others/{log}', 'Municipal\TrackController@track');
            Route::post('/track/send/sms', 'Municipal\TrackController@notify')->name('notify.others');

            Route::get('/m-city/list', 'Municipal\CityController@list')->name('city.list');
            Route::get('/m-cities', 'Municipal\CityController@index')->name('m-city.index');

			Route::resource('m-checker', 'Municipal\CheckerController');

            Route::get('/m-establishment/list', 'Municipal\EstablishmentController@list')->name('municipal.establishment.list');
			Route::resource('m-establishment', 'Municipal\EstablishmentController');
		});

	});







Auth::routes();
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
Route::group(['middleware' => ['auth']], function () {
		Route::group(['middleware' => 'update.done'], function () {
			Route::get('/my/profile', 'UpdateProfileController@edit')->name('user.update.profile');
			Route::put('/my/profile', 'UpdateProfileController@update')->name('user.update.profile.submit');
		});


	Route::group(['middleware' => 'check.update.profile'], function () {
		Route::get('/home', 'HomeController@index')->name('home');
		Route::get('/my/id', 'QRController@index')->name('user-id');
        Route::get('/setting', 'LoginCredentialsController@edit')->name('user.account.edit');
        Route::put('/setting', 'LoginCredentialsController@update')->name('user.account.update');
	});

});
