<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\OTPSms;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if($request->method() == 'GET'){
            return view('auth.login');
        }
        $request->validate([
            'cellphone' =>'required'
        ]);

        try {

            $user = User::where('cellphone', $request->cellphone)->first();
            $OTPCode = mt_rand(100000, 999999);
            $loginToken = Hash::make('DCDCojncd@cdjn%!!ghnjrgtn&&');

            if ($user) {
                $user->update([
                    'otp' => $OTPCode,
                    'login_token' => $loginToken
                ]);
            } else {
                $user = User::Create([
                    'cellphone' => $request->cellphone,
                    'otp' => $OTPCode,
                    'login_token' => $loginToken
                ]);
            }
            $user->notify(new OTPSms($OTPCode));

            return response(['login_token' => $loginToken], 200);

        } catch (Exception $ex) {
            return response(['errors' => $ex->getMessage()], 422);
        }
    }

    public function checkOTP(Request $request)
    {
        $request->validate([
            'otp' =>'required|digits:6',
            'login_token' =>'required',
        ]);

        try{
            $user = User::where('login_token' , $request->login_token)->firstOrFail();

            if($user->otp == $request->otp){
                auth()->login($user , $remember=true);
                return response(['ورود با موفقیت انجام شد.'] , 200);
            }else{
                return response(['errors' => ['otp'=>['کد تایید نادرست است']]] , 422);
            }
        } catch (Exception $ex) {
            return response(['errors' => $ex->getMessage()], 422);
        }
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'login_token' =>'required'
        ]);

        try {

            $user = User::where('login_token', $request->login_token)->firstOrFail();
            $OTPCode = mt_rand(100000, 999999);
            $loginToken = Hash::make('DCDCojncd@cdjn%!!ghnjrgtn&&');

            $user->update([
                'otp' => $OTPCode,
                'login_token' => $loginToken
            ]);

            $user->notify(new OTPSms($OTPCode));

            return response(['login_token' => $loginToken], 200);

        } catch (Exception $ex) {
            return response(['errors' => $ex->getMessage()], 422);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

