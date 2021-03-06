<?php

namespace App\Http\Controllers;

use App\Education;
use App\Gender;
use App\Job;
use App\MailData;
use App\MaritalStatus;
use App\Religion;
use App\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        $data = UserData::where('user_id', Auth::user()->id)->get();
        return view('user.components/mydata', compact('data'));
    }

    public function data()
    {
        $genders = Gender::all();
        $jobs = Job::all();
        $educations = Education::all();
        $religions = Religion::all();
        $marital_status = MaritalStatus::all();
        return view('user.components/adddata', compact('genders', 'marital_status', 'religions', 'educations', 'jobs'));
    }

    public function notifications()
    {
        $data = MailData::whereHas('userdata.user', function ($query){ 
            $query->where('users.id', '=', Auth::user()->id); 
        })  ->limit(10)->orderBy('id', 'desc')->get();
        // dd($data);
        return view('user.components/notification', compact('data'));
    }

    public function myaccount()
    {
        return view('user.components/account');
    }
}
