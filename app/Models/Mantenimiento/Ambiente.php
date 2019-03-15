<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use DB;

class Ambiente extends Model
{
    protected   $table = 'am_locales_ambientes';
    
    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $ambiente = Ambiente::find($r->id);
        $ambiente->estado = trim( $r->estadof );
        $ambiente->persona_id_updated_at=$persona_id;
        $ambiente->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $ambiente = new Ambiente;
        $ambiente->local_id = trim( $r->local_id );
        $ambiente->pabellon_id = trim( $r->pabellon_id );
        $ambiente->tipo_ambiente = trim( $r->tipo_ambiente );
        $ambiente->ambiente = trim( $r->ambiente );
        $ambiente->piso = trim( $r->piso );
        $ambiente->aforo = trim( $r->aforo );
        $ambiente->estado = trim( $r->estado );
        $ambiente->persona_id_created_at=$persona_id;
        $ambiente->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $ambiente = Ambiente::find($r->id);
        $ambiente->local_id = trim( $r->local_id );
        $ambiente->pabellon_id = trim( $r->pabellon_id );
        $ambiente->tipo_ambiente = trim( $r->tipo_ambiente );
        $ambiente->ambiente = trim( $r->ambiente );
        $ambiente->piso = trim( $r->piso );
        $ambiente->aforo = trim( $r->aforo );
        $ambiente->estado = trim( $r->estado );
        $ambiente->persona_id_updated_at=$persona_id;
        $ambiente->save();
    }

    public static function runLoad($r)
    {
        $sql=DB::table('am_locales_ambientes as la')
            ->join('am_locales_pabellones AS lp',function($join){
                $join->on('lp.id','=','la.pabellon_id');
            })
            ->join('am_locales AS l',function($join){
                $join->on('l.id','=','la.local_id');
            })
            ->select(
                'la.id', 'la.local_id', 'la.pabellon_id', 'la.ambiente',
                'la.tipo_ambiente', 'la.estado', 'la.piso', 'la.aforo',
                'l.local', 'lp.pabellon'
            )
            ->where( 
                function($query) use ($r){
                    if( $r->has("local") ){
                        $local=trim($r->local);
                        if( $local !='' ){
                            $query->where('l.local','like','%'.$local.'%');
                        }
                    }
                    if( $r->has("pabellon") ){
                        $pabellon=trim($r->pabellon);
                        if( $pabellon !='' ){
                            $query->where('lp.pabellon','like','%'.$pabellon.'%');
                        }
                    }
                    if( $r->has("ambiente") ){
                        $ambiente=trim($r->ambiente);
                        if( $ambiente !='' ){
                            $query->where('la.ambiente','like','%'.$ambiente.'%');
                        }
                    }
                    if( $r->has("tipo_ambiente") ){
                        $tipo_ambiente=trim($r->tipo_ambiente);
                        if( $tipo_ambiente !='' ){
                            $query->where('la.tipo_ambiente',$tipo_ambiente);
                        }
                    }
                    if( $r->has("piso") ){
                        $piso=trim($r->piso);
                        if( $piso !='' ){
                            $query->where('la.piso',$piso);
                        }
                    }
                    if( $r->has("aforo") ){
                        $aforo=trim($r->aforo);
                        if( $aforo !='' ){
                            $query->where('la.aforo',$aforo);
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('la.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('la.ambiente','asc')->paginate(10);
        return $result;
    }

    public static function ListAmbiente($r)
    {
        $sql=DB::table('am_locales_ambientes AS am')
            ->select('am.id','am.ambiente','am.aforo',
            DB::raw('CONCAT("Piso:",am.piso," | ",p.pabellon) AS detalle'))
            ->join('am_locales_pabellones AS p',function($join){
                $join->on('am.pabellon_id','=','p.id')
                ->where('p.estado',1);
            })
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('am.ambiente','like','%'.$dphrase[0].'%');
                            if( count($dphrase)>1 AND trim($dphrase[1])!='' ){
                                $dphrase[1]=trim($dphrase[1]);
                                $query->where('p.pabellon','like','%'.$dphrase[1].'%');
                            }
                        }
                    }
                    if( $r->has("local_id") ){
                        $local_id=trim($r->local_id);
                        if( $local_id !='' ){
                            $query->where('am.local_id',$local_id);
                        }
                    }
                    if( $r->has("tipo_ambiente") ){
                        $tipo_ambiente=trim($r->tipo_ambiente);
                        if( $tipo_ambiente !='' ){
                            $query->where('am.tipo_ambiente',$tipo_ambiente);
                        }
                    }
                }
            )
            ->where('am.estado',1);
        $result = $sql->get();
        return $result;
    }
}
