<?php

namespace App\Http\Controllers\Admin;

use App\Models\ParkingLot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParkingLots extends Controller
{
    public function index()
    {
        $page_title = 'Parking Lots';

        $parkingLots = ParkingLot::all();

        return view('admin.parking_lots', [
            'page_title' => $page_title,
            'parkingLots' => $parkingLots,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tag' => 'required|unique:parking_lots|max:255',
        ]);

        $parkingLot = new ParkingLot();
        $parkingLot->tag = $request->input('tag');
        $parkingLot->status = 'available';
        $parkingLot->save();

        $success_msg = 'Parking Lot with tag ' . $parkingLot->tag . ' added successfully.';

        return redirect()->route('admin.parkingLots')->with('success', $success_msg);
    }

    public function show($id)
    {
        $parkingLot = ParkingLot::findOrFail($id);

        return response()->json($parkingLot);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tag' => 'required',
        ]);

        $parkingLot = ParkingLot::find($id);

        $parkingLot->tag = $request->input('tag');
        $parkingLot->status = $request->input('status', 'available');
        $parkingLot->save();

        $success_msg = 'Parking Lot with tag ' . $parkingLot->tag . ' updated successfully.';

        return redirect()->route('admin.parkingLots')->with('success', $success_msg);
    }

    public function remove($id)
    {
        $parkingLot = ParkingLot::findOrFail($id);

        // Perform any necessary checks before deleting the parking lot

        $parkingLot->delete();

        $success_msg = 'Parking Lot with tag ' . $parkingLot->tag . ' deleted successfully.';

        return redirect()->route('admin.parkingLots')->with('success', $success_msg);
    }
}
