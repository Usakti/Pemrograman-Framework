<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AutentikasiController extends Controller
{
    public function index() {
        return view('login');
    }

    public function register(Request $request) {
        $success = false;
        try {
            DB::beginTransaction();
            // saving data to database
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();
            logger()->error('Ada masalah ketika menambahkan data user: '. $e->getMessage());
        }

        if($success) {
            return redirect()->route('loginPage')->with('success', 'Akun berhasil ditambahkan');
        } else {
            return back()->with('error', 'Oops, email sudah terdaftar');
        }
    }

    public function login(Request $request) {
        // dd($request->all());
        $data = User::where('email', $request->email)->firstOrFail();

        if($data) {
            if(Hash::check($request->pass, $data->password)) {
                session(['user' => $data->id]);
                session(['nama' => $data->name]);
                return redirect()->route('index')->with('message', 'Anda Berhasil Login');
            } else {
                return redirect()->route('loginPage')->with('message', 'Password salah');
            }
        } else {
            return redirect()->route('loginPage')->with('message', 'Email dan password salah');
        }
    }
    public function logout(Request $request) {
        $request -> session()->flush();
        return redirect()->route('loginPage');
    }
}