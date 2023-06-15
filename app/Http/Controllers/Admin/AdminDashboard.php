<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboard extends Controller
{
    public function index()
    {
        $page_title = 'Dashboard';

        return view('admin.dashboard', [
            'page_title' => $page_title,
        ]);
    }


}
