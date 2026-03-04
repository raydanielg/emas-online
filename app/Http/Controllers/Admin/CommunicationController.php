<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    public function sms()
    {
        return view('admin.communication.sms');
    }

    public function email()
    {
        return view('admin.communication.email');
    }

    public function announcements()
    {
        return view('admin.communication.announcements');
    }
}
