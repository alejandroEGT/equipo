<?php

Route::post('/notifications', 'NotificationController@index');
Route::post('/markAsRead', 'NotificationController@markAsRead');
Route::get('/gantt/{id}', 'GanttController@get');