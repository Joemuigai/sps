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

    public function show($id)
    {
        $car = MemberCar::findOrFail($id);

        return response()->json($car);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'registration_number' => 'required',
            'model' => 'required',
            'make' => 'required',
            'color' => 'required',
            'status' => 'required',
        ]);

        $car = MemberCar::find($id);

        $car->registration_number = $request->input('registration_number');
        $car->model = $request->input('model');
        $car->make = $request->input('make');
        $car->color = $request->input('color');
        $car->status = $request->input('status');
        $car->save();

        $success_msg = 'Car with registration number ' . $car->registration_number . ' updated successfully.';

        return redirect()->route('admin.cars')->with('success', $success_msg);
    }
}
