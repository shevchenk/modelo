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
        DB::beginTransaction();
        $persona_id=Auth::user()->id;
        $grupoAcademicoDetalle = GrupoAcademicoDetalle::find($r->id);
        $grupoAcademicoDetalle->estado = 0;
        $grupoAcademicoDetalle->persona_id_updated_at=$persona_id;
        $grupoAcademicoDetalle->save();

        $grupoAcademicoDetalleHistorico= new GrupoAcademicoDetalleHistorico;
        $grupoAcademicoDetalleHistorico->programacion_curso_id = $grupoAcademicoDetalle->id;
        $grupoAcademicoDetalleHistorico->local_id = $grupoAcademicoDetalle->local_id;
        $grupoAcademicoDetalleHistorico->grupo_academico_id = $grupoAcademicoDetalle->grupo_academico_id;
        $grupoAcademicoDetalleHistorico->plan_estudio_detalle_id = $grupoAcademicoDetalle->plan_estudio_detalle_id;
        $grupoAcademicoDetalleHistorico->curso_id = $grupoAcademicoDetalle->curso_id;
        $grupoAcademicoDetalleHistorico->tipo_clase = $grupoAcademicoDetalle->tipo_clase;
        $grupoAcademicoDetalleHistorico->seccion = $grupoAcademicoDetalle->seccion;
        $grupoAcademicoDetalleHistorico->dia_id = $grupoAcademicoDetalle->dia_id;
        $grupoAcademicoDetalleHistorico->hora_inicio = $grupoAcademicoDetalle->hora_inicio;
        $grupoAcademicoDetalleHistorico->hora_final = $grupoAcademicoDetalle->hora_final;
        $grupoAcademicoDetalleHistorico->ambiente_id = $grupoAcademicoDetalle->ambiente_id;
        $grupoAcademicoDetalleHistorico->ambiente_id_aula = $grupoAcademicoDetalle->ambiente_id_aula;
        $grupoAcademicoDetalleHistorico->empleado_id = $grupoAcademicoDetalle->empleado_id;
        $grupoAcademicoDetalleHistorico->estado = $grupoAcademicoDetalle->estado;
        $grupoAcademicoDetalleHistorico->persona_id_created_at = $persona_id;
        $grupoAcademicoDetalleHistorico->save();
        DB::commit();
    }

    public static function runEditAula($r)
    {
        DB::beginTransaction();
        $persona_id=Auth::user()->id;
        $grupoAcademicoDetalle = GrupoAcademicoDetalle::where('grupo_academico_id',$r->grupo_academico_id)
                                    ->where('seccion',$r->seccion)
                                    ->update(['ambiente_id_aula'=>$r->ambiente_id_aula]);
        $result['cant']=$grupoAcademicoDetalle;
        $grupoAcademicoDetalle = GrupoAcademicoDetalle::where('grupo_academico_id',$r->grupo_academico_id)
                                    ->where('seccion',$r->seccion)
                                    ->get();
        foreach ($grupoAcademicoDetalle as $key => $value) {
            $grupoAcademicoDetalleHistorico= new GrupoAcademicoDetalleHistorico;
            $grupoAcademicoDetalleHistorico->programacion_curso_id = $value->id;
            $grupoAcademicoDetalleHistorico->local_id = $value->local_id;
            $grupoAcademicoDetalleHistorico->grupo_academico_id = $value->grupo_academico_id;
            $grupoAcademicoDetalleHistorico->plan_estudio_detalle_id = $value->plan_estudio_detalle_id;
            $grupoAcademicoDetalleHistorico->curso_id = $value->curso_id;
            $grupoAcademicoDetalleHistorico->tipo_clase = $value->tipo_clase;
            $grupoAcademicoDetalleHistorico->seccion = $value->seccion;
            $grupoAcademicoDetalleHistorico->dia_id = $value->dia_id;
            $grupoAcademicoDetalleHistorico->hora_inicio = $value->hora_inicio;
            $grupoAcademicoDetalleHistorico->hora_final = $value->hora_final;
            $grupoAcademicoDetalleHistorico->ambiente_id = $value->ambiente_id;
            $grupoAcademicoDetalleHistorico->ambiente_id_aula = $value->ambiente_id_aula;
            $grupoAcademicoDetalleHistorico->empleado_id = $value->empleado_id;
            $grupoAcademicoDetalleHistorico->estado = $value->estado;
            $grupoAcademicoDetalleHistorico->persona_id_created_at = $persona_id;
            $grupoAcademicoDetalleHistorico->save();
        }
        DB::commit();
        $result['rst']=1;
        if( $result['cant']==0 ){
            $result['rst']=2;
            $result['msj']='No hay ningún curso registrado, para asignar el aula';
        }
        return $result;
    }

    public static function runNewEdit($r)
    {
        DB::beginTransaction();
        $persona_id=Auth::user()->id;
        $resultado='';

        if( $r->has('id') ){
            $grupoAcademicoDetalle = GrupoAcademicoDetalle::find($r->id);
            $grupoAcademicoDetalle->persona_id_updated_at=$persona_id;
            $resultado="Se actualizó correctamente";
        }
        else{
            $grupoAcademicoDetalle = GrupoAcademicoDetalle::where('local_id',$r->local_id)
                                    ->where('grupo_academico_id',$r->grupo_academico_id)
                                    ->where('seccion',$r->seccion)
                                    ->where('dia_id',$r->dia_id)
                                    ->where('hora_inicio',$r->hora_inicio)
                                    ->where('hora_final',$r->hora_final)
                                    ->first();
            if( !isset($grupoAcademicoDetalle->id) ){
                $grupoAcademicoDetalle = new GrupoAcademicoDetalle;
                $grupoAcademicoDetalle->persona_id_created_at=$persona_id;
            }
            else{
                $grupoAcademicoDetalle->persona_id_updated_at=$persona_id;
            }
                $resultado="Se insertó correctamente";
        }

        $grupoAcademicoDetalle->local_id= trim( $r->local_id );
        $grupoAcademicoDetalle->grupo_academico_id= trim( $r->grupo_academico_id );
        $grupoAcademicoDetalle->plan_estudio_detalle_id= trim( $r->plan_estudio_detalle_id );
        $grupoAcademicoDetalle->curso_id= trim( $r->curso_id );
        $grupoAcademicoDetalle->tipo_clase= trim( $r->tipo_clase );
        $grupoAcademicoDetalle->seccion= trim( $r->seccion );
        $grupoAcademicoDetalle->dia_id= trim( $r->dia_id );
        $grupoAcademicoDetalle->hora_inicio= trim( $r->hora_inicio );
        $grupoAcademicoDetalle->hora_final= trim( $r->hora_final );

        $grupoAcademicoDetalle->ambiente_id=NULL;
        if( trim($r->lab)==1 ){
            $grupoAcademicoDetalle->ambiente_id= trim( $r->ambiente_id );
        }

        $grupoAcademicoDetalle->empleado_id=NULL;
        if( trim($r->empleado_id)!='' ){
            $grupoAcademicoDetalle->empleado_id= trim( $r->empleado_id );
        }

        $grupoAcademicoDetalle->estado=1;
        $grupoAcademicoDetalle->save();

        $grupoAcademicoDetalleHistorico= new GrupoAcademicoDetalleHistorico;
        $grupoAcademicoDetalleHistorico->programacion_curso_id = $grupoAcademicoDetalle->id;
        $grupoAcademicoDetalleHistorico->local_id = $grupoAcademicoDetalle->local_id;
        $grupoAcademicoDetalleHistorico->grupo_academico_id = $grupoAcademicoDetalle->grupo_academico_id;
        $grupoAcademicoDetalleHistorico->plan_estudio_detalle_id = $grupoAcademicoDetalle->plan_estudio_detalle_id;
        $grupoAcademicoDetalleHistorico->curso_id = $grupoAcademicoDetalle->curso_id;
        $grupoAcademicoDetalleHistorico->tipo_clase = $grupoAcademicoDetalle->tipo_clase;
        $grupoAcademicoDetalleHistorico->seccion = $grupoAcademicoDetalle->seccion;
        $grupoAcademicoDetalleHistorico->dia_id = $grupoAcademicoDetalle->dia_id;
        $grupoAcademicoDetalleHistorico->hora_inicio = $grupoAcademicoDetalle->hora_inicio;
        $grupoAcademicoDetalleHistorico->hora_final = $grupoAcademicoDetalle->hora_final;
        $grupoAcademicoDetalleHistorico->ambiente_id = $grupoAcademicoDetalle->ambiente_id;
        $grupoAcademicoDetalleHistorico->ambiente_id_aula = $grupoAcademicoDetalle->ambiente_id_aula;
        $grupoAcademicoDetalleHistorico->empleado_id = $grupoAcademicoDetalle->empleado_id;
        $grupoAcademicoDetalleHistorico->estado = $grupoAcademicoDetalle->estado;
        $grupoAcademicoDetalleHistorico->persona_id_created_at = $persona_id;
        $grupoAcademicoDetalleHistorico->save();
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
            ->leftJoin('am_locales_ambientes AS la2',function($join){
                $join->on('la2.id','=','pc.ambiente_id_aula');
            })
            ->select('pc.hora_inicio','pc.hora_final','pc.dia_id','pc.ambiente_id'
            ,'la.ambiente',DB::raw('CONCAT( p.paterno," ",p.materno,", ",p.nombre ) persona')
            ,'pc.seccion','pc.tipo_clase','pc.curso_id','c.curso','pc.plan_estudio_detalle_id'
            ,'pc.empleado_id','pc.id','pc.ambiente_id_aula','la2.ambiente AS aula'
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

    public static function runListHoras($r)
    {
        $sql=DB::table('ep_programaciones_cursos AS pc')
            ->select('pc.hora_inicio','pc.hora_final')
            ->where('pc.estado',1)
            ->where('pc.seccion',$r->seccion)
            ->where('pc.grupo_academico_id',$r->grupo_academico_id);
        $result = $sql->groupBy('pc.hora_inicio')
                    ->groupBy('pc.hora_final')
                    ->orderBy('pc.hora_inicio','asc')
                    ->get();
        return $result;
    }

}
