<?php

namespace App;

use App\Colaborador;
use App\Notifications\NewTaskStatusNotification;
use App\Tarea;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model {
    protected $table = "tarea";

    protected function insertar($d) {
        $this->nombre          = $d->nombre;
        $this->fecha_inicio    = date('Y-m-d', strtotime($d->calendario[0]));
        $this->fecha_fin       = date('Y-m-d', strtotime($d->calendario[1]));
        $this->horas_estimadas = $d->horas;
        $this->id_proyecto     = $d->idProyecto;
        $this->id_user         = $d->idUser;
        $this->estado          = $d->estadoProyecto;

        if ($this->save()) {
            $task       = Tarea::all()->last();
            $findColabs = Colaborador::where('id_proyecto', $task->id_proyecto)->get();

            for ($i = 0; $i < count($findColabs); $i++) {
                $user[$i] = User::find($findColabs[$i]->id_user);
                $user[$i]->notify(new NewTaskStatusNotification($task));
            }

            return 'success';
        }
    }
    protected function actualizar($d) {

    }
    protected function eliminar($d) {

    }
    protected function listar($d) {
        return $this->where
        ([
            'id_user'     => $d->idUser,
            'id_proyecto' => $d->idProyecto,
        ])->get();
        //return $this->where('id_proyecto', $d->idProyecto)->get();
    }
}
