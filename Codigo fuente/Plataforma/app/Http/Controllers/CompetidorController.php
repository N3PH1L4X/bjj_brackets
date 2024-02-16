<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CompetidorController extends Controller
{
    public function index(){

        $competidores = DB::table('competidor')
        ->join('escuela', 'competidor.escuela_id_escuela', '=', 'escuela.id_escuela')
        ->get();

        $escuelas = DB::table('escuela')->get();

        return view('competidor', [
            'competidores' => $competidores,
            'escuelas' => $escuelas
        ]);

    }

    public function add(Request $request){

        $rut = $request->input('idrut');
        $nombres = $request->input('idnombres');
        $papellido = $request->input('idprimerap');
        $sapellido = $request->input('idsegundoap');
        $idescuela = $request->input('inputescuelaregistro');
        $peso = $request->input('idpeso');
        $edad = $request->input('idedad');
        $email = $request->input('idcorreo');
        $telefono = $request->input('idtelefono');

        DB::table('competidor')->insert([
            'rut_competidor' => $rut,
            'nombre_competidor' => $nombres,
            'primer_apellido_competidor' => $papellido,
            'segundo_apellido_competidor' => $sapellido,
            'peso_competidor' => $peso,
            'edad_competidor' => $edad,
            'escuela_id_escuela' => $idescuela,
            'correo_competidor' => $email,
            'telefono_competidor' => $telefono
        ]);

        return redirect('/competidores');
    }

    public function borrar(Request $request){

        $idcompetidor = $request->id;
        $idborrarcompetidor = DB::table('competidor')->where('id_competidor', '=', $idcompetidor)->delete();

        return redirect('/competidores');
    }

    public function editar(Request $request){

        $id = $request->input('inputeditarid');
        $rut = $request->input('editarrut');
        $nombres = $request->input('editarnombres');
        $papellido = $request->input('editarpapellido');
        $sapellido = $request->input('editarsapellido');
        $idescuela = $request->input('inputescuelaeditar'.$id );
        $peso = $request->input('editarpeso');
        $edad = $request->input('editaredad');
        $email = $request->input('editaremail');
        $telefono = $request->input('editartelefono');

        $editarregistro = DB::table('competidor')
            ->where('id_competidor', $id)
            ->update([
                'rut_competidor' => $rut,
                'nombre_competidor' => $nombres,
                'primer_apellido_competidor' => $papellido,
                'segundo_apellido_competidor' => $sapellido,
                'peso_competidor' => $peso,
                'edad_competidor' => $edad,
                'escuela_id_escuela' => $idescuela,
                'correo_competidor' => $email,
                'telefono_competidor' => $telefono
            ]);

        return redirect('/competidores');
    }

}
