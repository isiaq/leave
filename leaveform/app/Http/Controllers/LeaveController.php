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

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class LeaveController extends Controller
{

    public function index()
    {
        // TODO: Limit form days max to available
        return view('users.leave_form');
    }

    public static function calculateDays($start, $end) {
        $workingDays = [1, 2, 3, 4, 5]; // Work days (in week)
        $holidayDays = [
            '*-12-25', 
            '*-12-26',
            '*-01-01',
            // Add Sallah and others: yyyy-mm-dd
        ];  // Holidays array, add desired dates to this array 
        $period = CarbonPeriod::create($start, $end);

        $days = 0;
        $holidays = [];
        foreach ($period as $date) {
            $free_day = !in_array($date->format('N'), $workingDays) || 
                in_array($date->format('Y-m-d'), $holidayDays) || 
                in_array($date->format('*-m-d'), $holidayDays);
            if ($free_day) {
                $holidays[] = $date->format('Y-m-d');
                continue;
            }
            $days++;
        }
        $holidays_string = join(',', $holidays);
        return [$days, $holidays_string];
    }

    public function doleave(Request $req)
    {
        $leave = new Leave;
        $leave->user_id = auth()->user()->id;
        $leave->type = $req->leavetype;
        $leave->start = $req->start;
        $leave->end = $req->end;
        $leave->phone  = $req->phone;
        $leave->reason = $req->reason;
        $leave->address = $req->address;
        $leave->holidays = $req->holidays;

        $leave->decl_sig ='approved';
        $leave->super_sig = 'pending';
        $leave->hod_sig = 'pending';
        $leave->hr_sig = 'pending';
        $leave->status = 'pending';

        [$days, $holidays] = self::calculateDays($leave->start, $leave->end);
        $leave->holidays = $holidays;
        $leave->days = $days;
        $leave->sent = false;
        $leave->save();
        Alert::success('Submitted', 'Leave form successfully submitted');
        return $this->mail($leave->id);
    }

    public function mail($id)
    {

        $hostname = "www.google.com";
        $port = 80;
        $con = @fsockopen($hostname, $port);
        if (!$con) {
            Alert::error('Email Error', 'Please check Internet connection');
        } else {
            $leave = Leave::findOrFail($id);
            $data = ['name' => auth()->user()->name];
            $dept = auth()->user()->department;
            // TODO: Update to use supervisor_id on User model
            $sup = User::query()
                ->where('usertype', 'supervisor')
                ->where('department', $dept); // No supervisors for HODs
            foreach ($sup as $s ) {
                Mail::to("$xyz->email")->send(new sendUser($data));
            }
            $leave->sent = true;
            $leave->save();
        }
        return redirect('/home');
    }


}
