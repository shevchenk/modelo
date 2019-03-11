<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use DB;

class Ambiente extends Model
{
    protected   $table = 'am_locales_ambientes';
    
    public static function ListAmbiente($r)
    {
        $sql=DB::table('am_locales_ambientes AS am')
            ->select('am.id','am.ambiente','am.aforo',
            DB::raw('CONCAT("Piso:",am.piso," | ",p.pabellon) AS detalle'))
            ->join('am_locales_pabellones AS p',function($join){
                $join->on('am.pabellon_id','=','p.id')
                ->where('p.estado',1);
            })
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('am.ambiente','like','%'.$dphrase[0].'%');
                            if( count($dphrase)>1 AND trim($dphrase[1])!='' ){
                                $dphrase[1]=trim($dphrase[1]);
                                $query->where('p.pabellon','like','%'.$dphrase[1].'%');
                            }
                        }
                    }
                    if( $r->has("local_id") ){
                        $local_id=trim($r->local_id);
                        if( $local_id !='' ){
                            $query->where('am.local_id',$local_id);
                        }
                    }
                    if( $r->has("tipo_ambiente") ){
                        $tipo_ambiente=trim($r->tipo_ambiente);
                        if( $tipo_ambiente !='' ){
                            $query->where('am.tipo_ambiente',$tipo_ambiente);
                        }
                    }
                }
            )
            ->where('am.estado',1);
        $result = $sql->get();
        return $result;
    }
}
