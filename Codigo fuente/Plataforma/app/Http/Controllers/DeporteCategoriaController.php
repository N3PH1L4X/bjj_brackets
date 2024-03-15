<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class DeporteCategoriaController extends Controller
{
    public function index(){

        $deportesycategorias = DB::table('categoria')
        ->join('deporte', 'deporte.id_deporte', '=', 'categoria.deporte_id_deporte')
        ->get();

        $deportes = DB::table('deporte')->get();

        $categorias = DB::table('categoria')->get();

        return view('deportecategoria', [
            'deportesycategorias' => $deportesycategorias,
            'deportes' => $deportes,
            'categorias' => $categorias
        ]);

    }

    public function deporteadd(Request $request){

        $nombre_deporte = $request->input('nombrenuevodeporte');

        DB::table('deporte')->insert([
            'nombre_deporte' => $nombre_deporte
        ]);

        return redirect('/deportesycategorias');
    }

    public function categoriaadd(Request $request){

        $nombre_categoria = $request->input('nombrenuevacategoria');
        $deporte_id_deporte = $request->input('inputcategoriaregistro');

        DB::table('categoria')->insert([
            'nombre_categoria' => $nombre_categoria,
            'deporte_id_deporte' => $deporte_id_deporte
        ]);

        return redirect('/deportesycategorias');
    }

}
