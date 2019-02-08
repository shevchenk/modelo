<?php

namespace App\Models\SecureAccess;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class Persona extends Authenticatable
{
    use Notifiable;
    protected   $table = 'am_personas';


    public static function runEditPassword($r)
    {
        $persona_id = Auth::user()->id;
        $persona = Persona::find($persona_id);
        $bcryptpassword = bcrypt($r->password);
        if( Hash::check($r->password_actual, $persona->password) ){
            $persona->password = $bcryptpassword;
            $persona->persona_id_updated_at = $persona_id;
            $persona->save();
            return 1;
        }
        else{
            return 2;
        }
    }

    public static function Menu($r)
    {
        //if(Auth::check())
        $persona = Auth::user()->id;
        $priv=array();
        if( !$r->has("privilegio_id") ){
            $priv=DB::table('am_privilegios as p')
                    ->join('am_personas_privilegios as pp', function($join){
                            $join->on('pp.privilegio_id','p.id')
                            ->where('pp.estado',1);
                    })
                    ->select('p.id')
                    ->where('pp.persona_id',$persona)
                    ->where('p.estado',1)
                    ->orderBy('p.privilegio')
                    ->first();
        }
        $resultP=DB::table('am_privilegios as p')
                ->join('am_personas_privilegios as pp', function($join){
                        $join->on('pp.privilegio_id','p.id')
                        ->where('pp.estado',1);
                })
                ->select('p.id','p.privilegio')
                ->where('pp.persona_id',$persona)
                ->where('p.estado',1)
                ->where(
                      function($query) use ($r,$priv){
                          if( $r->has("privilegio_id") ){
                            if( trim($r->privilegio_id)!='' ){
                                $query->where('p.id','!=', $r->privilegio_id);
                            }
                          }
                          else{
                            $query->where('p.id','!=', $priv->id);
                          }
                      }
                  )
                ->groupBy('p.id','p.privilegio')
                ->orderBy('p.privilegio')
                ->get();

        $set=DB::statement('SET group_concat_max_len := @@max_allowed_packet');
        $resultM=DB::table('am_opciones as o')
                ->join('am_menus as m', function($join){
                        $join->on('m.id','o.menu_id')
                        ->where('m.estado',1);
                })
                ->join('am_privilegios_opciones as po', function($join){
                        $join->on('po.opcion_id','o.id')
                        ->where('po.estado',1);
                })
                ->join('am_privilegios as p', function($join){
                        $join->on('p.id','po.privilegio_id')
                        ->where('p.estado',1);
                })
                ->join('am_personas_privilegios as pp', function($join){
                        $join->on('pp.privilegio_id','p.id')
                        ->where('pp.estado',1);
                })
                ->select('m.menu','p.privilegio','m.id as menu_id',
                    DB::raw(
                    'GROUP_CONCAT(
                        DISTINCT( CONCAT_WS("|",o.opcion,o.ruta,o.class_icono) )
                        ORDER BY o.opcion SEPARATOR "||"
                        ) opciones, min(m.class_icono) icono'
                    )
                )
                ->where('pp.persona_id',$persona)
                ->where('o.estado',1)
                ->where(
                      function($query) use ($r,$priv){
                          if( $r->has("privilegio_id") ){
                            if( trim($r->privilegio_id)!='' ){
                                $query->where('p.id','=', $r->privilegio_id);
                            }
                          }
                          else{
                            $query->where('p.id','=', $priv->id);
                          }
                      }
                  )
                ->groupBy('m.id','m.menu','p.privilegio')
                ->orderBy('m.menu')
                ->get();

        return array($resultP,$resultM);
    }
}
