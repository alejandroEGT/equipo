<?php

namespace App\Http\Controllers;

use App\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class davidTareaController extends Controller {
    public function guardarTarea(Request $datos) {

        //dd($datos->all());

        return Tarea::insertar($datos);

    }

    public function llenarSelect() {
        return DB::table('estado_tarea')->get();
    }

    public function listarTarea(Request $d) {
        //dd($d->idProyecto);
        return Tarea::listar($d);
    }

}
