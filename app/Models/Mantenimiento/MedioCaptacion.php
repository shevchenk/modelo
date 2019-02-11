<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use DB;

class MedioCaptacion extends Model
{
    protected   $table = 'dm_medios_captaciones';
    
    public static function ListMedioCaptacion($r)
    {
        $sql=MedioCaptacion::select('id','medio_captacion','tipo_medio','estado')
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $medio_captacion=trim($r->phrase);
                        if( $medio_captacion !='' ){
                            $query->where('medio_captacion','like','%'.$medio_captacion.'%');
                        }
                    }
                    if( $r->has("tipo_medio") ){
                        $tipo_medio=trim($r->tipo_medio);
                        $query->where('tipo_medio',$tipo_medio);
                    }
                }
            )
            ->where('estado','=','1');
        $result = $sql->get();
        return $result;
    }
}
