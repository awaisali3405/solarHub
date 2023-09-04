<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string', 'max:12', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data): User
    {
        // dd($data);
        $this->validator($data);


        if (isset($data['img'])) {
            // dd($data['img']);
            $data['img'] = $this->saveImage($data['img'], $data['img']);
        }

        return User::create([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'img' => $data['img'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);


    }

    public function showRegistrationForm()
    {
        return view('front.auth.register');
    }
    public function saveImage($image, $img)
    {
        $ext = $image->getClientOriginalExtension();
        $ext = strtolower($ext);
        if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'svg' || $ext == 'webp') {
            if (!is_null($img)) {
                $path = public_path($img);
                if (is_file($path)) {
                    unlink($path);
                }
            }
            $path = 'assets/front/talors/';

            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $i = $image->move($path, $profileImage);
            // dd($path.$profileImage);
            return $path . $profileImage;
        }
    }
}
