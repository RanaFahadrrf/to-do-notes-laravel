<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Note;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    

    public function showLogin() {
    return view('admin-blades.admin-login');
}

    public function showSignup() {
    return view('admin-blades.admin-signup');
}

 public function processSignup(Request $req)
    {
        // return $req;
        $credentials = Validator::make($req->all(),
        [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required',
        ]);
      
        if($credentials->fails())
        {
              return response()->json([
                'status' => false,
                'message' => "Validation Error Occured",
              ] , 401);
        }
       
        $admin = Admin::create([
                'name' => $req->name,
                'email' => $req->email,
                'password' => $req->password,
        ]);

        if($admin)
        {
            //  return response()->json([
            //     'status' => true,
            //     'message' => "Data Saved in DB Successfully",
            //   ] , 200);
            SendWelcomeEmail::dispatch($admin);  //send welcome email to a new user.
            return redirect()->route('admin-login-page');
        }
        else{
             return response()->json([
                'status' => false,
                'message' => "Failed to save data in database",
              ],401);
        }
        
    }

public function processLogin(Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
        $admin = Auth::guard('admin')->user();
        //   return $admin;
        $otp = rand(100000, 999999);
        $admin->otp_code = $otp;
        $admin->otp_expires_at = Carbon::now()->addMinutes(5);
        $admin->save();

        // Send OTP via email
        Mail::raw("Your OTP is: $otp", function ($message) use ($admin) {
            $message->to($admin->email)
                    ->subject('Admin Login OTP');
        });

        return redirect()->route('admin.otp');
    }

    return back()->withErrors(['email' => 'Invalid login credentials']);
}


public function showOtpForm() {
    return view('admin-blades.admin-verify-otp');
}

public function verifyOtp(Request $request) {
    $request->validate([
        'otp_code' => 'required|digits:6'
    ]);

    $admin = Auth::guard('admin')->user();

    if (
        $admin &&
        $admin->otp_code === $request->otp_code &&
        Carbon::now()->lt($admin->otp_expires_at)
    ) {
        // OTP valid
        $admin->otp_code = null;
        $admin->otp_expires_at = null;
        $admin->save();

        return redirect()->route('admin-dashboard');
    }

    return back()->withErrors(['otp_code' => 'Invalid or expired OTP']);
}

public function adminLogout()
{
    Auth::guard('admin')->logout();
    return redirect()->route('admin-login'); 
}



public function showDashboard()
{
     $admin = Auth::guard('admin')->user();
      $stats = $this->loadUserStats();

        return view('admin-blades.admin-dashboard', compact('stats'));
}

    private function loadUserStats()
    {
        $users = User::orderBy('created_at', 'desc')->take(3)->get();
        $usersWithNoteCount = User::withCount('notes')->get();
       
        // $user_with_total_notes = User::with->notes()->count();
        // $requests = User::where('status', 'pending')->get();
        $pendingNotes = Note::where('status', 'pending')->with('user')->get();
        return [
            'total_users' => User::count(),
            'recent_users' => $users,
            'requests' => $pendingNotes,
            'all_users' => $usersWithNoteCount,
        ];
    }





public function approveUserNoteRequest(int $id)
{
    $admin = Auth::guard('admin')->user();
    $request = Note::findOrFail($id);
    $request->status = 'completed';
    $request->save();

    return redirect()->back()->with('success', 'Note Request approved.');
}




public function adminSettings()
{
    return view('admin-blades.admin-settings');
    // return redirect()->route();
}

}

