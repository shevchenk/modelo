<?php

namespace App\Models\PlanEstudio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class PlanEstudioDetalle extends Model
{
    protected   $table = 'cp_plan_estudios_detalles';

    public static function runEliminar($r)
    {
        DB::beginTransaction();
        $persona_id=Auth::user()->id;
        $planEstudioDetalle = PlanEstudioDetalle::find($r->id);
        $planEstudioDetalle->estado = 0;
        $planEstudioDetalle->persona_id_updated_at=$persona_id;
        $planEstudioDetalle->save();

        $planEstudioDetalleHistorico = new PlanEstudioDetalleHistorico;
        $planEstudioDetalleHistorico->plan_estudio_detalle_id = $planEstudioDetalle->id;
        $planEstudioDetalleHistorico->plan_estudio_id = $planEstudioDetalle->plan_estudio_id;
        $planEstudioDetalleHistorico->ciclo_id = $planEstudioDetalle->ciclo_id;
        $planEstudioDetalleHistorico->curso_id = $planEstudioDetalle->curso_id;
        $planEstudioDetalleHistorico->tipo_estudio = $planEstudioDetalle->tipo_estudio;
        $planEstudioDetalleHistorico->tipo_curso = $planEstudioDetalle->tipo_curso;
        $planEstudioDetalleHistorico->hora_teoria_presencial = $planEstudioDetalle->hora_teoria_presencial;
        $planEstudioDetalleHistorico->hora_teoria_virtual = $planEstudioDetalle->hora_teoria_virtual;
        $planEstudioDetalleHistorico->hora_teoria_total = $planEstudioDetalle->hora_teoria_total;
        $planEstudioDetalleHistorico->hora_practica_presencial = $planEstudioDetalle->hora_practica_presencial;
        $planEstudioDetalleHistorico->hora_practica_virtual = $planEstudioDetalle->hora_practica_virtual;
        $planEstudioDetalleHistorico->hora_practica_total = $planEstudioDetalle->hora_practica_total;
        $planEstudioDetalleHistorico->hora_total = $planEstudioDetalle->hora_total;
        $planEstudioDetalleHistorico->credito_teoria_presencial = $planEstudioDetalle->credito_teoria_presencial;
        $planEstudioDetalleHistorico->credito_teoria_virtual = $planEstudioDetalle->credito_teoria_virtual;
        $planEstudioDetalleHistorico->credito_teoria_total = $planEstudioDetalle->credito_teoria_total;
        $planEstudioDetalleHistorico->credito_practica_presencial = $planEstudioDetalle->credito_practica_presencial;
        $planEstudioDetalleHistorico->credito_practica_virtual = $planEstudioDetalle->credito_practica_virtual;
        $planEstudioDetalleHistorico->credito_practica_total = $planEstudioDetalle->credito_practica_total;
        $planEstudioDetalleHistorico->credito_total = $planEstudioDetalle->credito_total;

        $planEstudioDetalleHistorico->estado = 0;
        $planEstudioDetalleHistorico->persona_id_created_at=$persona_id;
        $planEstudioDetalleHistorico->save();
        DB::commit();
    }

    public static function runNew($r)
    {
        DB::beginTransaction();
        $persona_id=Auth::user()->id;

        $planEstudioDetalle = PlanEstudioDetalle::where('plan_estudio_id',$r->plan_estudio_id)
                                        ->where('curso_id',$r->curso_id)
                                        ->first();
        if( !isset($planEstudioDetalle->id) ){
            $planEstudioDetalle = new PlanEstudioDetalle;
            $planEstudioDetalle->persona_id_created_at=Auth::user()->id;
        }
        else{
            $planEstudioDetalle->persona_id_updated_at=Auth::user()->id;
        }

        $planEstudioDetalle->plan_estudio_id = trim( $r->plan_estudio_id );
        $planEstudioDetalle->ciclo_id = trim( $r->ciclo_id );
        $planEstudioDetalle->curso_id = trim( $r->curso_id );
        $planEstudioDetalle->tipo_estudio = trim( $r->tipo_estudio );
        $planEstudioDetalle->tipo_curso = trim( $r->tipo_curso );
        $planEstudioDetalle->hora_teoria_presencial = trim( $r->hora_teoria_presencial );
        $planEstudioDetalle->hora_teoria_virtual = trim( $r->hora_teoria_virtual );
        $planEstudioDetalle->hora_teoria_total = trim( $r->hora_teoria_total );
        $planEstudioDetalle->hora_practica_presencial = trim( $r->hora_practica_presencial );
        $planEstudioDetalle->hora_practica_virtual = trim( $r->hora_practica_virtual );
        $planEstudioDetalle->hora_practica_total = trim( $r->hora_practica_total );
        $planEstudioDetalle->hora_total = trim( $r->hora_total );
        $planEstudioDetalle->credito_teoria_presencial = trim( $r->credito_teoria_presencial );
        $planEstudioDetalle->credito_teoria_virtual = trim( $r->credito_teoria_virtual );
        $planEstudioDetalle->credito_teoria_total = trim( $r->credito_teoria_total );
        $planEstudioDetalle->credito_practica_presencial = trim( $r->credito_practica_presencial );
        $planEstudioDetalle->credito_practica_virtual = trim( $r->credito_practica_virtual );
        $planEstudioDetalle->credito_practica_total = trim( $r->credito_practica_total );
        $planEstudioDetalle->credito_total = trim( $r->credito_total );

        $planEstudioDetalle->estado = 1;
        $planEstudioDetalle->persona_id_created_at=$persona_id;

        $planEstudioDetalleHistorico = new PlanEstudioDetalleHistorico;
        if( trim( $r->modalidad_id )>1 OR 
            (   
                trim( $r->modalidad_id )==1 AND 
                trim( $r['hora_teoria_virtual'.$r->id] )==0 AND 
                trim( $r['hora_practica_virtual'.$r->id] )==0 
            )
        ){
            $planEstudioDetalle->save();
            $planEstudioDetalleHistorico->plan_estudio_detalle_id = $planEstudioDetalle->id;
        }

        $planEstudioDetalleHistorico->plan_estudio_id = $planEstudioDetalle->plan_estudio_id;
        $planEstudioDetalleHistorico->ciclo_id = $planEstudioDetalle->ciclo_id;
        $planEstudioDetalleHistorico->curso_id = $planEstudioDetalle->curso_id;
        $planEstudioDetalleHistorico->tipo_estudio = $planEstudioDetalle->tipo_estudio;
        $planEstudioDetalleHistorico->tipo_curso = $planEstudioDetalle->tipo_curso;
        $planEstudioDetalleHistorico->hora_teoria_presencial = $planEstudioDetalle->hora_teoria_presencial;
        $planEstudioDetalleHistorico->hora_teoria_virtual = $planEstudioDetalle->hora_teoria_virtual;
        $planEstudioDetalleHistorico->hora_teoria_total = $planEstudioDetalle->hora_teoria_total;
        $planEstudioDetalleHistorico->hora_practica_presencial = $planEstudioDetalle->hora_practica_presencial;
        $planEstudioDetalleHistorico->hora_practica_virtual = $planEstudioDetalle->hora_practica_virtual;
        $planEstudioDetalleHistorico->hora_practica_total = $planEstudioDetalle->hora_practica_total;
        $planEstudioDetalleHistorico->hora_total = $planEstudioDetalle->hora_total;
        $planEstudioDetalleHistorico->credito_teoria_presencial = $planEstudioDetalle->credito_teoria_presencial;
        $planEstudioDetalleHistorico->credito_teoria_virtual = $planEstudioDetalle->credito_teoria_virtual;
        $planEstudioDetalleHistorico->credito_teoria_total = $planEstudioDetalle->credito_teoria_total;
        $planEstudioDetalleHistorico->credito_practica_presencial = $planEstudioDetalle->credito_practica_presencial;
        $planEstudioDetalleHistorico->credito_practica_virtual = $planEstudioDetalle->credito_practica_virtual;
        $planEstudioDetalleHistorico->credito_practica_total = $planEstudioDetalle->credito_practica_total;
        $planEstudioDetalleHistorico->credito_total = $planEstudioDetalle->credito_total;

        $planEstudioDetalleHistorico->estado = 1;
        $planEstudioDetalleHistorico->persona_id_created_at=$persona_id;
        $planEstudioDetalleHistorico->save();
        DB::commit();
    }

    public static function runEdit($r)
    {
        DB::beginTransaction();
        $persona_id=Auth::user()->id;
        $planEstudioDetalle = PlanEstudioDetalle::find($r->id);
        $planEstudioDetalle->plan_estudio_id = trim( $r->plan_estudio_id );
        $planEstudioDetalle->ciclo_id = trim( $r['ciclo_id'.$r->id] );
        $planEstudioDetalle->tipo_estudio = trim( $r['tipo_estudio'.$r->id] );
        $planEstudioDetalle->tipo_curso = trim( $r['tipo_curso'.$r->id] );
        $planEstudioDetalle->hora_teoria_presencial = trim( $r['hora_teoria_presencial'.$r->id] );
        $planEstudioDetalle->hora_teoria_virtual = trim( $r['hora_teoria_virtual'.$r->id] );
        $planEstudioDetalle->hora_teoria_total = trim( $r['hora_teoria_total'.$r->id] );
        $planEstudioDetalle->hora_practica_presencial = trim( $r['hora_practica_presencial'.$r->id] );
        $planEstudioDetalle->hora_practica_virtual = trim( $r['hora_practica_virtual'.$r->id] );
        $planEstudioDetalle->hora_practica_total = trim( $r['hora_practica_total'.$r->id] );
        $planEstudioDetalle->hora_total = trim( $r['hora_total'.$r->id] );
        $planEstudioDetalle->credito_teoria_presencial = trim( $r['credito_teoria_presencial'.$r->id] );
        $planEstudioDetalle->credito_teoria_virtual = trim( $r['credito_teoria_virtual'.$r->id] );
        $planEstudioDetalle->credito_teoria_total = trim( $r['credito_teoria_total'.$r->id] );
        $planEstudioDetalle->credito_practica_presencial = trim( $r['credito_practica_presencial'.$r->id] );
        $planEstudioDetalle->credito_practica_virtual = trim( $r['credito_practica_virtual'.$r->id] );
        $planEstudioDetalle->credito_practica_total = trim( $r['credito_practica_total'.$r->id] );
        $planEstudioDetalle->credito_total = trim( $r['credito_total'.$r->id] );
        
        $planEstudioDetalle->estado = 1;
        $planEstudioDetalle->persona_id_updated_at=$persona_id;

        if( trim( $r->modalidad_id )>1 OR 
            (   
                trim( $r->modalidad_id )==1 AND 
                trim( $r['hora_teoria_virtual'.$r->id] )==0 AND 
                trim( $r['hora_practica_virtual'.$r->id] )==0 
            )
        ){
            $planEstudioDetalle->save();
        }

        $planEstudioDetalleHistorico = new PlanEstudioDetalleHistorico;
        $planEstudioDetalleHistorico->plan_estudio_detalle_id = $planEstudioDetalle->id;
        $planEstudioDetalleHistorico->plan_estudio_id = $planEstudioDetalle->plan_estudio_id;
        $planEstudioDetalleHistorico->ciclo_id = $planEstudioDetalle->ciclo_id;
        $planEstudioDetalleHistorico->curso_id = $planEstudioDetalle->curso_id;
        $planEstudioDetalleHistorico->tipo_estudio = $planEstudioDetalle->tipo_estudio;
        $planEstudioDetalleHistorico->tipo_curso = $planEstudioDetalle->tipo_curso;
        $planEstudioDetalleHistorico->hora_teoria_presencial = $planEstudioDetalle->hora_teoria_presencial;
        $planEstudioDetalleHistorico->hora_teoria_virtual = $planEstudioDetalle->hora_teoria_virtual;
        $planEstudioDetalleHistorico->hora_teoria_total = $planEstudioDetalle->hora_teoria_total;
        $planEstudioDetalleHistorico->hora_practica_presencial = $planEstudioDetalle->hora_practica_presencial;
        $planEstudioDetalleHistorico->hora_practica_virtual = $planEstudioDetalle->hora_practica_virtual;
        $planEstudioDetalleHistorico->hora_practica_total = $planEstudioDetalle->hora_practica_total;
        $planEstudioDetalleHistorico->hora_total = $planEstudioDetalle->hora_total;
        $planEstudioDetalleHistorico->credito_teoria_presencial = $planEstudioDetalle->credito_teoria_presencial;
        $planEstudioDetalleHistorico->credito_teoria_virtual = $planEstudioDetalle->credito_teoria_virtual;
        $planEstudioDetalleHistorico->credito_teoria_total = $planEstudioDetalle->credito_teoria_total;
        $planEstudioDetalleHistorico->credito_practica_presencial = $planEstudioDetalle->credito_practica_presencial;
        $planEstudioDetalleHistorico->credito_practica_virtual = $planEstudioDetalle->credito_practica_virtual;
        $planEstudioDetalleHistorico->credito_practica_total = $planEstudioDetalle->credito_practica_total;
        $planEstudioDetalleHistorico->credito_total = $planEstudioDetalle->credito_total;

        $planEstudioDetalleHistorico->estado = 1;
        $planEstudioDetalleHistorico->persona_id_created_at=$persona_id;
        $planEstudioDetalleHistorico->save();
        DB::commit();
    }

    public static function runEditVir($r)
    {
        DB::beginTransaction();
        $persona_id=Auth::user()->id;
        $planEstudioDetalle = PlanEstudioDetalle::find($r->id);
        $planEstudioDetalle->ciclo_id = trim( $r['ciclo_id'.$r->id] );
        $planEstudioDetalle->hora_teoria_presencial = trim( $r['hora_teoria_presencial'.$r->id] );
        $planEstudioDetalle->hora_teoria_virtual = trim( $r['hora_teoria_virtual'.$r->id] );
        
        $planEstudioDetalle->hora_practica_presencial = trim( $r['hora_practica_presencial'.$r->id] );
        $planEstudioDetalle->hora_practica_virtual = trim( $r['hora_practica_virtual'.$r->id] );

        $planEstudioDetalle->credito_teoria_presencial = trim( $r['credito_teoria_presencial'.$r->id] );
        $planEstudioDetalle->credito_teoria_virtual = trim( $r['credito_teoria_virtual'.$r->id] );
        
        $planEstudioDetalle->credito_practica_presencial = trim( $r['credito_practica_presencial'.$r->id] );
        $planEstudioDetalle->credito_practica_virtual = trim( $r['credito_practica_virtual'.$r->id] );
        
        $planEstudioDetalle->estado = 1;
        $planEstudioDetalle->persona_id_updated_at=$persona_id;

        if( ($planEstudioDetalle->hora_teoria_total== ( trim( $r['hora_teoria_presencial'.$r->id] ) + trim( $r['hora_teoria_virtual'.$r->id] ) )) AND 
            ($planEstudioDetalle->hora_practica_total== ( trim( $r['hora_practica_presencial'.$r->id] ) + trim( $r['hora_practica_virtual'.$r->id] ) ))
        ){
            $planEstudioDetalle->save();
        }

        $planEstudioDetalleHistorico = new PlanEstudioDetalleHistorico;
        $planEstudioDetalleHistorico->plan_estudio_detalle_id = $planEstudioDetalle->id;
        $planEstudioDetalleHistorico->plan_estudio_id = $planEstudioDetalle->plan_estudio_id;
        $planEstudioDetalleHistorico->ciclo_id = $planEstudioDetalle->ciclo_id;
        $planEstudioDetalleHistorico->curso_id = $planEstudioDetalle->curso_id;
        $planEstudioDetalleHistorico->tipo_estudio = $planEstudioDetalle->tipo_estudio;
        $planEstudioDetalleHistorico->tipo_curso = $planEstudioDetalle->tipo_curso;
        $planEstudioDetalleHistorico->hora_teoria_presencial = $planEstudioDetalle->hora_teoria_presencial;
        $planEstudioDetalleHistorico->hora_teoria_virtual = $planEstudioDetalle->hora_teoria_virtual;
        $planEstudioDetalleHistorico->hora_teoria_total = $planEstudioDetalle->hora_teoria_total;
        $planEstudioDetalleHistorico->hora_practica_presencial = $planEstudioDetalle->hora_practica_presencial;
        $planEstudioDetalleHistorico->hora_practica_virtual = $planEstudioDetalle->hora_practica_virtual;
        $planEstudioDetalleHistorico->hora_practica_total = $planEstudioDetalle->hora_practica_total;
        $planEstudioDetalleHistorico->hora_total = $planEstudioDetalle->hora_total;
        $planEstudioDetalleHistorico->credito_teoria_presencial = $planEstudioDetalle->credito_teoria_presencial;
        $planEstudioDetalleHistorico->credito_teoria_virtual = $planEstudioDetalle->credito_teoria_virtual;
        $planEstudioDetalleHistorico->credito_teoria_total = $planEstudioDetalle->credito_teoria_total;
        $planEstudioDetalleHistorico->credito_practica_presencial = $planEstudioDetalle->credito_practica_presencial;
        $planEstudioDetalleHistorico->credito_practica_virtual = $planEstudioDetalle->credito_practica_virtual;
        $planEstudioDetalleHistorico->credito_practica_total = $planEstudioDetalle->credito_practica_total;
        $planEstudioDetalleHistorico->credito_total = $planEstudioDetalle->credito_total;

        $planEstudioDetalleHistorico->estado = 1;
        $planEstudioDetalleHistorico->persona_id_created_at=$persona_id;
        $planEstudioDetalleHistorico->save();
        DB::commit();
    }

    public static function runLoad($r)
    {
        $sql=DB::table('cp_plan_estudios_detalles as ped')
            ->join('ca_ciclos AS c',function($join){
                $join->on('c.id','=','ped.ciclo_id');
            })
            ->join('cm_cursos AS cu',function($join){
                $join->on('cu.id','=','ped.curso_id');
            })
            ->select(
                'ped.id','ped.tipo_estudio','ped.tipo_curso','ped.hora_teoria_presencial',
                'ped.hora_teoria_virtual','ped.hora_teoria_total','ped.hora_practica_presencial',
                'ped.hora_practica_virtual','ped.hora_practica_total','ped.hora_total',
                'ped.credito_teoria_presencial','ped.credito_teoria_virtual','ped.credito_teoria_total',
                'ped.credito_practica_presencial','ped.credito_practica_virtual','ped.credito_practica_total',
                'ped.credito_total','ped.ciclo_id','ped.curso_id','ped.requisitos',
                'cu.curso'
            )
            ->where(
                function($query) use ($r){
                    if( $r->has("plan_estudio_id") ){
                        $plan_estudio_id=trim($r->plan_estudio_id);
                        if( $plan_estudio_id !='' ){
                            $query->where('ped.plan_estudio_id',$plan_estudio_id);
                        }
                    }
                    if( $r->has("ciclo_id_filtro") ){
                        $ciclo_id_filtro=trim($r->ciclo_id_filtro);
                        if( $ciclo_id_filtro !='' ){
                            $query->where('ped.ciclo_id',$ciclo_id_filtro);
                        }
                    }
                }
            )
            ->where('ped.estado','1');
        $result =   $sql->orderBy('ped.ciclo_id','asc')
                        ->orderBy('ped.tipo_estudio','asc')
                        ->get();
        return $result;
    }

    public static function runLoadResumen($r)
    {
        $sqltt= DB::table('cp_plan_estudios_detalles AS ped')
                ->select(
                    DB::raw('"t" AS ini, "t" AS fin, COUNT( curso_id ) AS curso 
                    ,SUM(ped.hora_teoria_total) AS hora_teoria, SUM(ped.hora_practica_total) AS hora_practica, SUM(ped.hora_total) AS hora_total
                    ,SUM(ped.credito_teoria_total) AS credito_teoria, SUM(ped.credito_practica_total) AS credito_practica, SUM(ped.credito_total) AS credito_total')
                )
                ->where(
                    function($query) use ($r){
                        if( $r->has("plan_estudio_id") ){
                            $plan_estudio_id=trim($r->plan_estudio_id);
                            if( $plan_estudio_id !='' ){
                                $query->where('ped.plan_estudio_id',$plan_estudio_id);
                            }
                        }
                    }
                )
                ->where('ped.estado','1')
                ->groupBy('ped.plan_estudio_id');

        $sqlm1= DB::table('cp_plan_estudios_detalles AS ped')
                ->select(
                    DB::raw('"m" AS ini, "1" AS fin, COUNT( curso_id ) AS curso
                    ,SUM(ped.hora_teoria_presencial) AS hora_teoria, SUM(ped.hora_practica_presencial) AS hora_practica, (SUM(ped.hora_teoria_presencial) + SUM(ped.hora_practica_presencial)) AS hora_total
                    ,SUM(ped.credito_teoria_presencial) AS credito_teoria, SUM(ped.credito_practica_presencial) AS credito_practica, (SUM(ped.credito_teoria_presencial) + SUM(ped.credito_practica_presencial)) AS credito_total')
                )
                ->where(
                    function($query) use ($r){
                        if( $r->has("plan_estudio_id") ){
                            $plan_estudio_id=trim($r->plan_estudio_id);
                            if( $plan_estudio_id !='' ){
                                $query->where('ped.plan_estudio_id',$plan_estudio_id);
                            }
                        }
                    }
                )
                ->where('ped.estado','1')
                ->groupBy('ped.plan_estudio_id');

        $sqlm2= DB::table('cp_plan_estudios_detalles AS ped')
                ->select(
                    DB::raw('"m" AS ini, "2" AS fin, COUNT( curso_id ) AS curso
                    ,SUM(ped.hora_teoria_virtual) AS hora_teoria, SUM(ped.hora_practica_virtual) AS hora_practica, (SUM(ped.hora_teoria_virtual) + SUM(ped.hora_practica_virtual)) AS hora_total
                    ,SUM(ped.credito_teoria_virtual) AS credito_teoria, SUM(ped.credito_practica_virtual) AS credito_practica, (SUM(ped.credito_teoria_virtual) + SUM(ped.credito_practica_virtual)) AS credito_total')
                )
                ->where(
                    function($query) use ($r){
                        if( $r->has("plan_estudio_id") ){
                            $plan_estudio_id=trim($r->plan_estudio_id);
                            if( $plan_estudio_id !='' ){
                                $query->where('ped.plan_estudio_id',$plan_estudio_id);
                            }
                        }
                    }
                )
                ->where('ped.estado','1')
                ->groupBy('ped.plan_estudio_id');

        $sqle=  DB::table('cp_plan_estudios_detalles AS ped')
                ->select(
                    DB::raw('"e" AS ini, ped.tipo_estudio AS fin, COUNT( curso_id ) AS curso
                    ,SUM(ped.hora_teoria_total) AS hora_teoria, SUM(ped.hora_practica_total) AS hora_practica, SUM(ped.hora_total) AS hora_total
                    ,SUM(ped.credito_teoria_total) AS credito_teoria, SUM(ped.credito_practica_total) AS credito_practica, SUM(ped.credito_total) AS credito_total')
                )
                ->where(
                    function($query) use ($r){
                        if( $r->has("plan_estudio_id") ){
                            $plan_estudio_id=trim($r->plan_estudio_id);
                            if( $plan_estudio_id !='' ){
                                $query->where('ped.plan_estudio_id',$plan_estudio_id);
                            }
                        }
                    }
                )
                ->where('ped.estado','1')
                ->groupBy('ped.plan_estudio_id','ped.tipo_estudio');

        $sqlt=  DB::table('cp_plan_estudios_detalles AS ped')
                ->select(
                    DB::raw('"t" AS ini, ped.tipo_curso AS fin, COUNT( curso_id ) AS curso
                    ,SUM(ped.hora_teoria_total) AS hora_teoria, SUM(ped.hora_practica_total) AS hora_practica, SUM(ped.hora_total) AS hora_total
                    ,SUM(ped.credito_teoria_total) AS credito_teoria, SUM(ped.credito_practica_total) AS credito_practica, SUM(ped.credito_total) AS credito_total')
                )
                ->where(
                    function($query) use ($r){
                        if( $r->has("plan_estudio_id") ){
                            $plan_estudio_id=trim($r->plan_estudio_id);
                            if( $plan_estudio_id !='' ){
                                $query->where('ped.plan_estudio_id',$plan_estudio_id);
                            }
                        }
                    }
                )
                ->where('ped.estado','1')
                ->groupBy('ped.plan_estudio_id','ped.tipo_curso');

        $result =   $sqltt->unionAll($sqle)
                    ->unionAll($sqlm1)
                    ->unionAll($sqlm2)
                    ->unionAll($sqlt)
                    ->get();
        return $result;
    }

}
