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
        //Teachers
        Route::get('/teachers',                         'TeachersController@index');

        //Vacancies
        Route::get('/vacancies',                        'VacanciesController@index');
        Route::post('/vacancies',                       'VacanciesController@store');
        Route::patch('/vacancies/{id}',                 'VacanciesController@update');
        Route::put('/vacancies/{id}',                   'VacanciesController@update');
        Route::delete('/vacancies/{id}',                'VacanciesController@destroy');
    });
});
