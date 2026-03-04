<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    public function index()
    {
        return view('user.marks.index');
    }
}
