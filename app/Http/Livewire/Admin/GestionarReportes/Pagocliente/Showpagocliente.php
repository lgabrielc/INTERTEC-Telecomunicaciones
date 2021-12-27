<?php

namespace App\Http\Livewire\Admin\GestionarReportes\Pagocliente;

use App\Models\Pago;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Showpagocliente extends Component
{
    use WithPagination;

    public $sort = 'id', $search, $direction = 'desc', $cant = '5';
    public $searchdate, $searchdate2, $pagoshoy, $ingresoshoy;

    public function mount()
    {
        $this->pagoshoy = Pago::whereDate('fecha', Carbon::today())->count();
        $this->ingresoshoy = Pago::whereDate('fecha', Carbon::today())->sum('monto');
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
        $pagocliente = Pago::join('clientes', 'clientes.id', '=', 'pagos.cliente_id')
            ->join('users', 'users.id', 'pagos.user_id')
            ->select(
                'pagos.id as id',
                'pagos.fecha as fechapagada',
                'clientes.nombre as nombre',
                'clientes.apellido as apellido',
                'clientes.dni as dni',
                'pagos.periodo as periodo',
                'pagos.monto as monto',
                'users.name as personal',
            )
            //SOLO TEXT
            ->where(function ($query) {
                $query->where('clientes.nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('clientes.apellido', 'like', '%' . $this->search . '%')
                    ->orWhere('clientes.dni', 'like', '%' . $this->search . '%')
                    ->orWhere('pagos.periodo', 'like', '%' . $this->search . '%')
                    ->orWhere('pagos.monto', 'like', '%' . $this->search . '%')
                    ->orWhere('users.name', 'like', '%' . $this->search . '%');
            })
            //SOLO DATE
            ->where(function ($query) {
                if ($this->searchdate) {
                    $query->whereBetween('pagos.fecha', [$this->searchdate, $this->searchdate2])
                        ->orWhereDate('pagos.fecha', $this->searchdate);
                }
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        $totalitems = $pagocliente->count();
        return view('livewire.admin.gestionar-reportes.pagocliente.showpagocliente')->with('clientes', $pagocliente)->with('totalitems', $totalitems);
    }
}
