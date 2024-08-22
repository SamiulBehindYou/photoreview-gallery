<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class accountController extends Controller
{
    public function register(){
        return view('account.register');
    }

    public function processRegister(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->route('account.register')->withInput()->witherrors($validator);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('account.login')->with('success', 'You have registered successfully!');

    }
    public function login(){
        return view('account.login');
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if($validator->fails()){
            return redirect()->route('account.login')->withInput()->witherrors($validator);
        }

        if (Auth::attempt([
            'email'=> $request->email,
            'password'=> $request->password,
        ])){
            return redirect()->route('account.profile')->with('success', 'You are successfully logged in!');

        } else {
            return redirect()->route('account.login')->with('error', 'Either email/password incorrect');
        }
    }

    public function profile(){
        return view('account.profile');
    }

    public function updateprofile(Request $request){
        $rules = [
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.Auth::user()->id.',id'
        ];

        if(!empty($request->image)) {
            $rules['image'] = 'image';
        }


        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('account.profile')->withInput()->withErrors($validator);
        }

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // image updaete
        if(!empty($request->image)){

            File::delete('uploads/profile/'.Auth::User()->image);
            File::delete('uploads/profile/thumb/'.Auth::User()->image);


            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
            $image->move(public_path('uploads/profile'),$imageName);
            $user->image = $imageName;
            $user->save();

            // create new image instance
            $manager = new ImageManager(Driver::class);
            $img = $manager->read(public_path('uploads/profile/'.$imageName)); // 800 x 600

            $img->cover(150, 150);
            $img->save(public_path('uploads/profile/thumb/'.$imageName));
        }
        return redirect()->route('account.profile')->with('success', 'Profile successfully updated!');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
    }

}
