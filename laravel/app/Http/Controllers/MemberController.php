<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        return $request->user();
    }
}
