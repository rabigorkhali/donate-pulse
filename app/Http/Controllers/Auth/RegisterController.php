<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\RegisterRequest;
use App\Mail\NewUserRegistrationEmail;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

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
    protected $redirectTo = '/system/dashboard';

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
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegistrationForm()
    {
        return view('backend.public.auth.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function register(RegisterRequest $request)
    {
        try {
            $data = $request->all();
            $password = uniqid();
            $insertData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => 2,
                'image' => 'https://via.placeholder.com/640x480.png/00aabb?text=people+Faker+earum',
                'password' => $password,
            ];
            DB::beginTransaction();
            $response = User::create($insertData);
            if ($response) {
                Mail::to($data['email'])->send(new NewUserRegistrationEmail($data));

            }
            Session::flash('success', 'Success. Please check your email to get your password.');
            DB::commit();
            return redirect()->route('login');
        } catch (\Throwable $th) {
            DB::rollback();
            Session::flash('error', 'Please try again later.');
            return redirect()->route('register');
        }
    }
}
