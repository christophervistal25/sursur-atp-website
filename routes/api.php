<?php
use Illuminate\Support\Facades\Route;

Route::post('/checker/login', 'Api\CheckerController@login');
Route::post('/checker/register', 'Api\CheckerController@register');
Route::get('/checker/{id}/qr/scanned', 'Api\CheckerController@countQRScanned');

Route::post('/person/scanned/', 'Api\PersonLogController@scanned');
Route::post('/bulk/person/log', 'Api\PersonLogController@addMultiple');

Route::post('/person/login', 'Api\PersonnelController@login');
Route::post('/person/id/generate', 'Api\PersonnelController@make');
Route::post('/person/register', 'Api\PersonnelController@register');

Route::get('/person/{id}/profile', 'Api\PersonnelController@show');

Route::get('/person/temperature', 'Api\PersonnelChartController@temperature');
Route::get('/municipal/analytics/{id}', 'Api\PersonnelChartController@municipalAnalytics');


// Routes for cities and barangays.
Route::get('/provinces', 'Api\ProvinceController@province');
Route::get('/municipals', 'Api\MunicipalController@city');
Route::get('/barangay', 'Api\BarangayController@barangay');

Route::get('/province/municipal/{province_code}', 'Api\ProvinceController@municipals');
Route::get('/province/barangay/{province_code}', 'Api\ProvinceController@barangays');

Route::get('/municipal/filter/{name}', 'Api\MunicipalController@filterByName');
Route::get('/municipal/list', 'Api\MunicipalController@list');


Route::get('/notify/people', 'Api\NotifyController@message');
Route::post('/sms/message/done', 'Api\NotifyController@messageDone');

// Surigao del Sur stat
Route::get('surigao/sur/covid/stat', 'Api\SurigaoStatController@data');



// Municipal Personnel Create upload image
Route::post('/from/webcam/upload/image', 'Municipal\WebcamController@upload');