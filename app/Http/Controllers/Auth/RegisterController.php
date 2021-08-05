<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

    public function register(Request $request)
    {
        // dd($request->all());

        $this->validator($request->all())->validate();
        $image= null;
        if($request->hasFile('image')){

            $img = $request->image;
            $filename= $img->getClientOriginalName();
            $image = Storage::putFileAs('/public/images', $request->file('image'), $filename);

        }
        // dd($image);
        $this->create(array_merge($request->all(), ['image' => $image]));


        return response()->json(['success'=> true, 'message'=>'user registration succesfully',],200);
    }

    /**
     * Where to redirect users after registration.
     *
     *
     *
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
        return Validator::make($data, [
            'image' =>['nullable'],
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'company_name' => ['nullable'],
            'mobile_no' =>['nullable','digits:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        return User::create([
            'image'=> $data['image'],
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'company_name'=>$data['company_name'],
            'mobile_no'=>$data['mobile_no'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
