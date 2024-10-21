<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Notifications\InviteNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminController extends Controller
{
    //use AuthorizesRequests, ValidatesRequests;
    
        public function process_invites(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email'
        ]);
        $validator->after(function ($validator) use ($request) {
            if (Invite::where('email', $request->input('email'))->exists()) {
                $validator->errors()->add('email', 'There exists an invite with this email!');
            }
        });
        if ($validator->fails()) {
            return redirect(route('invite_view'))
                ->withErrors($validator)
                ->withInput();
        }
        do {
            $token = Str::random(20);
        } while (Invite::where('token', $token)->first());
        Invite::create([
            'token' => $token,
            'email' => $request->input('email')
        ]);
        $url = URL::temporarySignedRoute(
            'registration',
            now()->addMinutes(2880), // valid for 48 hrs
            ['token' => $token]
        );

        Notification::route('mail', $request->input('email'))->notify(new InviteNotification($url));

        return redirect('/admin')->with('success', 'The Invite has been sent successfully');
    }

    public function registration_view($token)
    {
        $invite = Invite::where('token', $token)->firstOrFail();
        return view('auth.register', ['invite' => $invite]);
    }
}
