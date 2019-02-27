<?php
namespace App\Http\Controllers\Ingreso;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ingreso\Nivel2;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Nivel2IN extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    } 

    public function EditStatus(Request $r )
    {
        if ( $r->ajax() ) {
            Nivel2::runEditStatus($r);
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
                'ps_nivel1_id' => 
                       ['required',
                     //   Rule::unique('bm_ps_nivel3_local','cargo')->where(function ($query) use($r) {
//                                $query->where('pregunta_id',$r->pregunta_id );
                    //   }),
                        ],
            );

            
            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                Nivel2::runNew($r);
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
                'ps_nivel1_id' => 
                       ['required',
                     //   Rule::unique('bm_ps_nivel3_local','cargo')->ignore($r->id)->where(function ($query) use($r) {
                              //  $query->where('pregunta_id',$r->pregunta_id );
                       // }),
                        ],
            );

            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                Nivel2::runEdit($r);
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
            $renturnModel = Nivel2::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";    
            return response()->json($return);   
        }
    }
    
        public function ListNivel2 (Request $r )
    {
        if ( $r->ajax() ) {
            $renturnModel = Nivel2::ListNivel2($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";
            return response()->json($return);
        }
    }
}
