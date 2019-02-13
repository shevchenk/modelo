<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class Opcion extends Model
{
    protected   $table = 'am_opciones';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $opcion = Opcion::find($r->id);
        $opcion->estado = trim( $r->estadof );
        $opcion->persona_id_updated_at=$persona_id;
        $opcion->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $opcion = new Opcion;
        $opcion->opcion = trim( $r->opcion );
        $opcion->menu_id = trim( $r->menu_id );
        $opcion->ruta = trim( $r->ruta );
        $opcion->estado = trim( $r->estado );
        $opcion->persona_id_created_at=$persona_id;
        $opcion->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $opcion = Opcion::find($r->id);
        $opcion->opcion = trim( $r->opcion );
        $opcion->menu_id = trim( $r->menu_id );
        $opcion->ruta = trim( $r->ruta );
        $opcion->estado = trim( $r->estado );
        $opcion->persona_id_updated_at=$persona_id;
        $opcion->save();
    }

    public static function runLoad($r)
    {
        $sql=DB::table('am_opciones as o')
            ->join('am_menus AS m',function($join){
                $join->on('m.id','=','o.menu_id');
            })
            ->select(
                'o.id',
                'o.opcion',
                'o.ruta',
                'o.class_icono',
                'o.estado',
                'm.menu as menu',
                'o.menu_id'
            )
            ->where( 
                function($query) use ($r){
                    if( $r->has("menu") ){
                        $menu=trim($r->menu);
                        if( $menu !='' ){
                            $query->where('m.menu','like','%'.$menu.'%');
                        }
                    }
                    if( $r->has("opcion") ){
                        $opcion=trim($r->opcion);
                        if( $opcion !='' ){
                            $query->where('o.opcion','like','%'.$opcion.'%');
                        }
                    }
                    if( $r->has("ruta") ){
                        $ruta=trim($r->ruta);
                        if( $ruta !='' ){
                            $query->where('o.ruta','like','%'.$ruta.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('o.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('o.opcion','asc')->paginate(10);
        return $result;
    }
    
    public static function ListOpcion($r)
    {
        $sql=Opcion::select('id','opcion','estado')
            ->where('estado','=','1');
        $result = $sql->orderBy('opcion','asc')->get();
        return $result;
    }
    

}
