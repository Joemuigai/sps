<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberDashboard extends Controller
{
    public function index()
    {
        $page_title = 'Dashboard';

        return view('members.dashboard', [
            'page_title' => $page_title,
        ]);
    }
}
