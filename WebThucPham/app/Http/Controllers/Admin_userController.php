<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Admin_userController extends Controller
{
    public function index()
    {
        $user=User::all();
        return view('admin.user.index',['user'=>$user]);
    }
}
