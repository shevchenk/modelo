<?php

namespace App\Models\PlanEstudio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class Carrera extends Model
{
    protected   $table = 'cm_carreras';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $carrera = Carrera::find($r->id);
        $carrera->estado = trim( $r->estadof );
        $carrera->persona_id_updated_at=$persona_id;
        $carrera->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $carrera = new Carrera;
        $carrera->carrera = trim( $r->carrera );
        $carrera->codigo = trim( $r->codigo );
        $carrera->facultad_id = trim( $r->facultad_id );
        $carrera->grado_academico = trim( $r->grado_academico );
        $carrera->titulo_profesional = trim( $r->titulo_profesional );
        $carrera->estado = trim( $r->estado );
        $carrera->persona_id_created_at=$persona_id;
        $carrera->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $carrera = Carrera::find($r->id);
        $carrera->carrera = trim( $r->carrera );
        $carrera->codigo = trim( $r->codigo );
        $carrera->facultad_id = trim( $r->facultad_id );
        $carrera->grado_academico = trim( $r->grado_academico );
        $carrera->titulo_profesional = trim( $r->titulo_profesional );
        $carrera->estado = trim( $r->estado );
        $carrera->persona_id_updated_at=$persona_id;
        $carrera->save();
    }

    public static function runLoad($r)
    {
        $sql=DB::table('cm_carreras as c')
            ->join('cm_facultades AS f',function($join){
                $join->on('f.id','=','c.facultad_id');
            })
            ->select(
                'c.id',
                'c.carrera',
                'c.codigo',
                'c.grado_academico',
                'c.titulo_profesional',
                'c.estado',
                'f.facultad',
                'c.facultad_id'
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
                    if( $r->has("codigo") ){
                        $codigo=trim($r->codigo);
                        if( $codigo !='' ){
                            $query->where('c.codigo','like','%'.$codigo.'%');
                        }
                    }
                    if( $r->has("grado_academico") ){
                        $grado_academico=trim($r->grado_academico);
                        if( $grado_academico !='' ){
                            $query->where('c.grado_academico','like','%'.$grado_academico.'%');
                        }
                    }
                    if( $r->has("titulo_profesional") ){
                        $titulo_profesional=trim($r->titulo_profesional);
                        if( $titulo_profesional !='' ){
                            $query->where('c.titulo_profesional','like','%'.$titulo_profesional.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('c.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('c.carrera','asc')->paginate(10);
        return $result;
    }
    
    public static function ListCarrera($r)
    {
        $sql=DB::table('cm_carreras as c')
            ->join('cm_facultades AS f',function($join){
                $join->on('f.id','=','c.facultad_id')
                ->where('f.estado','=','1');
            })
            ->select(
                'c.id',
                'c.carrera','c.codigo',
                'f.facultad',
                'c.facultad_id',
                'c.estado'
            )
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('c.carrera','like','%'.$dphrase[0].'%');
                            if( count($dphrase)>1 AND trim($dphrase[1])!='' ){
                                $dphrase[1]=trim($dphrase[1]);
                                $query->where('f.facultad','like',$dphrase[1].'%');
                            }
                        }
                    }
                }
            )
            ->where('c.estado','=','1');
        $result = $sql->orderBy('c.carrera','asc')->get();
        return $result;
    }

    public static function ListCarreraPlanEstudio($r)
    {
        $sql=DB::table('cp_plan_estudios AS pe')
            ->join('cm_carreras AS c',function($join){
                $join->on('c.id','=','pe.carrera_id')
                ->where('c.estado','=','1');
            })
            ->select(
                'pe.nro_plan_estudio',
                'pe.plan_estudio','pe.id AS plan_estudio_id',
                'c.carrera','c.id AS carrera_id',
                DB::raw('CONCAT("( ",pe.nro_plan_estudio," )",pe.plan_estudio) AS plan_estudio_text')
            )
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('c.carrera','like','%'.$dphrase[0].'%');
                            if( count($dphrase)>1 AND trim($dphrase[1])!='' ){
                                $dphrase[1]=trim($dphrase[1]);
                                $query->where('pe.plan_estudio','like','%'.$dphrase[1].'%');
                            }
                        }
                    }
                    if( $r->has('modalidad_id') ){
                        $modalidad_id= $r->modalidad_id;
                        $query->whereIn('pe.modalidad_id',$modalidad_id);
                    }
                }
            )
            ->where('pe.estado','=','1');
        $result = $sql->orderBy('c.carrera','asc')->get();
        return $result;
    }
    

}
