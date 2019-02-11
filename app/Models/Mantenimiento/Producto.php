<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Producto extends Model
{
    protected $table = 'bm_ps_nivel3_local';
    
    public static function runEditStatus($r)
    {
        $producto = Producto::find($r->id);
        $producto->estado = trim( $r->estadof );
        $producto->persona_id_updated_at=Auth::user()->id;
        $producto->save();
    }

    public static function runNew($r)
    {
        $producto = new Producto;
        $producto->ps_nivel3_id = trim( $r->ps_nivel3_id );
        $producto->local_id = trim( $r->local_id );
        $producto->precio_venta=trim( $r->precio_venta );
        $producto->precio_compra=trim( $r->precio_compra );
        $producto->moneda=trim( $r->moneda );
        $producto->stock=trim( $r->stock );
        $producto->stock_minimo=trim( $r->stock_minimo );
        $producto->dias_alerta=trim( $r->dias_alerta );
        if(trim($r->fecha_vencimiento)!=''){
            $producto->dias_vencimiento = 0; 
            $producto->fecha_vencimiento = trim( $r->fecha_vencimiento );
        }else {
            $producto->dias_vencimiento = trim( $r->dias_vencimiento );
            $producto->fecha_vencimiento  = date('Y-m-d', strtotime('+'.$r->dias_vencimiento.' day', strtotime(date('Y-m-d'))));     
        }
        $producto->estado = trim( $r->estado );
        $producto->persona_id_created_at=Auth::user()->id;
        $producto->save();
    }

    public static function runEdit($r)
    {
        $producto = Producto::find($r->id);
        $producto->ps_nivel3_id = trim( $r->ps_nivel3_id );
        $producto->local_id = trim( $r->local_id );
        $producto->precio_venta=trim( $r->precio_venta );
        $producto->precio_compra=trim( $r->precio_compra );
        $producto->moneda=trim( $r->moneda );
        $producto->stock=trim( $r->stock );
        $producto->stock_minimo=trim( $r->stock_minimo );
        $producto->dias_alerta=trim( $r->dias_alerta );
        if(trim($r->fecha_vencimiento)!=''){
            $producto->dias_vencimiento = 0; 
            $producto->fecha_vencimiento = trim( $r->fecha_vencimiento );
        }else {
            $producto->dias_vencimiento = trim( $r->dias_vencimiento );
            $producto->fecha_vencimiento  = date('Y-m-d', strtotime('+'.$r->dias_vencimiento.' day', strtotime(date('Y-m-d'))));     
        }
        $producto->estado = trim( $r->estado );
        $producto->persona_id_updated_at=Auth::user()->id;
        $producto->save();
    }


    public static function runLoad($r)
    {
        $sql=Producto::select('bm_ps_nivel3_local.id','bm_ps_nivel3_local.ps_nivel3_id','bm_ps_nivel3_local.local_id',
                'bm_ps_nivel3_local.precio_venta','bm_ps_nivel3_local.precio_compra','bm_ps_nivel3_local.moneda',
                'bm_ps_nivel3_local.stock','bm_ps_nivel3_local.stock_minimo','bm_ps_nivel3_local.dias_alerta','bm_ps_nivel3_local.fecha_vencimiento',
                'bm_ps_nivel3_local.dias_vencimiento','bm_ps_nivel3_local.estado','bpn.nivel3','al.local')
        ->join('bm_ps_nivel3 AS bpn',function($join){
            $join->on('bpn.id','=','bm_ps_nivel3_local.ps_nivel3_id');
        })
        ->join('am_locales AS al',function($join){
            $join->on('al.id','=','bm_ps_nivel3_local.id');
        })
            ->where( 
                    
                function($query) use ($r){
                    if( $r->has("nivel3") ){
                        $nivel3=trim($r->nivel3);
                        if( $nivel3 !='' ){
                           $query->where('bpn.nivel3','like','%'.$nivel3.'%');
                        }
                    }
                    if( $r->has("local") ){
                        $local=trim($r->local);
                        if( $local !='' ){
                           $query->where('al.local','like','%'.$local.'%');
                        }
                    }
                    if( $r->has("stock") ){
                        $stock=trim($r->stock);
                        if( $stock !='' ){
                           $query->where('bm_ps_nivel3_local.stock','like','%'.$stock.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('bm_ps_nivel3_local.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('bm_ps_nivel3_local.id','asc')->paginate(10);
        return $result;
    }
}
