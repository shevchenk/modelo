<?php
namespace App\Models\PlanEstudio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

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
    

}
