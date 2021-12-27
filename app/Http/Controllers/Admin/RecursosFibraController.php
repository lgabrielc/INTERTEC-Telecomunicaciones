<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecursosFibraController extends Controller
{
    public function datacenter()
    {
        return view('livewire.admin.recursos-fibra.datacenter.index');
    }
    public function olt()
    {
        return view('livewire.admin.recursos-fibra.olt.index');
    }
    public function tarjeta()
    {
        return view('livewire.admin.recursos-fibra.tarjeta.index');
    }
    public function gpon()
    {
        return view('livewire.admin.recursos-fibra.gpon.index');
    }
    public function nap()
    {
        return view('livewire.admin.recursos-fibra.nap.index');
    }
}
