<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CentrodatosController extends Controller
{
    public function index()
    {
        return view('livewire.admin.datacenter.index');
        
    }
}
