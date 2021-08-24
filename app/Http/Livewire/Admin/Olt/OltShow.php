<?php

namespace App\Http\Livewire\Admin\Olt;

use App\Models\DataCenter;
use App\Models\Olt;
use Livewire\Component;

class OltShow extends Component
{
    public $datacenterid, $OltEdit, $oltid, $nombre, $slots, $marca, $modelo;
    public $search, $totalcontar, $totaldatacenters;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';

    public function mount()
    {
        $this->totalcontar = Olt::count();
        $this->totaldatacenters = DataCenter::all();
    }
    public function save()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'slots' => 'required|numeric|min:1|max:7',
            'marca' => 'required|min:3|max:50',
            'modelo' => 'required|min:3|max:50',
            'datacenterid' => 'required',
        ]);

        $NewOlt = Olt::create([
            'nombre' => $this->nombre,
            'slots' => $this->slots,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'datacenter_id' => $this->datacenterid,
        ]);
        $this->totalcontar = Olt::count();
        $this->reset(['nombre', 'slots', 'marca', 'modelo']);
        $this->emit('cerrarModalCrear');
        $this->emit('alert', 'El Olt se creo satisfactoriamente');
    }

    public function edit(Olt $olt)
    {
        $this->OltEdit = $olt;
        $this->oltid = $this->OltEdit->id;
        $this->nombre = $this->OltEdit->nombre;
        $this->slots = $this->OltEdit->slots;
        $this->marca = $this->OltEdit->marca;
        $this->modelo = $this->OltEdit->modelo;
        $this->datacenterid = $this->OltEdit->datacenter->id;
    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'slots' => 'required|numeric|min:1|max:7',
            'marca' => 'required|min:3|max:50',
            'modelo' => 'required|min:3|max:50',
            'datacenterid' => 'required',
        ]);

        if ($this->oltid) {
            $updDataCenter = Olt::find($this->oltid);
            $updDataCenter->update([
                'nombre' => $this->nombre,
                'slots' => $this->slots,
                'marca' => $this->marca,
                'modelo' => $this->modelo,
                'datacenter_id' => $this->datacenterid,
            ]);
        }
        $this->reset(['nombre', 'slots', 'marca', 'modelo']);
        $this->emit('cerrarModalEditar');
        $this->emit('alert', 'El Olt se actualizo satisfactoriamente');
    }
    public function delete($id)
    {
        Olt::where('id', $id)->delete();
        $this->totalcontar = Olt::count();
    }
    public function resetcampos()
    {
        $this->reset(['nombre', 'slots', 'marca', 'modelo','datacenterid']);
    }
    public function render()
    {
        $olts = Olt::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('slots', 'like', '%' . $this->search . '%')
            ->orwhere('modelo', 'like', '%' . $this->search . '%')
            ->orwhere('marca', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.olt.olt-show', compact('olts'));
    }
}
