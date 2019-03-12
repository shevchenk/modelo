<?php

namespace App\Models\PreGrado;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class GrupoAcademicoDetalle extends Model
{
    protected   $table = 'ep_programaciones_cursos';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $grupoAcademicoDetalle = GrupoAcademicoDetalle::find($r->id);
        $grupoAcademicoDetalle->estado = trim( $r->estadof );
        $grupoAcademicoDetalle->persona_id_updated_at=$persona_id;
        $grupoAcademicoDetalle->save();
    }

    public static function runNewEdit($r)
    {
        DB::beginTransaction();
        $persona_id=Auth::user()->id;
        $grupoAcademicoDetalle = new GrupoAcademicoDetalle;
        $grupoAcademicoDetalle->local_id= trim( $r->local_id );
        $grupoAcademicoDetalle->grupo_academico_id= trim( $r->grupo_academico_id );
        $grupoAcademicoDetalle->plan_estudio_detalle_id= trim( $r->plan_estudio_detalle_id );
        $grupoAcademicoDetalle->curso_id= trim( $r->curso_id );
        $grupoAcademicoDetalle->tipo_clase= trim( $r->tipo_clase );
        $grupoAcademicoDetalle->seccion= trim( $r->seccion );
        $grupoAcademicoDetalle->dia_id= trim( $r->dia_id );
        $grupoAcademicoDetalle->hora_inicio= trim( $r->hora_inicio );
        $grupoAcademicoDetalle->hora_final= trim( $r->hora_final );

        if( trim($r->lab)==1 ){
            $grupoAcademicoDetalle->ambiente_id= trim( $r->ambiente_id );
        }

        if( trim($r->empleado_id)!='' ){
            $grupoAcademicoDetalle->empleado_id= trim( $r->empleado_id );
        }

        $grupoAcademicoDetalle->estado=1;
        $grupoAcademicoDetalle->persona_id_created_at=$persona_id;
        $grupoAcademicoDetalle->save();
        $resultado="Se insertó correctamente";
        DB::commit();
        return $resultado;
    }

    public static function runEdit($r)
    {
        DB::beginTransaction();
        $persona_id=Auth::user()->id;
        DB::commit();
        return $resultado;
    }

    public static function runLoadProgramacion($r)
    {
        $sql=DB::table('ep_programaciones_cursos AS pc')
            ->join('ep_grupo_academico AS ga',function($join) use ($r){
                $join->on('ga.id','=','pc.grupo_academico_id')
                ->where('ga.id',$r->grupo_academico_id);
            })
            ->join('cm_cursos AS c',function($join){
                $join->on('c.id','=','pc.curso_id');
            })
            ->leftJoin('am_empleados AS e',function($join){
                $join->on('e.id','=','pc.empleado_id');
            })
            ->leftJoin('am_personas AS p',function($join){
                $join->on('p.id','=','e.persona_id');
            })
            ->leftJoin('am_locales_ambientes AS la',function($join){
                $join->on('la.id','=','pc.ambiente_id');
            })
            ->select('pc.hora_inicio','pc.hora_final','pc.dia_id','pc.ambiente_id'
            ,'la.ambiente',DB::raw('CONCAT( p.paterno," ",p.materno,", ",p.nombre ) persona')
            ,'pc.seccion','pc.tipo_clase','pc.curso_id','c.curso'
            )
            ->where( 
                function($query) use ($r){
                    if( $r->has("seccion") ){
                        $seccion=trim($r->seccion);
                        if( $seccion !='' ){
                            $query->where('pc.seccion',$seccion);
                        }
                    }
                }
            )
            ->where('pc.estado',1);
        $result = $sql->orderBy('c.curso','asc')->get();
        return $result;
    }

}
