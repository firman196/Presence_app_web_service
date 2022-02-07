<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Dosen;


use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     /* 
        $this->middleware('dosen:dosen')->except('logout');
        $this->middleware('admin:admin')->except('logout');*/
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(AuthLoginRequest $request)
    {
       
       /* if(auth()->guard('admin')->check()){
            $user   = Admin::where('nip',$request->username)->first();
       
            if(!isset($user)){
                return redirect()->route('login')->with(['error' => 'Username/Password salah!']);
            }
        }else{
            $user   = Dosen::where('nip',$request->username)->first();
       
            if(!isset($user)){
                return redirect()->route('login')->with(['error' => 'Username/Password salah!']);
            }
        }*/
       
       
        $credentials = [
            'nip'       => $request->username,
            'password'  => $request->password,
            'status'    => '1'
        ];

        
        if(Auth::guard('admin')->attempt($credentials)){
            return redirect()->intended('/');
        }elseif(Auth::guard('dosen')->attempt($credentials)){
            return redirect()->intended('/dosen');           
        }else {
            
            return redirect()
                ->intended('login')
                ->withInput()
                ->withErrors(["Incorrect user login details!"]);
        }
    }

    public function logout(Request $request)
    {
        if(Auth::guard('admin')->check()){
            $this->guard('admin')->logout();
        }elseif(Auth::guard('dosen')->check()){
            $this->guard('dosen')->logout();
        }

        session()->flush();
        return $this->loggedOut($request) ?: redirect(route('login'));
    }

    
}
