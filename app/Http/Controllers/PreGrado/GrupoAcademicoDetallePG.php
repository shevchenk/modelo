<?php
namespace App\Http\Controllers\PreGrado;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\PreGrado\GrupoAcademicoDetalle;

class GrupoAcademicoDetallePG extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    } 

    public function NewEdit(Request $r)
    {
        if ( $r->ajax() ) {

            $mensaje= array(
                'required'    => ':attribute es requerido',
                'unique'        => ':attribute solo debe ser único',
            );

            $rules = array(
                'curso_id' => ['required']
            );

            
            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                $resultado=GrupoAcademicoDetalle::runNewEdit($r);
                $return['rst'] = 1;
                $return['msj'] = $resultado;
            }
            else{
                $return['rst'] = 2;
                $return['msj'] = $validator->errors()->all()[0];
            }
            return response()->json($return);
        }
    }

    public function LoadProgramacion(Request $r )
    {
        if ( $r->ajax() ) {
            $renturnModel = GrupoAcademicoDetalle::runLoadProgramacion($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }

}
