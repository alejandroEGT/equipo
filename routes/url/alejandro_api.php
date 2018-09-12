<?php 

// Route::get('route', function(){
	
// });

 Route::resource('proyecto','proyectoController');
 Route::get('contar_colaborador/{id_proyecto}','ColaboradorController@contar_by_proyecto');
 Route::get('todos_colaboradores/{id_proyecto}','ColaboradorController@todos_colaboradores');
 Route::get('mis_colaboradores/{id_proyecto}','ColaboradorController@mis_colaboradores');
 Route::post('agregar_colaborador','ColaboradorController@agregar_colaboradores');
 Route::post('cambiar_estado_proyecto','proyectoController@cambiar_estado_proyecto');
 Route::post('quitar_colaborador','ColaboradorController@quitar_colaborador');