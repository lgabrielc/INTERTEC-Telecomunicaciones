<?php

namespace App\Http\Livewire\Admin\Gestionarservicio\Descongelarservicio;

use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Showdescongelarservicio extends Component
{
    public $direction = 'desc', $cant = '5', $search, $sort = 'id', $estado_id, $nombrecompleto, $fechavencimiento, $fechacorte, $mensualidad;
    public $servicioid, $totalserviciocortejectuado, $totalserviciocortesinejecutar, $fechacorteejecutado, $saldoendias, $estado, $fechacongelacion;
    public $vermodaldescongelar = false;

    public function mount()
    {
        $this->totalserviciosactivos = Servicio::where('estado_id', '1')->count();
        $this->totalservicioscongelados = Servicio::where('estado_id', '8')->count();
    }
    public function abrirmodalcongelar(Servicio $servicio)
    {
        $this->vermodalcongelar = true;
        $this->servicioid = $servicio->id;
        $this->nombrecompleto = $servicio->cliente->nombre . " " . $servicio->cliente->apellido;
        $this->fechavencimiento = $servicio->fechavencimiento;
        $this->fechacorte = $servicio->fechacorte;
        $this->estado = $servicio->estado->nombre;
        $this->mensualidad = $servicio->plan->precio;
        $this->saldoendias = Carbon::now()->diffInDays($servicio->fechavencimiento);
        $this->fechacongelacion = Carbon::now()->format('Y-m-d');
    }
    public function congelarservicio()
    {
        Servicio::find($this->servicioid)->update([
            'estado_id' => '8',
            'fechacongelado' => $this->fechacongelacion,
        ]);
        $this->vermodalcongelar = false;
        $this->mount();
        $this->emit('alert', 'El Servicio se congelo satisfactoriamente');
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
            ->join('pagos', 'pagos.cliente_id', '=', 'clientes.id')
            ->select(
                'clientes.nombre as nombre',
                'clientes.apellido as apellido',
                'servicios.tiposervicio as tiposervicio',
                'servicios.fechavencimiento as fechavencimiento',
                'servicios.fechacorte as fechacorte',
                'servicios.id as id',
                'estados.nombre as estado'
            )
            ->where('servicios.estado_id', '8')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('pagos')
                    ->whereColumn('pagos.cliente_id', 'clientes.id');
            })
            ->where(function ($query) {
                $query->where('clientes.nombre', 'like', '%' . $this->search . '%')
                    ->orwhere('clientes.apellido', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.gestionarservicio.descongelarservicio.showdescongelarservicio', compact('clientes'));
    }
}
