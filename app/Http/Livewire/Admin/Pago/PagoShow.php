<?php

namespace App\Http\Livewire\Admin\Pago;

use Carbon\Carbon;
use App\Models\Centrodato;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Pago;
use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class PagoShow extends Component
{
    use WithPagination;
    public $sort = 'id';
    public $search, $totalestados, $totalplanes, $totalantenas, $totaldatacenters;
    public $clientesactivos, $clientesvencidos, $clientescortesinejecutar, $clientesejecutados;
    public $fechapago, $cliente, $fechainicio, $fechavencimiento, $diasretraso, $diasencorte, $fechacorteejecutado,
        $fechacorte, $monto, $nombre, $apellido, $clienteid, $periodo, $fecha, $user_id, $cliente_id, $servicioid, $servicio;
    public $direction = 'desc';
    public $cant = '5';
    public $open = false;
    public $disable = false;
    // Commit
    public function savepago()
    {
        $this->user_id = '1';
        $this->validate([
            'fecha' => 'required|date_format:Y-m-d',
            'monto' => 'required|numeric',
            'periodo' => 'required',
            'cliente_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'fechainicio' => 'required|date_format:Y-m-d',
            'fechavencimiento' => 'required|date_format:Y-m-d|after:fechainicio',
            'fechacorte' => 'required|date_format:Y-m-d|after:fechavencimiento',
        ]);
        Pago::create([
            'fecha' => $this->fecha,
            'monto' => $this->monto,
            'periodo' => $this->periodo,
            'cliente_id' => $this->cliente_id,
            'user_id' => $this->user_id,
        ]);
        $servicioobj = Servicio::find($this->servicioid);
        $servicioobj->update([
            'fechainicio' => $this->fechainicio,
            'fechavencimiento' => $this->fechavencimiento,
            'fechacorte' => $this->fechacorte,
        ]);
        $this->emit('cerrarModalNuevoPago');
        $this->emit('alert', 'El servidor se actualizo satisfactoriamente');
    }
    // no sirve
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
        $this->fecha = date('Y-m-d');
        $this->periodo = $this->fechainicio . ' al ' . $this->fechacorte;
        $this->servicio = $servicio;
        $this->servicioid = $servicio->id;
        $this->cliente_id = $this->servicio->cliente->id;
        $this->nombre = $this->servicio->cliente->nombre;
        $this->apellido = $this->servicio->cliente->apellido;
        $this->monto = $this->servicio->plan->precio;
    }
    public function registrarpago(Servicio $servicio)
    {
        $this->servicio = $servicio;
        $this->cliente_id = $this->servicio->cliente->id;
        $this->nombre = $this->servicio->cliente->nombre;
        $this->apellido = $this->servicio->cliente->apellido;
        $this->fechapago = $this->servicio->fechavencimiento;
        $this->fechacorte = $this->servicio->fechacorte;
        $this->fechacorteejecutado = $this->servicio->fechacorteejecutado;
        $fechaactual = date('Y-m-d');
        $finicio = Carbon::createFromFormat('Y-m-d', $fechaactual);
        $ffinal = Carbon::createFromFormat('Y-m-d', $this->fechapago);
        if ($this->fechacorteejecutado != null) {
            $ffinal2 = Carbon::createFromFormat('Y-m-d', $this->fechacorteejecutado);
            if ($finicio->gt($ffinal2)) {
                $this->diasencorte = $ffinal2->diffInDays($finicio);
            } else {
                $this->diasencorte = '0';
            }
        } else {
            $this->diasencorte = '0';
        }
        if ($finicio->gt($ffinal)) {
            $this->diasretraso = $ffinal->diffInDays($finicio);
        } else {
            $this->diasretraso = '0';
        }
    }
    public function mount()
    {
        $this->clientesactivos = Servicio::where('estado_id', "=", '1')->count();
        $this->clientesvencidos = Servicio::where('estado_id', "=", '4')->count();
        $this->clientescortesinejecutar = Servicio::where('estado_id', "=", '5')->count();
        $this->clientesejecutados = Servicio::where('estado_id', "=", '6')->count();
        $this->totalestados = Estado::all();
        $this->totaldatacenters = Centrodato::where('estado_id', "=", '1')->get();
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
        // $clientes = Cliente::join("servicios", "servicios.cliente_id", "=", "clientes.id")
        //     ->select("clientes.nombre","clientes.apellido","servicios.tiposervicio", "servicios.id", "clientes.apellido", "clientes.dni")
        //     ->paginate($this->cant);
        // $clientes = Cliente::where('nombre', 'like', '%' . $this->search . '%')
        //     ->orwhere('apellido', 'like', '%' . $this->search . '%')
        //     ->orwhere('dni', 'like', '%' . $this->search . '%')
        //     ->orwhere('correo', 'like', '%' . $this->search . '%')
        //     ->orderBy($this->sort, $this->direction)
        //     ->paginate($this->cant);
        $clientes = Cliente::join("servicios", "servicios.cliente_id", "=", "clientes.id")
            ->where('clientes.nombre', 'like', '%' . $this->search . '%')
            ->paginate($this->cant);
        return view('livewire.admin.pago.pago-show', compact('clientes'));
    }
}
