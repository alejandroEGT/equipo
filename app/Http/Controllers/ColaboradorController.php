<?php

namespace App\Http\Controllers;

use App\Colaborador;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColaboradorController extends Controller
{
     public function contar_by_proyecto($id_proyecto)
    {
    	$col = Colaborador::where([
            'id_proyecto'=>$id_proyecto,
            'delete' => 0
        ])->get();
    	return count($col);
    }
    public function todos_colaboradores($id_proyecto)
    {
    	$verify_col = Colaborador::select('id_user')->where([
            'id_proyecto' => $id_proyecto,
            'delete' => 0
        ])->get();

    	return User::whereNotIn('id', $verify_col)->get();
    }
    public function mis_colaboradores($id_proyecto)
    {
    	$col = DB::table('Users as us')
                ->select([
                    'us.nombres','us.apellidos','us.email','us.id'
                ])
    			->join('colaborador as col','col.id_user','us.id')
    			->where([
                    'col.id_proyecto'=> $id_proyecto,
                    'col.delete'=> 0
                ])->get();

        return $col;
    }
    public function agregar_colaboradores(Request $r)
    {
        $verify = Colaborador::where([ 'id_proyecto'=>$r->id_proyecto, 'id_user'=>$r->colaborador ])
                  ->first();
        if ($verify) {
            $verify->delete = 0;
            if ($verify->save()) {
                return "success op";
            }
        }else{
            $col = new Colaborador;
            $col->id_proyecto = $r->id_proyecto;
            $col->id_user = $r->colaborador;
            $col->delete = 0;
            if ($col->save()) {
                return "success";
            }
        }

    }
    public function quitar_colaborador(Request $r)
    {
        $verify = Colaborador::where([ 'id_proyecto'=>$r->id_proyecto, 'id_user'=>$r->colaborador ])
                  ->first();
        if ($verify) {
            $verify->delete = 1;
            if ($verify->save()) {
                return "delete";
            }
        }
    }
}
