<?php
namespace App\Http\Controllers\Ingreso;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ingreso\PSLocal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PSLocalIN extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  //Esto debe activarse cuando estemos con sessión
    } 

    public function EditStatus(Request $r )
    {
        if ( $r->ajax() ) {
            PSLocal::runEditStatus($r);
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
                'unique'      => 'El '.$r->ttipo.': '.$r->nivel3.' ya existe y debe ser único, en el local:'.$r->local,
            );

            $rules = array(
                'ps_nivel3_id' => ['required',
                                Rule::unique('bm_ps_nivel3_local','ps_nivel3_id')
                                ->where('local_id',$r->local_id)
                                ->where('estado',1)],
            );

            
            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                PSLocal::runNew($r);
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
                'ps_nivel3_id' => 
                       ['required'],
            );

            $validator=Validator::make($r->all(), $rules,$mensaje);

            if ( !$validator->fails() ) {
                PSLocal::runEdit($r);
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
            $r['estado']=1;
            $renturnModel = PSLocal::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";    
            return response()->json($return);   
        }
    }

    public function LoadUser(Request $r )
    {
        if ( $r->ajax() ) {
            $r['user']=1;
            $renturnModel = PSLocal::runLoad($r);
            $return['rst'] = 1;
            $return['data'] = $renturnModel;
            $return['msj'] = "No hay registros aún";    
            return response()->json($return);   
        }
    }
}
