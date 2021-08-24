<?php

namespace App\Http\Livewire\Admin\Tarjeta;

use App\Models\Olt;
use App\Models\Tarjeta;
use Livewire\Component;

class TarjetaShow extends Component
{
    public $oltid,$tarjetaid,$tarjetaedit, $nombre, $slots;
    public $search, $totalcontar, $totalolts;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';

    public function mount()
    {
        $this->totalcontar = Tarjeta::count();
        $this->totalolts = Olt::all();
    }
    public function save()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'slots' => 'required|numeric|min:1|max:15',
            'oltid' => 'required',
        ]);

        $NewTarjeta = Tarjeta::create([
            'nombre' => $this->nombre,
            'slots' => $this->slots,
            'olt_id' => $this->oltid,
        ]);
        $this->totalcontar = Tarjeta::count();
        $this->reset(['nombre', 'slots']);
        $this->emit('cerrarModalCrear');
        $this->emit('alert', 'La Tarjeta se creo satisfactoriamente');
    }

    public function edit(Tarjeta $tarjeta)
    {
        $this->tarjetaedit = $tarjeta;
        $this->tarjetaid = $this->tarjetaedit->id;
        $this->nombre = $this->tarjetaedit->nombre;
        $this->slots = $this->tarjetaedit->slots;
        $this->oltid = $this->tarjetaedit->olt->id;
    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'slots' => 'required|numeric|min:1|max:15',
            'oltid' => 'required',
        ]);

        if ($this->tarjetaid) {
            $updDataCenter = Tarjeta::find($this->tarjetaid);
            $updDataCenter->update([
                'nombre' => $this->nombre,
                'slots' => $this->slots,
                'olt_id' => $this->oltid,
            ]);
        }
        $this->reset(['nombre', 'slots']);
        $this->emit('cerrarModalEditar');
        $this->emit('alert', 'La Tarjeta se actualizo satisfactoriamente');
    }
    public function delete($id)
    {
        Tarjeta::where('id', $id)->delete();
        $this->totalcontar = Tarjeta::count();
    }
    public function resetcampos()
    {
        $this->reset(['nombre', 'slots','oltid']);
    }
    public function render()
    {
        $tarjetas = Tarjeta::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('slots', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
        return view('livewire.admin.tarjeta.tarjeta-show', compact('tarjetas'));
    }
}
