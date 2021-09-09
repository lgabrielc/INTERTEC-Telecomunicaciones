<?php

namespace App\Http\Livewire\Admin\Datacenter;

use App\Models\Datacenter;
use App\Models\Estado;
use Livewire\WithPagination;
use Livewire\Component;

class DatacenterShow extends Component
{
    use WithPagination;
    public $datacenterid, $nombre, $ubicacion, $direccion, $encargado, $DataCenterEdit;
    public $search, $totaldatacenters, $estados, $estado_id;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '5';

    public function mount()
    {
        $this->totaldatacenters = Datacenter::count();
        $this->estados = Estado::where('nombre',"=" ,'Activo')->orwhere('nombre',"=" ,'Deshabilitado')->get();
    }
    public function resetcampos()
    {

        $this->reset(['nombre', 'ubicacion', 'direccion', 'encargado', 'estado_id']);
        $this->estado_id = "1";
    }
    public function save()
    {

        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'ubicacion' => 'required|min:3|max:100',
            'direccion' => 'required|min:3|max:100',
            'encargado' => 'nullable',
            'estado_id' => 'required',
        ]);

        $NewDatacenter = Datacenter::create([
            'nombre' => $this->nombre,
            'ubicacion' => $this->ubicacion,
            'direccion' => $this->direccion,
            'encargado' => $this->encargado,
            'estado_id' => $this->estado_id,
        ]);
        $this->totaldatacenters = Datacenter::count();
        $this->reset(['nombre', 'ubicacion', 'direccion', 'encargado', 'estado_id']);
        $this->emit('cerrarModalCrearDataCenter');
        $this->emit('alert', 'El DataCenter se creo satisfactoriamente');
    }

    public function edit(Datacenter $dataCenter)
    {
        $this->DataCenterEdit = $dataCenter;
        $this->datacenterid = $this->DataCenterEdit->id;
        $this->nombre = $this->DataCenterEdit->nombre;
        $this->ubicacion = $this->DataCenterEdit->ubicacion;
        $this->direccion = $this->DataCenterEdit->direccion;
        $this->encargado = $this->DataCenterEdit->encargado;
        $this->estado_id = $this->DataCenterEdit->estado_id;
    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required|min:3|max:50',
            'ubicacion' => 'required|min:3|max:100',
            'direccion' => 'required|min:3|max:100',
            'encargado' => 'nullable',
            'estado_id' => 'required',
        ]);

        if ($this->datacenterid) {
            $updDataCenter = Datacenter::find($this->datacenterid);
            $updDataCenter->update([
                'nombre' => $this->nombre,
                'ubicacion' => $this->ubicacion,
                'direccion' => $this->direccion,
                'encargado' => $this->encargado,
                'estado_id' => $this->estado_id,
            ]);
            $this->reset(['nombre', 'ubicacion', 'direccion', 'encargado']);
        }



        $this->emit('cerrarModalEditarDataCenter');
        $this->emit('alert', 'El DataCenter se actualizo satisfactoriamente');
    }
    public function cambiarestado($id)
    {

        $actualizardatacenter = Datacenter::find($id);
        if ($actualizardatacenter->estado_id == '1') {
            $this->estado_id = '2';
            $actualizardatacenter->update(['estado_id' => $this->estado_id]);
        } else {
            $this->estado_id = '1';
            $actualizardatacenter->update(['estado_id' => $this->estado_id]);
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
    public function render()
    {
        $datacenters = Datacenter::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('ubicacion', 'like', '%' . $this->search . '%')
            ->orwhere('direccion', 'like', '%' . $this->search . '%')
            ->orwhere('encargado', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->cant);

        return view('livewire.admin.datacenter.datacenter-show', compact('datacenters'));
    }
}
