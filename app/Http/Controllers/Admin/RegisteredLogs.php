<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisteredLogs extends Controller
{
    public function index()
    {
        $page_title = 'Parking Logs';

        return view('admin.parking_logs', [
            'page_title' => $page_title,
        ]);
    }
}
