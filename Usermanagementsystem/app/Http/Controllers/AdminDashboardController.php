<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function superadmin_dashboard()
    {
        return view("Admin.AdminDashboard");
    }
}
