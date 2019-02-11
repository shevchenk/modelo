<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Persona extends Model
{
    protected   $table = 'am_personas';

    public static function runEditStatus($r)
    {
        $persona_id = Auth::user()->id;
        $persona = Persona::find($r->id);
        $persona->estado = trim( $r->estadof );
        $persona->persona_id_updated_at=$persona_id;
        $persona->save();
    }

    public static function runNew($r)
    {
        DB::beginTransaction();
        $persona_id = Auth::user()->id;
        $persona = new Persona;
        $persona->paterno = trim( $r->paterno );
        $persona->materno = trim( $r->materno );
        $persona->nombre = trim( $r->nombre );
        $persona->dni = trim( $r->dni );
        $persona->sexo = trim( $r->sexo );
        $persona->email = trim( $r->email );
        $persona->password=bcrypt($r->dni);

        if( trim( $r->password ) != ''){
            $persona->password=bcrypt($r->password);
        }
        
        $persona->telefono = trim( $r->telefono );
        $persona->celular = trim( $r->celular );
        $persona->estado_civil = trim( $r->estado_civil );

        if(trim( $r->fecha_nacimiento )!=''){
            $persona->fecha_nacimiento = trim( $r->fecha_nacimiento );}
        else {
            $persona->fecha_nacimiento = null;
        }

        $persona->estado = trim( $r->estado );
        $persona->persona_id_created_at=$persona_id;
        $persona->save();

        $persona->foto='';
        $extension='';
        if( trim($r->imagen_nombre)!='' ){
            $type=explode(".",$r->imagen_nombre);
            $extension=".".$type[1];
        }
        $url = "img/persona/Foto_".$persona->id.$extension; 
        if( trim($r->imagen_archivo)!='' ){
            $persona->foto=$url;
            Entidad::fileToFile($r->imagen_archivo, $url);
        }
        $persona->save();

        $personaAdicional = new PersonaAdicional;
        $personaAdicional->persona_id=$persona->id;
        
        if(trim( $r->colegio_id )!=''){
            $personaAdicional->colegio_id=$r->colegio_id;
        }

        if(trim( $r->pais_id )!=''){
            $personaAdicional->pais_id=$r->pais_id;
        }

        if(trim( $r->distrito_id )!=''){
            $personaAdicional->region_id=$r->region_id;
            $personaAdicional->provincia_id=$r->provincia_id;
            $personaAdicional->distrito_id=$r->distrito_id;
        }

        if(trim( $r->distrito_id_dir )!=''){
            $personaAdicional->region_id_dir=$r->region_id_dir;
            $personaAdicional->provincia_id_dir=$r->provincia_id_dir;
            $personaAdicional->distrito_id_dir=$r->distrito_id_dir;
        }

        $personaAdicional->direccion= trim($r->direccion);
        $personaAdicional->tenencia= trim($r->tenencia);
        $personaAdicional->empresa_laboral= trim($r->empresa_laboral);
        $personaAdicional->direccion_laboral= trim($r->direccion_laboral);
        $personaAdicional->telefono_laboral= trim($r->telefono_laboral);
        $personaAdicional->persona_id_created_at=$persona_id;
        $personaAdicional->save();

        if ( $r->has("privilegio_id") ) {
            $privilegios = $r->privilegio_id;
            for ($i=0; $i < count($privilegios) ; $i++) { 
                $personaPrivilegio= new PersonaPrivilegio;
                $personaPrivilegio->persona_id=$persona->id;
                $personaPrivilegio->privilegio_id=$privilegios[$i];
                $local_ids='';
                if( isset($r['locales'.$privilegios[$i]]) ){
                    $local_ids=$r['locales'.$privilegios[$i]];
                    $local_ids=implode(",",$local_ids);
                }
                $personaPrivilegio->local_ids=$local_ids;
                $personaPrivilegio->persona_id_created_at=$persona_id;
                $personaPrivilegio->estado=1;
                $personaPrivilegio->save();
            }
        }
        // --

        DB::commit();
    }

    public static function runEdit($r)
    {
        
        DB::beginTransaction();
        $persona_id = Auth::user()->id;
        $persona = Persona::find($r->id);
        $persona->paterno = trim( $r->paterno );
        $persona->materno = trim( $r->materno );
        $persona->nombre = trim( $r->nombre );
        $persona->dni = trim( $r->dni );
        $persona->sexo = trim( $r->sexo );
        $persona->email = trim( $r->email );
        
        if(trim( $r->password )!=''){
            $persona->password=bcrypt($r->password);
        }

        $persona->telefono = trim( $r->telefono );
        $persona->celular = trim( $r->celular );
        $persona->estado_civil = trim( $r->estado_civil );

        if(trim( $r->fecha_nacimiento )!=''){
            $persona->fecha_nacimiento = trim( $r->fecha_nacimiento );
        }
        else{
            $persona->fecha_nacimiento = null;
        }

        $extension='';
        if( trim($r->imagen_nombre)!='' ){
            $type=explode(".",$r->imagen_nombre);
            $extension=".".$type[1];
        }
        $url = "img/persona/Foto_".$persona->id.$extension; 
        if( trim($r->imagen_archivo)!='' ){
            $persona->foto=$url;
            Entidad::fileToFile($r->imagen_archivo, $url);
        }

        $persona->estado = trim( $r->estado );
        $persona->persona_id_updated_at=$persona_id;
        $persona->save();
                
        $personaAdicional = PersonaAdicional::where('persona_id',$persona->id)
                            ->first();
        
        $personaAdicional->colegio_id=null;
        if(trim( $r->colegio_id )!=''){
            $personaAdicional->colegio_id=$r->colegio_id;
        }

        $personaAdicional->pais_id=null;
        if(trim( $r->pais_id )!=''){
            $personaAdicional->pais_id=$r->pais_id;
        }

        $personaAdicional->region_id=null;
        $personaAdicional->provincia_id=null;
        $personaAdicional->distrito_id=null;
        if(trim( $r->distrito_id )!=''){
            $personaAdicional->region_id=$r->region_id;
            $personaAdicional->provincia_id=$r->provincia_id;
            $personaAdicional->distrito_id=$r->distrito_id;
        }

        $personaAdicional->region_id_dir=null;
        $personaAdicional->provincia_id_dir=null;
        $personaAdicional->distrito_id_dir=null;
        if(trim( $r->distrito_id_dir )!=''){
            $personaAdicional->region_id_dir=$r->region_id_dir;
            $personaAdicional->provincia_id_dir=$r->provincia_id_dir;
            $personaAdicional->distrito_id_dir=$r->distrito_id_dir;
        }

        $personaAdicional->direccion= trim($r->direccion);
        $personaAdicional->tenencia= trim($r->tenencia);
        $personaAdicional->empresa_laboral= trim($r->empresa_laboral);
        $personaAdicional->direccion_laboral= trim($r->direccion_laboral);
        $personaAdicional->telefono_laboral= trim($r->telefono_laboral);
        $personaAdicional->persona_id_updated_at=$persona_id;
        $personaAdicional->save();
        
        PersonaPrivilegio::where('persona_id',$persona->id)
        ->update(['estado'=>0]);

        if ( $r->has("privilegio_id") ) {
            $privilegios = $r->privilegio_id;
            for ($i=0; $i < count($privilegios) ; $i++) { 
                $personaPrivilegio= PersonaPrivilegio::where('persona_id',$persona->id)
                                    ->where('privilegio_id',$privilegios[$i])
                                    ->first();
                if( !isset($personaPrivilegio->id) ){
                    $personaPrivilegio= new PersonaPrivilegio;
                }
                $personaPrivilegio->persona_id=$persona->id;
                $personaPrivilegio->privilegio_id=$privilegios[$i];
                $local_ids='';
                if( isset($r['locales'.$privilegios[$i]]) ){
                    $local_ids=$r['locales'.$privilegios[$i]];
                    $local_ids=implode(",",$local_ids);
                }
                $personaPrivilegio->local_ids=$local_ids;
                $personaPrivilegio->persona_id_created_at=$persona_id;
                $personaPrivilegio->estado=1;
                $personaPrivilegio->save();
            }
        }

        DB::commit();
    }

    public static function runLoad($r)
    {
        $sql=Persona::select('id','paterno','materno','nombre','dni','email',
                DB::raw('IFNULL(fecha_nacimiento,"") as fecha_nacimiento'),
                'sexo','telefono','celular','password','estado_civil','estado',
                'foto')
            ->where(
                function($query) use ($r){
                    if( $r->has("paterno") ){
                        $paterno=trim($r->paterno);
                        if( $paterno !='' ){
                            $query->where('paterno','like','%'.$paterno.'%');
                        }
                    }
                    if( $r->has("materno") ){
                        $materno=trim($r->materno);
                        if( $materno !='' ){
                            $query->where('materno','like','%'.$materno.'%');
                        }
                    }
                    if( $r->has("nombre") ){
                        $nombre=trim($r->nombre);
                        if( $nombre !='' ){
                            $query->where('nombre','like','%'.$nombre.'%');
                        }
                    }
                    if( $r->has("dni") ){
                        $dni=trim($r->dni);
                        if( $dni !='' ){
                            $query->where('dni','like','%'.$dni.'%');
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
                            $query->where('estado','=',$estado);
                        }
                    }
                }
            );
        $result = $sql->orderBy('paterno','asc')->paginate(10);
        return $result;
    }

    public static function runLoadAdicional($r)
    {
        $result=DB::table('am_personas_adicionales as pa')
                ->leftJoin('aa_distritos AS di',function($join){
                    $join->on('pa.distrito_id','=','di.id')
                    ->where('di.estado','=',1);
                })
                ->leftJoin('aa_provincias AS pr',function($join){
                    $join->on('pa.provincia_id','=','pr.id')
                    ->where('pr.estado','=',1);
                })
                ->leftJoin('aa_regiones AS re',function($join){
                    $join->on('pa.region_id','=','re.id')
                    ->where('re.estado','=',1);
                })
                ->leftJoin('aa_distritos AS di2',function($join){
                    $join->on('pa.distrito_id_dir','=','di2.id')
                    ->where('di2.estado','=',1);
                })
                ->leftJoin('aa_provincias AS pr2',function($join){
                    $join->on('pa.provincia_id_dir','=','pr2.id')
                    ->where('pr2.estado','=',1);
                })
                ->leftJoin('aa_regiones AS re2',function($join){
                    $join->on('pa.region_id_dir','=','re2.id')
                    ->where('re2.estado','=',1);
                })
                ->leftJoin('am_paises AS p',function($join){
                    $join->on('pa.pais_id','=','p.id')
                    ->where('p.estado','=',1);
                })
                ->leftJoin('am_colegios AS co',function($join){
                    $join->on('pa.colegio_id','=','co.id')
                    ->where('co.estado','=',1);
                })
                ->select('pa.pais_id','pa.colegio_id','pa.distrito_id','pa.provincia_id'
                ,'pa.region_id','pa.distrito_id_dir','pa.provincia_id_dir','pa.region_id_dir'
                ,'pa.direccion','pa.tenencia','pa.empresa_laboral','pa.direccion_laboral'
                ,'pa.telefono_laboral','di.distrito','pr.provincia','re.region','p.pais'
                ,'di2.distrito AS distrito_dir','pr2.provincia AS provincia_dir'
                ,'re2.region AS region_dir','co.colegio')
                ->where('pa.persona_id',$r->persona_id)
                ->first();
        return $result;
    }

    public static function runLoadPrivilegio($r)
    {
        $result=DB::table('am_personas_privilegios AS pp')
                ->join('am_personas AS p',function($join){
                    $join->on('pp.persona_id','=','p.id')
                    ->where('p.estado','=',1);
                })
                ->join('am_privilegios AS pr',function($join){
                    $join->on('pp.privilegio_id','=','pr.id')
                    ->where('pr.estado','=',1);
                })
                ->select('pp.id','pp.privilegio_id','pr.privilegio','pp.local_ids')
                ->where('p.id',$r->persona_id)
                ->where('pp.estado',1)
                ->orderBy('privilegio','asc')
                ->get();
        return $result;
    }

    public static function ListPersona($r)
    {
        $sql=DB::table('am_personas AS p')
            ->select('p.id','p.dni','p.foto'
                ,DB::raw( 'CONCAT(p.paterno," ",p.materno,", ",p.nombre) as persona')
            )
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('p.paterno','like',$dphrase[0].'%');
                            if( count($dphrase)>1 AND trim($dphrase[1])!='' ){
                                $dphrase[1]=trim($dphrase[1]);
                                $query->where('p.materno','like',$dphrase[1].'%');
                            }
                            if( count($dphrase)>2 AND trim($dphrase[2])!='' ){
                                $dphrase[2]=trim($dphrase[2]);
                                $query->where('p.nombre','like',$dphrase[2].'%');
                            }
                            if( count($dphrase)>3 AND trim($dphrase[3])!='' ){
                                $dphrase[3]=trim($dphrase[3]);
                                $query->where('p.dni','like',$dphrase[3].'%');
                            }
                        }
                    }
                }
            )
            ->where('p.estado','=','1');
        $result = $sql->get();
        return $result;
    }

}
