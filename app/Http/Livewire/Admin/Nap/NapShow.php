<?php

namespace App\Http\Livewire\Admin\Nap;

use App\Models\Datacenter;
use App\Models\Estado;
use App\Models\Gpon;
use App\Models\Nap;
use App\Models\Olt;
use App\Models\Tarjeta;
use Livewire\Component;
use Livewire\WithPagination;


class NapShow extends Component
{
    use WithPagination;
    //Propiedades para crear nuevo Nap
    public $datacenterid, $oltid, $tarjetaid, $nombre, $slots, $estado_id, $gponid;
    //Extraer relaciones entre modelos
    public $datacenterselect, $olttarjetarelacionado, $tarjetagponrelacionado, $gponnaprelacionado;
    //Propiedades para editar una Nap
    public $napid, $napedit, $datacenteride, $oltide, $oltnombre, $gponide, $gponnombre, $oltidnuevo, $tarjetaide, $tarjetanombre, $tarjetaidnuevo, $gponidnuevo;
    //Método mount
    public $totalcontar, $totaldatacenters, $estados;
    public $sort = 'id', $direction = 'desc', $cant = '5', $search = '';
    public $objprueba;
    public function mount()
    {
        $this->totalcontar = Nap::count();
        $this->totaldatacenters = Datacenter::where('estado_id', "=", '1')->get();
        $this->estados = Estado::where('nombre', "=", 'Activo')->orwhere('nombre', "=", 'Deshabilitado')->get();
    }
    public function save()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'slots' => 'required|numeric|min:1|max:15',
            'datacenterid' => 'required',
            'oltid' => 'required',
            'tarjetaid' => 'required',
            'gponid' => 'required',
        ]);

        $NewNap = Nap::create([
            'nombre' => $this->nombre,
            'slots' => $this->slots,
            'gpon_id' => $this->gponid,
            'estado_id' => $this->estado_id,
        ]);
        $this->totalcontar = Nap::count();

        $this->resetcampos();
        $this->emit('cerrarModalCrear');
        $this->emit('alert', 'La Caja Nap se creo satisfactoriamente');
    }
    public function edit(Nap $nap)
    {
        $this->resetcampos();
        $this->objprueba = Nap::find($nap->id);
        $this->napedit     = $nap;
        $this->napid     = $this->napedit->id;
        $this->datacenteride = $this->napedit->gpon->tarjeta->olt->datacenter->id;
        $this->oltide       = $this->napedit->gpon->tarjeta->olt->id;
        $this->oltnombre    = $this->napedit->gpon->tarjeta->olt->nombre;
        $this->tarjetaide   = $this->napedit->gpon->tarjeta->id;
        $this->tarjetanombre = $this->napedit->gpon->tarjeta->nombre;
        $this->gponide    = $this->napedit->gpon->id;
        $this->gponnombre    = $this->napedit->gpon->nombre;
        $this->nombre       = $this->napedit->nombre;
        $this->slots        = $this->napedit->slots;
    }
    public function update()
    {
        if (is_numeric($this->gponidnuevo)) {
            $this->gponide = $this->gponidnuevo;
        }
        $this->validate([
            'nombre' => 'required|min:5|max:10',
            'slots' => 'required|numeric|min:1|max:15',
            'gponide' => 'required|numeric',
        ]);
        if ($this->gponide) {
            $updNap = Nap::find($this->napid);
            $updNap->update([
                'nombre' => $this->nombre,
                'slots' => $this->slots,
                'gpon_id' => $this->gponide,
            ]);
        }
        $this->reset('search');
        $this->emit('cerrarModalEditar');
        $this->emit('alert', 'La Caja Nap se actualizo satisfactoriamente');
    }
    public function generarolts()
    {
        if (is_numeric($this->datacenteride)) {
            $this->datacenterid = $this->datacenteride;
        }
        if (is_numeric($this->datacenterid)) {
            $this->datacenterselect = Datacenter::find($this->datacenterid);
            $this->reset('tarjetaid', 'oltid', 'olttarjetarelacionado', 'tarjetagponrelacionado', 'oltidnuevo', 'tarjetaidnuevo');
        } else {
            // $this->reset('oltid', 'tarjetaid', 'datacenterid', 'olttarjetarelacionado', 'tarjetagponrelacionado');
        }
    }
    //Cada vez que cambiamos uN OLT o escogemos una nueva
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
            $this->reset('gponidnuevo', 'gponid');
        }
        if (is_numeric($this->tarjetaid)) {
            $this->tarjetagponrelacionado = Tarjeta::find($this->tarjetaid);
            $this->reset('gponidnuevo', 'gponid');
        }
    }
    public function gponnaprelacion()
    {
        if (is_numeric($this->gponidnuevo)) {
            $this->gponid = $this->gponidnuevo;
        }
        if (is_numeric($this->gponid)) {
            $this->gponnaprelacionado = Gpon::find($this->gponid);
        }
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
    public function resetcampos()
    {
        $this->reset(['nombre', 'slots', 'datacenterid', 'oltid', 'tarjetaid', 'gponid']);
        $this->reset(['gponidnuevo', 'datacenterselect', 'napedit', 'datacenteride', 'oltide', 'oltnombre', 'gponide', 'gponnombre', 'oltidnuevo', 'tarjetaide', 'tarjetanombre', 'tarjetaidnuevo', 'gponidnuevo']);
        $this->estado_id = "1";
    }
    public function cambiarestado($id)
    {
        $actualizarid = Nap::find($id);
        if ($actualizarid->estado_id == '1') {
            $this->estado_id = '2';
            $actualizarid->update(['estado_id' => $this->estado_id]);
        } else {
            $this->estado_id = '1';
            $actualizarid->update(['estado_id' => $this->estado_id]);
        }
    }
    public function render()
    {
        if (is_numeric($this->oltidnuevo)) {
            $this->olttarjetarelacion();
        }
        $naps = Nap::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('slots', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.nap.nap-show', compact('naps'));
    }
}
