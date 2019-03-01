<?php

namespace App\Models\Ingreso;

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
        DB::beginTransaction();
        $promocionAux = Promocion::where('ps_nivel1_id',$r->ps_nivel1_id)
                        ->where('oferta',$r->oferta)
                        ->where('estado','1')
                        ->where(function ($query) use($r) {
                            if( trim($r->ps_nivel2_id)!='' ){
                                $query->where( 'ps_nivel2_id',$r->ps_nivel2_id );
                            }
                            if( trim($r->ps_nivel3_id)!='' ){
                                $query->where( 'ps_nivel3_id',$r->ps_nivel3_id );
                            }
                            if( trim($r->local_id)!='' ){
                                $query->where( 'local_id',$r->local_id );
                            }
                        })
                        ->first();
        if( isset($promocionAux->id) ){
            $promocionAux->estado=0;
            $promocionAux->persona_id_updated_at=Auth::user()->id;
            $promocionAux->save();
        }

        $promocion = new Promocion;
        $promocion->ps_nivel1_id = trim( $r->ps_nivel1_id );

        if( trim($r->ps_nivel2_id)!='' ){
            $promocion->ps_nivel2_id = trim( $r->ps_nivel2_id );
        }

        if( trim($r->ps_nivel3_id)!='' ){
            $promocion->ps_nivel3_id = trim( $r->ps_nivel3_id );
        }

        if( trim($r->local_id)!='' ){
            $promocion->local_id = trim( $r->local_id );
        }

        $promocion->tipo = trim( $r->tipo );;
        $promocion->oferta = trim( $r->oferta );
        $promocion->fecha_inicio_pro=trim( $r->fecha_inicio_pro );
        $promocion->fecha_final_pro=trim( $r->fecha_final_pro );
        $promocion->cantidad_pro=trim( $r->cantidad_pro );
        $promocion->dscto_porcentaje=trim( $r->dscto_porcentaje );
        $promocion->dscto_monto=trim( $r->dscto_monto );
        $promocion->dscto_cantidad=trim( $r->dscto_cantidad );
        $promocion->estado = 1;
        $promocion->persona_id_created_at=Auth::user()->id;
        $promocion->save();
        DB::commit();
    }

    public static function runLoad($r)
    {
        $sql=Promocion::select('bp_promociones.id','bp_promociones.ps_nivel1_id','bp_promociones.local_id',
                'bp_promociones.ps_nivel2_id','bp_promociones.ps_nivel3_id','bp_promociones.oferta',
                'bp_promociones.fecha_inicio_pro','bp_promociones.fecha_final_pro','bp_promociones.cantidad_pro',
                'bp_promociones.dscto_porcentaje','bp_promociones.dscto_monto','bp_promociones.dscto_cantidad',
                'bp_promociones.estado','bpn.nivel2','al.local','al.codigo as local_codigo',
                'bpna.nivel1','n3.nivel3')
            ->join('bm_ps_nivel1 AS bpna',function($join){
                $join->on('bpna.id','=','bp_promociones.ps_nivel1_id');
            })
            ->leftJoin('bm_ps_nivel3 AS n3',function($join){
                $join->on('n3.id','=','bp_promociones.ps_nivel3_id');
            })
            ->leftJoin('bm_ps_nivel2 AS bpn',function($join){
                $join->on('bpn.id','=','bp_promociones.ps_nivel2_id');
            })
            ->leftJoin('am_locales AS al',function($join){
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
                    if( $r->has("nivel1") ){
                        $nivel1=trim($r->nivel1);
                        if( $nivel1 !='' ){
                            $query->where('bpna.nivel1','like','%'.$nivel1.'%');
                        }
                    }
                    if( $r->has("nivel2") ){
                        $nivel2=trim($r->nivel2);
                        if( $nivel2 !='' ){
                            $query->where('bpn.nivel2','like','%'.$nivel2.'%');
                        }
                    }
                    if( $r->has("nivel3") ){
                        $nivel3=trim($r->nivel3);
                        if( $nivel3 !='' ){
                            $query->where('n3.nivel3','like','%'.$nivel3.'%');
                        }
                    }
                    if( $r->has("oferta") ){
                        $oferta=trim($r->oferta);
                        if( $oferta !='' ){
                            $query->where('bp_promociones.oferta','like','%'.$oferta.'%');
                        }
                    }
                    if( $r->has("local") ){
                        $local=trim($r->local);
                        if( $local !='' ){
                            $query->where('al.local','like','%'.$local.'%');
                        }
                    }
                    if( $r->has("tipo") ){
                        $tipo=trim($r->tipo);
                        if( $tipo !='' ){
                            $query->where('bp_promociones.tipo','=',$tipo);
                        }
                    }
                }
            );
        $result = $sql->orderBy('bp_promociones.id','asc')->paginate(10);
        return $result;
    }
}
