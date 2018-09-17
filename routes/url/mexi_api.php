<?php

Route::post('/notifications', 'NotificationController@index');
Route::post('/markAsRead', 'NotificationController@markAsRead');