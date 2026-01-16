<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Correlaciones;
use App\Models\User;
use App\Models\Tipos;
use App\Models\Unit;
use App\Models\Actividad;

class CorrelacionesController extends Controller
{
    public function guardarcite(Request $request){
        $datos = json_decode($request->getContent(), true);
        $valorInicial = 1;
        if ($request->id == 4 && $request->user()->unit_id == 38) {
            $unitId = 12;
        } else {
            $unitId = $request->user()->unit_id;
        }
        $maxCodInterno = Correlaciones::whereYear('created_at',date('Y'))->where('unit_id', $unitId)
            ->where('tipo_id', $request->id)
            ->max("cod_interno");       
        if ($maxCodInterno === null) {
            $codigointerno = $valorInicial;
        } else {
            $codigointerno = $maxCodInterno + 1;
        }
        $user=User::where('id',$request->user()->id)->with('unit')->get();
        $tipo = Tipos::where('id', $request->id)->first();

        $cor = new Correlaciones();
        $cor->codigo=$user[0]->unit->codigo.'-'.$tipo->codigo.' No '.str_pad($codigointerno, 4, '0', STR_PAD_LEFT).'/'.date('y');
        $cor->user_id=$request->user()->id;
        $cor->unit_id=$unitId;
        $cor->tipo_id=$request->id;
        $cor->cod_interno=$codigointerno;
        $cor->fecha=date('Y-m-d');
        $cor->referencia =  strtoupper($datos['datos']['referencia']);
        $cor->destinatario =  strtoupper($datos['datos']['nombre']);
        $cor->observacion =  strtoupper($datos['datos']['observacion']);
        $cor->save();
        return $cor;
    }
    public function historial(Request $request){
        if($request->identificacion == 4 && $request->user()->unit_id == 38){
            $historial = Correlaciones::where('tipo_id', $request->identificacion)
            ->where('unit_id', 12)
            ->with('user')
            ->whereYear('created_at',$request->gestion)
            ->orderBy('cod_interno', 'desc')
            ->get();
        }else{
            $historial = Correlaciones::where('tipo_id', $request->identificacion)
            ->where('unit_id', $request->user()->unit_id)
            ->with('user')
            ->whereYear('created_at',$request->gestion)
            ->orderBy('cod_interno', 'desc')
            ->get();
        }
        $datos = Unit::where('id', $request->user()->unit_id)->first();
        $tipo = Tipos::where('id',$request->identificacion)->first();
        return response()->json([
        'historial' => $historial,
        'datos' => $datos,
        'tipos' => $tipo,
        'gest' =>$request->gestion
        ]);
    }
    public function editarcorrelacion(Request $request){
        $datos = Correlaciones::find($request->id);
        $datos->referencia = strtoupper($request->referencia);
        $datos->destinatario = strtoupper($request->destinatario);
        $datos->observacion = strtoupper($request->observacion);
        $datos->save();
    }
    public function guardarpadron(Request $request){
        $datos = json_decode($request->getContent(), true);
        $valorInicial = 56254; 
        $maxCodInterno = Correlaciones::where('unit_id', $request->user()->unit_id)
            ->where('tipo_id', $request->id)
            ->max("cod_interno");
        if ($maxCodInterno === null) {
            $codigointerno = $valorInicial;
        } else {
            $codigointerno = $maxCodInterno + 1;
        }
        $pad2 = (int) $datos['padron']['activ']['codigo'];
        $codigo='1-'.$pad2.'-'.$codigointerno;
        $cor = new Correlaciones();
        $cor->codigo=$codigo;
        $cor->referencia =  strtoupper($datos['padron']['nombre']);
        $cor->user_id=$request->user()->id;
        $cor->unit_id=$request->user()->unit_id;
        $cor->tipo_id=$request->id;
        $cor->cod_interno=$codigointerno;
        $cor->fecha=date('Y-m-d');
        $cor->destinatario =  strtoupper($datos['padron']['descrip']);
        $cor->observacion =  strtoupper($datos['padron']['observacion']);
        $cor->save();
        return $cor;
    }
}
