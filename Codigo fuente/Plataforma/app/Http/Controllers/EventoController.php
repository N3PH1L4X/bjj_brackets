<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class EventoController extends Controller
{
    public function index(){

        $eventos = DB::table('evento')
        ->join('deporte', 'evento.deporte_id_deporte', '=', 'deporte.id_deporte')
        ->join('estado_evento', 'evento.estado_evento_id_estado_evento', '=', 'estado_evento.id_estado_evento')
        ->orderByDesc('id_evento')
        ->get();

        $estados_evento = DB::table('estado_evento')
        ->get();

        $deportes = DB::table('deporte')
        ->get();

        $fechahoy = Carbon::now()->toDateString();
        $fechamaximo = Carbon::now()->addYears(2)->toDateString();

        return view('evento', [
            'eventos' => $eventos,
            'estados_evento' => $estados_evento,
            'deportes' => $deportes,
            'fechahoy' => $fechahoy,
            'fechamaximo' => $fechamaximo
        ]);

    }

    public function add(Request $request){

        $nombre_evento = $request->input('idnombre');
        $fechainicio = $request->input('idfechainicio');
        $fechacierre = $request->input('idfechacierre');
        $deporte = $request->input('inputdeporteregistro');
        $estado_evento = 1; // Por defecto al crear un nuevo evento se registrará como "Agendado". Ver inserts del script SQL.

        DB::table('evento')->insert([
            'nombre_evento' => $nombre_evento,
            'f_inicio_evento' => $fechainicio,
            'f_cierre_evento' => $fechacierre,
            'deporte_id_deporte' => $deporte,
            'estado_evento_id_estado_evento' => $estado_evento
        ]);

        return redirect('/eventos');
    }

    // public function borrar(Request $request){
    //     $idinstructor = $request->id;

    //     $escuelas = DB::table('escuela')
    //     ->where('instructor_id_instructor', '=', $idinstructor)
    //     ->get();

    //     foreach ($escuelas as $escuela) {
    //         $pathimagen = $escuela->escudo_escuela;
    //         if ($pathimagen !== 'storage/img/escudos/sinImagenDefault.jpg') {
    //             unlink($pathimagen);
    //         }
    //     }

    //     $escuela = DB::table('escuela')->where('instructor_id_instructor', '=', $idinstructor)
    //     ->get();

    //     $pathimagen = $escuela->pluck('escudo_escuela')
    //     ->first();

    //     DB::table('escuela')->where('instructor_id_instructor', '=', $idinstructor)
    //     ->delete();

    //     DB::table('instructor')->where('id_instructor', '=', $idinstructor)
    //     ->delete();

    //     return redirect('/instructores');
    // }

    public function editar(Request $request){

        $id = $request->input('inputeditarid');
        $editarnombreevento = $request->input('editarnombreevento');
        $editarfechainicio = $request->input('editarfechainicio');
        $editarfechacierre = $request->input('editarfechacierre');
        $editarsdisciplina = $request->input('inputdeporteeditar' . $id);
        $editarestadoevento = $request->input('inputestadoeditar' . $id);

        DB::table('evento')
            ->where('id_evento', $id)
            ->update([
                'nombre_evento' => $editarnombreevento,
                'f_inicio_evento' => $editarfechainicio,
                'f_cierre_evento' => $editarfechacierre,
                'deporte_id_deporte' => $editarsdisciplina,
                'estado_evento_id_estado_evento' => $editarestadoevento,
            ]);

        return redirect('/eventos');
    }

}
