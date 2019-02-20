<?php

namespace App\Models\PlanEstudio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class Semestre extends Model
{
    protected   $table = 'dm_semestres';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $semestre = Semestre::find($r->id);
        $semestre->estado = trim( $r->estadof );
        $semestre->persona_id_updated_at=$persona_id;
        $semestre->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $semestre = new Semestre;
        $semestre->semestre = trim( $r->semestre );

        if( trim( $r->fecha_inicio )!='' ){
            $semestre->fecha_inicio = trim( $r->fecha_inicio );
        }

        if( trim( $r->fecha_final )!='' ){
            $semestre->fecha_final = trim( $r->fecha_final );
        }
        
        $semestre->estado = trim( $r->estado );
        $semestre->persona_id_created_at=$persona_id;
        $semestre->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $semestre = Semestre::find($r->id);
        $semestre->semestre = trim( $r->semestre );
        $semestre->fecha_inicio = trim( $r->fecha_inicio );
        $semestre->fecha_final = trim( $r->fecha_final );
        $semestre->estado = trim( $r->estado );
        $semestre->persona_id_updated_at=$persona_id;
        $semestre->save();
    }

    public static function runLoad($r)
    {
        $sql=DB::table('dm_semestres as s')
            ->select(
                's.id','s.semestre','s.fecha_inicio','s.fecha_final','s.estado'
            )
            ->where( 
                function($query) use ($r){
                    if( $r->has("semestre") ){
                        $semestre=trim($r->semestre);
                        if( $semestre !='' ){
                            $query->where('s.semestre','like','%'.$semestre.'%');
                        }
                    }
                    if( $r->has("fecha_inicio") ){
                        $fecha_inicio=trim($r->fecha_inicio);
                        if( $fecha_inicio !='' ){
                            $query->where('s.fecha_inicio','like','%'.$fecha_inicio.'%');
                        }
                    }
                    if( $r->has("fecha_final") ){
                        $fecha_final=trim($r->fecha_final);
                        if( $fecha_final !='' ){
                            $query->where('s.fecha_final','like','%'.$fecha_final.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('s.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('s.semestre','desc')->paginate(10);
        return $result;
    }
    
    public static function ListSemestre($r)
    {
        $sql=DB::table('dm_semestres as s')
            ->select(
                's.id','s.semestre','s.fecha_inicio','s.fecha_final','s.estado'
            )
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('s.semestre','like','%'.$dphrase[0].'%');
                        }
                    }
                }
            )
            ->where('s.estado','=','1');
        $result = $sql->orderBy('s.semestre','asc')->get();
        return $result;
    }
    

}
