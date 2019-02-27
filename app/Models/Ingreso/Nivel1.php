<?php

namespace App\Models\Ingreso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Nivel1 extends Model
{
    protected $table = 'bm_ps_nivel1';
    
    public static function runEditStatus($r)
    {
        $producto = Nivel1::find($r->id);
        $producto->estado = trim( $r->estadof );
        $producto->persona_id_updated_at=Auth::user()->id;
        $producto->save();
    }

    public static function runNew($r)
    {
        $producto = new Nivel1;
        $producto->item = trim( $r->item );
        $producto->nivel1=trim( $r->nivel1 );
        $producto->estado = trim( $r->estado );
        $producto->persona_id_created_at=Auth::user()->id;
        $producto->save();
    }

    public static function runEdit($r)
    {
        $producto = Nivel1::find($r->id);
        $producto->item = trim( $r->item );
        $producto->nivel1=trim( $r->nivel1 );
        $producto->estado = trim( $r->estado );
        $producto->persona_id_updated_at=Auth::user()->id;
        $producto->save();
    }


    public static function runLoad($r)
    {
        $sql=Nivel1::select('bm_ps_nivel1.id','bm_ps_nivel1.item',
                'bm_ps_nivel1.nivel1','bm_ps_nivel1.estado')
            ->where( 
                    
                function($query) use ($r){
                    if( $r->has("nivel1") ){
                        $nivel1=trim($r->nivel1);
                        if( $nivel1 !='' ){
                           $query->where('bm_ps_nivel1.nivel1','like','%'.$nivel1.'%');
                        }
                    }
                    if( $r->has("item") ){
                        $item=trim($r->item);
                        if( $item !='' ){
                           $query->where('bm_ps_nivel1.item','like','%'.$item.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('bm_ps_nivel1.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('bm_ps_nivel1.id','asc')->paginate(10);
        return $result;
    }
    
    public static function ListNivel1($r)
    {
        $sql=Nivel1::select('bm_ps_nivel1.id','bm_ps_nivel1.nivel1')
//            ->join('aa_distritos AS di',function($join){
//                $join->on('co.distrito_id','=','di.id')
//                ->where('di.estado','=',1);
//            })
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $nivel1=trim($r->phrase);
                        if( $nivel1 !='' ){
                            $query->where('bm_ps_nivel1.nivel1','like','%'.$nivel1.'%');
                        }
                    }
                }
            )
            ->where('bm_ps_nivel1.estado','=','1');
        $result = $sql->get();
        return $result;
    }
}
