<?php

namespace App\Models\Ingreso;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class PSLocal extends Model
{
    protected $table = 'bm_ps_nivel3_local';
    
    public static function runEditStatus($r)
    {
        DB::beginTransaction();
        $psLocal = PSLocal::find($r->id);
        $psLocal->estado = trim( $r->estadof );
        $psLocal->persona_id_updated_at=Auth::user()->id;
        $psLocal->save();

        $psLocalHistorico = new PSLocalHistorico;
        $psLocalHistorico->ps_nivel3_local_id = $psLocal->id;
        $psLocalHistorico->ps_nivel3_id = $psLocal->ps_nivel3_id;
        $psLocalHistorico->local_id = $psLocal->local_id;
        $psLocalHistorico->precio_venta = $psLocal->precio_venta;
        $psLocalHistorico->precio_compra = $psLocal->precio_compra;
        $psLocalHistorico->moneda = $psLocal->moneda;
        $psLocalHistorico->stock = $psLocal->stock;
        $psLocalHistorico->stock_minimo = $psLocal->stock_minimo;
        $psLocalHistorico->dias_alerta = $psLocal->dias_alerta;
        $psLocalHistorico->dias_vencimiento = $psLocal->dias_vencimiento; 
        $psLocalHistorico->fecha_vencimiento = $psLocal->fecha_vencimiento;
        $psLocalHistorico->fecha_ingreso = $psLocal->fecha_ingreso;
        $psLocalHistorico->estado = $psLocal->estado;
        $psLocalHistorico->persona_id_created_at=Auth::user()->id;
        $psLocalHistorico->save();
        DB::commit();
    }

    public static function runNew($r)
    {
        DB::beginTransaction();
        $psLocal = PSLocal::where('ps_nivel3_id',$r->ps_nivel3_id)
                    ->where('local_id',$r->local_id)
                    ->first();
        if( !isset($psLocal->id) ){
            $psLocal = new PSLocal;
            $psLocal->persona_id_created_at=Auth::user()->id;
        }
        else{
            $psLocal->persona_id_updated_at=Auth::user()->id;
        }
        
        $psLocal->ps_nivel3_id = trim( $r->ps_nivel3_id );
        $psLocal->local_id = trim( $r->local_id );
        $psLocal->precio_venta=trim( $r->precio_venta );
        $psLocal->precio_compra=trim( $r->precio_compra );
        $psLocal->moneda=trim( $r->moneda );
        $psLocal->stock=trim( $r->stock );
        $psLocal->stock_minimo=trim( $r->stock_minimo );
        $psLocal->dias_alerta=trim( $r->dias_alerta );
        
        if(trim($r->dias_vencimiento)=='0'){
            $psLocal->dias_vencimiento = 0; 
            if( trim($r->fecha_vencimiento)!='' ){
                $psLocal->fecha_vencimiento = trim( $r->fecha_vencimiento );
            }
        }else {
            $psLocal->dias_vencimiento = trim( $r->dias_vencimiento );
            $psLocal->fecha_vencimiento  = date('Y-m-d', strtotime('+'.$r->dias_vencimiento.' day', strtotime($r->fecha_ingreso)));
        }

        $psLocal->fecha_ingreso=trim($r->fecha_ingreso);
        $psLocal->estado = 1;
        $psLocal->save();

        $psLocalHistorico = new PSLocalHistorico;
        $psLocalHistorico->ps_nivel3_local_id = $psLocal->id;
        $psLocalHistorico->ps_nivel3_id = $psLocal->ps_nivel3_id;
        $psLocalHistorico->local_id = $psLocal->local_id;
        $psLocalHistorico->precio_venta = $psLocal->precio_venta;
        $psLocalHistorico->precio_compra = $psLocal->precio_compra;
        $psLocalHistorico->moneda = $psLocal->moneda;
        $psLocalHistorico->stock = $psLocal->stock;
        $psLocalHistorico->stock_minimo = $psLocal->stock_minimo;
        $psLocalHistorico->dias_alerta = $psLocal->dias_alerta;
        $psLocalHistorico->dias_vencimiento = $psLocal->dias_vencimiento; 
        $psLocalHistorico->fecha_vencimiento = $psLocal->fecha_vencimiento;
        $psLocalHistorico->fecha_ingreso = $psLocal->fecha_ingreso;
        $psLocalHistorico->estado = $psLocal->estado;
        $psLocalHistorico->persona_id_created_at=Auth::user()->id;
        $psLocalHistorico->save();
        DB::commit();
    }

    public static function runEdit($r)
    {
        DB::beginTransaction();
        $producto = PSLocal::find($r->id);
        $producto->precio_venta=trim( $r->precio_venta );
        $producto->precio_compra=trim( $r->precio_compra );
        $producto->moneda=trim( $r->moneda );
        $producto->stock=trim( $r->stock );
        $producto->stock_minimo=trim( $r->stock_minimo );
        $producto->dias_alerta=trim( $r->dias_alerta );
        
        if(trim($r->dias_vencimiento)=='0'){
            $producto->dias_vencimiento = 0; 
            if( trim($r->fecha_vencimiento)!='' ){
                $producto->fecha_vencimiento = trim( $r->fecha_vencimiento );
            }
        }else {
            $producto->dias_vencimiento = trim( $r->dias_vencimiento );
            $producto->fecha_vencimiento  = date('Y-m-d', strtotime('+'.$r->dias_vencimiento.' day', strtotime($r->fecha_ingreso)));
        }

        $producto->fecha_ingreso=trim($r->fecha_ingreso);
        $producto->estado = 1;
        $producto->persona_id_updated_at=Auth::user()->id;
        $producto->save();

        $psLocalHistorico = new PSLocalHistorico;
        $psLocalHistorico->ps_nivel3_local_id = $psLocal->id;
        $psLocalHistorico->ps_nivel3_id = $psLocal->ps_nivel3_id;
        $psLocalHistorico->local_id = $psLocal->local_id;
        $psLocalHistorico->precio_venta = $psLocal->precio_venta;
        $psLocalHistorico->precio_compra = $psLocal->precio_compra;
        $psLocalHistorico->moneda = $psLocal->moneda;
        $psLocalHistorico->stock = $psLocal->stock;
        $psLocalHistorico->stock_minimo = $psLocal->stock_minimo;
        $psLocalHistorico->dias_alerta = $psLocal->dias_alerta;
        $psLocalHistorico->dias_vencimiento = $psLocal->dias_vencimiento; 
        $psLocalHistorico->fecha_vencimiento = $psLocal->fecha_vencimiento;
        $psLocalHistorico->fecha_ingreso = $psLocal->fecha_ingreso;
        $psLocalHistorico->estado = $psLocal->estado;
        $psLocalHistorico->persona_id_created_at=Auth::user()->id;
        $psLocalHistorico->save();
        DB::commit();
    }


    public static function runLoad($r)
    {
        $sql=PSLocal::select('bm_ps_nivel3_local.id','bm_ps_nivel3_local.ps_nivel3_id','bm_ps_nivel3_local.local_id',
                'bm_ps_nivel3_local.precio_venta','bm_ps_nivel3_local.precio_compra','bm_ps_nivel3_local.moneda',
                'bm_ps_nivel3_local.stock','bm_ps_nivel3_local.stock_minimo','bm_ps_nivel3_local.dias_alerta',
                'bm_ps_nivel3_local.fecha_vencimiento','bm_ps_nivel3_local.dias_vencimiento','bm_ps_nivel3_local.fecha_ingreso',
                'bm_ps_nivel3_local.estado','bpn.nivel3','bpn.tipo','al.local','al.codigo as local_codigo',
                'ps2.nivel2')
            ->join('bm_ps_nivel3 AS bpn',function($join){
                $join->on('bpn.id','=','bm_ps_nivel3_local.ps_nivel3_id');
            })
            ->join('bm_ps_nivel2 AS ps2',function($join){
                $join->on('ps2.id','=','bpn.ps_nivel2_id');
            })
            ->join('am_locales AS al',function($join){
                $join->on('al.id','=','bm_ps_nivel3_local.local_id');
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
                    if( $r->has("tipo") ){
                        $tipo=trim($r->tipo);
                        if( $tipo !='' ){
                            $query->where('bpn.tipo','=',$tipo);
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('bm_ps_nivel3_local.estado','=',$estado);
                        }
                    }
                }
            );
        $result = $sql->orderBy('al.local','asc')->paginate(10);
        return $result;
    }
}
