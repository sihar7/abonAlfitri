<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Role;

class AuthController extends Controller
{
    function index()
    {
        return view('auth.login');
    }

    function register()
    {

        return view('auth.register');
    }

    function postLogin(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        
        $email    = $request->email;
        $password = $request->password;


        $validator = Validator::make($request->all(), ['email' => 'required|email']);
       
        if ($validator->fails() ) {
            return response()->json(['message' => 6], 202);
            //validate gagal
        }
        
        $remember_me  = ( !empty( $request->remember_me ) )? TRUE : FALSE;

        try {
            if (Auth::attempt( [ 'email' => $email, 'password' => $password ]) ) {
                $cek_user       = User::whereEmail($email)->first();
                $is_active      = $cek_user->is_active;
                $alredy_login   = $cek_user->alredy_login;
                
                $newToken = $this->generateRandomString();

                if ($alredy_login == 0 || $alredy_login == null) {
                    if ($request->user()->hasRole('admin')) {
                        $user                 = User::cekEmail($email);
                        $user->alredy_login   = 1;
                        $user->api_token      = 'USER_TOKEN_'.$newToken;
                        $user->last_login     = now();
                        $user->save();

                        Auth::login($cek_user, $remember_me);
                        
                        return response()->json(['message' => 1], 201);
                        //Sukses Login Admin
                    } else if( $request->user()->hasRole('user') ) {
                        $user                 = User::cekEmail($email);
                        $user->alredy_login   = 1;
                        $user->api_token      = 'USER_TOKEN_'.$newToken;
                        $user->last_login     = now();
                        $user->save();
                        Auth::login($cek_user, $remember_me);
                        
                        return response()->json(['message' => 2], 201);
                        //Sukses Login User
                    }
                } elseif ($alredy_login == 1) {
                    if ($request->user()->hasRole('admin')) {
                        // ini kondisikalo user login terus maumasuklagi jadiga alredy login
                        return response()->json(['message' => 7], 201);
                    } else if($request->user()->hasRole('user')){
                        return response()->json(['message' => 8], 201);
                    } else {
                        return response()->json(['message' => 3], 202);
                        //User Sedang Login
                    }
                } else if ($is_active == null || $is_active == 0) {
                    return response()->json(['message' => 4], 202);
                    //User sudah tidak aktif
                } 
                
            } else {
                return response()->json(['message' => 5], 202);
                //Username atau password salah
            }
        } catch (\Exception $e) {
            return response()->json([ 'error' => $e->getMessage() ]);
        }
    }

    function postRegister(Request $request)
    {
        
        $newToken = $this->generateRandomString();
        if ($request->password == $request->confirm_password) {
            $cek_email = User::whereEmail($request->email)->count();
            if ($cek_email == 0) {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->api_token = 'USER_TOKEN_'.$newToken;
                $user->is_active = 0;
                $user->avatar = 'default.png';
                $user->alredy_login = 0;
                $user->last_login = null;
                $user->save();

                $user->roles()->attach(Role::where('name', 'user')->first());
                return response()->json(['status' => 1], 201);
                // Berhasil
            } else {
                
                return response()->json(['status' => 2], 201);
                // Email Telah Digunakan
            }
       } else {
            return response()->json(['status' => 3], 201);
            // Password Tidak Sama
       }
    }

    function logout()
    {
        $user = User::whereId(Auth::id())->first();
        $user->alredy_login = 0;
        $user->save();

        Auth::logout();

        return redirect('/');
    }

    function generateRandomString($length = 80)
    {
        $karakkter = '012345678dssd9abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $panjang_karakter = strlen($karakkter);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $karakkter[rand(0, $panjang_karakter - 1)];
        }
        return $str;
    }
}
