<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Promocion extends Model
{
    protected $table = 'bp_promociones';
    
    public static function runEditStatus($r)
    {
        $promocion = Promocion::find($r->id);
        $promocion->estado = trim( $r->estadof );
        $promocion->persona_id_updated_at=Auth::user()->id;
        $promocion->save();
    }

    public static function runNew($r)
    {
        $promocion = new Promocion;
        $promocion->ps_nivel1_id = trim( $r->ps_nivel1_id );
        $promocion->local_id = trim( $r->local_id );
        $promocion->ps_nivel2_id = trim( $r->ps_nivel2_id );
        $promocion->ps_nivel3_local_id = 1;//trim( $r->ps_nivel3_local_id );
        $promocion->oferta = trim( $r->oferta );
        $promocion->fecha_inicio_pro=trim( $r->fecha_inicio_pro );
        $promocion->fecha_final_pro=trim( $r->fecha_final_pro );
        $promocion->cantidad_pro=trim( $r->cantidad_pro );
        $promocion->dscto_porcentaje=trim( $r->dscto_porcentaje );
        $promocion->dscto_monto=trim( $r->dscto_monto );
        $promocion->dscto_cantidad=trim( $r->dscto_cantidad );
        $promocion->estado = trim( $r->estado );
        $promocion->persona_id_created_at=Auth::user()->id;
        $promocion->save();
    }

    public static function runEdit($r)
    {
        $promocion = Promocion::find($r->id);
        $promocion->ps_nivel1_id = trim( $r->ps_nivel1_id );
        $promocion->local_id = trim( $r->local_id );
        $promocion->ps_nivel2_id = trim( $r->ps_nivel2_id );
        $promocion->ps_nivel3_local_id = trim( $r->ps_nivel3_local_id );
        $promocion->oferta = trim( $r->oferta );
        $promocion->fecha_inicio_pro=trim( $r->fecha_inicio_pro );
        $promocion->fecha_final_pro=trim( $r->fecha_final_pro );
        $promocion->cantidad_pro=trim( $r->cantidad_pro );
        $promocion->dscto_porcentaje=trim( $r->dscto_porcentaje );
        $promocion->dscto_monto=trim( $r->dscto_monto );
        $promocion->dscto_cantidad=trim( $r->dscto_cantidad );
        $promocion->estado = trim( $r->estado );
        $promocion->persona_id_updated_at=Auth::user()->id;
        $promocion->save();
    }


    public static function runLoad($r)
    {
        $sql=Promocion::select('bp_promociones.id','bp_promociones.ps_nivel1_id','bp_promociones.local_id',
                'bp_promociones.ps_nivel2_id','bp_promociones.ps_nivel3_local_id','bp_promociones.oferta',
                'bp_promociones.fecha_inicio_pro','bp_promociones.fecha_final_pro','bp_promociones.cantidad_pro','bp_promociones.dscto_porcentaje',
                'bp_promociones.dscto_monto','bp_promociones.dscto_cantidad','bp_promociones.estado',
                'bpn.nivel2','al.local','al.codigo as local_codigo','bpna.nivel1')
        ->join('bm_ps_nivel3_local AS bpnl',function($join){
            $join->on('bpnl.id','=','bp_promociones.ps_nivel3_local_id');
        })
        ->join('bm_ps_nivel1 AS bpna',function($join){
            $join->on('bpna.id','=','bp_promociones.ps_nivel1_id');
        })
        ->join('bm_ps_nivel2 AS bpn',function($join){
            $join->on('bpn.id','=','bp_promociones.ps_nivel2_id');
        })
        ->join('am_locales AS al',function($join){
            $join->on('al.id','=','bp_promociones.local_id');
        })
            ->where( 
                    
                function($query) use ($r){
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('bp_promociones.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('bp_promociones.id','asc')->paginate(10);
        return $result;
    }
}
