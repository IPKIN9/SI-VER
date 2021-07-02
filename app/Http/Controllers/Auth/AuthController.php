<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function check(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect(route('ds.index'));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    public function regist_view()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $data = array(
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        );
        DB::table('users')->insert($data);

        return redirect(route('login'))->with('status', 'Pendaftaran berhasil dilakukan');
    }
}
