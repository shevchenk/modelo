<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class Empleado extends Model
{
    protected $table = 'am_empleados';
    
    public static function runEditStatus($r)
    {
        DB::beginTransaction();
        $empleado = Empleado::find($r->id);
        $empleado->estado = trim( $r->estadof );
        $empleado->persona_id_updated_at=Auth::user()->id;
        $empleado->save();

        $empleadoHistorico = new EmpleadoHistorico;
        $empleadoHistorico->empleado_id = $empleado->id;
        $empleadoHistorico->persona_id = $empleado->persona_id;
        $empleadoHistorico->cargo_id = $empleado->cargo_id;
        $empleadoHistorico->local_id = $empleado->local_id;
        $empleadoHistorico->codigo = $empleado->codigo;
        $empleadoHistorico->medio_captacion_id = $empleado->medio_captacion_id;
        $empleadoHistorico->fecha_inicio = $empleado->fecha_inicio;
        $empleadoHistorico->fecha_final = $empleado->fecha_final;
        $empleadoHistorico->estado = $empleado->estado;
        $empleadoHistorico->persona_id_created_at = Auth::user()->id;
        $empleadoHistorico->save();
        DB::commit();
    }

    public static function runNew($r)
    {
        DB::beginTransaction();
        $crear=0;
        $empleado = Empleado::where('persona_id',$r->persona_id)
                    ->first();
        if( !isset($empleado->id) ){
            $crear=1;
            $empleado = new Empleado;
            $empleado->persona_id_created_at=Auth::user()->id;
        }
        else{
            $empleado->persona_id_updated_at=Auth::user()->id;
        }

        $empleado->persona_id = trim( $r->persona_id );
        $empleado->cargo_id = trim( $r->cargo_id );
        $empleado->local_id = trim( $r->local_id );
        $empleado->codigo = trim( $r->codigo );

        $empleado->medio_captacion_id = null;
        if( $r->has('medio_captacion_id') AND trim($r->medio_captacion_id)!='' ){
            $empleado->medio_captacion_id = trim( $r->medio_captacion_id );
        }

        $empleado->fecha_inicio = null;
        if( $r->has('fecha_ingreso') AND trim($r->fecha_ingreso)!='' ){
            $empleado->fecha_inicio = trim( $r->fecha_ingreso );
        }

        $empleado->fecha_final = null;
        if( $r->has('fecha_cese') AND trim($r->fecha_cese)!='' ){
            $empleado->fecha_final = trim( $r->fecha_cese );
        }
        $empleado->estado=1;
        $empleado->save();

        $empleadoHistorico = new EmpleadoHistorico;
        $empleadoHistorico->empleado_id = $empleado->id;
        $empleadoHistorico->persona_id = $empleado->persona_id;
        $empleadoHistorico->cargo_id = $empleado->cargo_id;
        $empleadoHistorico->local_id = $empleado->local_id;
        $empleadoHistorico->codigo = $empleado->codigo;
        $empleadoHistorico->medio_captacion_id = $empleado->medio_captacion_id;
        $empleadoHistorico->fecha_inicio = $empleado->fecha_inicio;
        $empleadoHistorico->fecha_final = $empleado->fecha_final;
        $empleadoHistorico->estado = $empleado->estado;
        $empleadoHistorico->persona_id_created_at = Auth::user()->id;
        $empleadoHistorico->save();
        DB::commit();
    }

    public static function runEdit($r)
    {
        DB::beginTransaction();
        $empleado = Empleado::find($r->id);
        $empleado->persona_id = trim( $r->persona_id );
        $empleado->cargo_id = trim( $r->cargo_id );
        $empleado->local_id = trim( $r->local_id );
        $empleado->codigo = trim( $r->codigo );

        $empleado->medio_captacion_id = null;
        if( $r->has('medio_captacion_id') AND trim($r->medio_captacion_id)!='' ){
            $empleado->medio_captacion_id = trim( $r->medio_captacion_id );
        }

        $empleado->fecha_inicio = null;
        if( $r->has('fecha_ingreso') AND trim($r->fecha_ingreso)!='' ){
            $empleado->fecha_inicio = trim( $r->fecha_ingreso );
        }

        $empleado->fecha_final = null;
        if( $r->has('fecha_cese') AND trim($r->fecha_cese)!='' ){
            $empleado->fecha_final = trim( $r->fecha_cese );
        }

        $empleado->estado=1;
        $empleado->persona_id_updated_at=Auth::user()->id;
        $empleado->save();

        $empleadoHistorico = new EmpleadoHistorico;
        $empleadoHistorico->empleado_id = $empleado->id;
        $empleadoHistorico->persona_id = $empleado->persona_id;
        $empleadoHistorico->cargo_id = $empleado->cargo_id;
        $empleadoHistorico->local_id = $empleado->local_id;
        $empleadoHistorico->codigo = $empleado->codigo;
        $empleadoHistorico->medio_captacion_id = $empleado->medio_captacion_id;
        $empleadoHistorico->fecha_inicio = $empleado->fecha_inicio;
        $empleadoHistorico->fecha_final = $empleado->fecha_final;
        $empleadoHistorico->estado = $empleado->estado;
        $empleadoHistorico->persona_id_created_at = Auth::user()->id;
        $empleadoHistorico->save();
        DB::commit();
    }


    public static function runLoad($r)
    {
        $sql=DB::table('am_empleados AS e')
            ->join('am_personas AS p',function($join){
                $join->on('e.persona_id','=','p.id')
                ->where('p.estado',1);
            })
            ->join('am_cargos AS c',function($join){
                $join->on('e.cargo_id','=','c.id');
            })
            ->join('am_locales AS l',function($join){
                $join->on('e.local_id','=','l.id');
            })
            ->leftJoin('dm_medios_captaciones AS mc',function($join){
                $join->on('e.medio_captacion_id','=','mc.id');
            })
            ->select('e.id','e.estado','e.persona_id','e.cargo_id','e.local_id'
                ,'e.medio_captacion_id','l.local','c.cargo','mc.medio_captacion'
                ,'p.paterno','p.materno','p.nombre','p.dni','e.codigo','l.codigo AS codigo_local'
                ,'e.fecha_inicio','e.fecha_final'
            )
            ->where( 
                    
                function($query) use ($r){
                    if( $r->has("paterno") ){
                        $paterno=trim($r->paterno);
                        if( $paterno !='' ){
                            $query->where('p.paterno','like',$paterno.'%');
                        }
                    }
                    if( $r->has("materno") ){
                        $materno=trim($r->materno);
                        if( $materno !='' ){
                            $query->where('p.materno','like',$materno.'%');
                        }
                    }
                    if( $r->has("nombre") ){
                        $nombre=trim($r->nombre);
                        if( $nombre !='' ){
                            $query->where('p.nombre','like',$nombre.'%');
                        }
                    }
                    if( $r->has("dni") ){
                        $dni=trim($r->dni);
                        if( $dni !='' ){
                            $query->where('p.dni','like',$dni.'%');
                        }
                    }
                    if( $r->has("codigo") ){
                        $codigo=trim($r->codigo);
                        if( $codigo !='' ){
                            $query->where('e.codigo','like',$codigo.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('e.estado','=',''.$estado.'');
                        }
                    }
                }
            );
        $result = $sql->orderBy('id','asc')->paginate(10);
        return $result;
    }

    // --
    public static function ListEmpleado($r)
    {
        $sql=DB::table('am_empleados AS e')
            ->join('am_personas AS p',function($join){
                $join->on('e.persona_id','=','p.id')
                ->where('p.estado',1);
            })
            ->select('e.id','e.persona_id',
                DB::raw( 'CONCAT(p.paterno," ",p.materno,", ",p.nombre) as empleado')
                ,'p.dni','p.foto'
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
                            if( count($dphrase)>4 AND trim($dphrase[4])!='' ){
                                $dphrase[4]=trim($dphrase[4]);
                                $query->where('e.codigo','like',$dphrase[4].'%');
                            }
                        }
                    }
                    if( $r->has("medio_captacion_id") ){
                        $medio_captacion_id=trim($r->medio_captacion_id);
                        if( $medio_captacion_id !='' ){
                            $query->where('e.medio_captacion_id','=',''.$medio_captacion_id.'');
                        }
                    }
                    if( $r->has("local_id") ){
                        $local_id=trim($r->local_id);
                        if( $local_id !='' ){
                            $query->where('e.local_id','=',''.$local_id.'');
                        }
                    }
                    if( $r->has("cargo_id") ){
                        $cargo_id=trim($r->cargo_id);
                        if( $cargo_id !='' ){
                            $query->where('e.cargo_id','=',''.$cargo_id.'');
                        }
                    }
                }
            )
            ->where('e.estado','=','1');
        $result = $sql->get();
        return $result;
    }

}
