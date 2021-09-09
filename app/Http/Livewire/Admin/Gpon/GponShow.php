<?php

namespace App\Http\Livewire\Admin\Gpon;

use App\Models\Datacenter;
use App\Models\Estado;
use App\Models\Gpon;
use App\Models\Olt;
use App\Models\Tarjeta;
use Livewire\Component;
use Livewire\WithPagination;

class GponShow extends Component
{
    use WithPagination;
    //Para crear nuevo gpon
    public $datacenterid, $datacenterselect, $oltid, $olttarjetarelacionado, $tarjetaid, $tarjetagponrelacionado;
    public $slots, $nombre, $oltnombre, $tarjetaide, $tarjetanombre;
    //Para editar nuevo gpon
    public $datacenteride, $oltide, $gponide, $estado_id, $oltidnuevo, $tarjetaidnuevo;
    public $search, $estados, $totalcontar, $totaldatacenters;
    //Para la  datatable
    public $sort = 'id', $direction = 'desc', $cant = '5';

    public function mount()
    {
        $this->totalcontar = Gpon::count();
        $this->totaldatacenters = Datacenter::where('estado_id', "=", '1')->get();
        $this->totalolts = Olt::where('estado_id', "=", '1')->get();
        $this->estados = Estado::where('nombre', "=", 'Activo')->orwhere('nombre', "=", 'Deshabilitado')->get();
    }
    //Si escogemos o cambiamos un nuevo datacenter
    public function generarolts()
    {
        if (is_numeric($this->datacenteride)) {
            $this->datacenterid = $this->datacenteride;
        }
        if (is_numeric($this->datacenterid)) {
            $this->datacenterselect = Datacenter::find($this->datacenterid);
            $this->reset('tarjetaid', 'oltid', 'olttarjetarelacionado', 'tarjetagponrelacionado', 'oltidnuevo', 'tarjetaidnuevo');
        } else {
            $this->reset('oltid', 'tarjetaid', 'datacenterid', 'olttarjetarelacionado', 'tarjetagponrelacionado');
        }
    }
    //Cada vez que cambiamos uN OLT o escogemos una
    public function olttarjetarelacion()
    {
        if (is_numeric($this->oltidnuevo)) {
            $this->oltid = $this->oltidnuevo;
        }
        if (is_numeric($this->oltid)) {
            $this->olttarjetarelacionado = Olt::find($this->oltid);
            $this->reset('tarjetaid');
        }
    }

    public function tarjetagponrelacion()
    {
        if (is_numeric($this->tarjetaidnuevo)) {
            $this->tarjetaide = $this->tarjetaidnuevo;
            $this->tarjetaid = $this->tarjetaidnuevo;
        }
        if (is_numeric($this->tarjetaid)) {
            $this->tarjetagponrelacionado = Tarjeta::find($this->tarjetaid);
        }
    }
    public function save()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'slots' => 'required|numeric|min:1|max:15',
            'datacenterid' => 'required',
            'oltid' => 'required',
            'tarjetaid' => 'required',
            'estado_id' => 'required',
        ]);

        $NewGpon = Gpon::create([
            'nombre' => $this->nombre,
            'slots' => $this->slots,
            'tarjeta_id' => $this->tarjetaid,
            'estado_id' => $this->estado_id,
        ]);
        $this->totalcontar = Gpon::count();

        $this->resetcampos();
        $this->emit('cerrarModalCrear');
        $this->emit('alert', 'El Gpon se creo satisfactoriamente');
    }
    public function resetcampos()
    {
        $this->reset([
            'nombre', 'slots', 'datacenterid', 'oltid', 'tarjetaid', 'estado_id', 'datacenterselect', 'olttarjetarelacionado', 'tarjetagponrelacionado',
            'datacenteride', 'gponide', 'tarjetaide', 'tarjetaidnuevo', 'tarjetanombre', 'oltide', 'oltidnuevo', 'oltnombre'
        ]);
        $this->estado_id = "1";
    }
    public function cambiarestado($id)
    {
        $actualizarid = Gpon::find($id);
        if ($actualizarid->estado_id == '1') {
            $this->estado_id = '2';
            $actualizarid->update(['estado_id' => $this->estado_id]);
        } else {
            $this->estado_id = '1';
            $actualizarid->update(['estado_id' => $this->estado_id]);
        }
    }
    public function edit(Gpon $gpon)
    {
        $this->resetcampos();
        $this->gponedit     = $gpon;
        $this->datacenteride = $this->gponedit->tarjeta->olt->datacenter->id;
        $this->gponide    = $this->gponedit->id;
        $this->nombre       = $this->gponedit->nombre;
        $this->slots        = $this->gponedit->slots;
        $this->tarjetaide   = $this->gponedit->tarjeta->id;
        $this->tarjetanombre = $this->gponedit->tarjeta->nombre;
        $this->oltide       = $this->gponedit->tarjeta->olt->id;
        $this->oltnombre    = $this->gponedit->tarjeta->olt->nombre;
    }
    public function update()
    {
        if (is_numeric($this->tarjetaidnuevo)) {
            $this->tarjetaide = $this->tarjetaidnuevo;
        }
        $this->validate([
            'nombre' => 'required|min:5|max:10',
            'slots' => 'required|numeric|min:1|max:15',
            'tarjetaide' => 'required|numeric',
        ]);
        if ($this->gponide) {
            $updDataCenter = Gpon::find($this->gponide);
            $updDataCenter->update([
                'nombre' => $this->nombre,
                'slots' => $this->slots,
                'tarjeta_id' => $this->tarjetaide,
            ]);
        }
        $this->reset('search');
        $this->emit('cerrarModalEditar');
        $this->emit('alert', 'El Gpon se actualizo satisfactoriamente');
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
        if (is_numeric($this->oltidnuevo)) {
            $this->olttarjetarelacion();
        }
        $gpons = Gpon::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('slots', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.gpon.gpon-show', compact('gpons'));
    }
}
