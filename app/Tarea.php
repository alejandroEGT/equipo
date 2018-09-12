<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = "tarea";
    protected function insertar($d){
    	$this->nombre = $d->nombre;
    	$this->fecha_inicio = date('Y-m-d', strtotime($d->calendario[0]));
    	$this->fecha_fin = date('Y-m-d', strtotime($d->calendario[1]));
    	$this->horas_estimadas = $d->horas;
    	$this->id_proyecto = $d->idProyecto;
    	$this->id_user = $d->idUser;
    	$this->estado = $d->estadoProyecto;

    	if($this->save()){
    		return 'success';
    	}
    }
    protected function actualizar($d){

    }
    protected function eliminar($d){

    }
    protected function listar($d){
    	return $this->where
    	([
	    	'id_user' => $d->idUser,
	    	'id_proyecto' => $d->idProyecto,
    	])->get();
    }
}
