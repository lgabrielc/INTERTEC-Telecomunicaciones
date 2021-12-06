<?php

namespace App\Http\Livewire\Admin\Reporte;

use Livewire\Component;

class ShowReporte extends Component
{
    public $vermodal = false;

    public function activarmodal()
    {
        $this->vermodal = true;
    }
    public function render()
    {
        return view('livewire.admin.reporte.show-reporte');
    }
}
