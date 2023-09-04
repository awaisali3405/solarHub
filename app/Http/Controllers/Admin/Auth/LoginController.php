<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
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
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admins')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * @param Request $request
     * @return bool
     */
    protected function attemptLogin(Request $request): bool
    {
        $credentials = $request->only(['email', 'password']);
        if ($this->guard()->attempt($credentials, $request->get('remember'))) {
            // Authentication passed...
            $admin = auth('admins')->user();
            // $admin['role'] = Role::select('name')->firstOrFail($admin->role_id)->name;
            // $admin['token'] = JWTAuth::fromUser($admin);
            session()->put('ADMIN', $admin->toArray());
            // $this->loadPermissions($admin->role_id);
            return true;
        }
        return false;
    }

    public function redirectTo(): string
    {
        return route('admin.dashboard.index');
    }

    protected function guard()
    {
        return Auth::guard('admins');
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        auth('admins')->logout();
        session()->forget('ADMIN');
        return redirect()->route('admin.login');
    }



    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/admin/dashboard';
    }
}
