<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    protected   $table = 'aa_entidad';

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
