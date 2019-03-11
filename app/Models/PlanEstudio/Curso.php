<?php
namespace App\Models\PlanEstudio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class Curso extends Model
{
    protected   $table = 'cm_cursos';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $curso = Curso::find($r->id);
        $curso->estado = trim( $r->estadof );
        $curso->persona_id_updated_at=$persona_id;
        $curso->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $curso = new Curso;
        $curso->curso = trim( $r->curso );
        $curso->codigo = trim( $r->codigo );
        $curso->estado = trim( $r->estado );
        $curso->persona_id_created_at=$persona_id;
        $curso->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $curso = Curso::find($r->id);
        $curso->curso = trim( $r->curso );
        $curso->codigo = trim( $r->codigo );
        $curso->estado = trim( $r->estado );
        $curso->persona_id_updated_at=$persona_id;
        $curso->save();
    }

    public static function runLoad($r)
    {

        $sql=Curso::select('id','curso','codigo','estado')
            ->where( 
                function($query) use ($r){
                    if( $r->has("curso") ){
                        $curso=trim($r->curso);
                        if( $curso !='' ){
                            $query->where('curso','like','%'.$curso.'%');
                        }
                    }
                    if( $r->has("codigo") ){
                        $codigo=trim($r->codigo);
                        if( $codigo !='' ){
                            $query->where('codigo','like','%'.$codigo.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('estado','=',$estado);
                        }
                    }
                }
            );
        $result = $sql->orderBy('curso','asc')->paginate(10);
        return $result;
    }
    
    public static function ListCurso($r)
    {
        $sql=Curso::select('id','curso','codigo','estado')
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('curso','like','%'.$dphrase[0].'%');
                            if( count($dphrase)>1 AND trim($dphrase[1])!='' ){
                                $dphrase[1]=trim($dphrase[1]);
                                $query->where('codigo','like','%'.$dphrase[1].'%');
                            }
                        }
                    }
                }
            )
            ->where('estado','=','1');
        $result = $sql->orderBy('curso','asc')->get();
        return $result;
    }

    public static function ListCursoPlan($r)
    {
        $sql=DB::table('cm_cursos AS c')
            ->join('cp_plan_estudios_detalles AS ped',function($join){
                $join->on('ped.curso_id','=','c.id')
                ->where('ped.estado',1);
            })
            ->join('cp_plan_estudios AS pe',function($join){
                $join->on('pe.id','=','ped.plan_estudio_id')
                ->where('pe.estado',1);
            })
            ->join('ep_grupo_academico AS ga',function($join){
                $join->on('ga.plan_estudio_id','=','ped.plan_estudio_id')
                ->on('ga.ciclo_id','=','ped.ciclo_id')
                ->where('ga.estado',1);
            })
            ->select('c.id','c.curso','c.codigo','ped.hora_total')
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('c.curso','like','%'.$dphrase[0].'%');
                            if( count($dphrase)>1 AND trim($dphrase[1])!='' ){
                                $dphrase[1]=trim($dphrase[1]);
                                $query->where('c.codigo','like','%'.$dphrase[1].'%');
                            }
                        }
                    }
                    if( $r->has("grupo_academico_id") ){
                        $grupo_academico_id= trim($r->grupo_academico_id);
                        if( $grupo_academico_id!='' ){
                            $query->where('ga.id',$grupo_academico_id);
                        }
                    }
                }
            )
            ->where('c.estado',1);
        $result = $sql->orderBy('c.curso','asc')->get();
        return $result;
    }
    

}
