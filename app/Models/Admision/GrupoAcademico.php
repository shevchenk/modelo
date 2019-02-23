<?php

namespace App\Models\Admision;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class GrupoAcademico extends Model
{
    protected   $table = 'dp_grupo_academico_admision';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $grupoAcademico = GrupoAcademico::find($r->id);
        $grupoAcademico->estado = trim( $r->estadof );
        $grupoAcademico->persona_id_updated_at=$persona_id;
        $grupoAcademico->save();
    }

    public static function runNew($r)
    {
        DB::beginTransaction();
        $persona_id=Auth::user()->id;
        $local_id = $r->local_id;
        $fechayhoraini = explode(" ",$r->fecha_inicio);
        $fecha_inicio = $fechayhoraini[0];
        $hora_inicio = $fechayhoraini[1];
        $fechayhorafin = explode(" ",$r->fecha_final);
        $fecha_final = $fechayhorafin[0];
        $hora_final = $fechayhorafin[1];
        $frecuencia = implode(",",$r->frecuencia);
        $nuevo=0;
        $editado=0;
        for ($i=0; $i < count($local_id) ; $i++) { 
            $grupoAcademico = GrupoAcademico::where('plan_estudio_id',$r->plan_estudio_id)
                                ->where('local_id',$local_id[$i])
                                ->where('semestre_id',$r->semestre_id)
                                ->where('ciclo_id',1)
                                ->first();
            if( !isset($grupoAcademico->id) ){
                $nuevo++;
                $grupoAcademico = new GrupoAcademico;
                $grupoAcademico->persona_id_created_at=$persona_id;
                $grupoAcademico->plan_estudio_id = trim( $r->plan_estudio_id );
                $grupoAcademico->local_id = trim( $local_id[$i] );
                $grupoAcademico->semestre_id = trim( $r->semestre_id );
                $grupoAcademico->ciclo_id = 1;
                $grupoAcademico->fecha_inicio = trim( $fecha_inicio );
                $grupoAcademico->fecha_final = trim( $fecha_final );
                $grupoAcademico->hora_inicio = trim( $hora_inicio );
                $grupoAcademico->hora_final = trim( $hora_final );
                $grupoAcademico->frecuencia = trim( $frecuencia );
                $grupoAcademico->meta_minima_matricula = trim( $r->meta_minima );
                $grupoAcademico->meta_maxima_matricula = trim( $r->meta_maxima );
                $grupoAcademico->fecha_inicio_mat = trim( $r->fecha_inicio_mat );
                $grupoAcademico->fecha_final_mat = trim( $r->fecha_final_mat );
                $grupoAcademico->estado = 1;
                $grupoAcademico->save();
            }
            else{
                $editado++;
            }
        }
        if($nuevo<=1){
            $nuevo="Se creó ".$nuevo." registro nuevo y ";
        }
        else{
            $nuevo="Se creó ".$nuevo." registros nuevos y ";
        }
        if($editado<=1){
            $editado=$editado." registro existente";
        }
        else{
            $editado=$editado." registros existentes";
        }
        $resultado=$nuevo.$editado;
        DB::commit();
        return $resultado;
    }

    public static function runNewEdit($r)
    {
        DB::beginTransaction();
        $persona_id=Auth::user()->id;
        $local_id = $r->local_id;
        $fechayhoraini = explode(" ",$r->fecha_inicio);
        $fecha_inicio = $fechayhoraini[0];
        $hora_inicio = $fechayhoraini[1];
        $fechayhorafin = explode(" ",$r->fecha_final);
        $fecha_final = $fechayhorafin[0];
        $hora_final = $fechayhorafin[1];
        $frecuencia = implode(",",$r->frecuencia);
        $nuevo=0;
        $editado=0;
        for ($i=0; $i < count($local_id) ; $i++) { 
            $grupoAcademico = GrupoAcademico::where('plan_estudio_id',$r->plan_estudio_id)
                                ->where('local_id',$local_id[$i])
                                ->where('semestre_id',$r->semestre_id)
                                ->where('ciclo_id',1)
                                ->first();
            if( !isset($grupoAcademico->id) ){
                $nuevo++;
                $grupoAcademico = new GrupoAcademico;
                $grupoAcademico->persona_id_created_at=$persona_id;
                $grupoAcademico->estado = 1;
            }
            else{
                $editado++;
                $grupoAcademico->persona_id_updated_at=$persona_id;
            }
            $grupoAcademico->plan_estudio_id = trim( $r->plan_estudio_id );
            $grupoAcademico->local_id = trim( $local_id[$i] );
            $grupoAcademico->semestre_id = trim( $r->semestre_id );
            $grupoAcademico->ciclo_id = 1;
            $grupoAcademico->fecha_inicio = trim( $fecha_inicio );
            $grupoAcademico->fecha_final = trim( $fecha_final );
            $grupoAcademico->hora_inicio = trim( $hora_inicio );
            $grupoAcademico->hora_final = trim( $hora_final );
            $grupoAcademico->frecuencia = trim( $frecuencia );
            $grupoAcademico->meta_minima_matricula = trim( $r->meta_minima );
            $grupoAcademico->meta_maxima_matricula = trim( $r->meta_maxima );
            $grupoAcademico->fecha_inicio_mat = trim( $r->fecha_inicio_mat );
            $grupoAcademico->fecha_final_mat = trim( $r->fecha_final_mat );
            $grupoAcademico->save();
        }
        if($nuevo<=1){
            $nuevo="Se creó ".$nuevo." registro nuevo y ";
        }
        else{
            $nuevo="Se creó ".$nuevo." registros nuevos y ";
        }
        if($editado<=1){
            $editado=$editado." registro se editó";
        }
        else{
            $editado=$editado." registros se editaron";
        }
        $resultado=$nuevo.$editado;
        DB::commit();
        return $resultado;
    }

    public static function runEdit($r)
    {
        DB::beginTransaction();
        $persona_id=Auth::user()->id;
        $local_id = $r->local_id;
        $fechayhoraini = explode(" ",$r->fecha_inicio);
        $fecha_inicio = $fechayhoraini[0];
        $hora_inicio = $fechayhoraini[1];
        $fechayhorafin = explode(" ",$r->fecha_final);
        $fecha_final = $fechayhorafin[0];
        $hora_final = $fechayhorafin[1];
        $frecuencia = implode(",",$r->frecuencia);
        $nuevo=0;
        $editado=0;
        $ids= explode(",",$r->ids);
        for ($i=1; $i < count($ids) ; $i++) { 
            $grupoAcademico = GrupoAcademico::find($ids[$i]);
            $editado++;
            $grupoAcademico->fecha_inicio = trim( $fecha_inicio );
            $grupoAcademico->fecha_final = trim( $fecha_final );
            $grupoAcademico->hora_inicio = trim( $hora_inicio );
            $grupoAcademico->hora_final = trim( $hora_final );
            $grupoAcademico->frecuencia = trim( $frecuencia );
            $grupoAcademico->meta_minima_matricula = trim( $r->meta_minima );
            $grupoAcademico->meta_maxima_matricula = trim( $r->meta_maxima );
            $grupoAcademico->fecha_inicio_mat = trim( $r->fecha_inicio_mat );
            $grupoAcademico->fecha_final_mat = trim( $r->fecha_final_mat );
            $grupoAcademico->persona_id_updated_at=$persona_id;
            $grupoAcademico->save();
        }
        if($editado<=1){
            $editado=$editado." registro se editó";
        }
        else{
            $editado=$editado." registros se editaron";
        }
        $resultado=$editado;
        DB::commit();
        return $resultado;
    }

    public static function runLoad($r)
    {
        $sql=DB::table('dp_grupo_academico_admision AS ga')
            ->join('am_locales AS l',function($join){
                $join->on('l.id','=','ga.local_id');
            })
            ->join('dm_semestres AS s',function($join){
                $join->on('s.id','=','ga.semestre_id');
            })
            ->join('ca_ciclos AS ci',function($join){
                $join->on('ci.id','=','ga.ciclo_id');
            })
            ->join('cp_plan_estudios AS pe',function($join){
                $join->on('pe.id','=','ga.plan_estudio_id');
            })
            ->join('cm_carreras AS c',function($join){
                $join->on('c.id','=','pe.carrera_id');
            })
            ->select(DB::raw(' CONCAT(pe.nro_plan_estudio," - ",pe.plan_estudio) AS plan_estudio')
            ,'c.carrera', 'l.local', 's.semestre', 'ci.ciclo','ga.fecha_inicio_mat','ga.fecha_final_mat'
            ,'ga.fecha_inicio', 'ga.fecha_final', 'ga.hora_inicio', 'ga.hora_final', 'ga.frecuencia'
            ,'ga.meta_minima_matricula', 'ga.meta_maxima_matricula','ga.estado','ga.id')
            ->where('ga.ciclo_id',1)
            ->where( 
                function($query) use ($r){
                    if( $r->has("local_id") ){
                        $local_id=$r->local_id;
                        if( count($local_id)>0 ){
                            $query->whereIn('ga.local_id',$local_id);
                        }
                        elseif($r->has('grupo_academico')){
                            $query->where('ga.local_id',0);
                        }
                    }
                    elseif($r->has('grupo_academico')){
                        $query->where('ga.local_id',0);
                    }
                    
                    if( $r->has("plan_estudio_id") ){
                        $plan_estudio_id=trim($r->plan_estudio_id);
                        if( $plan_estudio_id !='' ){
                            $query->where('ga.plan_estudio_id','=',$plan_estudio_id);
                        }
                        elseif($r->has('grupo_academico')){
                            $query->where('ga.plan_estudio_id',0);
                        }
                    }
                    elseif($r->has('grupo_academico')){
                        $query->where('ga.plan_estudio_id',0);
                    }

                    if( $r->has("semestre_id") ){
                        $semestre_id=trim($r->semestre_id);
                        if( $semestre_id !='' ){
                            $query->where('ga.semestre_id','=',$semestre_id);
                        }
                        elseif($r->has('plan_estudio_id')){
                            $query->where('ga.semestre_id',0);
                        }
                    }
                    elseif($r->has('plan_estudio_id')){
                        $query->where('ga.semestre_id',0);
                    }

                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('ga.estado','=',$estado);
                        }
                    }
                }
            );
        $result = $sql->orderBy('l.local','asc')->get();
        return $result;
    }

}
