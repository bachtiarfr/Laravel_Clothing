<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    function index()
    {
        $user = User::all();
        return response()->json($user);
    }
}
