<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mantenimiento\Entidad;
use Illuminate\Support\Facades\Auth;
use DB;

class Nivel3 extends Model
{
    protected $table = 'bm_ps_nivel3';
    
    public static function runEditStatus($r)
    {
        $nivel3 = Nivel3::find($r->id);
        $nivel3->estado = trim( $r->estadof );
        $nivel3->persona_id_updated_at=Auth::user()->id;
        $nivel3->save();
    }

    public static function runNew($r)
    {
        $nivel3 = new Nivel3;
        $nivel3->ps_nivel2_id = trim( $r->ps_nivel2_id );
        $nivel3->item = trim( $r->item );
        $nivel3->nivel3=trim( $r->nivel3 );
        $nivel3->descripcion=trim( $r->descripcion );
        if(trim($r->imagen_nombre)!=''){
        $nivel3->foto=$r->imagen_nombre;
            $entidad = new Entidad;
            $url = "img/product/".$r->imagen_nombre; 
            $entidad->fileToFile($r->imagen_archivo, $url);}
        else {
        $nivel3->foto=null;    
        }
        $nivel3->estado = trim( $r->estado );
        $nivel3->persona_id_created_at=Auth::user()->id;
        $nivel3->save();
    }

    public static function runEdit($r)
    {
        $nivel3 = Nivel3::find($r->id);
        $nivel3->ps_nivel2_id = trim( $r->ps_nivel2_id );
        $nivel3->item = trim( $r->item );
        $nivel3->nivel3=trim( $r->nivel3 );
        $nivel3->descripcion=trim( $r->descripcion );
        if(trim($r->imagen_nombre)!=''){
            $nivel3->foto=$r->imagen_nombre;
        }else {
            $nivel3->foto=null;    
        }
        if(trim($r->imagen_archivo)!=''){
            $entidad = new Entidad;
            $url = "img/product/".$r->imagen_nombre; 
            $entidad->fileToFile($r->imagen_archivo, $url);
        }
        $nivel3->estado = trim( $r->estado );
        $nivel3->persona_id_updated_at=Auth::user()->id;
        $nivel3->save();
    }


    public static function runLoad($r)
    {
        $sql=Nivel3::select('bm_ps_nivel3.id','bm_ps_nivel3.ps_nivel2_id','bm_ps_nivel3.item',
                'bm_ps_nivel3.nivel3','bm_ps_nivel3.descripcion','bm_ps_nivel3.foto','bm_ps_nivel3.estado',
                'bpn.nivel2')
        ->join('bm_ps_nivel2 AS bpn',function($join){
            $join->on('bpn.id','=','bm_ps_nivel3.ps_nivel2_id');
        })
            ->where( 
                    
                function($query) use ($r){
                    if( $r->has("nivel3") ){
                        $nivel3=trim($r->nivel3);
                        if( $nivel3 !='' ){
                           $query->where('bm_ps_nivel3.nivel3','like','%'.$nivel3.'%');
                        }
                    }
                    if( $r->has("nivel2") ){
                        $nivel2=trim($r->nivel2);
                        if( $nivel2 !='' ){
                           $query->where('bpn.nivel2','like','%'.$nivel2.'%');
                        }
                    }
                    if( $r->has("item") ){
                        $item=trim($r->item);
                        if( $item !='' ){
                           $query->where('bm_ps_nivel3.item','like','%'.$item.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('bm_ps_nivel3.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('bm_ps_nivel3.id','asc')->paginate(10);
        return $result;
    }
    
    public static function ListNivel3($r)
    {
        $sql=Nivel3::select('bm_ps_nivel3.id','bm_ps_nivel3.nivel3')
//            ->join('aa_distritos AS di',function($join){
//                $join->on('co.distrito_id','=','di.id')
//                ->where('di.estado','=',1);
//            })
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $nivel3=trim($r->phrase);
                        if( $nivel3 !='' ){
                            $query->where('bm_ps_nivel3.nivel3','like','%'.$nivel3.'%');
                        }
                    }
                }
            )
            ->where('bm_ps_nivel3.estado','=','1');
        $result = $sql->get();
        return $result;
    }

}
