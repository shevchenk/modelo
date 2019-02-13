<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class Menu extends Model
{
    protected   $table = 'am_menus';

    public static function runEditStatus($r)
    {
        $persona_id=Auth::user()->id;
        $menu = Menu::find($r->id);
        $menu->estado = trim( $r->estadof );
        $menu->persona_id_updated_at=$persona_id;
        $menu->save();
    }

    public static function runNew($r)
    {
        $persona_id=Auth::user()->id;
        $menu = new Menu;
        $menu->menu = trim( $r->menu );
        $menu->class_icono = trim( $r->class_icono );
        $menu->estado = trim( $r->estado );
        $menu->persona_id_created_at=$persona_id;
        $menu->save();
    }

    public static function runEdit($r)
    {
        $persona_id=Auth::user()->id;
        $menu = Menu::find($r->id);
        $menu->menu = trim( $r->menu );
        $menu->class_icono = trim( $r->class_icono );
        $menu->estado = trim( $r->estado );
        $menu->persona_id_updated_at=$persona_id;
        $menu->save();
    }

    public static function runLoad($r)
    {

        $sql=Menu::select('id','menu','class_icono','estado')
            ->where( 
                function($query) use ($r){
                    if( $r->has("menu") ){
                        $menu=trim($r->menu);
                        if( $menu !='' ){
                            $query->where('menu','like','%'.$menu.'%');
                        }
                    }
                    if( $r->has("class_icono") ){
                        $class_icono=trim($r->class_icono);
                        if( $class_icono !='' ){
                            $query->where('class_icono','like','%'.$class_icono.'%');
                        }
                    }
                    if( $r->has("estado") ){
                        $estado=trim($r->estado);
                        if( $estado !='' ){
                            $query->where('estado','=',$estado);
                        }
                    }
                }
            );
        $result = $sql->orderBy('menu','asc')->paginate(10);
        return $result;
    }
    
    public static function ListMenu($r)
    {
        $sql=Menu::select('id','menu','class_icono','estado')
            ->where(
                function($query) use ($r){
                    if( $r->has("phrase") ){
                        $phrase=trim($r->phrase);
                        if( $phrase !='' ){
                            $dphrase= explode("|",$phrase);
                            $dphrase[0]=trim($dphrase[0]);
                            $query->where('menu','like','%'.$dphrase[0].'%');
                        }
                    }
                }
            )
            ->where('estado','=','1');
        $result = $sql->orderBy('menu','asc')->get();
        return $result;
    }
    

}
