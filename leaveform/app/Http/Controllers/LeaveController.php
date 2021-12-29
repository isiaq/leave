<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Leave;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendUser;

class LeaveController extends Controller
{

    public function index()
    {
        return view('users.leave_form');
    }

    function doleave(Request $req)
    {
        /*print_r($req->input());*/
        $user = new Leave;
        $user->user_id = auth()->user()->id;
        $user->days = $req->days;
        $user->type = $req->type;
        $user->start = $req->start;
        $user->phonegit  = $req->phone;
        $user->reason = $req->reason;
        $user->address = $req->address;
        $user->holidays = $req->holidays;

        $user->decl_sig ='approved';
        $user->super_sig = 'pending';
        $user->hod_sig = 'pending';
        $user->hr_sig = 'pending';

        $data = [
            'name' => auth()->user->name,
        ];

        $val = 'supervisor';
        $val2 = auth()->user()->department;

        $abc = User::where('usertype', $val)
                            ->where('department', $val2)
                            ->get(['email']);
        // TODO: Continue
        $hostname = "www.google.com";
        $port = 80;

        $con = @fsockopen($hostname, $port);

        if (!$con) {
          Alert::error('Email not Sent', 'Please check your internet connection');
          return redirect('/home');
        } else {
            $user->save();
            foreach ( $abc as $xyz ) {
            Mail::to("$xyz->email")->send(new sendUser($data)); }
        }


        Alert::success('Submitted', 'The Form is Successfully Submitted');
        return redirect('/home');
    }





}
