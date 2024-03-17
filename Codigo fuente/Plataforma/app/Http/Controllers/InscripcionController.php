<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class InscripcionController extends Controller
{
    public function index()
    {

        $inscripciones = DB::table('inscripcion')
            ->join('competidor', 'competidor.id_competidor', '=', 'inscripcion.competidor_id_competidor')
            ->join('evento', 'evento.id_evento', '=', 'inscripcion.evento_id_evento')
            ->join('categoria', 'categoria.id_categoria', '=', 'inscripcion.categoria_id_categoria')
            ->join('estado_pago', 'estado_pago.id_estado_pago', '=', 'inscripcion.estado_pago_id_estado_pago')
            ->join('deporte', 'deporte.id_deporte', '=', 'categoria.deporte_id_deporte')
            ->join('escuela', 'escuela.id_escuela', '=', 'competidor.escuela_id_escuela')
            ->join('instructor', 'instructor.id_instructor', '=', 'escuela.instructor_id_instructor')
            ->where('estado_evento_id_estado_evento', '!=', 5)
            ->get();

        $competidores = DB::table('competidor')->get();
        $eventos = DB::table('evento')->join('deporte', 'deporte.id_deporte', '=', 'evento.deporte_id_deporte')->where('estado_evento_id_estado_evento', '<=', '2')->get();
        $estadopagos = DB::table('estado_pago')->get();
        $categorias = DB::table('categoria')->join('deporte', 'deporte.id_deporte', '=', 'categoria.deporte_id_deporte')->get();

        return view('inscripcion', [
            'inscripciones' => $inscripciones,
            'competidores' => $competidores,
            'eventos' => $eventos,
            'estadopagos' => $estadopagos,
            'categorias' => $categorias,
        ]);

    }

    public function add(Request $request)
    {
        $idcompetidor = $request->input('competidor');
        $idcategoria = $request->input('categoria');
        $idevento = $request->input('evento');
        $idestadopago = $request->input('inputestadopagoregistro');

        DB::table('inscripcion')->insert([
            'competidor_id_competidor' => $idcompetidor,
            'evento_id_evento' => $idevento,
            'categoria_id_categoria' => $idcategoria,
            'estado_pago_id_estado_pago' => $idestadopago
        ]);

        return redirect('/inscripciones');
    }


    public function borrar(Request $request){
        $idinscripcion = $request->id;

        DB::table('inscripcion')->where('id_inscripcion', '=', $idinscripcion)
        ->delete();

        return redirect('/inscripciones');
    }

    public function editar(Request $request)
    {

        $id = $request->input('inputeditarid');
        $editarestadopago = $request->input('inputescuelaeditar' . $id);

        DB::table('inscripcion')
            ->where('id_inscripcion', $id)
            ->update([
                'estado_pago_id_estado_pago' => $editarestadopago,
            ]);

        return redirect('/inscripciones');
    }




    public function obtenereventos()
    {
        $eventos = DB::table('evento')
            ->where('estado_evento_id_estado_evento', '<=', 2)
            ->join('deporte', 'deporte.id_deporte', '=', 'evento.deporte_id_deporte')
            ->get();
        return response()->json($eventos);
    }

    public function obtenercategorias($idevento)
    {
        $categorias = DB::table('categoria')
            ->join('deporte', 'deporte.id_deporte', '=', 'categoria.deporte_id_deporte')
            ->join('evento', 'evento.deporte_id_deporte', '=', 'deporte.id_deporte')
            ->where('id_evento', '=', $idevento)
            ->get();

        return response()->json($categorias);
    }

}
