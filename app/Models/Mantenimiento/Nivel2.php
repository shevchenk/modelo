<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Nivel2 extends Model
{
    protected $table = 'bm_ps_nivel2';
    
    public static function runEditStatus($r)
    {
        $producto = Nivel2::find($r->id);
        $producto->estado = trim( $r->estadof );
        $producto->persona_id_updated_at=Auth::user()->id;
        $producto->save();
    }

    public static function runNew($r)
    {
        $producto = new Nivel2;
        $producto->ps_nivel1_id = trim( $r->ps_nivel1_id );
        $producto->nivel2=trim( $r->nivel2 );
        $producto->estado = trim( $r->estado );
        $producto->persona_id_created_at=Auth::user()->id;
        $producto->save();
    }

    public static function runEdit($r)
    {
        $producto = Nivel2::find($r->id);
        $producto->ps_nivel1_id = trim( $r->ps_nivel1_id );
        $producto->nivel2=trim( $r->nivel2 );
        $producto->estado = trim( $r->estado );
        $producto->persona_id_updated_at=Auth::user()->id;
        $producto->save();
    }


    public static function runLoad($r)
    {
        $sql=Nivel2::select('bm_ps_nivel2.id','bm_ps_nivel2.ps_nivel1_id',
                'bm_ps_nivel2.nivel2','bm_ps_nivel2.estado',
                'bpn.nivel1')
        ->join('bm_ps_nivel1 AS bpn',function($join){
            $join->on('bpn.id','=','bm_ps_nivel2.ps_nivel1_id');
        })
            ->where( 
                    
                function($query) use ($r){
                    if( $r->has("nivel1") ){
                        $nivel1=trim($r->nivel1);
                        if( $nivel1 !='' ){
                           $query->where('bpn.nivel1','like','%'.$nivel1.'%');
                        }
                    }
                    if( $r->has("nivel2") ){
                        $nivel2=trim($r->nivel2);
                        if( $nivel2 !='' ){
                           $query->where('bm_ps_nivel2.nivel2','like','%'.$nivel2.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('bm_ps_nivel2.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('bm_ps_nivel2.id','asc')->paginate(10);
        return $result;
    }
    
    public static function ListNivel2($r)
    {
        $sql=Nivel2::select('bm_ps_nivel2.id','bm_ps_nivel2.nivel2')
//            ->join('aa_distritos AS di',function($join){
//                $join->on('co.distrito_id','=','di.id')
//                ->where('di.estado','=',1);
//            })
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $nivel2=trim($r->phrase);
                        if( $nivel2 !='' ){
                            $query->where('bm_ps_nivel2.nivel2','like','%'.$nivel2.'%');
                        }
                    }
                }
            )
            ->where('bm_ps_nivel2.estado','=','1');
        $result = $sql->get();
        return $result;
    }
}
