<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use DB;

class Colegio extends Model
{
    protected   $table = 'am_colegios';
    
    public static function ListColegio($r)
    {
        $sql=DB::table('am_colegios AS co')
            ->select('di.distrito','co.id','co.colegio','co.direccion')
            ->join('aa_distritos AS di',function($join){
                $join->on('co.distrito_id','=','di.id')
                ->where('di.estado','=',1);
            })
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $colegio=trim($r->phrase);
                        if( $colegio !='' ){
                            $query->where('co.colegio','like','%'.$colegio.'%');
                        }
                    }
                }
            )
            ->where('co.estado','=','1');
        $result = $sql->get();
        return $result;
    }
}
