<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function national()
    {
        return view('admin.reports.national');
    }

    public function regional()
    {
        return view('admin.reports.regional');
    }

    public function rankings()
    {
        return view('admin.reports.rankings');
    }
}
