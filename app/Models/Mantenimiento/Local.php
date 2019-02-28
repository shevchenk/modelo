<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;

class Local extends Model
{
    protected   $table = 'am_locales';

    public static function runEditStatus($r)
    {
        $persona_id = Auth::user()->id;
        $local = Local::find($r->id);
        $local->estado = trim( $r->estadof );
        $local->persona_id_updated_at=$persona_id;
        $local->save();
    }

    public static function runNew($r)
    {
        $persona_id = Auth::user()->id;
        $local = new Local;
        $local->local = trim( $r->local );
        $local->empleado_id = trim( $r->empleado_id );
        $local->codigo = trim( $r->codigo );
        $local->serie = trim( $r->serie );
        $local->direccion = trim( $r->direccion );
        $local->telefono = trim( $r->telefono );
        $local->celular = trim( $r->celular );
        $local->email = trim( $r->email );
        $local->estado = trim( $r->estado );
        $local->persona_id_created_at=$persona_id;
        $local->save();

        $local->foto='';
        $extension='';
        if( trim($r->imagen_nombre)!='' ){
            $type=explode(".",$r->imagen_nombre);
            $extension=".".$type[1];
        }
        $url = "img/local/Foto_".$local->id.$extension; 
        if( trim($r->imagen_archivo)!='' ){
            $local->foto=$url;
            Entidad::fileToFile($r->imagen_archivo, $url);
        }
        $local->save();
    }

    public static function runEdit($r)
    {
        $persona_id = Auth::user()->id;
        $local = Local::find($r->id);
        $local->local = trim( $r->local );
        $local->empleado_id = trim( $r->empleado_id );
        $local->codigo = trim( $r->codigo );
        $local->serie = trim( $r->serie );
        $local->direccion = trim( $r->direccion );
        $local->telefono = trim( $r->telefono );
        $local->celular = trim( $r->celular );
        $local->email = trim( $r->email );
        $local->estado = trim( $r->estado );
        $local->persona_id_updated_at=$persona_id;

        $extension='';
        if( trim($r->imagen_nombre)!='' ){
            $type=explode(".",$r->imagen_nombre);
            $extension=".".$type[1];
        }
        $url = "img/local/Foto_".$local->id.$extension; 
        if( trim($r->imagen_archivo)!='' ){
            $local->foto=$url;
            Entidad::fileToFile($r->imagen_archivo, $url);
        }
        $local->save();
    }

    public static function runLoad($r)
    {
        $sql=DB::table('am_locales AS l')
            ->join('am_empleados AS e',function($join){
                $join->on('l.empleado_id','=','e.id');
            })
            ->join('am_personas AS p',function($join){
                $join->on('e.persona_id','=','p.id');
            })
            ->select('l.id','l.local','l.codigo','l.direccion','l.telefono','l.celular'
            ,'l.email','l.foto','l.estado','p.paterno','p.materno','p.nombre','p.dni'
            ,'l.serie','l.empleado_id')
            ->where( 
                function($query) use ($r){
                    if( $r->has("l.local") ){
                        $local=trim($r->local);
                        if( $local !='' ){
                            $query->where('l.local','like','%'.$local.'%');
                        }
                    }
                    if( $r->has("codigo") ){
                        $codigo=trim($r->codigo);
                        if( $codigo !='' ){
                            $query->where('l.codigo','like','%'.$codigo.'%');
                        }
                    }
                    if( $r->has("direccion") ){
                        $direccion=trim($r->direccion);
                        if( $direccion !='' ){
                            $query->where('l.direccion','like','%'.$direccion.'%');
                        }
                    }
                    if( $r->has("telefono") ){
                        $telefono=trim($r->telefono);
                        if( $telefono !='' ){
                            $query->where('l.telefono','like',$telefono.'%');
                        }
                    }
                    if( $r->has("celular") ){
                        $celular=trim($r->celular);
                        if( $celular !='' ){
                            $query->where('l.celular','like',$celular.'%');
                        }
                    }
                    if( $r->has("email") ){
                        $email=trim($r->email);
                        if( $email !='' ){
                            $query->where('l.email','like','%'.$email.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('l.estado','=',$estado);
                        }
                    }
                }
            );
        $result = $sql->orderBy('local','asc')->paginate(10);
        return $result;
    }

    public static function runLoad2($r)
    {
        $sql=Local::select('id','local','direccion','telefono','celular','email')->where('estado','=',1);
        $result = $sql->orderBy('local','asc')->get();
        return $result;
    }
    
    public static function ListLocal($r)
    {
        $sql=Local::select('id','local','estado','codigo')
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('local','like','%'.$dphrase[0].'%');
                            if( count($dphrase)>1 AND trim($dphrase[1])!='' ){
                                $dphrase[1]=trim($dphrase[1]);
                                $query->where('codigo','like','%'.$dphrase[1].'%');
                            }
                        }
                    }
                    if( $r->has("user") ){
                        $user=trim($r->user);
                        if( $user !='' ){
                            $locales=   PersonaPrivilegio::where('persona_id',Auth::user()->id)
                                        ->select('local_ids')
                                        ->first();
                            if( trim($locales->local_ids)!='' ){
                                $users= explode(",",$locales->local_ids);
                                $query->whereIn('id',$users);
                            }
                        }
                    }
                }
            )
            ->where('estado','=','1');
        $result = $sql->orderBy('local','asc')->get();
        return $result;
    }

    // Export
    public static function runExport($r)
    {
        $rsql= Local::runLoad2($r);

        $length=array(
            'A'=>15,
            'B'=>15,'C'=>40,'D'=>20,'E'=>20,
            'F'=>30
        );
        $cabecera=array(
            'id','Local','Direccion','Telefono',
            'Celular','Email'
        );
        $campos=array(
            'id','local','direccion','telefono',
            'celular','email'
        );

        $r['data']=$rsql;
        $r['cabecera']=$cabecera;
        $r['campos']=$campos;
        $r['length']=$length;
        $r['max']='F'; // Max. Celda en LETRA
        return $r;
    }

}
