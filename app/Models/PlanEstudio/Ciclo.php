<?php

namespace App\Models\PlanEstudio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class Ciclo extends Model
{
    protected   $table = 'ca_ciclos';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $ciclo = Ciclo::find($r->id);
        $ciclo->estado = trim( $r->estadof );
        $ciclo->persona_id_updated_at=$persona_id;
        $ciclo->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $ciclo = new Ciclo;
        $ciclo->ciclo = trim( $r->ciclo );
        $ciclo->estado = trim( $r->estado );
        $ciclo->persona_id_created_at=$persona_id;
        $ciclo->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $ciclo = Ciclo::find($r->id);
        $ciclo->ciclo = trim( $r->ciclo );
        $ciclo->estado = trim( $r->estado );
        $ciclo->persona_id_updated_at=$persona_id;
        $ciclo->save();
    }

    public static function runLoad($r)
    {

        $sql=Ciclo::select('id','ciclo','estado')
            ->where( 
                function($query) use ($r){
                    if( $r->has("ciclo") ){
                        $ciclo=trim($r->ciclo);
                        if( $ciclo !='' ){
                            $query->where('ciclo','like','%'.$ciclo.'%');
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
        $result = $sql->orderBy('ciclo','asc')->paginate(10);
        return $result;
    }
    
    public static function ListCiclo($r)
    {
        $sql=Ciclo::select('id','ciclo','estado')
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('ciclo','like','%'.$dphrase[0].'%');
                        }
                    }
                }
            )
            ->where('estado','=','1');
        $result = $sql->orderBy('ciclo','asc')->get();
        return $result;
    }
    

}
