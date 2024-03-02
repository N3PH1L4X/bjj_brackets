<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    public function index(){

        $instructores = DB::table('instructor')
        ->inRandomOrder()
        ->get();

        return view('instructor', [
            'instructores' => $instructores
        ]);

    }

    public function add(Request $request){

        $rut = $request->input('idrut');
        $nombres = $request->input('idnombres');
        $papellido = $request->input('idprimerap');
        $sapellido = $request->input('idsegundoap');
        $email = $request->input('idcorreo');
        $telefono = $request->input('idtelefono');

        DB::table('instructor')->insert([
            'rut_instructor' => $rut,
            'nombre_instructor' => $nombres,
            'primer_apellido_instructor' => $papellido,
            'segundo_apellido_instructor' => $sapellido,
            'correo_instructor' => $email,
            'telefono_instructor' => $telefono
        ]);

        return redirect('/instructores');
    }

    public function borrar(Request $request){
        $idinstructor = $request->id;

        $escuelas = DB::table('escuela')
        ->where('instructor_id_instructor', '=', $idinstructor)
        ->get();

        foreach ($escuelas as $escuela) {
            $pathimagen = $escuela->escudo_escuela;
            if ($pathimagen !== 'storage/img/escudos/sinImagenDefault.jpg') {
                unlink($pathimagen);
            }
        }

        $escuela = DB::table('escuela')->where('instructor_id_instructor', '=', $idinstructor)
        ->get();

        $pathimagen = $escuela->pluck('escudo_escuela')
        ->first();

        DB::table('escuela')->where('instructor_id_instructor', '=', $idinstructor)
        ->delete();

        DB::table('instructor')->where('id_instructor', '=', $idinstructor)
        ->delete();

        return redirect('/instructores');
    }

    public function editar(Request $request){

        $id = $request->input('inputeditarid');
        $rut = $request->input('editarrut');
        $nombres = $request->input('editarnombres');
        $papellido = $request->input('editarpapellido');
        $sapellido = $request->input('editarsapellido');
        $email = $request->input('editaremail');
        $telefono = $request->input('editartelefono');

        DB::table('instructor')
            ->where('id_instructor', $id)
            ->update([
                'rut_instructor' => $rut,
                'nombre_instructor' => $nombres,
                'primer_apellido_instructor' => $papellido,
                'segundo_apellido_instructor' => $sapellido,
                'correo_instructor' => $email,
                'telefono_instructor' => $telefono
            ]);

        return redirect('/instructores');
    }

}
