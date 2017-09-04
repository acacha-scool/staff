<?php

Route::group(['middleware' => 'web'], function () {
    Route::group(['middleware' => 'auth'], function() {
        // Teachers
        Route::get('/management/teachers/wizard',               'TeachersWizardController@index');

        //TODO
        Route::get('/teachers/{id}/user',                       'TeachersUserController@index');
    });

});

Route::group(['middleware' => 'api','prefix' => 'api/v1', 'middleware' => 'throttle'], function () {
    Route::group(['middleware' => 'auth:api'], function() {
        //USERS
        Route::get('/teachers',                         'TeachersController@index');
    });
});
