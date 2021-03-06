<?php
namespace App\Http\Controllers\PlanEstudio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\PlanEstudio\PlanEstudio;

class PlanEstudioPE extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    } 

    public function EditStatus(Request $r )
    {
        if ( $r->ajax() ) {
            PlanEstudio::runEditStatus($r);
            $return['rst'] = 1;
            $return['msj'] = 'Registro actualizado';
            return response()->json($return);
        }
    }

   public function New(Request $r )
    {
        if ( $r->ajax() ) {

            $mensaje= array(
                'required'    => ':attribute es requerido',
                'unique'      => ':attribute solo debe ser único',
            );

            $rules = array(
                'modalidad_id' => ['required'],
                'carrera_id' => ['required'],
                'facultad_id' => ['required'],
            );

            
            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                PlanEstudio::runNew($r);
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
                'modalidad_id' => ['required'],
                'carrera_id' => ['required'],
                'facultad_id' => ['required'],
            );

            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                PlanEstudio::runEdit($r);
                $return['rst'] = 1;
                $return['msj'] = 'Registro actualizado';
            }
            else{
                $return['rst'] = 2;
                $return['msj'] = $validator->errors()->all()[0];
            }
            return response()->json($return);
        }
    }

    public function EditVir(Request $r )
    {
        if ( $r->ajax() ) {
            $mensaje= array(
                'required'    => ':attribute es requerido',
                'unique'        => ':attribute solo debe ser único',
            );

            $rules = array(
                'id' => ['required'],
            );

            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                PlanEstudio::runEditVir($r);
                $return['rst'] = 1;
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
            $renturnModel = PlanEstudio::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);   
        }
    }

    public function LoadVir(Request $r )
    {
        if ( $r->ajax() ) {
            $r['modalidad_virtual'] = 1;
            $renturnModel = PlanEstudio::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);   
        }
    }
    
    public function ListPlanEstudio (Request $r )
    {
        if ( $r->ajax() ) {
            $renturnModel = PlanEstudio::ListPlanEstudio($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }

    public function Replicar (Request $r )
    {
        if ( $r->ajax() ) {
            $renturnModel = PlanEstudio::runReplicar($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "Plan: ".$r->plan_estudio." replicado";
            return response()->json($return);
        }
    }

}
