<?php

namespace App\Http\Livewire\Admin\Pago;

use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class PagoShow extends Component
{
    use WithPagination;
    public $sort = 'id';
    public $search, $totalestados, $totalplanes, $totalantenas, $totaldatacenters;
    public $clientesactivos, $clientesvencidos, $clientescortesinejecutar, $clientesejecutados;
    public $direction = 'desc';
    public $cant = '5';
    public $open = false;


    public function mount()
    {
        $this->clientesactivos = Servicio::where('estado_id', "=", '1')->count();
        $this->clientesvencidos = Servicio::where('estado_id', "=", '4')->count();
        $this->clientescortesinejecutar = Servicio::where('estado_id', "=", '5')->count();
        $this->clientesejecutados = Servicio::where('estado_id', "=", '6')->count();
        // $this->totalplanes = Plan::all();
        $this->totalestados = Estado::all();
        // $this->totalantenas = Antena::all();
        // $this->totaldatacenters = DataCenter::where('estado_id', "=", '1')->get();
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
        $clientes = Cliente::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('apellido', 'like', '%' . $this->search . '%')
            ->orwhere('dni', 'like', '%' . $this->search . '%')
            ->orwhere('correo', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.pago.pago-show', compact('clientes'));
    }
}
