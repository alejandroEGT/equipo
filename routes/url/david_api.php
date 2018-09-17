<?php

Route::post('insertarTarea', 'davidTareaController@guardarTarea');
Route::get('llenarEstadosTarea', 'davidTareaController@llenarSelect');
Route::post('listarTarea', 'davidTareaController@listarTarea');
