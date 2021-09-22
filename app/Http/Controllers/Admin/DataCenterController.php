<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DatacenterController extends Controller
{

    public function index()
    {
        return view('livewire.admin.datacenter.index');
    }
}
