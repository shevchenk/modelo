<?php
namespace App\Http\Controllers\Mantenimiento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Mantenimiento\MedioCaptacion;

class MedioCaptacionMA extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    }

    public function ListMedioCaptacion(Request $r )
    {
        if ( $r->ajax() ) {
            $renturnModel = MedioCaptacion::ListMedioCaptacion($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }

    public function ListMedioCaptacionComision(Request $r )
    {
        if ( $r->ajax() ) {
            $r['tipo_medio']=1;
            $renturnModel = MedioCaptacion::ListMedioCaptacion($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }

}
