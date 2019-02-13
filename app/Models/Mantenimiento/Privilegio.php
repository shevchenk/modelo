<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class Privilegio extends Model
{
    protected   $table = 'am_privilegios';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $privilegio = Privilegio::find($r->id);
        $privilegio->estado = trim( $r->estadof );
        $privilegio->persona_id_updated_at=$persona_id;
        $privilegio->save();
    }

    public static function runNew($r)
    {
        DB::beginTransaction();
        $persona_id=Auth::user()->id;
        $privilegio = new Privilegio;
        $privilegio->privilegio = trim( $r->privilegio );
        $privilegio->estado = trim( $r->estado );
        $privilegio->persona_id_created_at=$persona_id;
        $privilegio->save();

        if ( $r->has("opcion") ) {
            $opcion = $r->opcion;
            for ($i=0; $i < count($opcion) ; $i++) { 
                $privilegioOpcion= new PrivilegioOpcion;
                $privilegioOpcion->privilegio_id=$privilegio->id;
                $privilegioOpcion->opcion_id=$opcion[$i];
                $privilegioOpcion->estado=1;
                $privilegioOpcion->persona_id_created_at=$persona_id;
                $privilegioOpcion->save();
            }
        }
        DB::commit();
    }

    public static function runEdit($r)
    {
        DB::beginTransaction();
        $persona_id=Auth::user()->id;
        $privilegio = Privilegio::find($r->id);
        $privilegio->privilegio = trim( $r->privilegio );
        $privilegio->estado = trim( $r->estado );
        $privilegio->persona_id_updated_at=$persona_id;
        $privilegio->save();

        PrivilegioOpcion::where('privilegio_id',$privilegio->id)
        ->update(['estado'=>0]);

        if ( $r->has("opcion") ) {
            $opcion = $r->opcion;
            for ($i=0; $i < count($opcion) ; $i++) { 
                $privilegioOpcion= PrivilegioOpcion::where('privilegio_id',$privilegio->id)
                                    ->where('opcion_id',$opcion[$i])
                                    ->first();
                if( !isset($privilegioOpcion->id) ){
                    $privilegioOpcion= new PrivilegioOpcion;
                    $privilegioOpcion->persona_id_created_at=$persona_id;
                }
                else{
                    $privilegioOpcion->persona_id_updated_at=$persona_id;
                }
                $privilegioOpcion->privilegio_id=$privilegio->id;
                $privilegioOpcion->opcion_id=$opcion[$i];
                $privilegioOpcion->estado=1;
                $privilegioOpcion->save();
            }
        }
        DB::commit();
    }

    public static function runLoad($r)
    {
        DB::statement(DB::raw('SET @@group_concat_max_len = 4294967295'));
        $sql=DB::table('am_privilegios AS p')
            ->leftJoin('am_privilegios_opciones AS po',function($join){
                $join->on('po.privilegio_id','=','p.id')
                ->where('po.estado','=',1);
            })
            ->leftJoin('am_opciones AS o',function($join){
                $join->on('o.id','=','po.opcion_id')
                ->where('o.estado','=',1);
            })
            ->select(
            'p.id',
            'p.privilegio',
            'p.estado',
            DB::raw('GROUP_CONCAT(o.opcion ORDER BY opcion) opciones')
            )
            ->where( 
                function($query) use ($r){
                    if( $r->has("privilegio") ){
                        $privilegio=trim($r->privilegio);
                        if( $privilegio !='' ){
                            $query->where('privilegio','like','%'.$privilegio.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('estado','=',$estado);
                        }
                    }
                }
            );
        $result =   $sql->groupBy('p.id','p.privilegio','p.estado')
                    ->orderBy('privilegio','asc')->paginate(10);
        return $result;
    }
    
    public static function ListPrivilegio($r)
    {
        $sql=Privilegio::select('id','privilegio','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('privilegio','asc')->get();
        return $result;
    }

    public static function ListOpcion($r)
    {
        $sql=DB::table('am_opciones as o')
            ->leftJoin('am_privilegios_opciones AS po',function($join) use ($r){
                $join->on('po.opcion_id','=','o.id')
                ->where('po.estado','=',1)
                ->where('po.privilegio_id','=',$r->privilegio_id);
            })
            ->select('o.id','o.opcion','po.id AS ok')
            ->where('o.estado','=','1');
        $result = $sql->orderBy('o.opcion','asc')->get();
        return $result;
    }

}
