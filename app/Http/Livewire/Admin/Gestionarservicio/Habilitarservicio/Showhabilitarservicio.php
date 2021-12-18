<?php

namespace App\Http\Livewire\Admin\Gestionarservicio\Habilitarservicio;

use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Showhabilitarservicio extends Component
{
    public $direction = 'desc', $cant = '5', $search, $sort = 'id';
    public $servicioid, $totalserviciocortejectuado, $totalservicioretirado, $totalservicioretirodeequipos, $opcionquery, $opcionquery2;
    public $opcionvista = 'deshabilitar';
    public function mount()
    {
        $this->totalserviciocortejectuado = Servicio::where('estado_id', '5')->count();
        $this->totalservicioretirado = Servicio::where('estado_id', '7')->count();
        $this->totalservicioretirodeequipos = Servicio::where('estado_id', '6')->count();
    }
    public function changearetirado(Servicio $servicio)
    {
        $servicio->update([
            'estado_id' => '7',
        ]);
        $this->mount();
    }
    public function changeacorteejecutado(Servicio $servicio)
    {
        $servicio->update([
            'estado_id' => '5',
        ]);
        $this->mount();
    }
    public function render()
    {
        if ($this->opcionvista == 'habilitar') {
            //Mostrar retirados
            $this->opcionquery = '7';
            // $this->opcionquery2 = '7';
            $this->reset('opcionquery2');
        } else {
            //Mostrar corte ejecutado, 
            $this->opcionquery = '5';
            //mostrar retiro de equipos
            $this->opcionquery2 = '6';
        }
        $clientes = DB::table('servicios')
            ->join('clientes', 'servicios.cliente_id', '=', 'clientes.id')
            ->join('estados', 'servicios.estado_id', '=', 'estados.id')
            ->select(
                'clientes.nombre as nombre',
                'clientes.apellido as apellido',
                'clientes.dni as dni',
                'servicios.tiposervicio as tiposervicio',
                'servicios.fechavencimiento as fechavencimiento',
                'servicios.fechacorte as fechacorte',
                'servicios.id as id',
                'estados.nombre as estado'
            )
            ->where(function ($q) {
                $q->where('clientes.nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('clientes.apellido', 'like', '%' . $this->search . '%');
            })
            ->where(function ($q) {
                $q->where('servicios.estado_id', '=', $this->opcionquery)
                    ->orWhere('servicios.estado_id', '=', $this->opcionquery2);
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.gestionarservicio.habilitarservicio.showhabilitarservicio', compact('clientes'));
    }
}
