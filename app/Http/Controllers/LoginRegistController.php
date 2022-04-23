<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
// use App\User;
use App\Models\User;

class LoginRegistController extends Controller
{
    public function registerUser(Request $req){
        if($req->password == $req->confirm_password)
{
        $user= User::create($req->all());
        return response()->json($user,200);
}
        else
        {
            return response()->json('impossible');
        }
    }

    function login(Request $req){

        $result = DB::table('users')->where('email',$req->email)->get();

        $res = json_decode($result,true);

        if(sizeof($res) === 0){
        return response()->json(sizeof($res));
        }
        else{
            if($result[0]->password === $req->password){
            $user=DB::table('users')->where('id',$result[0]->id)->get();
            return response()->json($req->email);
            }
            else{
                return response()->json(sizeof($res));
            }
        }
    }

    public function getUser($email){
        $data = DB::table('users')->where('email',$email)->get();
        return response()->json($data->prenom,200);
      }

}
