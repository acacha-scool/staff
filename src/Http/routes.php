<?php

Route::group(['middleware' => 'web'], function () {
    Route::group(['middleware' => 'auth'], function() {
        // Teachers
        Route::get('/teachers/{id}/user',               'TeachersUserController@index');
    });

});

