<?php

namespace App\Http\Controllers\Admin;

use App\Models\MemberCar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisteredCars extends Controller
{
    public function index()
    {
        $page_title = 'Registered Cars';

        $cars = MemberCar::all();

        return view('admin.cars', [
            'page_title' => $page_title,
            'cars' => $cars,
        ]);
    }
}
