<?php

namespace App\Http\Controllers;

use App\Tarea;

class GanttController extends Controller {
    public function get($id) {

        $tasks = Tarea::select([
            'tarea.id', 'tarea.nombre as text', 'tarea.fecha_inicio as start_date', 'tarea.fecha_fin as end_date', 'estado_tarea.value as progress',
        ])
            ->join('estado_tarea', 'estado_tarea.id', 'tarea.estado')
            ->where('tarea.id_proyecto', $id)
            ->orderBy('tarea.id', 'asc')
            ->get();

        return response()->json([
            "data" => $tasks,
        ]);
    }
}
