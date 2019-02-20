<?php
namespace App\Http\Controllers\PlanEstudio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\PlanEstudio\SemestreProgramacion;

class SemestreProgramacionPE extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    }

    public function New(Request $r )
    {
        if ( $r->ajax() ) {

            $mensaje= array(
                'required'    => ':attribute es requerido',
                'unique'      => 'Fecha "'.$r->fecha.'" debe ser único',
            );

            $rules = array(
                'semestre_id' => ['required'],
                'fecha' => ['required',
                                Rule::unique('dm_semestres_programaciones','fecha')
                                ->where('semestre_id',$r->semestre_id)
                                ->where('estado',1)],
            );

            
            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                SemestreProgramacion::runNew($r);
                $return['rst'] = 1;
                $return['msj'] = 'Registro creado';
            }
            else{
                $return['rst'] = 2;
                $return['msj'] = $validator->errors()->all()[0];
            }
            return response()->json($return);
        }
    }

    public function Load(Request $r )
    {
        if ( $r->ajax() ) {
            $renturnModel = SemestreProgramacion::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);   
        }
    }

    public function Eliminar(Request $r )
    {
        if ( $r->ajax() ) {
            SemestreProgramacion::runEliminar($r);
            $return['rst'] = 1;
            $return['msj'] = "Registro eliminado";
            return response()->json($return);
        }
    }

}
