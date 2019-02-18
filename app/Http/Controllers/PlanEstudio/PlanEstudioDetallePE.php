<?php
namespace App\Http\Controllers\PlanEstudio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\PlanEstudio\PlanEstudioDetalle;

class PlanEstudioDetallePE extends Controller
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
                'unique'      => 'Curso "'.$r->curso.'" debe ser único',
            );

            $rules = array(
                'plan_estudio_id' => ['required'],
                'curso_id' => ['required',
                                Rule::unique('cp_plan_estudios_detalles','curso_id')
                                ->where('plan_estudio_id',$r->plan_estudio_id)
                                ->where('estado',1)],
            );

            
            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                PlanEstudioDetalle::runNew($r);
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

    public function Edit(Request $r )
    {
        if ( $r->ajax() ) {
            $mensaje= array(
                'required'    => ':attribute es requerido',
                'unique'        => ':attribute solo debe ser único',
            );

            $rules = array(
                'plan_estudio_id' => ['required'],
            );

            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                PlanEstudioDetalle::runEdit($r);
                $return['rst'] = 1;
                $return['id'] = $r->id;
                $return['msj'] = 'Registro actualizado';
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
            $renturnModel = PlanEstudioDetalle::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);   
        }
    }

    public function LoadResumen(Request $r )
    {
        if ( $r->ajax() ) {
            $renturnModel = PlanEstudioDetalle::runLoadResumen($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);   
        }
    }

    public function Eliminar(Request $r )
    {
        if ( $r->ajax() ) {
            PlanEstudioDetalle::runEliminar($r);
            $return['rst'] = 1;
            $return['msj'] = "Registro eliminado";
            return response()->json($return);
        }
    }

}
