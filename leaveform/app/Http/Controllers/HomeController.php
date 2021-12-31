<?php

namespace App\Http\Controllers;

use App\Models\theleaveformModel;
use App\Models\Leave;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Images;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $auth = Auth::user()->StaffID;
        $val = 'approved';
        $val2 = 'pending';

        $year = Carbon::today()->year;
        $user_id = auth()->user()->id;
        $used_leave = Leave::used($user_id, $year);
        $entitled_leave = auth()->user()->entitled;
        $available_leave = Leave::available($user_id, $year);

        $theleaveform = theleaveformModel::where('StaffID', 'like', '%'. $auth . '%' )->count();
        $theleaveform2 = theleaveformModel::where('StaffID', 'like', '%' . $auth . '%')
                            ->where('decl_sig', 'like', '%' . $val . '%')
                            ->where('super_sig', 'like', '%' . $val . '%')
                            ->where('hod_sig', 'like', '%' . $val . '%')
                            ->where('hr_sig', 'like', '%' . $val . '%')->count();
        $theleaveform3 = theleaveformModel::where('StaffID', 'like', '%' . $auth . '%')
                            ->orwhere('decl_sig', 'like', '%' . $val2 . '%')
                            ->orwhere('super_sig', 'like', '%' . $val2 . '%')
                            ->orwhere('hod_sig', 'like', '%' . $val2 . '%')
                            ->orwhere('hr_sig', 'like', '%' . $val2 . '%')->count();
        $theleaveform4 = DB::table('users')->count();

        return view('users.users_dashboard')
            ->with('year', $year)
            ->with('used', $used_leave)
            ->with('entitled', $entitled_leave)
            ->with('available', $available_leave)
            ->with('theleaveform', $theleaveform)
            ->with('theleaveform2', $theleaveform2)
            ->with('theleaveform3', $theleaveform3)
            ->with('theleaveform4', $theleaveform4);
        }
        
        
}
