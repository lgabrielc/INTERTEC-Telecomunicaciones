<?php

namespace App\Http\Controllers\Admin;
use App\Models\Servidor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $users = DB::table('users')->get();
        $servidores= DB::table('servidor')->get();
      //  $servidoresORD=$servidores->sortKeysDesc();
        //$servidores= Servidor::all()->orderBy('id','DESC');
        return view('admin.servidor.index')->with('servidores',$servidores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'ipEntrada'=> 'required',
            'ipSalida' => 'required'

        ]); 

        $Servidor= new Servidor();
        $Servidor->nombre = $request->nombre;
        $Servidor->ipEntrada = $request->ipEntrada;
        $Servidor->ipSalida = $request->ipSalida;
        $Servidor->save();
        return redirect()->route('servidor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servidor $servidor)
    {
        $request->validate([
            'nombre'=>'required',
            'ipEntrada'=> 'required',
            'ipSalida' => 'required'
        ]);
        $servidor->update($request->all());
        return redirect()->route('servidor.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servidor $servidor)
    {
        $servidor->delete();
        return redirect()->route('servidor.index');
    }

    public function actualizar(Request $request)
    {
        //
    }
}
