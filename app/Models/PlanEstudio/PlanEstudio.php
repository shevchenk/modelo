<?php

namespace App\Models\PlanEstudio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class PlanEstudio extends Model
{
    protected   $table = 'cp_plan_estudios';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $planEstudio = PlanEstudio::find($r->id);
        $planEstudio->estado = trim( $r->estadof );
        $planEstudio->persona_id_updated_at=$persona_id;
        $planEstudio->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;

        $posicion= DB::table('cp_plan_estudios')
                    ->where('modalidad_id',$r->modalidad_id)
                    ->where('carrera_id',$r->carrera_id)
                    ->max('nro_plan_estudio');

        $planEstudio = new PlanEstudio;
        $planEstudio->modalidad_id = trim( $r->modalidad_id );
        $planEstudio->carrera_id = trim( $r->carrera_id );
        $planEstudio->facultad_id = trim( $r->facultad_id );
        $planEstudio->nro_plan_estudio = trim( ($posicion+1) );
        $planEstudio->plan_estudio = trim( $r->plan_estudio );
        $planEstudio->perfil_profesional = trim( $r->perfil_profesional );
        $planEstudio->resolucion = trim( $r->resolucion );
        $planEstudio->regimen_estudio = trim( $r->regimen_estudio );
        $planEstudio->regimen_otro = trim( $r->regimen_otro );
        $planEstudio->periodo_academico = trim( $r->periodo_academico );
        $planEstudio->duracion = trim( $r->duracion );
        $planEstudio->credito_teoria = trim( $r->credito_teoria );
        $planEstudio->credito_practica = trim( $r->credito_practica );
        
        if( trim( $r->fecha_resolucion )!='' ){
            $planEstudio->fecha_resolucion = trim( $r->fecha_resolucion );
        }

        $planEstudio->estado = trim( $r->estado );
        $planEstudio->persona_id_created_at=$persona_id;
        $planEstudio->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $planEstudio = PlanEstudio::find($r->id);
        $planEstudio->modalidad_id = trim( $r->modalidad_id );
        $planEstudio->carrera_id = trim( $r->carrera_id );
        $planEstudio->facultad_id = trim( $r->facultad_id );
        $planEstudio->plan_estudio = trim( $r->plan_estudio );
        $planEstudio->perfil_profesional = trim( $r->perfil_profesional );
        $planEstudio->resolucion = trim( $r->resolucion );
        $planEstudio->regimen_estudio = trim( $r->regimen_estudio );
        $planEstudio->regimen_otro = trim( $r->regimen_otro );
        $planEstudio->periodo_academico = trim( $r->periodo_academico );
        $planEstudio->duracion = trim( $r->duracion );
        $planEstudio->credito_teoria = trim( $r->credito_teoria );
        $planEstudio->credito_practica = trim( $r->credito_practica );

        $planEstudio->fecha_resolucion = null;
        if( trim( $r->fecha_resolucion )!='' ){
            $planEstudio->fecha_resolucion = trim( $r->fecha_resolucion );
        }
        
        $planEstudio->estado = trim( $r->estado );
        $planEstudio->persona_id_updated_at=$persona_id;
        $planEstudio->save();
    }

    public static function runLoad($r)
    {
        $sql=DB::table('cp_plan_estudios as pe')
            ->join('ca_modalidades AS m',function($join){
                $join->on('m.id','=','pe.modalidad_id');
            })
            ->join('cm_carreras AS c',function($join){
                $join->on('c.id','=','pe.carrera_id');
            })
            ->join('cm_facultades AS f',function($join){
                $join->on('f.id','=','pe.facultad_id');
            })
            ->select(
                'pe.id','pe.modalidad_id','pe.carrera_id','pe.facultad_id',
                'pe.plan_estudio','pe.perfil_profesional','pe.resolucion',
                'pe.fecha_resolucion','pe.regimen_estudio','pe.regimen_otro',
                'pe.periodo_academico','pe.duracion','pe.credito_teoria',
                'pe.credito_practica','pe.estado','pe.nro_plan_estudio',
                'm.modalidad','pe.created_at',
                'f.facultad',
                'c.carrera','c.codigo'
            )
            ->where( 
                function($query) use ($r){
                    if( $r->has("facultad") ){
                        $facultad=trim($r->facultad);
                        if( $facultad !='' ){
                            $query->where('f.facultad','like','%'.$facultad.'%');
                        }
                    }
                    if( $r->has("carrera") ){
                        $carrera=trim($r->carrera);
                        if( $carrera !='' ){
                            $query->where('c.carrera','like','%'.$carrera.'%');
                        }
                    }
                    if( $r->has("modalidad") ){
                        $modalidad=trim($r->modalidad);
                        if( $modalidad !='' ){
                            $query->where('m.modalidad','like','%'.$modalidad.'%');
                        }
                    }
                    if( $r->has("plan_estudio") ){
                        $plan_estudio=trim($r->plan_estudio);
                        if( $plan_estudio !='' ){
                            $query->where('pe.plan_estudio','like','%'.$plan_estudio.'%');
                        }
                    }
                    if( $r->has("perfil_profesional") ){
                        $perfil_profesional=trim($r->perfil_profesional);
                        if( $perfil_profesional !='' ){
                            $query->where('pe.perfil_profesional','like','%'.$perfil_profesional.'%');
                        }
                    }
                    if( $r->has("resolucion") ){
                        $resolucion=trim($r->resolucion);
                        if( $resolucion !='' ){
                            $query->where('pe.resolucion','like','%'.$resolucion.'%');
                        }
                    }
                    if( $r->has("fecha_resolucion") ){
                        $fecha_resolucion=trim($r->fecha_resolucion);
                        if( $fecha_resolucion !='' ){
                            $query->where('pe.fecha_resolucion','like','%'.$fecha_resolucion.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('pe.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('f.facultad','asc')
                    ->orderBy('c.carrera','asc')
                    ->orderBy('m.modalidad','asc')
                    ->orderBy('pe.nro_plan_estudio','desc')
                    ->paginate(10);
        return $result;
    }
    
    public static function ListPlanEstudio($r)
    {
        $sql=PlanEstudio::select('id','carrera','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('carrera','asc')->get();
        return $result;
    }
    
    public static function runReplicar($r)
    {
        DB::beginTransaction();
        $persona_id=Auth::user()->id;
        $planEstudioAux = PlanEstudio::find($r->id);

        $posicion= DB::table('cp_plan_estudios')
                    ->where('modalidad_id',$planEstudioAux->modalidad_id)
                    ->where('carrera_id',$planEstudioAux->carrera_id)
                    ->max('nro_plan_estudio');

        $planEstudio = new PlanEstudio;
        $planEstudio->modalidad_id = $planEstudioAux->modalidad_id;
        $planEstudio->carrera_id = $planEstudioAux->carrera_id;
        $planEstudio->facultad_id = $planEstudioAux->facultad_id;
        $planEstudio->nro_plan_estudio = trim( ($posicion+1) );
        $planEstudio->plan_estudio = $planEstudioAux->plan_estudio." - Replicado";
        $planEstudio->perfil_profesional = $planEstudioAux->perfil_profesional;
        $planEstudio->resolucion = $planEstudioAux->resolucion;
        $planEstudio->regimen_estudio = $planEstudioAux->regimen_estudio;
        $planEstudio->regimen_otro = $planEstudioAux->regimen_otro;
        $planEstudio->periodo_academico = $planEstudioAux->periodo_academico;
        $planEstudio->duracion = $planEstudioAux->duracion;
        $planEstudio->credito_teoria = $planEstudioAux->credito_teoria;
        $planEstudio->credito_practica = $planEstudioAux->credito_practica;
        $planEstudio->fecha_resolucion = $planEstudioAux->fecha_resolucion;
        $planEstudio->estado = 1;
        $planEstudio->persona_id_created_at=$persona_id;
        $planEstudio->save();

        $planEstudioDetalleAux= DB::table('cp_plan_estudios_detalles')
                                ->where('estado','1')
                                ->where('plan_estudio_id',$planEstudioAux->id)
                                ->get();

        foreach ($planEstudioDetalleAux as $key => $value) {
            $planEstudioDetalle = new PlanEstudioDetalle;
            $planEstudioDetalle->plan_estudio_id = $planEstudio->id;
            $planEstudioDetalle->ciclo_id = $value->ciclo_id;
            $planEstudioDetalle->curso_id = $value->curso_id;
            $planEstudioDetalle->requisitos = $value->requisitos;
            $planEstudioDetalle->tipo_estudio = $value->tipo_estudio;
            $planEstudioDetalle->tipo_curso = $value->tipo_curso;
            $planEstudioDetalle->hora_teoria_presencial = $value->hora_teoria_presencial;
            $planEstudioDetalle->hora_teoria_virtual = $value->hora_teoria_virtual;
            $planEstudioDetalle->hora_teoria_total = $value->hora_teoria_total;
            $planEstudioDetalle->hora_practica_presencial = $value->hora_practica_presencial;
            $planEstudioDetalle->hora_practica_virtual = $value->hora_practica_virtual;
            $planEstudioDetalle->hora_practica_total = $value->hora_practica_total;
            $planEstudioDetalle->hora_total = $value->hora_total;
            $planEstudioDetalle->credito_teoria_presencial = $value->credito_teoria_presencial;
            $planEstudioDetalle->credito_teoria_virtual = $value->credito_teoria_virtual;
            $planEstudioDetalle->credito_teoria_total = $value->credito_teoria_total;
            $planEstudioDetalle->credito_practica_presencial = $value->credito_practica_presencial;
            $planEstudioDetalle->credito_practica_virtual = $value->credito_practica_virtual;
            $planEstudioDetalle->credito_practica_total = $value->credito_practica_total;
            $planEstudioDetalle->credito_total = $value->credito_total;
            $planEstudioDetalle->estado = 1;
            $planEstudioDetalle->persona_id_created_at=$persona_id;
            $planEstudioDetalle->save();
        }
        DB::commit();
    }

}
