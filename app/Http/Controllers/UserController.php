<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }
    public function registration()
    {
        return view('registration');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => ['nullable', 'string', 'min:10'],
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/', $filename);

        }

        $data = $request->all();
        $data['image'] = $filename;
        $check = $this->create($data);
        $check->save();
        return redirect("dashboard")->withSuccess('You have signed-in');
    }
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'image' => $data['image'],
        ]);
    }
    public function dashboard()
    {
        if (Auth::check()) {
            $user = DB::table('users')->orderBy('id','desc')->paginate(3);
            return view('listuser', compact('user'));
        }

        return redirect('login')->withSuccess('You are not allowed to access');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $path = 'assets/uploads/' . $user->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $user->delete();
        return redirect('dashboard');
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('profile', compact('user'));
    }

    public function editlayout($id){
        $user = User::findOrFail($id);
        return view('profile-edit', compact('user'));
    }

    public function edit($id, Request $request)
    {
        $user = User::findOrFail($id);
        if ($request->hasFile('image')) {
            $path = 'assets/uploads/' . $user->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/uploads/', $filename);
            $user->image = $filename;
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // $user->password = $request->input('password');
        $user->phone = $request->input('phone');
        // dd($user);
        $user->update();
        return redirect('dashboard')->with('message','Edit Account Successful !');
    }
}
