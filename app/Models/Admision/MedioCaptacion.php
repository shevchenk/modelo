<?php
namespace App\Models\Admision;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class MedioCaptacion extends Model
{
    protected   $table = 'dm_medios_captaciones';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $medioCaptacion = MedioCaptacion::find($r->id);
        $medioCaptacion->estado = trim( $r->estadof );
        $medioCaptacion->persona_id_updated_at=$persona_id;
        $medioCaptacion->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $medioCaptacion = new MedioCaptacion;
        $medioCaptacion->medio_captacion = trim( $r->medio_captacion );
        $medioCaptacion->tipo_medio = trim( $r->tipo_medio );
        $medioCaptacion->estado = trim( $r->estado );
        $medioCaptacion->persona_id_created_at=$persona_id;
        $medioCaptacion->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $medioCaptacion = MedioCaptacion::find($r->id);
        $medioCaptacion->medio_captacion = trim( $r->medio_captacion );
        $medioCaptacion->tipo_medio = trim( $r->tipo_medio );
        $medioCaptacion->estado = trim( $r->estado );
        $medioCaptacion->persona_id_updated_at=$persona_id;
        $medioCaptacion->save();
    }

    public static function runLoad($r)
    {

        $sql=MedioCaptacion::select('id','medio_captacion','tipo_medio','estado',
            DB::raw('IF(tipo_medio=0,"Medios Masivos",IF(tipo_medio=1,"Comisionan","No Comisionan")) AS tipo_medio_texto'))
            ->where( 
                function($query) use ($r){
                    if( $r->has("medio_captacion") ){
                        $medio_captacion=trim($r->medio_captacion);
                        if( $medio_captacion !='' ){
                            $query->where('medio_captacion','like','%'.$medio_captacion.'%');
                        }
                    }
                    if( $r->has("tipo_medio") ){
                        $tipo_medio=trim($r->tipo_medio);
                        if( $tipo_medio !='' ){
                            $query->where('tipo_medio','=',$tipo_medio);
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
        $result = $sql->orderBy('medio_captacion','asc')->paginate(10);
        return $result;
    }
    
    public static function ListMedioCaptacion($r)
    {
        $sql=MedioCaptacion::select('id','medio_captacion','tipo_medio','estado',
            DB::raw('IF(tipo_medio=0,"Medios Masivos",IF(tipo_medio=1,"Comisionan","No Comisionan")) AS tipo_medio_texto'))
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('medio_captacion','like','%'.$dphrase[0].'%');
                            if( count($dphrase)>1 AND trim($dphrase[1])!='' ){
                                $dphrase[1]=trim($dphrase[1]);
                                $texto=array("Medios Masivos","Comisionan","No Comisionan");
                                $filtro=array(-1);
                                for ($i=0; $i < count($texto) ; $i++) { 
                                    $pos=mb_stripos($texto[$i], $dphrase[1], 0);
                                    if($pos!=false){
                                        array_push($filtro,$i); 
                                    }
                                }
                                $query->whereIn('tipo_medio',$filtro);
                            }
                        }
                    }
                }
            )
            ->where('estado','=','1');
        $result = $sql->orderBy('medio_captacion','asc')->get();
        return $result;
    }
    

}
