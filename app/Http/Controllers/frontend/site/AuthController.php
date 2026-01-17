<?php

namespace App\Http\Controllers\frontend\site;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function mobileSmsApi($ctry, $mbl, $otp) {}
    function whatsappSmsApi($ctry, $mbl, $otp) {}
    public function signIn()
    {
        return view('frontend.site.sign-in');
    }
    public function signInData(Request $request)
    {
        $data = $request->validate(['country_code' => 'required|string', 'mobile_no' => 'required|digits_between:8,15',]);
        $user = User::where('country', $data['country_code'])->where('mobile', $data['mobile_no'])->first();
        if ($user) {
            if ($user->status === 'inactive') {
                if ($user->otp_last_sent_at && !$user->otp_last_sent_at->isSameDay(now())) {
                    $user->otp_limit = 0;
                }
                if ($user->otp_limit >= 3) {
                    return redirect()->back()->with('error', 'OTP limit exceeded. Try again after 24 hours.');
                }
                $otp = random_int(100000, 999999);
                $otpExpiry = now()->addMinutes(5);
                $user->update(['otp' => $otp, 'otp_expires_at' => $otpExpiry, 'otp_limit' => $user->otp_limit + 1, 'otp_last_sent_at' => now(), 'otp_token' => Str::random(60), 'remember_token' => Str::random(60),]);
                $this->mobileSmsApi($user->country, $user->mobile, $otp);
                return redirect()->route('verify-number', ['ctry'  => encrypt($user->country), 'mbl' => encrypt($user->mobile), 'token' => $user->otp_token,])->with('success', 'Already registered. Please verify your number!');
            }
            return redirect()->route('password', ['ctry' => encrypt($user->country), 'mbl' => encrypt($user->mobile), 'token' => $user->otp_token,])->with('success', 'Already registered!');
        }
        return redirect()->route('check-account', ['ctry' => encrypt($data['country_code']), 'mbl' => encrypt($data['mobile_no']),])->with('success', 'Looks like you are new here!');
    }
    public function checkAccount($ctry, $mbl)
    {
        try {
            $country = decrypt(urldecode($ctry));
            $mobile = decrypt(urldecode($mbl));
        } catch (DecryptException $e) {
            abort(404);
        }
        return view('frontend.site.check-account', compact('country', 'mobile'));
    }
    public function signUp($ctry, $mbl)
    {
        try {
            $country = decrypt(urldecode($ctry));
            $mobile = decrypt(urldecode($mbl));
        } catch (DecryptException $e) {
            abort(404);
        }
        return view('frontend.site.sign-up', compact('country', 'mobile'));
    }
    public function signUpData(Request $request)
    {
        $data = $request->validate(['country' => 'required', 'mobile' => 'required|numeric|unique:users,mobile', 'name' => 'required|string', 'email' => 'nullable|email|unique:users,email', 'password' => 'required|min:8']);
        try {
            $data['andr_pass'] = trim($data['password']);
            $data['password'] = Hash::make($data['password']);
            $data['created_ip'] = trim($request->ip());
            $data['remember_token'] = Str::random(40);
            $data['otp_token'] = Str::random(40);
            $data['otp'] = rand(100000, 999999);
            $data['otp_expires_at'] = now()->addMinutes(5);
            $data['otp_limit'] = trim('1');
            $data['otp_last_sent_at'] = now();
            $user = User::create($data);
            if ($user) {
                $this->mobileSmsApi($user->country, $user->mobile, $user->otp);
            }
            return redirect()->route('verify-number', ['ctry' => encrypt($user->country), 'mbl' => encrypt($user->mobile), 'token' => $user->otp_token])->with('success', "OTP sent to your registered number!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Something went wrong! Please try again.");
        }
    }
    public function verifyNumber($ctry, $mbl, $token)
    {
        try {
            $country = decrypt($ctry);
            $mobile  = decrypt($mbl);
            $user = User::where('mobile', $mobile)->where('otp_token', $token)->first();
            if (!$user) {
                abort(404);
            }
            return view('frontend.site.verify-number', ['country' => $country, 'mobile' => $mobile, 'token' => $token]);
        } catch (DecryptException $e) {
            abort(404);
        }
    }
    public function verifyOtp(Request $request)
    {
        $data = $request->validate(['token' => 'required|string', 'country' => 'required|string', 'mobile' => 'required|string', 'otp' => 'required|digits:6',]);
        $user = User::where('otp_token', $data['token'])->where('country', $data['country'])->where('mobile', $data['mobile'])->first();
        if (!$user) {
            return redirect()->route('sign-in')->with('error', 'Invalid user details!');
        }
        if ($user->otp_expires_at && now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['error' => 'OTP has expired!']);
        }
        if ((string) $user->otp !== (string) $data['otp']) {
            return back()->withErrors(['error' => 'Invalid OTP!']);
        }
        $user->update(['otp_verified_at' => now(), 'status' => 'active', 'otp' => null, 'otp_token' => Str::random(40), 'remember_token' => Str::random(40)]);
        return redirect()->route('password', ['ctry' => encrypt($user->country), 'mbl' => encrypt($user->mobile), 'token' => $user->otp_token,])->with('success', 'User verification successful!');
    }
    public function resendOtp($ctry, $mbl, $token)
    {
        try {
            $user = User::where('otp_token', $token)->first();
            if (!$user) {
                return redirect()->route('sign-in')
                    ->with('error', 'Invalid user details!');
            }
            if ($user->country !== $ctry || $user->mobile !== $mbl) {
                return redirect()->back()
                    ->with('error', 'Validation failed! Invalid details.');
            }
            if ($user->otp_last_sent_at && !$user->otp_last_sent_at->isSameDay(now())) {
                $user->otp_limit = 0;
            }
            if ($user->otp_limit >= 3) {
                return redirect()->back()->with('error', 'OTP limit exceeded. Try again after 24 hours.');
            }
            $otp = random_int(100000, 999999);
            $otpExpiry = now()->addMinutes(5);
            $user->update(['otp' => $otp, 'otp_expires_at' => $otpExpiry, 'otp_limit' => $user->otp_limit + 1, 'otp_last_sent_at' => now(),]);
            $this->mobileSmsApi($user->country, $user->mobile, $otp);
            return redirect()->back()->with('success', 'OTP sent to your number!');
        } catch (\Exception $e) {
            Log::error('Resend OTP Error', ['message' => $e->getMessage(), 'trace'   => $e->getTraceAsString(),]);
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }
    public function sendOtpInWhatsapp($ctry, $mbl, $token)
    {
        try {
            $user = User::where('otp_token', $token)->first();
            if (!$user) {
                return redirect()->route('sign-in')->with('error', 'Invalid user details!');
            }
            if ($ctry == $user->country && $mbl == $user->mobile) {
                $this->whatsappSmsApi($user->country, $user->mobile, $user->otp);
                return redirect()->back()->with('success', 'OTP sent to your number!');
            }
            return redirect()->back()->with('error', 'Validation failed! Invalid details.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Something went wrong! Please try again.");
        }
    }
    public function password($ctry, $mbl, $token)
    {
        try {
            $user = User::where('otp_token', $token)->first();
            if (!$user) {
                return redirect()->route('sign-in')->with('error', 'Invalid action!');
            }
            $country = decrypt($ctry);
            $mobile = decrypt($mbl);
            return view('frontend.site.password', compact('country', 'mobile', 'token'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Something went wrong! Please try again.");
        }
    }
    public function userVerifyPassword(Request $request)
    {
        $data = $request->validate(['token' => 'required|string', 'country' => 'required|string', 'mobile' => 'required|string', 'password' => 'required']);
        $user = User::where('otp_token', $data['token'])->where('country', $data['country'])->where('mobile', $data['mobile'])->first();
        if (!$user) {
            return redirect()->route('sign-in')->with('error', 'Invalid user details!');
        }
        if (!Hash::check($data['password'], $user->password)) {
            return redirect()->back()->with('error', 'Invalid password!');
        }
        Auth::login($user);
        $request->session()->regenerate();
        session(['user_data' => ['id' => $user->id, 'name' => $user->name, 'mobile' => $user->mobile, 'role' => $user->role]]);
        return in_array($user->role, ['admin', 'super-admin']) ? redirect()->route('dashboard')->with('success', 'Logged in successfully!') : redirect()->route('home-page')->with('success', 'Logged in successfully!');
    }
    public function userVerifiedByOtp($ctry, $mbl, $token)
    {
        try {
            $country = decrypt($ctry);
            $mobile  = decrypt($mbl);
            $user = User::where('otp_token', $token)->where('mobile', $mobile)->first();
            if (!$user) {
                return redirect()->route('sign-in')->with('error', 'Invalid user details!');
            }
            if (trim($user->country) !== trim($country)) {
                return redirect()->back()->with('error', 'Country mismatch!');
            }
            $otp = rand(100000, 999999);
            $user->update(['otp' => $otp]);
            $this->mobileSmsApi($user->country, $user->mobile, $user->otp);
            return view('frontend.site.otp-verification', ['country' => $country, 'mobile' => $mobile, 'token' => $token]);
        } catch (\Exception $e) {
            abort(404);
        }
    }
    public function userVerifyOtp(Request $request)
    {
        $data = $request->validate(['token' => 'required|string', 'country' => 'required|string', 'mobile' => 'required|string', 'otp' => 'required|digits:6',]);
        $user = User::where('otp_token', $data['token'])->where('country', $data['country'])->where('mobile', $data['mobile'])->first();
        if (!$user) {
            return redirect()->route('sign-in')->with('error', 'Invalid user details!');
        }
        if ($user->otp_expires_at && now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['error' => 'OTP has expired!']);
        }
        if ((string) $user->otp !== (string) $data['otp']) {
            return back()->withErrors(['error' => 'Invalid OTP!']);
        }
        Auth::login($user);
        $user->update(['otp' => null, 'otp_expires_at' => null, 'status' => 'active', 'remember_token' => Str::random(60), 'otp_verified_at' => now(),]);
        session(['user_data' => ['id' => $user->id, 'name' => $user->name, 'mobile' => $user->mobile,]]);
        return in_array($user->role, ['admin', 'super-admin']) ? redirect()->route('dashboard')->with('success', 'Logged in successfully!') : redirect()->route('home-page')->with('success', 'Logged in successfully!');
    }
    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            $role = $user->role;
        }
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return in_array($role ?? null, ['admin', 'super-admin']) ? redirect()->route('sign-in')->with('success', 'Logged out successfully!') : redirect()->route('home-page')->with('success', 'Logged out successfully!');
    }
}
