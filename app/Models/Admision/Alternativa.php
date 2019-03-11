<?php
namespace App\Models\Admision;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class Alternativa extends Model
{
    protected   $table = 'dm_cursos_preguntas_alternativas';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $alternativa = Alternativa::find($r->id);
        $alternativa->estado = trim( $r->estadof );
        $alternativa->persona_id_updated_at=$persona_id;
        $alternativa->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $alternativa = new Alternativa;
        $alternativa->curso_pregunta_id = trim( $r->pregunta_id );
        $alternativa->alternativa = trim( $r->alternativa );
        $alternativa->correcto = trim( $r->correcto );
        $alternativa->estado = trim( $r->estado );
        $alternativa->persona_id_created_at=$persona_id;
        $alternativa->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $alternativa = Alternativa::find($r->id);
        $alternativa->curso_pregunta_id = trim( $r->pregunta_id );
        $alternativa->alternativa = trim( $r->alternativa );
        $alternativa->correcto = trim( $r->correcto );
        $alternativa->estado = trim( $r->estado );
        $alternativa->persona_id_updated_at=$persona_id;
        $alternativa->save();
    }

    public static function runLoad($r)
    {

        $sql=Alternativa::select('dm_cursos_preguntas_alternativas.id','dm_cursos_preguntas_alternativas.curso_pregunta_id','dm_cursos_preguntas_alternativas.alternativa','dm_cursos_preguntas_alternativas.correcto'
                    ,'dm_cursos_preguntas_alternativas.estado','cc.pregunta',DB::raw('CASE dm_cursos_preguntas_alternativas.correcto WHEN 0 THEN "Incorrecto" WHEN 1 THEN "Correcto" ELSE 0 END as correcto_nombre'))
            ->join('dm_cursos_preguntas AS cc',function($join){
                $join->on('cc.id','=','dm_cursos_preguntas_alternativas.curso_pregunta_id');
                //->where('cc.estado','=',1);
            })
            ->where( 
                function($query) use ($r){
                    if( $r->has("pregunta_id") ){
                        $pregunta_id=trim($r->pregunta_id);
                        if( $pregunta_id !='' ){
                            $query->where('dm_cursos_preguntas_alternativas.curso_pregunta_id','=',$pregunta_id);
                        }
                    }
                    if( $r->has("alternativa") ){
                        $alternativa=trim($r->alternativa);
                        if( $alternativa !='' ){
                            $query->where('dm_cursos_preguntas_alternativas.alternativa','like','%'.$alternativa.'%');
                        }
                    }
                    if( $r->has("correcto") ){
                        $correcto=trim($r->correcto);
                        if( $correcto !='' ){
                            $query->where('dm_cursos_preguntas_alternativas.correcto','=',$correcto);
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('dm_cursos_preguntas_alternativas.estado','=',$estado);
                        }
                    }
                }
            );
        $result = $sql->orderBy('dm_cursos_preguntas_alternativas.id','asc')->paginate(10);
        return $result;
    }

}
