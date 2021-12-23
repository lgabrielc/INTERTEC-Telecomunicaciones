<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
        //Antes de usar el patron de diseño Repository, se debe crear una clase que extienda de Eloquent
        // $herramientas = Herramienta::all();
        //Aquí ya estamos usando el patron repository
        $herramientas = $this->herramientaRepository->all();
        // return response()->json($herramientas);
        return view("herramienta.herramientas")->with('herramientas', $herramientas);
    }
    public function show($id)
    {
        //Antes de usar el patron repository
        //$herramienta = Herramienta::find($id);
        //Aquí ya estamos usando el patron repository
        $herramienta = $this->herramientaRepository->get($id);
        return view("herramienta.herramientafind")->with('herramientas',    $herramienta);
    }
    public function create()
    {
        return view("herramienta.herramientacreate")->with('message', '');
    }
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nombre' => 'required|unique:herramientas,nombre',
                'descripcion' => 'required',
                'stock' => 'required',
                'precio' => 'required',
            ]);
            $herramienta = new Herramienta($request->all());
            $this->herramientaRepository->save($herramienta);
            return view("herramienta.herramientacreate")->with('message', 'Herramienta creada satisfactoriamente !!');
        } catch (\Exception $e) {
            return view("herramienta.herramientacreate")->with('message', 'Por favor verifique los campos herramienta');
        }
    }
    public function edit($id)
    {
        $herramienta = $this->herramientaRepository->get($id);
        return view("herramienta.herramientaedit")->with('herramienta', $herramienta);
    }
    public function update(Request $request, $id)
    {
        $herramientaencontrada = $this->herramientaRepository->get($id);
        $herramientaencontrada->fill($request->all());
        $herramientaupdate = $this->herramientaRepository->save($herramientaencontrada);
        $herramientas = $this->herramientaRepository->all();
        return view("herramienta.herramientas")->with('herramientas', $herramientas);
    }
    public function destroy($idherramienta)
    {
        try {
            if ($this->herramientaRepository->get($idherramienta)) {
                $herramientaencontrada = $this->herramientaRepository->get($idherramienta);
                $this->herramientaRepository->delete($herramientaencontrada);
            }
            $herramientas = $this->herramientaRepository->all();
            return view("herramienta.herramientas")->with('herramientas', $herramientas);
        } catch (\Exception $e) {
            $herramientas = $this->herramientaRepository->all();
            return view("herramienta.herramientas")->with('herramientas', $herramientas);
        }
    }
}
