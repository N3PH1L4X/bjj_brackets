<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class EscuelaController extends Controller
{
    public function index(){

        $escuelas = DB::table('escuela')
        ->join('instructor', 'escuela.instructor_id_instructor', '=', 'instructor.id_instructor')
        ->inRandomOrder()
        ->get();

        $instructores = DB::table('instructor')->get();

        return view('escuela', [
            'escuelas' => $escuelas,
            'instructores' => $instructores
        ]);

    }

    public function add(Request $request){

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imagePath = "storage/img/escudos/sinImagenDefault.jpg";

        if ($request->hasFile('image')) {
            $randomString = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(20/strlen($x)) )),1,20);
            $fileName = $randomString . '.' . $request->image->extension();
            $request->image->storeAs('public/img/escudos/', $fileName);
            $imagePath = 'storage/img/escudos/' . $fileName;
        }

        $nombre_escuela = $request->input('idnombres');
        $id_instructor = $request->input('inputescuelaregistro');

        DB::table('escuela')->insert([
            'nombre_escuela' => $nombre_escuela,
            'instructor_id_instructor' => $id_instructor,
            'escudo_escuela' => $imagePath,
        ]);

        return redirect('/escuelas');
    }



    public function borrar(Request $request){

        $idescuela = $request->id;
        $escuela = DB::table('escuela')->where('id_escuela', '=', $idescuela)->get();
        $pathimagen = $escuela->pluck('escudo_escuela')->first();

        $idborrarescuela = DB::table('escuela')->where('id_escuela', '=', $idescuela)->delete();

        if ($pathimagen !== 'storage/img/escudos/sinImagenDefault.jpg') {
            $archivoborrar = unlink($pathimagen);
        }

        return redirect('/escuelas');
    }

    public function editar(Request $request){

        $id = $request->input('inputeditarid');
        $nombres = $request->input('editarnombres');
        $idescuela = $request->input('inputescuelaeditar'.$id );

        $editarregistro = DB::table('escuela')
            ->where('id_escuela', $id)
            ->update([
                'nombre_escuela' => $nombres,
                'instructor_id_instructor' => $idescuela,
            ]);

        return redirect('/escuelas');
    }

}
