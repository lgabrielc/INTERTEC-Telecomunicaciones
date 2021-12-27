<?php

namespace App\Http\Livewire\Admin\Gestionarservicio\Regresaracorte;

use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Showregresaracorte extends Component
{
    public $direction = 'desc', $cant = '5', $search, $sort = 'id', $estado_id;
    public $servicioid, $totalserviciocortejectuado, $totalserviciocortesinejecutar, $fechacorteejecutado;

    public function mount()
    {
        $this->totalserviciocortejectuado = Servicio::where('estado_id', '5')->count();
        $this->totalserviciocortesinejecutar = Servicio::where('estado_id', '4')->count();
    }
    public function regresaracortesinejecutar(Servicio $servicio)
    {
        $servicio->update([
            'fechacorteejecutado' => null,
            'estado_id' => '4',
        ]);
        $this->mount();
    }
    public function order($sort)
    {
        if ($sort == $this->sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
        }
    }
    public function render()
    {
        $clientes = DB::table('clientes')
            ->join('servicios', 'servicios.cliente_id', '=', 'clientes.id')
            ->join('estados', 'estados.id', '=', 'servicios.estado_id')
            ->select(
                'clientes.nombre as nombre',
                'clientes.apellido as apellido',
                'servicios.tiposervicio as tiposervicio',
                'servicios.fechavencimiento as fechavencimiento',
                'servicios.fechacorte as fechacorte',
                'servicios.id as id',
                'estados.nombre as estado'
            )
            ->where('servicios.estado_id', '=', '5')
            ->where(function ($query) {
                $query->where('clientes.nombre', 'like', '%' . $this->search . '%')
                    ->orwhere('clientes.apellido', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.gestionarservicio.regresaracorte.showregresaracorte', compact('clientes'));
    }
}
