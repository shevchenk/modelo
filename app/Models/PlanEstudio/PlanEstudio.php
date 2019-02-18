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
        $planEstudio = new PlanEstudio;
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
                'pe.credito_practica','pe.estado',
                'm.modalidad',
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
        $result = $sql->orderBy('pe.plan_estudio','asc')->paginate(10);
        return $result;
    }
    
    public static function ListPlanEstudio($r)
    {
        $sql=PlanEstudio::select('id','carrera','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('carrera','asc')->get();
        return $result;
    }
    

}
