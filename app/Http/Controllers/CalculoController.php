<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculoController extends Controller
{
    //
    public function index($id)
    {
        return 'el valor es '.$id;
    }
    public function calcular(Request $r)
    {
        $x = $r['c']-($r['a']-$r['b']);
        $x1 = (-$r['b']+sqrt($r['b']*$r['b']-4*$r['a']*$r['c']))/(2*$r['a']);
        $x2 = (-$r['b']-sqrt($r['b']*$r['b']-4*$r['a']*$r['c']))/(2*$r['a']);
        $Resp = ['Primer grado'=>'El resultado es x = '.$x,
                 'Segundo grado'=>'El resultado es x1 = '.$x1.' , x2 = '.$x2
                ];
        return response()->json($Resp);
        return $r;
    }
}
