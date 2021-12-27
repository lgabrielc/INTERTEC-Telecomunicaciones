<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GestionarReportesController extends Controller
{
    public function pagocliente()
    {
        return view('livewire.admin.gestionar-reportes.pagocliente.index');
    }
    public function reportepagos()
    {
        return view('livewire.admin.gestionar-reportes.reportepagos.index');
    }
}
