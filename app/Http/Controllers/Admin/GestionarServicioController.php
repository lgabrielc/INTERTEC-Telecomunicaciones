<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GestionarServicioController extends Controller
{
    static public function actualizarestados()
    {
        $fechadehoy = date('Y-m-d');
        Servicio::where('fechavencimiento', '<', $fechadehoy)
            ->where('estado_id', '1')
            ->update(['estado_id' => '4']);
        $fechaparacorteejecutado= Carbon::now();
        $fechaparacorteejecutado->subDays(15);
        $fechaparacorteejecutado =$fechaparacorteejecutado->format('Y-m-d');
        Servicio::where('fechacorteejecutado', '<=', $fechaparacorteejecutado)
            ->where('estado_id', '=', '5')
            ->update(['estado_id' => '6']);
    }
    public function cortarservicio()
    {
        GestionarServicioController::actualizarestados();
        return view('livewire.admin.gestionarservicio.cortarservicio.index');
    }
    public function activarcliente()
    {
        GestionarServicioController::actualizarestados();
        return view('livewire.admin.gestionarservicio.activarcliente.index');
    }
    public function habilitarservicio()
    {
        GestionarServicioController::actualizarestados();
        return view('livewire.admin.gestionarservicio.habilitarservicio.index');
    }
    public function congelarservicio()
    {
        GestionarServicioController::actualizarestados();
        return view('livewire.admin.gestionarservicio.congelarservicio.index');
    }
    public function descongelarservicio()
    {
        GestionarServicioController::actualizarestados();
        return view('livewire.admin.gestionarservicio.descongelarservicio.index');
    }
    public function regresaracorte()
    {
        GestionarServicioController::actualizarestados();
        return view('livewire.admin.gestionarservicio.regresaracorte.index');
    }
}
