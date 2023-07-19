<?php

namespace App\Http\Controllers\Security;

use App\Models\MemberCar;
use Illuminate\Http\Request;
use App\Models\StudentMember;
use App\Http\Controllers\Controller;

class CarSearch extends Controller
{
    public function search($regNo)
    {


        $cars = MemberCar::where('registration_number', $regNo)->get();

        // Retrieve the player based on the player id
        $carProfile = StudentMember::where('id', $cars->student_member_id)->first();

        // Return a 404 response if the student was not found
        if (!$student) {
            abort(404);
        }

        $page_title = $student->first_name . ' ' . $student->last_name;

        return view('admin.view_student_member', [
            'carProfile' => $carProfile,
            'page_title' => $page_title,
            'cars' => $cars,
        ]);
    }
}
