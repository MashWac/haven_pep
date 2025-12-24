<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\userDetailsModel;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function myProfile()
    {
        $user_id = session('user_id');
        $user_data=userDetailsModel::where('id',$user_id)->first();
        return view('client.user_profile',compact('user_data'));
    }
}
