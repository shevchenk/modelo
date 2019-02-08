<?php
Route::get('/', function () {
    return view('secureaccess.login');
});

Route::get('/salir','SecureAccess\PersonaSA@logout');

Route::get('/ReportDinamic/{ruta}','SecureAccess\PersonaSA@Menu');
Route::post('/AjaxDinamic/{ruta}','SecureAccess\PersonaSA@Menu');

Route::get(
    '/{ruta}', function ($ruta) {        
        if( session()->has('dni') && session()->has('menu')
            && session()->has('opciones')
        ){
            $valores['valida_ruta_url'] = $ruta;
            $valores['menu'] = session('menu');
            $valores['privilegios'] = session('privilegios');

            if( strpos( session('opciones'),$ruta )!==false
                || $ruta=='secureaccess.inicio'
                || $ruta=='secureaccess.myself' ){
                return view($ruta)->with($valores);
            }
            else{
                return redirect('secureaccess.inicio');
            }
        }
        else{
            return redirect('/');
        }
    }
);


