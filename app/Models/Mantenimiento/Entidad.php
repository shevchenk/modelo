<?php
namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class Entidad extends Model
{
    protected $table = 'aa_entidad';

    public static function runNew($r)
    {
        DB::beginTransaction();
        DB::table('aa_entidad')->update(['estado'=>0]);

        $entidad=new Entidad;
        $entidad->persona_id= $r->persona_id;
        $entidad->entidad= $r->entidad;
        $entidad->nombre_comercial= $r->nombre_comercial;
        $entidad->ruc= $r->ruc;
        $entidad->igv= $r->igv;
        $entidad->logo='';
        $entidad->estado=1;
        $entidad->persona_id_created_at=Auth::user()->id;
        $entidad->save();

        $extension='';
        if( trim($r->imagen_nombre)!='' ){
            $type=explode(".",$r->imagen_nombre);
            $extension=".".$type[1];
            $entidad->logo=$r->imagen_nombre;
        }
        $url = "img/entidad/logo_".$entidad->id.$extension; 
        if( trim($r->imagen_archivo)!='' ){
            $entidad->logo=$url;
            Entidad::fileToFile($r->imagen_archivo, $url);
        }
        $entidad->save();

        DB::commit();
    }

    public static function runLoad($r)
    {
        $sql=DB::table('aa_entidad AS e')
        ->join('am_personas AS p',function($join){
            $join->on('p.id','=','e.persona_id');
        })
        ->select('p.paterno','p.materno','p.nombre','p.dni','e.entidad','e.persona_id'
        ,'e.ruc','e.nombre_comercial','e.igv','e.logo')
        ->where( 
            function($query) use ($r){
                if( $r->has("estado") ){
                    $estado=trim($r->estado);
                    if( $estado !='' ){
                        $query->where('e.estado','=',$estado);
                    }
                }
            }
        );
        $result = $sql->get();
        return $result;
    }

    public static function fileToFile($file, $url)
    {
        $urld=explode("/",$url);
        $urlt=array();
        for ($i=0; $i < (count($urld)-1) ; $i++) { 
            array_push($urlt, $urld[$i]);
            $urltexto=implode("/",$urlt);
            if ( !is_dir($urltexto) ) {
                mkdir($urltexto,0777);
            }
        }
        
        list($type, $file) = explode(';', $file);
        list(, $type) = explode('/', $type);
        if ($type=='jpeg') $type='jpg';
        if ($type=='x-icon') $type='ico';
        if (strpos($type,'document')!==False) $type='docx';
        if (strpos($type, 'sheet') !== False) $type='xlsx';
        if (strpos($type, 'pdf') !== False) $type='pdf';
        if ($type=='plain') $type='txt';
        list(, $file)      = explode(',', $file);
        $file = base64_decode($file);
        file_put_contents($url , $file);
        return $url.$type;
    }
}
