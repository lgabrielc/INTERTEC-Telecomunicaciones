<?php

namespace App\Http\Livewire\Admin\Gpon;

use App\Models\Gpon;
use App\Models\Tarjeta;
use Livewire\Component;

class GponShow extends Component
{
    public $oltid,$tarjetaid,$tarjetaedit, $nombre, $slots;
    public $search, $totalcontar, $totaltarjetas;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';

    public function mount()
    {
        $this->totalcontar = Gpon::count();
        $this->totaltarjetas = Tarjeta::all();
    }
    // public function save()
    // {
    //     $this->validate([
    //         'nombre' => 'required|min:3|max:50',
    //         'slots' => 'required|numeric|min:1|max:15',
    //         'oltid' => 'required',
    //     ]);

    //     $NewTarjeta = Tarjeta::create([
    //         'nombre' => $this->nombre,
    //         'slots' => $this->slots,
    //         'olt_id' => $this->oltid,
    //     ]);
    //     $this->totalcontar = Tarjeta::count();
    //     $this->reset(['nombre', 'slots']);
    //     $this->emit('cerrarModalCrear');
    //     $this->emit('alert', 'La Tarjeta se creo satisfactoriamente');
    // }

    // public function edit(Tarjeta $tarjeta)
    // {
    //     $this->tarjetaedit = $tarjeta;
    //     $this->tarjetaid = $this->tarjetaedit->id;
    //     $this->nombre = $this->tarjetaedit->nombre;
    //     $this->slots = $this->tarjetaedit->slots;
    //     $this->oltid = $this->tarjetaedit->olt->id;
    // }
    // public function update()
    // {
    //     $this->validate([
    //         'nombre' => 'required|min:3|max:50',
    //         'slots' => 'required|numeric|min:1|max:15',
    //         'oltid' => 'required',
    //     ]);

    //     if ($this->tarjetaid) {
    //         $updDataCenter = Tarjeta::find($this->tarjetaid);
    //         $updDataCenter->update([
    //             'nombre' => $this->nombre,
    //             'slots' => $this->slots,
    //             'olt_id' => $this->oltid,
    //         ]);
    //     }
    //     $this->reset(['nombre', 'slots']);
    //     $this->emit('cerrarModalEditar');
    //     $this->emit('alert', 'La Tarjeta se actualizo satisfactoriamente');
    // }
    // public function delete($id)
    // {
    //     Tarjeta::where('id', $id)->delete();
    //     $this->totalcontar = Tarjeta::count();
    // }

    public function render()
    {
        $gpons = Gpon::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('slots', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);
            return view('livewire.admin.gpon.gpon-show', compact('gpons'));
    }
}
