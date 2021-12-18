<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fechadehoy = date('Y-m-d');
        Servicio::where('fechavencimiento', '<', $fechadehoy)
            ->where('estado_id', '1')
            ->update(['estado_id' => '4']);
        $fechaparacorteejecutado = Carbon::now();
        $fechaparacorteejecutado->subDays(15);
        $fechaparacorteejecutado = $fechaparacorteejecutado->format('Y-m-d');
        Servicio::where('fechacorteejecutado', '<=', $fechaparacorteejecutado)
            ->where('estado_id', '=', '5')
            ->update(['estado_id' => '6']);
        return view('livewire.admin.cliente.index');
    }
}
