<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

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
        $local->direccion = trim( $r->direccion );
        $local->telefono = trim( $r->telefono );
        $local->celular = trim( $r->celular );
        $local->email = trim( $r->email );
        $local->estado = trim( $r->estado );
        $local->persona_id_created_at=$persona_id;
        if(trim($r->imagen_nombre)!=''){
        $local->foto=$r->imagen_nombre;
        $este = new Local;
        $url = "img/local/".$r->imagen_nombre; 
        $este->fileToFile($r->imagen_archivo, $url);}
        else {
        $local->foto=null;    
        }
        $local->save();
    }

    public static function runEdit($r)
    {
        $persona_id = Auth::user()->id;
        $local = Local::find($r->id);
        $local->local = trim( $r->local );
        $local->direccion = trim( $r->direccion );
        $local->telefono = trim( $r->telefono );
        $local->celular = trim( $r->celular );
        $local->email = trim( $r->email );
        $local->estado = trim( $r->estado );
        $local->persona_id_updated_at=$persona_id;
        if(trim($r->imagen_nombre)!=''){
            $local->foto=$r->imagen_nombre;
        }else {
            $local->foto=null;    
        }
        if(trim($r->imagen_archivo)!=''){
            $este = new Local;
            $url = "img/local/".$r->imagen_nombre; 
            $este->fileToFile($r->imagen_archivo, $url);
        }
        $local->save();
    }

    public static function runLoad($r)
    {
        $sql=Local::select('id','local','direccion','telefono','celular','email','foto','estado')
            ->where( 
                function($query) use ($r){
                    if( $r->has("local") ){
                        $local=trim($r->local);
                        if( $local !='' ){
                            $query->where('local','like','%'.$local.'%');
                        }
                    }
                    if( $r->has("direccion") ){
                        $direccion=trim($r->direccion);
                        if( $direccion !='' ){
                            $query->where('direccion','like','%'.$direccion.'%');
                        }
                    }
                    if( $r->has("telefono") ){
                        $telefono=trim($r->telefono);
                        if( $telefono !='' ){
                            $query->where('telefono','like',$telefono.'%');
                        }
                    }
                    if( $r->has("celular") ){
                        $celular=trim($r->celular);
                        if( $celular !='' ){
                            $query->where('celular','like','%'.$celular.'%');
                        }
                    }
                    if( $r->has("email") ){
                        $email=trim($r->email);
                        if( $email !='' ){
                            $query->where('email','like','%'.$email.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('estado','like','%'.$estado.'%');
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

    public function fileToFile($file, $url)
    {
        if ( !is_dir('img') ) {
            mkdir('img',0777);
        }
        if ( !is_dir('img/local') ) {
            mkdir('img/local',0777);
        }
        list($type, $file) = explode(';', $file);
        list(, $type) = explode('/', $type);
        if ($type=='jpeg') $type='jpg';
        if (strpos($type,'document')!==False) $type='docx';
        if (strpos($type, 'sheet') !== False) $type='xlsx';
        if (strpos($type, 'pdf') !== False) $type='pdf';
        if ($type=='plain') $type='txt';
        list(, $file)      = explode(',', $file);
        $file = base64_decode($file);
        file_put_contents($url , $file);
        return $url. $type;
    }
    
    public static function ListLocal($r)
    {
        $sql=Local::select('id','local','estado')
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
