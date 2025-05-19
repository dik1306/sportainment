<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);


            $user  = User::where('email', $request->email)->first();

            if ($user->is_admin == '1') {
                Auth::login($user);
                return redirect()->intended('admin/dashboard');
            } else {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->regenerate();
                Auth::login($user);
                return redirect()->intended('/');
                }
            } 


            return redirect("login")->withSuccess('Login details are not valid');
        } catch (\Exception $th) {
            // dd($th);
            return redirect("login")->withError($th->getMessage());
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'no_hp' => 'required|unique:users',
            // 'role' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        if ($check) {
            $message = "Kode verifikasi anda adalah " . $check->verification_code;
            $no_wha = $check->no_hp;
            $this->send_verification($no_wha, $message);
        }
        // dd($check);
        

        return redirect("verification")->withSuccess('You have registered successfully. Please verify your number.');
    }

    public function create(array $data)
    {
        try {
            $verification_code = rand(100000, 999999);
            return User::create([
                'name' => $data['name'],
                'no_hp' => $data['no_hp'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'is_admin' => '0',
                'verification_code' => $verification_code,
                'is_verified' => '0'
            ]);
        } catch (\Exception $th) {
            return redirect("register")->withError($th->getMessage());
        }
    }

    public function home()
    {
        if (Auth::check()) {
            return view('index');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function logout()
    {
        session()->flush();
        Auth::logout();
        return Redirect('login');
    }

    public function verification()
    {
        return view('auth.verification');
    }

    public function send_verification($no_wha, $message)
    {
        $dataSending = array();
        $dataSending["api_key"] = "VDSVRW87NW812KD7";
        $dataSending["number_key"] = "EP9028RqdDXPhPix";
        $dataSending["phone_no"] = $no_wha;
        $dataSending["message"] = $message;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($dataSending),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;

    }

    public function verify_post(Request $request)
    {
        try {
            $request->validate([
                'verification_code' => 'required',
            ]);

            $user = User::where('verification_code', $request->verification_code)->first();

            if ($user) {
                $user->update(['is_verified' => '1']);
                return redirect("login")->withSuccess('You have verified successfully.');
            }

            return redirect("verification")->withError('Verification code is not valid.');
        } catch (\Exception $th) {
            return redirect("verification")->withError($th->getMessage());
        }
       
    }

    public function profile()
    {
        $user = Auth::user();
        // dd($user);
        return view('profile.index', compact('user'));
    }

    public function profile_by_id($id)
    {
        $user = User::find($id);
        // dd($user);
        return view('profile.edit', compact('user'));
    }

    public function profile_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find($id);
        $user->update($request->all());

        return redirect("profile")->withSuccess('Profile updated successfully.');
    }
}
