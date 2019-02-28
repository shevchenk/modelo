<?php

namespace App\Models\Ingreso;

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
        DB::beginTransaction();
        $nivel3 = new Nivel3;
        $nivel3->ps_nivel2_id = trim( $r->ps_nivel2_id );
        $nivel3->item = trim( $r->item );
        $nivel3->tipo = trim( $r->tipo );
        $nivel3->nivel3=trim( $r->nivel3 );
        $nivel3->descripcion=trim( $r->descripcion );
        $nivel3->estado = trim( $r->estado );
        $nivel3->persona_id_created_at=Auth::user()->id;
        $nivel3->save();

        $nivel3->foto='';
        $extension='';
        if( trim($r->imagen_nombre)!='' ){
            $type=explode(".",$r->imagen_nombre);
            $extension=".".$type[1];
        }
        $url = "img/product/Foto_".$nivel3->id.$extension; 
        if( trim($r->imagen_archivo)!='' ){
            $nivel3->foto=$url;
            Entidad::fileToFile($r->imagen_archivo, $url);
        }
        
        $nivel3->save();
        DB::commit();
    }

    public static function runEdit($r)
    {
        $nivel3 = Nivel3::find($r->id);
        $nivel3->ps_nivel2_id = trim( $r->ps_nivel2_id );
        $nivel3->item = trim( $r->item );
        $nivel3->nivel3=trim( $r->nivel3 );
        $nivel3->descripcion=trim( $r->descripcion );

        $extension='';
        if( trim($r->imagen_nombre)!='' ){
            $type=explode(".",$r->imagen_nombre);
            $extension=".".$type[1];
        }
        $url = "img/product/Foto_".$nivel3->id.$extension; 
        if( trim($r->imagen_archivo)!='' ){
            $nivel3->foto=$url;
            Entidad::fileToFile($r->imagen_archivo, $url);
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
                    if( $r->has("tipo") ){
                        $tipo=trim($r->tipo);
                        if( $tipo !='' ){
                            $query->where('bm_ps_nivel3.tipo','=',''.$tipo.'');
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
        $sql=Nivel3::select('bm_ps_nivel3.id','bm_ps_nivel3.nivel3',
            'bm_ps_nivel3.foto','n2.nivel2','bm_ps_nivel3.ps_nivel2_id',
            'n1.nivel1','n2.ps_nivel1_id')
            ->join('bm_ps_nivel2 AS n2',function($join){
                $join->on('n2.id','=','bm_ps_nivel3.ps_nivel2_id')
                ->where('n2.estado',1);
            })
            ->join('bm_ps_nivel1 AS n1',function($join){
                $join->on('n1.id','=','n2.ps_nivel1_id')
                ->where('n1.estado',1);
            })
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $nivel3=trim($r->phrase);
                        if( $nivel3 !='' ){
                            $query->where('bm_ps_nivel3.nivel3','like','%'.$nivel3.'%');
                        }
                    }
                    if( $r->has("tipo") ){
                        $tipo=trim($r->tipo);
                        if( $tipo !='' ){
                            $query->where('bm_ps_nivel3.tipo','=',$tipo);
                        }
                    }
                }
            )
            ->where('bm_ps_nivel3.estado','=','1');
        $result = $sql->get();
        return $result;
    }

}
