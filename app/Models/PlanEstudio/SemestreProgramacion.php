<?php

namespace App\Models\PlanEstudio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class SemestreProgramacion extends Model
{
    protected   $table = 'dm_semestres_programaciones';

    public static function runEliminar($r)
    {
        $persona_id=Auth::user()->id;
        $planEstudioDetalle = SemestreProgramacion::find($r->id);
        $planEstudioDetalle->estado = 0;
        $planEstudioDetalle->persona_id_updated_at=$persona_id;
        $planEstudioDetalle->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $planEstudioDetalle = new SemestreProgramacion;
        $planEstudioDetalle->semestre_id = trim( $r->semestre_id );
        $planEstudioDetalle->fecha = trim( $r->fecha );

        $planEstudioDetalle->estado = 1;
        $planEstudioDetalle->persona_id_created_at=$persona_id;
        $planEstudioDetalle->save();
    }

    public static function runLoad($r)
    {
        $sql=DB::table('dm_semestres_programaciones AS sp')
            ->select(
                'sp.id','sp.fecha','sp.semestre_id'
            )
            ->where(
                function($query) use ($r){
                    if( $r->has("semestre_id") ){
                        $semestre_id=trim($r->semestre_id);
                        if( $semestre_id !='' ){
                            $query->where('sp.semestre_id',$semestre_id);
                        }
                    }
                }
            )
            ->where('sp.estado','1');
        $result =   $sql->orderBy('sp.fecha','asc')
                        ->get();
        return $result;
    }
}
