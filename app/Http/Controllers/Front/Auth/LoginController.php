<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\front\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        parent::__construct();
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('front.auth.login');
    }

    protected function attemptLogin(Request $request): bool
    {
        $credentials = $request->only(['email', 'password']);
        if ($this->guard()->attempt($credentials, $request->get('remember'))) {
            // Authentication passed...
            $user = auth()->user();
            if ($user->is_active == 0) {
                return false;
            }
            // $user['token'] = JWTAuth::fromUser($user);
            session()->put('USER', $user->toArray());
            //            $this->loadPermissions(session()->get('USER')['role_id']);
            return true;
        }
        return false;
    }

    public function redirectTo(): string
    {
        return route('front.home');
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        auth()->logout();
        session()->forget('USER');
        return redirect()->route('login');
    }

    private function loadPermissions($roleId)
    {
        //        session()->put('modules', roles($roleId));
    }

    /**
     * @return string
     */
    public function redirectPath(): string
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/dashboard';
    }
}
