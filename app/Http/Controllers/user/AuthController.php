<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\PasswordReset;
use App\Mail\VerifyUser;
use App\Models\Customers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    function login(Request $request){
        $v = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if($v->fails()){
            return back()->with('error', 'Email or Password Wrong');
        }
        if(Auth::guard('customer')->attempt(['email' => $request->email, 'password'=>$request->password])){
            return redirect()->route('index');
        }else{

            return back()->with('error', 'Email or Password Wrong');
        }

    }
    function register(Request $request){
        $v = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:customers',
            'password' => 'required|string',
            'repassword' => 'required|string|same:repassword',
            'phone' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'address' => 'string',
        ]);
        if($v->fails()){
            return back()->withErrors($v->errors())->withInput($request->all());
        }
        $name = filter_var($request->name, FILTER_SANITIZE_STRING);
        $email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
        $phone = filter_var($request->phone, FILTER_SANITIZE_STRING);
        $password = password_hash($request->password, PASSWORD_BCRYPT);
        $dob = filter_var($request->dob, FILTER_SANITIZE_STRING);
        $gender = filter_var($request->gender, FILTER_SANITIZE_STRING);
        $address = filter_var($request->address, FILTER_SANITIZE_STRING);
        $verify_code = Str::random(40);
        $cus = Customers::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'dob' => $dob,
            'gender' => $gender,
            'address' => $address,
            'verify_code' => $verify_code
        ]);
        $mailData = [
            'name' => $cus->name,
            'email' => $cus->email,
            'verify_code' => $verify_code
        ];
        Mail::to($cus->email)->send(new VerifyUser($mailData));
        try{
            Auth::guard('customer')->attempt(['email' => $cus->email, 'password'=>$password]);
            return back()->with('msg', 'Your account is created. Please check your email to verify your account');
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    function verify($code){
        Customers::where('verify_code', $code)->update(['is_verified' => '1']);
        echo "Your account is already verified";
    }
    function OAuthRedirect($provider){
        return Socialite::driver($provider)->redirect();
    }
    function OAuthFallback($provider){

        $user = Socialite::driver($provider)->stateless()->user()->user;
        $notExist = Customers::where('provider_id', $user['id'])->get()->isEmpty();
        $isUserCreatedManually = Customers::where([['provider', null], ['email', $user['email']]])->get()->isEmpty();
        if($notExist && $isUserCreatedManually){
            Customers::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'is_verified' => '1',
                'provider' => $provider,
                'provider_id' => $user['id'],
                'password' => password_hash($user['id'], PASSWORD_BCRYPT)
            ]);
        }else{
            if(!$isUserCreatedManually){
                return redirect()->route('loginView')->with('msg', 'Your Account Already Exist');
            }else{
                Auth::guard('customer')->attempt([
                    'email' => $user['email'],
                    'password' => $user['id']
                ]);
                return redirect()->route('index');
            }
        }
        
    }

    function checkUser(Request $request){
        $v = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if($v->fails()){
            return back()->withErrors($v->errors());
        }

        $notExist = Customers::where([['provider', null], ['email', $request->email]])->get()->isEmpty();
        if($notExist){
            return back()->with('error', 'Your account does not exist');
        }
        $cus = Customers::where('email',$request->email)->first();
        $mailData = [
            'name' => $cus->name,
            'email' => $cus->email,
            'verify_code' => $cus->verify_code
        ];
        Mail::to($cus->email)->send(new PasswordReset($mailData));
        return back()->with('msg', 'Your reset password link is already sent. Please check your email');
    }
    function resetPassword($code){
        $cus = Customers::where('verify_code',$code)->first();
        return view('user.account.reset_password', compact('cus'));
    }
    function confirmResetPassword(Request $request){
        $v = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
            'repassword' => 'required|string|same:password',
        ]);

        if($v->fails()){
            return back()->withErrors($v->errors());
        }
        $password = password_hash($request->password, PASSWORD_BCRYPT);
        $cus = Customers::where('email',$request->email)->update([
            'password' => $password,
        ]);
        return redirect()->route('loginView')->with('msg','Your password reset successfully, Please login');
    }
}