<?php

namespace App\Models\Admision;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class ModalidadIngresoRequisito extends Model
{
    protected   $table = 'da_modalidades_ingresos_requisitos';

    public static function runEliminar($r)
    {
        $persona_id=Auth::user()->id;
        $planEstudioDetalle = ModalidadIngresoRequisito::find($r->id);
        $planEstudioDetalle->estado = 0;
        $planEstudioDetalle->persona_id_updated_at=$persona_id;
        $planEstudioDetalle->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $planEstudioDetalle = new ModalidadIngresoRequisito;
        $planEstudioDetalle->modalidad_ingreso_id = trim( $r->modalidad_ingreso_id );
        $planEstudioDetalle->requisito = trim( $r->requisito );
        $planEstudioDetalle->estado = 1;
        $planEstudioDetalle->persona_id_created_at=$persona_id;
        $planEstudioDetalle->save();
    }

    public static function runLoad($r)
    {
        $sql=DB::table('da_modalidades_ingresos_requisitos AS mir')
            ->select(
                'mir.id','mir.requisito','mir.modalidad_ingreso_id'
            )
            ->where(
                function($query) use ($r){
                    if( $r->has("modalidad_ingreso_id") ){
                        $modalidad_ingreso_id=trim($r->modalidad_ingreso_id);
                        if( $modalidad_ingreso_id !='' ){
                            $query->where('mir.modalidad_ingreso_id',$modalidad_ingreso_id);
                        }
                    }
                }
            )
            ->where('mir.estado','1');
        $result =   $sql->orderBy('mir.requisito','asc')
                        ->get();
        return $result;
    }
}
