<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParkingLogs extends Controller
{
    public function index()
    {
        $page_title = 'Parking Logs';

        return view('members.parking_logs', [
            'page_title' => $page_title,
        ]);
    }
}
