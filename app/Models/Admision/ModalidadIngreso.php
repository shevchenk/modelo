<?php

namespace App\Models\Admision;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class ModalidadIngreso extends Model
{
    protected   $table = 'da_modalidades_ingresos';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $modalidadIngreso = ModalidadIngreso::find($r->id);
        $modalidadIngreso->estado = trim( $r->estadof );
        $modalidadIngreso->persona_id_updated_at=$persona_id;
        $modalidadIngreso->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $modalidadIngreso = new ModalidadIngreso;
        $modalidadIngreso->modalidad_ingreso = trim( $r->modalidad_ingreso );
        $modalidadIngreso->tipo = trim( $r->tipo );
        $modalidadIngreso->estado = trim( $r->estado );
        $modalidadIngreso->persona_id_created_at=$persona_id;
        $modalidadIngreso->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $modalidadIngreso = ModalidadIngreso::find($r->id);
        $modalidadIngreso->modalidad_ingreso = trim( $r->modalidad_ingreso );
        $modalidadIngreso->tipo = trim( $r->tipo );
        $modalidadIngreso->estado = trim( $r->estado );
        $modalidadIngreso->persona_id_updated_at=$persona_id;
        $modalidadIngreso->save();
    }

    public static function runLoad($r)
    {
        $sql=DB::table('da_modalidades_ingresos as mi')
            ->select(
                'mi.id','mi.modalidad_ingreso','mi.tipo','mi.estado'
            )
            ->where( 
                function($query) use ($r){
                    if( $r->has("modalidad_ingreso") ){
                        $modalidad_ingreso=trim($r->modalidad_ingreso);
                        if( $modalidad_ingreso !='' ){
                            $query->where('mi.modalidad_ingreso','like','%'.$modalidad_ingreso.'%');
                        }
                    }
                    if( $r->has("tipo") ){
                        $tipo=trim($r->tipo);
                        if( $tipo !='' ){
                            $query->where('mi.tipo','=',$tipo);
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('mi.estado','=',$estado);
                        }
                    }
                }
            );
        $result = $sql->orderBy('mi.modalidad_ingreso','desc')->paginate(10);
        return $result;
    }
    
    public static function ListModalidadIngreso($r)
    {
        $sql=DB::table('da_modalidades_ingresos as mi')
            ->select(
                'mi.id','mi.modalidad_ingreso','mi.tipo','mi.estado'
            )
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('mi.modalidad_ingreso','like','%'.$dphrase[0].'%');
                        }
                    }
                }
            )
            ->where('mi.estado','=','1');
        $result = $sql->orderBy('mi.modalidad_ingreso','desc')->get();
        return $result;
    }
    

}
