<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Http\Request;
use App\Models\Admin;

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
       // $this->middleware('auth')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(AuthLoginRequest $request)
    {
       
        $user   = Admin::where('nip',$request->username)->first();
       
        if(!isset($user)){
            return redirect()->route('login')->with(['error' => 'Username/Password salah!']);
        }
       
        $credentials = [
            'nip'       => $request->username,
            'password'  => $request->password,
            'status'    => '1'
        ];

    
        if(auth()->guard('admin')->attempt($credentials)){
            return redirect()->intended('/');
        }elseif(auth()->guard('dosen')->attempt($credentials)){
            return redirect()->intended('/');
        }else {
           // return $credentials;
            return redirect()
                ->intended('login')
                ->withInput()
                ->withErrors(["Incorrect user login details!"]);
        }
    }

    public function logout(Request $request)
    {
        $this->guard('admin')->logout();
        session()->flush();
        return $this->loggedOut($request) ?: redirect(route('login'));
    }
}
