<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class CompetidorController extends Controller
{
    public function index(){

        $competidores = DB::table('competidor')->get();

        return view('competidor', ['competidores' => $competidores]);

    }

    public function add(Request $request){

        $rut = $request->input('idrut');
        $nombres = $request->input('idnombres');
        $papellido = $request->input('idprimerap');
        $sapellido = $request->input('idsegundoap');
        $idcargo = $request->input('inputcargoregistro');
        $idturno = $request->input('inputturnoregistro');
        $email = $request->input('idcorreo');
        $telefono = $request->input('idtelefono');

        $respuestasolicitudes = Http::withHeaders(['Authorization' => 'cef0be1f-60d6-414e-a024-487fe6fff007'])->post('https://api.republicadebrasil.cl/api.php?numconsulta=205', [
            'rutfuncionario' => $rut,
            'nombrefuncionario' => $nombres,
            'papellidofuncionario' => $papellido,
            'sapellidofuncionario' => $sapellido,
            'idcargo' => $idcargo,
            'idturno' => $idturno,
            'emailfuncionario' => $email,
            'telefonofuncionario' => $telefono
        ]);

        DB::table('users')->insert([
            'email' => 'kayla@example.com',
            'votes' => 0
        ]);

        return redirect('/competidores');
    }

    public function borrar(Request $request){

        $idfuncionario = $request->id;

        $respuestasolicitudes = Http::withHeaders(['Authorization' => 'cef0be1f-60d6-414e-a024-487fe6fff007'])->post('https://api.republicadebrasil.cl/api.php?numconsulta=401', [
            'idfuncionario' => $idfuncionario,
        ]);

        return redirect('/funcionarios');
    }

    public function editar(Request $request){

        $id = $request->input('inputeditarid');
        $rut = $request->input('editarrut');
        $nombres = $request->input('editarnombres');
        $papellido = $request->input('editarpapellido');
        $sapellido = $request->input('editarsapellido');
        $idcargo = $request->input('inputcargoeditar'.$id );
        $idturno = $request->input('inputturnoeditar'.$id );
        $email = $request->input('editaremail');
        $telefono = $request->input('editartelefono');

        $respuestasolicitudes = Http::withHeaders(['Authorization' => 'cef0be1f-60d6-414e-a024-487fe6fff007'])->post('https://api.republicadebrasil.cl/api.php?numconsulta=305', [
            'idfuncionario' => $id,
            'rutfuncionario' => $rut,
            'nombrefuncionario' => $nombres,
            'papellidofuncionario' => $papellido,
            'sapellidofuncionario' => $sapellido,
            'idcargo' => $idcargo,
            'idturno' => $idturno,
            'emailfuncionario' => $email,
            'telefonofuncionario' => $telefono
        ]);

        return redirect('/funcionarios');
    }

}
