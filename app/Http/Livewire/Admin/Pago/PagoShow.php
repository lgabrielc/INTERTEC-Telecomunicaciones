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
    public $clientesactivos, $clientesvencidos, $clientescortesinejecutar, $clientesejecutados, $idcliente;
    public $fechaproxpago, $fechaproxcorte, $mensualidad, $fechapago, $cliente, $fechainicio, $fechavencimiento, $diasretraso, $diasencorte, $fechacorteejecutado,
        $fechacorte, $monto, $nombre, $diascorteejecutado, $estado, $fechadehoy, $apellido, $men, $clienteid, $periodo, $deuda, $nombrecompleto, $fecha, $user_id, $cliente_id, $servicioid, $servicio;
    public $direction = 'desc', $cant = '5', $open = false, $disable = false, $vermodalpago = false;
    public $proximafechadepago, $proximafechadecorte, $disabled2 = 1;

    public function changedata()
    {
        $this->proximafechadecorte = date("Y-m-d", strtotime($this->proximafechadepago . "+ 3 days"));
        // $this->periodo = $this->fechapago . " al " . $this->proximafechadepago;
        $this->periodo = Carbon::parse($this->fechapago)->format('d-m-Y') . '  al  ' . Carbon::parse($this->proximafechadepago)->format('d-m-Y');

    }
    public function abrirmodalpago(Cliente $cliente)
    {
        $this->client = $cliente;
        $this->nombre = $this->client->nombre;
        $this->apellido = $this->client->apellido;
        $this->nombrecompleto = $this->nombre . " " . $this->apellido;
        $this->idcliente = $this->client->id;
        $this->servicioid = $this->client->servicio->id;
        $this->fechapago = $this->client->servicio->fechavencimiento;
        $this->fechacorte = $this->client->servicio->fechacorte;
        $this->fechacorteejecutado = $this->client->servicio->fechacorteejecutado;
        $this->deuda = number_format($this->client->servicio->deuda, 2);
        $this->estado = $this->client->servicio->estado->nombre;
        $this->mensualidad = number_format($this->client->servicio->plan->precio, 2);
        $this->proximafechadepago = Carbon::now();
        $this->proximafechadepago->addMonth();
        $this->proximafechadepago = date("Y-m-d", strtotime($this->fechapago . "+ 1 month"));
        $this->fechadehoy = date('Y-m-d');
        $pasefecha1 = Carbon::parse($this->fechadehoy);
        $pasefecha2 = Carbon::parse($this->fechapago);
        $pasefecha3 = Carbon::parse($this->fechacorteejecutado);
        //Si ya paso su fecha de pago
        if ($pasefecha1->gt($pasefecha2)) {
            $this->diasretraso = $pasefecha1->diffInDays($pasefecha2);
        } else {
            $this->diasretraso = 0;
        }
        //Si ya paso dias de estar en corte ejecutado
        if ($pasefecha1->gt($pasefecha3)) {
            $this->diascorteejecutado = $pasefecha1->diffInDays($pasefecha3);
            $a = Carbon::createFromFormat('Y-m-d', $this->proximafechadepago);
            $a = $a->addDays($this->diascorteejecutado);
            $this->proximafechadepago = $a->format('Y-m-d');
            $this->diasretraso = $this->diasretraso - $this->diascorteejecutado;
        } else {
            $this->diascorteejecutado = 0;
        }
        $this->monto = number_format($this->mensualidad + $this->deuda, 2);
        $this->proximafechadecorte = date("Y-m-d", strtotime($this->proximafechadepago . "+ 3 days"));
        // $this->periodo = $this->fechapago . " al " . $this->proximafechadepago;
        $this->periodo = Carbon::parse($this->fechapago)->format('d-m-Y') . '  al  ' . Carbon::parse($this->proximafechadepago)->format('d-m-Y');


        $this->vermodalpago = true;
    }
    public function savepago()
    {
        $this->user_id = auth()->user()->personal->id;
        $this->validate([
            'fechadehoy' => 'required|date_format:Y-m-d',
            'monto' => 'required|numeric',
            'periodo' => 'required',
            'idcliente' => 'required|numeric',
            'user_id' => 'required|numeric',
            'proximafechadepago' => 'required|date_format:Y-m-d|after:fechapago',
            'proximafechadecorte' => 'required|date_format:Y-m-d|after:fechapago',
        ]);
        Pago::create([
            'fecha' => $this->fechadehoy,
            'monto' => $this->monto,
            'periodo' => $this->periodo,
            'cliente_id' => $this->idcliente,
            'user_id' => $this->user_id,
        ]);
        $servicioobj = Servicio::find($this->servicioid);
        $servicioobj->update([
            'fechavencimiento' => $this->proximafechadepago,
            'fechacorte' => $this->proximafechadecorte,
            'fechacorteejecutado' => null,
        ]);
        $fechadehoy = date('Y-m-d');
        Servicio::where('fechavencimiento', '>', $fechadehoy)
            ->where('estado_id', '!=', '1')
            ->update(['estado_id' => '1']);
        $this->vermodalpago = false;
        $this->emit('alert', 'El Pago se registro satisfactoriamente');
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
    public function actualizarfechas3($value)
    {
        // $this->fechaproxpago = date("Y-m-d", strtotime($value . "+ 1 month"));
        $this->fechaproxcorte = date("Y-m-d", strtotime($value . "+ 3 days"));
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
        $clientes = Cliente::join("servicios", "servicios.cliente_id", "=", "clientes.id")
            ->select('clientes.*', 'servicios.fechainicio', 'servicios.tiposervicio')
            ->where(function ($q) {
                $q->where('clientes.nombre', 'like', '%' . $this->search . '%')
                    ->orwhere('clientes.apellido', 'like', '%' . $this->search . '%')
                    ->orwhere('clientes.dni', 'like', '%' . $this->search . '%')
                    ->orwhere('servicios.tiposervicio', 'like', '%' . $this->search . '%');
            })
            ->where(function ($q) {
                $q->where('servicios.estado_id', '1')
                    ->orWhere('servicios.estado_id', '3')
                    ->orWhere('servicios.estado_id', '4')
                    ->orWhere('servicios.estado_id', '5')
                    ->orWhere('servicios.estado_id', '6');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.pago.pago-show', compact('clientes'));
    }
}
