<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use DB;

class Distrito extends Model
{
    protected   $table = 'aa_distritos';
    
    public static function ListDistrito($r)
    {
        $sql=DB::table('aa_distritos as di')
            ->select('di.id','di.distrito','di.provincia_id'
            ,'pr.region_id','pr.provincia','r.region',
            DB::raw('CONCAT(pr.provincia," | ",r.region) as detalle'))
            ->join('aa_provincias AS pr',function($join){
                $join->on('di.provincia_id','=','pr.id')
                ->where('pr.estado','=',1);
            })
            ->join('aa_regiones AS r',function($join){
                $join->on('pr.region_id','=','r.id')
                ->where('r.estado','=',1);
            })
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('di.distrito','like','%'.$dphrase[0].'%');
                            if( count($dphrase)>1 AND trim($dphrase[1])!='' ){
                                $dphrase[1]=trim($dphrase[1]);
                                $query->where('pr.provincia','like','%'.$dphrase[1].'%');
                            }
                            if( count($dphrase)>2 AND trim($dphrase[2])!='' ){
                                $dphrase[2]=trim($dphrase[2]);
                                $query->where('r.region','like','%'.$dphrase[2].'%');
                            }
                        }
                    }
                }
            )
            ->where('di.estado','=','1');
        $result = $sql->get();
        return $result;
    }
}
