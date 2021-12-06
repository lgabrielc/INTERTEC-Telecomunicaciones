<?php

namespace App\Http\Livewire\Admin\ReporteCliente;

use Livewire\Component;

class ShowReporteCliente extends Component
{
    public $vermodal=false;

    public function activarmodal(){
        $this->vermodal=true;
    }

    public function render()
    {
        return view('livewire.admin.reporte-cliente.show-reporte-cliente');
    }
}
