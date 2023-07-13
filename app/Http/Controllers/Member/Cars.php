<?php

namespace App\Http\Controllers\Member;

use App\Models\MemberCar;
use Illuminate\Http\Request;
use App\Models\StudentMember;
use App\Http\Controllers\Controller;

class Cars extends Controller
{
    public function index()
    {
        $page_title = 'Registered Cars';

        $userId = session('user_id');

        $student = StudentMember::where('user_id', $userId)->first();

        $cars = MemberCar::where('student_member_id', $student->id)->get();

        return view('members.cars', [
            'page_title' => $page_title,
            'student' => $student,
            'cars' => $cars,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'registration_number' => 'required',
            'make' => 'required',
            'model' => 'required',
            'color' => 'required',
        ]);

        // Create a new instance of the MemberCar model
        $memberCar = new MemberCar();
        $memberCar->student_member_id = $request->input('student_member_id');
        $memberCar->registration_number = $request->input('registration_number');
        $memberCar->make = $request->input('make');
        $memberCar->model = $request->input('model');
        $memberCar->color = $request->input('color');
        $memberCar->registration_date = now(); // Set the current date as the registration date
        $memberCar->status = 'pending'; // Set the initial status as 'pending'
        $memberCar->expiry_date = now()->endOfYear(); // Set the expiry date at the end of the current year
        $memberCar->save();

        // You can redirect to a specific route or perform additional actions after saving the data

        return redirect()->route('member.cars')->with('success', 'Car registered successfully.');
    }
}
