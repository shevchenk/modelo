<?php

namespace App\Models\PlanEstudio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class Modalidad extends Model
{
    protected   $table = 'ca_modalidades';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $modalidad = Modalidad::find($r->id);
        $modalidad->estado = trim( $r->estadof );
        $modalidad->persona_id_updated_at=$persona_id;
        $modalidad->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $modalidad = new Modalidad;
        $modalidad->modalidad = trim( $r->modalidad );
        $modalidad->estado = trim( $r->estado );
        $modalidad->persona_id_created_at=$persona_id;
        $modalidad->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $modalidad = Modalidad::find($r->id);
        $modalidad->modalidad = trim( $r->modalidad );
        $modalidad->estado = trim( $r->estado );
        $modalidad->persona_id_updated_at=$persona_id;
        $modalidad->save();
    }

    public static function runLoad($r)
    {

        $sql=Modalidad::select('id','modalidad','estado')
            ->where( 
                function($query) use ($r){
                    if( $r->has("modalidad") ){
                        $modalidad=trim($r->modalidad);
                        if( $modalidad !='' ){
                            $query->where('modalidad','like','%'.$modalidad.'%');
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
        $result = $sql->orderBy('modalidad','asc')->paginate(10);
        return $result;
    }
    
    public static function ListModalidad($r)
    {
        $sql=Modalidad::select('id','modalidad','estado')
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('modalidad','like','%'.$dphrase[0].'%');
                        }
                    }
                }
            )
            ->where('estado','=','1');
        $result = $sql->orderBy('modalidad','asc')->get();
        return $result;
    }
    

}
