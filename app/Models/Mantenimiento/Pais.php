<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use DB;

class Pais extends Model
{
    protected   $table = 'am_paises';
    
    public static function ListPais($r)
    {
        $sql=DB::table('am_paises as pa')
            ->select('pa.id','pa.pais','pa.abreviatura')
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $pais=trim($r->phrase);
                        if( $pais !='' ){
                            $query->where('pa.pais','like','%'.$pais.'%');
                        }
                    }
                }
            )
            ->where('pa.estado','=','1');
        $result = $sql->get();
        return $result;
    }
}
