<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Transferir extends Model
{
    protected $table = 'bp_transferir';
    
    public static function runEditStatus($r)
    {
        DB::beginTransaction();
        $transferir = Transferir::find($r->id);
        $transferir->estado = trim( $r->estadof );
        $transferir->persona_id_updated_at=Auth::user()->id;
        $transferir->save();
        DB::commit();
    }

    public static function runNew($r)
    {
        DB::beginTransaction();
        $transferir = new Transferir;
        $transferir->local_id_destino = trim( $r->local_id_destino );
        $transferir->empleado_id_destino = trim( $r->empleado_id_destino );
        $transferir->ps_nivel3_local_id=trim( $r->ps_nivel3_local_id );
        $transferir->local_id=trim( $r->local_id );
        $transferir->empleado_id=trim( $r->empleado_id );
        $transferir->cantidad=trim( $r->cantidad );
        $transferir->fecha_transferir=trim( $r->fecha_transferir );
        $transferir->estado_transferir=0;
        $transferir->estado = 1;
        $transferir->persona_id_created_at=Auth::user()->id;
        $transferir->save();

        DB::commit();
    }

    public static function runEdit($r)
    {
        DB::beginTransaction();
        $transferir = Transferir::find($r->id);
        $transferir->local_id_destino = trim( $r->local_id_destino );
        $transferir->empleado_id_destino = trim( $r->empleado_id_destino );
        $transferir->ps_nivel3_local_id=trim( $r->ps_nivel3_local_id );
        $transferir->local_id=trim( $r->local_id );
        $transferir->empleado_id=trim( $r->empleado_id );
        $transferir->cantidad=trim( $r->cantidad );
        $transferir->fecha_transferir=trim( $r->fecha_transferir );
        $transferir->estado_transferir=0;
        $transferir->estado = $r->estado;
        $transferir->persona_id_updated_at=Auth::user()->id;
        $transferir->save();
        DB::commit();
    }


    public static function runLoad($r)
    {
        $sql=Transferir::select('bp_transferir.id','bp_transferir.local_id_destino','bp_transferir.empleado_id_destino',
                'bp_transferir.ps_nivel3_local_id','bp_transferir.local_id','bp_transferir.empleado_id',
                'bp_transferir.empleado_id','bp_transferir.cantidad','bp_transferir.fecha_transferir',
                'bp_transferir.estado_transferir','bp_transferir.estado','ald.local as local_destino','ale.local as local_origen')
            ->join('am_locales AS ald',function($join){
                $join->on('ald.id','=','bp_transferir.local_id_destino');
            })
            ->join('am_locales AS ale',function($join){
                $join->on('ale.id','=','bp_transferir.local_id');
            })
            ->where( 
                    
                function($query) use ($r){
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('bp_transferir.estado','=',$estado);
                        }
                    }
                }
            );
        $result = $sql->orderBy('bp_transferir.id','asc')->paginate(10);
        return $result;
    }
}
