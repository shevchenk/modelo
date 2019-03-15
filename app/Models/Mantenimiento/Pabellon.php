<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use DB;

class Pabellon extends Model
{
    protected   $table = 'am_locales_pabellones';
    
    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $pabellon = Pabellon::find($r->id);
        $pabellon->estado = trim( $r->estadof );
        $pabellon->persona_id_updated_at=$persona_id;
        $pabellon->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $pabellon = new Pabellon;
        $pabellon->local_id = trim( $r->local_id );
        $pabellon->pabellon = trim( $r->pabellon );
        $pabellon->estado = trim( $r->estado );
        $pabellon->persona_id_created_at=$persona_id;
        $pabellon->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $pabellon = Pabellon::find($r->id);
        $pabellon->local_id = trim( $r->local_id );
        $pabellon->pabellon = trim( $r->pabellon );
        $pabellon->estado = trim( $r->estado );
        $pabellon->persona_id_updated_at=$persona_id;
        $pabellon->save();
    }

    public static function runLoad($r)
    {
        $sql=DB::table('am_locales_pabellones as lp')
            ->join('am_locales AS l',function($join){
                $join->on('l.id','=','lp.local_id');
            })
            ->select(
                'lp.id', 'lp.local_id', 'lp.pabellon',
                'l.local','lp.estado','l.codigo as codigo_local'
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
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('lp.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('lp.pabellon','asc')->paginate(10);
        return $result;
    }

    public static function ListPabellon($r)
    {
        $sql=DB::table('am_locales_pabellones AS lp')
            ->join('am_locales AS l',function($join){
                $join->on('l.id','=','lp.local_id')
                ->where('l.estado',1);
            })
            ->select('lp.id','lp.pabellon')
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('lp.pabellon','like','%'.$dphrase[0].'%');
                            if( count($dphrase)>1 AND trim($dphrase[1])!='' ){
                                $dphrase[1]=trim($dphrase[1]);
                                $query->where('p.pabellon','like','%'.$dphrase[1].'%');
                            }
                        }
                    }
                    if( $r->has("local_id") ){
                        $local_id=trim($r->local_id);
                        if( $local_id !='' ){
                            $query->where('lp.local_id',$local_id);
                        }
                    }
                }
            )
            ->where('lp.estado',1);
        $result = $sql->get();
        return $result;
    }
}
