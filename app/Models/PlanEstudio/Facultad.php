<?php

namespace App\Models\PlanEstudio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class Facultad extends Model
{
    protected   $table = 'cm_facultades';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $facultad = Facultad::find($r->id);
        $facultad->estado = trim( $r->estadof );
        $facultad->persona_id_updated_at=$persona_id;
        $facultad->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $facultad = new Facultad;
        $facultad->facultad = trim( $r->facultad );
        $facultad->estado = trim( $r->estado );
        $facultad->persona_id_created_at=$persona_id;
        $facultad->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $facultad = Facultad::find($r->id);
        $facultad->facultad = trim( $r->facultad );
        $facultad->estado = trim( $r->estado );
        $facultad->persona_id_updated_at=$persona_id;
        $facultad->save();
    }

    public static function runLoad($r)
    {

        $sql=Facultad::select('id','facultad','estado')
            ->where( 
                function($query) use ($r){
                    if( $r->has("facultad") ){
                        $facultad=trim($r->facultad);
                        if( $facultad !='' ){
                            $query->where('facultad','like','%'.$facultad.'%');
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
        $result = $sql->orderBy('facultad','asc')->paginate(10);
        return $result;
    }
    
    public static function ListFacultad($r)
    {
        $sql=Facultad::select('id','facultad','estado')
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('facultad','like','%'.$dphrase[0].'%');
                        }
                    }
                }
            )
            ->where('estado','=','1');
        $result = $sql->orderBy('facultad','asc')->get();
        return $result;
    }
    

}
