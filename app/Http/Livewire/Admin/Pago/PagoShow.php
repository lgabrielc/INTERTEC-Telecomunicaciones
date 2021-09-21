<?php

namespace App\Http\Livewire\Admin\Pago;

use App\Models\Cliente;
use App\Models\Datacenter;
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
    public $cliente, $fechainicio, $fechavencimiento, $fechacorte, $monto, $nombre, $apellido;
    public $direction = 'desc';
    public $cant = '5';
    public $open = false;
    public $disable=false;

    public function doubleClick()
    {
        $this->disable = 'false';
    }
    public function actualizarfechas($value)
    {
        // $this->fechainicio = date('Y-m-d');
        $this->fechavencimiento = date("Y-m-d", strtotime($value . "+ 1 month"));
        $this->fechacorte = date("Y-m-d", strtotime($this->fechavencimiento . "+ 3 days"));
    }
    public function actualizarfechas2($value)
    {
        $this->fechacorte = date("Y-m-d", strtotime($value . "+ 3 days"));
    }
    public function registrarprimerpago(Servicio $servicio)
    {
        $this->reset('fechainicio', 'fechavencimiento', 'fechacorte');
        $this->fechainicio = date('Y-m-d');
        $this->fechavencimiento = date("Y-m-d", strtotime($this->fechainicio . "+ 1 month"));
        $this->fechacorte = date("Y-m-d", strtotime($this->fechavencimiento . "+ 3 days"));
        $this->servicio = $servicio;
        $this->nombre = $this->servicio->cliente->nombre;
        $this->apellido = $this->servicio->cliente->apellido;
        $this->monto = $this->servicio->plan->precio;
    }
    public function registrarpago(Cliente $cliente)
    {
    }
    public function mount()
    {
        $this->clientesactivos = Servicio::where('estado_id', "=", '1')->count();
        $this->clientesvencidos = Servicio::where('estado_id', "=", '4')->count();
        $this->clientescortesinejecutar = Servicio::where('estado_id', "=", '5')->count();
        $this->clientesejecutados = Servicio::where('estado_id', "=", '6')->count();
        // $this->totalplanes = Plan::all();
        $this->totalestados = Estado::all();
        // $this->totalantenas = Antena::all();
        $this->totaldatacenters = Datacenter::where('estado_id', "=", '1')->get();
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
        $clientes = Cliente::join("servicios", "servicios.cliente_id", "=", "clientes.id")->select("clientes.nombre", "servicios.tiposervicio", "servicios.id", "clientes.apellido", "clientes.dni")->paginate($this->cant);
        // $clientes = Servicio::where('nombre', 'like', '%' . $this->search . '%')
        //     ->orwhere('apellido', 'like', '%' . $this->search . '%')
        //     ->orwhere('dni', 'like', '%' . $this->search . '%')
        //     ->orwhere('correo', 'like', '%' . $this->search . '%')
        //     ->orderBy($this->sort, $this->direction)
        //     ->paginate($this->cant);
        return view('livewire.admin.pago.pago-show', compact('clientes'));
    }
}
