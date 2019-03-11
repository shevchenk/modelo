<?php
namespace App\Http\Controllers\Mantenimiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Mantenimiento\Ambiente;

class AmbienteMA extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    }

    public function ListAmbiente(Request $r )
    {
        if ( $r->ajax() ) {
            $renturnModel = Ambiente::ListAmbiente($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }

    public function ListAmbienteAula(Request $r )
    {
        if ( $r->ajax() ) {
            $r['tipo_ambiente']=1;
            $renturnModel = Ambiente::ListAmbiente($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }

    public function ListAmbienteLaboratorio(Request $r )
    {
        if ( $r->ajax() ) {
            $r['tipo_ambiente']=2;
            $renturnModel = Ambiente::ListAmbiente($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }

}
