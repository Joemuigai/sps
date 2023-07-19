<?php

namespace App\Http\Controllers\Security;

use App\Models\MemberCar;
use App\Models\ParkingLog;
use App\Models\ParkingLot;
use Illuminate\Http\Request;
use App\Models\StudentMember;
use App\Http\Controllers\Controller;

class SecurityDashboard extends Controller
{
    public function index(Request $request)
    {
        $page_title = 'Dashboard';
        $carProfile = null;
        $parkingLot = null;

        if ($request->has('number_plate')) {
            $numberPlate = $request->input('number_plate');

            $car = MemberCar::where('registration_number', $numberPlate)->first();

            if ($car) {
                $carProfile = StudentMember::where('id', $car->student_member_id)->first();

                $parkingLot = ParkingLot::where('status', 'available')->first();
            }
        }

        return view('security.dashboard', [
            'page_title' => $page_title,
            'carProfile' => $carProfile,
            'parkingLot' => $parkingLot,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'student_member_id' => 'required',
            'tag' => 'required',
        ]);

        $studentMemberId = $request->input('student_member_id');
        $tag = $request->input('tag');

        // Check if the parking lot with the given tag is available
        $parkingLot = ParkingLot::where('tag', $tag)->where('status', 'available')->first();

        if ($parkingLot) {
            // Create a new parking log entry
            $parkingLog = new ParkingLog();
            $parkingLog->student_member_id = $studentMemberId;
            $parkingLog->car_registration_number = $tag;
            $parkingLog->entry_time = now();
            $parkingLog->parking_space_number = $parkingLot->space_number;
            $parkingLog->save();

            // Update the parking lot status to occupied
            $parkingLot->status = 'occupied';
            $parkingLot->save();

            return redirect()->route('security.dashboard')->with('success', 'Parking logged successfully.');
        } else {
            return redirect()->route('security.dashboard')->with('error', 'Parking lot with the given tag is not available.');
        }
    }
}
