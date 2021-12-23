<?php

namespace App\Http\Livewire\Admin\Gestionarservicio\Descongelarservicio;

use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Showdescongelarservicio extends Component
{
    use WithPagination;

    public $direction = 'desc', $cant = '5', $search, $sort = 'id', $estado_id,
        $nombrecompleto, $fechavencimiento, $fechacorte, $mensualidad, $periododesaldo;
    public $servicioid, $totalserviciocortejectuado, $totalserviciocortesinejecutar,
        $fechacorteejecutado, $saldoendias, $estado, $fechacongelado, $proximopago, $proximocorte;
    public $vermodaldescongelar = false;

    public function mount()
    {
        $this->totalserviciosactivos = Servicio::where('estado_id', '1')->count();
        $this->totalservicioscongelados = Servicio::where('estado_id', '8')->count();
    }
    public function changefechainicio()
    {
        $this->proximopago = Carbon::parse($this->fechadeinicio)->addDays($this->saldoendias);
        $this->proximopago = Carbon::parse($this->proximopago)->format('Y-m-d');
        $this->proximocorte = date("Y-m-d", strtotime($this->proximopago . "+ 3 days"));
    }
    public function changeproximopago()
    {
        $this->proximocorte = date("Y-m-d", strtotime($this->proximopago . "+ 3 days"));
    }
    public function abrirmodaldescongelar(Servicio $servicio)
    {
        $this->servicioid = $servicio->id;
        $this->nombrecompleto = $servicio->cliente->nombre . " " . $servicio->cliente->apellido;
        $this->fechavencimiento = $servicio->fechavencimiento;
        $this->fechacorte = $servicio->fechacorte;
        $this->fechacongelado = $servicio->fechacongelado;
        $this->estado = $servicio->estado->nombre;
        $this->mensualidad = $servicio->plan->precio;
        $this->saldoendias = Carbon::parse($this->fechavencimiento)->diffInDays($servicio->fechacongelado);
        $this->fechadeinicio = Carbon::now()->format('Y-m-d');
        $this->proximopago = Carbon::parse($this->fechadeinicio)->addDays($this->saldoendias);
        $this->proximopago = Carbon::parse($this->proximopago)->format('Y-m-d');
        $this->proximocorte = date("Y-m-d", strtotime($this->proximopago . "+ 3 days"));
        $this->periododesaldo = Carbon::parse($this->fechadeinicio)->format('d-m-Y') . '  al  ' . Carbon::parse($this->proximopago)->format('d-m-Y');
        $this->vermodaldescongelar = true;
    }
    public function descongelarserviciosave()
    {
        $this->validate([
            'fechadeinicio' => 'required|date',
            'proximopago' => 'required|date_format:Y-m-d|after:fechadeinicio',
            'proximocorte' => 'required|date_format:Y-m-d|after:proximopago',
        ]);
        Servicio::find($this->servicioid)->update([
            'estado_id' => '1',
            'fechacongelado' => null,
            'fechacorte' => $this->proximocorte,
            'fechavencimiento' => $this->proximopago,
        ]);
        $this->vermodaldescongelar = false;

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
