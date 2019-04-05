<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nexmo\Response;

interface Ecuacion{
    public function calcular($a,$b,$c);
}

class PrimerGrado implements Ecuacion{
    public function calcular($a,$b,$c)
    {
        $x = ($c-($a-$b));
        return ['Primer grado'=>'El resultado es x = '.$x];
    }
}
class SegundoGrado implements Ecuacion{
    public function calcular($a,$b,$c)
    {
        if($a==0){
            return ['error'=>'division entre cero.'];
        }
        if($b*$b<4*$a*$c){
            return ['error'=>'raiz de un negativo.'];
        }
        $x1 = (-$b+sqrt($b*$b-4*$a*$c))/(2*$a);
        $x2 = (-$b-sqrt($b*$b-4*$a*$c))/(2*$a);
        return ['Segundo grado'=>'El resultado es x1 = '.$x1.' , x2 = '.$x2];
    }
}
class NingunGrado implements Ecuacion{
    public function calcular($a,$b,$c)
    {
        return [];
    }
}

class EcuacionFabrica{
    public static function getEcuacion($tipo): Ecuacion
    {
        if (strtolower($tipo) == 'primer') {
            return new PrimerGrado();
        } elseif (strtolower($tipo) == 'segundo') {
            return new SegundoGrado();
        } else{
            return new NingunGrado();
        }
    }
}
class CalculoController extends Controller
{
    //
    public function index($id)
    {
        return 'el valor es '.$id;
    }
    public function calcular(Request $r)
    {
        if(!is_numeric($r['a'])){
            return response()->json(['error'=>'(a) no es numero'],\Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND);
        }
        if(!is_numeric($r['b'])){
            return response()->json(['error'=>'(b) no es numero'],\Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND);
        }
        if(!is_numeric($r['c'])){
            return response()->json(['error'=>'(c) no es numero'],\Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND);
        }
        /*
        $x = $r['c']-($r['a']-$r['b']);
        $x1 = (-$r['b']+sqrt($r['b']*$r['b']-4*$r['a']*$r['c']))/(2*$r['a']);
        $x2 = (-$r['b']-sqrt($r['b']*$r['b']-4*$r['a']*$r['c']))/(2*$r['a']);
        $Resp = ['Primer grado'=>'El resultado es x = '.$x,
                 'Segundo grado'=>'El resultado es x1 = '.$x1.' , x2 = '.$x2
                ];
        */
        $ecuacion = EcuacionFabrica::getEcuacion($r['tipo']);
        $Resp = $ecuacion->calcular($r['a'],$r['b'],$r['c']);
        if(key($Resp)=='error'){
            return response()->json($Resp,\Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND);
        }
        return response()->json($Resp);
    }
}
