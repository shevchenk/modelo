<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Cargo extends Model
{
    protected $table = 'am_cargos';
    
    public static function runEditStatus($r)
    {
        $regimen = Cargo::find($r->id);
        $regimen->estado = trim( $r->estadof );
        $regimen->persona_id_updated_at=Auth::user()->id;
        $regimen->save();
    }

    public static function runNew($r)
    {
        $regimen = new Cargo;
        $regimen->cargo = trim( $r->cargo );
        $regimen->estado = trim( $r->estado );
        $regimen->persona_id_created_at=Auth::user()->id;
        $regimen->save();
    }

    public static function runEdit($r)
    {
        $regimen = Cargo::find($r->id);
        $regimen->cargo = trim( $r->cargo );
        $regimen->estado = trim( $r->estado );
        $regimen->persona_id_updated_at=Auth::user()->id;
        $regimen->save();
    }


    public static function runLoad($r)
    {
        $sql=Cargo::select('id','cargo','estado')
            ->where( 
                    
                function($query) use ($r){
                    if( $r->has("cargo") ){
                        $cargo=trim($r->cargo);
                        if( $cargo !='' ){
                           $query->where('cargo','like','%'.$cargo.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('id','asc')->paginate(10);
        return $result;
    }

    // --
    public static function ListCargo($r){
        $sql=Cargo::select('id','cargo','estado')
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('cargo','like','%'.$dphrase[0].'%');
                        }
                    }
                }
            )
            ->where('estado','=','1');
        $result = $sql->orderBy('cargo','asc')->get();
        return $result;
    }
}
