<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Centrodato;
use App\Models\Herramienta;
use App\Repositories\HerramientaRepository;
use Illuminate\Http\Request;

class HerramientaController extends Controller
{
    private $herramientaRepository;

    public function __construct(HerramientaRepository $herramientaRepository)
    {
        $this->herramientaRepository = $herramientaRepository;
    }

    public function index()
    {
        // $herramientas = Herramienta::all();
        $herramientas = Herramienta::all();
        return view("herramientas")->with('herramientas', $herramientas);
    }
    public function show($id)
    {
        $herramienta = Herramienta::find($id);
        return view("herramientafind")->with('herramientas', $herramienta);
    }
    public function store(Request $request)
    {
        Herramienta::create($request->all());
        $herramientas = Herramienta::all();

        return view("herramientacreate")->with('herramientas', $herramientas);
    }
    public function update(Request $request, Herramienta $herramienta)
    {
        $herramienta->update($request->all());
    }
    public function destroy($id)
    {
        $herramienta = Herramienta::find($id);
        $herramienta->delete();
    }
}
