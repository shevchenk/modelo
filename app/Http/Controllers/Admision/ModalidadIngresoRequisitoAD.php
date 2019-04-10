<?php
namespace App\Http\Controllers\Admision;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Admision\ModalidadIngresoRequisito;

class ModalidadIngresoRequisitoAD extends Controller
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
                'modalidad_ingreso_id' => ['required'],
                'requisito' => ['required',
                                Rule::unique('da_modalidades_ingresos_requisitos','requisito')
                                ->where('modalidad_ingreso_id',$r->modalidad_ingreso_id)
                                ->where('estado',1)],
            );

            
            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                ModalidadIngresoRequisito::runNew($r);
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
            $renturnModel = ModalidadIngresoRequisito::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);   
        }
    }

    public function Eliminar(Request $r )
    {
        if ( $r->ajax() ) {
            ModalidadIngresoRequisito::runEliminar($r);
            $return['rst'] = 1;
            $return['msj'] = "Registro eliminado";
            return response()->json($return);
        }
    }

    public function ListRequisitos(Request $r )
    {
        if ( $r->ajax() ) {
            $renturnModel = ModalidadIngresoRequisito::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);   
        }
    }

}
