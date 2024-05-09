<?php

namespace App\Http\Controllers;

use App\Models\Token_settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $data = Token_settings::latest()->first();
        return view('home', compact('data'));
    }
    public function average_time(Request $request)
    {
        try {
            $request->validate([
                'avg_time_in_min' => 'required|numeric|min:1'
            ]);
            Token_settings::orderBy('id', 'desc')
            ->take(1)
            ->update(['avg_time_in_min' => $request->avg_time_in_min]);
            return redirect()->back()->with('success', 'Average Time Per Token Updated');
        } catch (\Exception $e) {

            $mssg =  $e->getMessage();
            return redirect()->back()->with('error', $mssg);
        }
    }
    public function start_opd(Request $request)
    {
        try {

            Token_settings::orderBy('id', 'desc')
            ->take(1)
                ->update(['status' => 1, 'curr_token'=> 1]);
            return redirect()->back()->with('success', 'OPD Status Updated');
        } catch (\Exception $e) {

            $mssg =  $e->getMessage();
            return redirect()->back()->with('error', $mssg);
        }
    }
    public function update_token(Request $request)
    {
        try {
            $request->validate([
                'curr_token' => 'required|numeric|min:1'
            ]);

            Token_settings::orderBy('id', 'desc')
            ->take(1)
                ->update(['curr_token' => $request->curr_token]);
            return redirect()->back()->with('success', 'Token Updated');
        } catch (\Exception $e) {

            $mssg =  $e->getMessage();
            return redirect()->back()->with('error', $mssg);
        }
    }
    public function stop_opd(Request $request)
    {
        try {
            $request->validate([
                'start_from_date' => 'required|after_or_equal:today',
                'start_from_time' => 'required'
            ]);

            Token_settings::orderBy('id', 'desc')
            ->take(1)
                ->update(['start_from_date' => $request->start_from_date,'start_from_time' => $request->start_from_time, 'status' => 0]);
            return redirect()->back()->with('success', 'OPD Status Updated');
        } catch (\Exception $e) {

            $mssg =  $e->getMessage();
            return redirect()->back()->with('error', $mssg);
        }
    }
    public function changePassword()
    {
        return view('change-password');
    }
    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("success", "Password changed successfully!");
    }

}
