<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\test;

class testController extends Controller
{
    public function create(request $req){

        $user= test::create($req->all());
        return response()->json($user,200);
    }
}
