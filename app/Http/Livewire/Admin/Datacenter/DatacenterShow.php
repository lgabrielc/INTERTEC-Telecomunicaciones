<?php

namespace App\Http\Livewire\Admin\Datacenter;

use App\Models\DataCenter;
use Livewire\Component;

class DatacenterShow extends Component
{
    public $datacenterid, $nombre, $ubicacion, $direccion, $encargado, $DataCenterEdit;
    public $search, $totaldatacenters;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';

    public function mount()
    {
        $this->totaldatacenters = DataCenter::count();
    }
    public function save()
    {

        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'ubicacion' => 'required|min:3|max:100',
            'direccion' => 'required|min:3|max:100',
            'encargado' => 'nullable',
        ]);

        $NewDatacenter = DataCenter::create([
            'nombre' => $this->nombre,
            'ubicacion' => $this->ubicacion,
            'direccion' => $this->direccion,
            'encargado' => $this->encargado,
        ]);
        $this->totaldatacenters = DataCenter::count();
        $this->reset(['nombre', 'ubicacion', 'direccion', 'encargado']);
        $this->emit('cerrarModalCrearDataCenter');
        $this->emit('alert', 'El DataCenter se creo satisfactoriamente');
    }

    public function edit(DataCenter $dataCenter)
    {
        $this->DataCenterEdit = $dataCenter;
        $this->datacenterid = $this->DataCenterEdit->id;
        $this->nombre = $this->DataCenterEdit->nombre;
        $this->ubicacion = $this->DataCenterEdit->ubicacion;
        $this->direccion = $this->DataCenterEdit->direccion;
        $this->encargado = $this->DataCenterEdit->encargado;
    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'ubicacion' => 'required|min:3|max:100',
            'direccion' => 'required|min:3|max:100',
            'encargado' => 'nullable',
        ]);

        if ($this->datacenterid) {
            $updDataCenter = DataCenter::find($this->datacenterid);
            $updDataCenter->update([
                'nombre' => $this->nombre,
                'ubicacion' => $this->ubicacion,
                'direccion' => $this->direccion,
                'encargado' => $this->encargado,
            ]);
            $this->reset(['nombre', 'ubicacion', 'direccion', 'encargado']);
        }
        $this->emit('cerrarModalEditarDataCenter');
        $this->emit('alert', 'El DataCenter se actualizo satisfactoriamente');
    }
    public function delete($id)
    {
        DataCenter::where('id', $id)->delete();
        $this->totaldatacenters = DataCenter::count();

    }
    public function render()
    {
        $datacenters = DataCenter::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('ubicacion', 'like', '%' . $this->search . '%')
            ->orwhere('direccion', 'like', '%' . $this->search . '%')
            ->orwhere('encargado', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);

        return view('livewire.admin.datacenter.datacenter-show', compact('datacenters'));
    }
}
