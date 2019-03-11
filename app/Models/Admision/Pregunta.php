<?php
namespace App\Models\Admision;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class Pregunta extends Model
{
    protected   $table = 'dm_cursos_preguntas';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $pregunta = Pregunta::find($r->id);
        $pregunta->estado = trim( $r->estadof );
        $pregunta->persona_id_updated_at=$persona_id;
        $pregunta->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $pregunta = new Pregunta;
        $pregunta->curso_id = trim( $r->curso_id );
        $pregunta->pregunta = trim( $r->pregunta );
        $pregunta->tipo_pregunta = trim( $r->tipo_pregunta );
        $pregunta->estado = trim( $r->estado );
        $pregunta->persona_id_created_at=$persona_id;
        $pregunta->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $pregunta = Pregunta::find($r->id);
        $pregunta->curso_id = trim( $r->curso_id );
        $pregunta->pregunta = trim( $r->pregunta );
        $pregunta->tipo_pregunta = trim( $r->tipo_pregunta );
        $pregunta->estado = trim( $r->estado );
        $pregunta->persona_id_updated_at=$persona_id;
        $pregunta->save();
    }

    public static function runLoad($r)
    {

        $sql=Pregunta::select('dm_cursos_preguntas.id','dm_cursos_preguntas.curso_id','dm_cursos_preguntas.pregunta','dm_cursos_preguntas.tipo_pregunta'
                ,'dm_cursos_preguntas.estado','cc.curso',DB::raw('CASE dm_cursos_preguntas.tipo_pregunta WHEN 1 THEN "Con Alternativa" WHEN 2 THEN "Libre" ELSE 0 END as tipo_pregunta_nombre'))
            ->join('cm_cursos AS cc',function($join){
                $join->on('cc.id','=','dm_cursos_preguntas.curso_id');
                //->where('cc.estado','=',1);
            })
            ->where( 
                function($query) use ($r){
                    if( $r->has("curso") ){
                        $curso=trim($r->curso);
                        if( $curso !='' ){
                            $query->where('cc.curso','like','%'.$curso.'%');
                        }
                    }
                    if( $r->has("pregunta") ){
                        $pregunta=trim($r->pregunta);
                        if( $pregunta !='' ){
                            $query->where('dm_cursos_preguntas.pregunta','like','%'.$pregunta.'%');
                        }
                    }
                    if( $r->has("tipo_pregunta") ){
                        $tipo_pregunta=trim($r->tipo_pregunta);
                        if( $tipo_pregunta !='' ){
                            $query->where('dm_cursos_preguntas.tipo_pregunta','=',$tipo_pregunta);
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('dm_cursos_preguntas.estado','=',$estado);
                        }
                    }
                }
            );
        $result = $sql->orderBy('dm_cursos_preguntas.id','asc')->paginate(10);
        return $result;
    }

}
