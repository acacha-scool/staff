<?php

Route::group(['middleware' => 'web'], function () {
    // Teachers
    Route::get('/teachers/{id}/user',               'TeachersUserController@index');
});

