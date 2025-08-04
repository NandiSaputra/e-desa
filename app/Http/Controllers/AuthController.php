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
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role dan arahkan ke dashboard sesuai role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard.admin')->with('success', "Selamat datang di Dashboard". Auth::user()->role. "!");
            } elseif (Auth::user()->role === 'perangkat') {
                return redirect()->route('dashboard.perangkat')->with('success', "Selamat datang di Dashboard". Auth::user()->role."!");
            }

            Auth::logout();
            return back()->with('error', 'Email ditolak karena bukan admin atau perangkat.');
        }

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
