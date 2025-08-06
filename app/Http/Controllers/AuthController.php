<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // FORM LOGIN ADMIN & PERANGKAT
    public function showLoginAdmin()
    {
        return view('login.login_admin');
    }

    // FORM LOGIN WARGA
    public function showLoginWarga()
    {
        return view('auth.login-warga');
    }

    // PROSES LOGIN ADMIN & PERANGKAT
public function loginAdmin(Request $request)
{
    $credentials = $request->validate([
    'email' => 'required|email',
    'password' => 'required|min:6'
]);

    $role = strtolower($request->input('role')); // pastikan lowercase

    // Coba login hanya pakai email + password
    if (Auth::attempt([
        'email' => $credentials['email'],
        'password' => $credentials['password']
    ])) {
        $request->session()->regenerate();

        // Cek apakah role user sama dengan role yang dipilih
        if (Auth::user()->role === $role) {
            // Arahkan ke dashboard sesuai role
            if ($role === 'admin') {
                return redirect('/dashboard/admin')
                    ->with('success', 'Selamat datang di dashboard admin! ' . Auth::user()->name);
            } elseif ($role === 'perangkat') {
                return redirect('/dashboard/perangkat')
                    ->with('success', 'Selamat datang di dashboard perangkat! ' . Auth::user()->name);
            }
        }

        // Kalau role salah
        Auth::logout();
        return back()->with('error', 'Akses ditolak untuk role ' . ucfirst($role) . '.')->onlyInput('email');
    }

    // Kalau email/password salah
    return back()->with('error', 'Email atau password salah.')->onlyInput('email');
}



    // PROSES LOGIN WARGA
    public function loginWarga(Request $request)
    {
        $credentials = $request->validate([
            'nik' => 'required', // login pakai NIK
            'password' => 'required'
        ]);

        if (Auth::attempt(['nik' => $credentials['nik'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'warga') {
                return redirect('/warga');
            }

            Auth::logout();
            return back()->withErrors(['nik' => 'Akses ditolak.']);
        }

        return back()->withErrors(['nik' => 'NIK atau password salah.'])->onlyInput('nik');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
