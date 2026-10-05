<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Redirect pengguna ke halaman autentikasi Google.
     */
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback dari Google OAuth.
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)
                ->orWhere('email', $googleUser->email)
                ->first();

            if (! $user) {
                $user = User::create([
                    'name' => $googleUser->name ?? $googleUser->nickname ?? 'Petualang Maro',
                    'email' => strtolower($googleUser->email),
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'role' => 'user',
                ]);
            } else {
                // Update google_id and avatar if missing
                $user->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $user->avatar ?? $googleUser->avatar,
                ]);
            }

            Auth::login($user, true);

            return redirect()->intended(url('/'))->with('success', 'Berhasil masuk dengan Google! Selamat datang, '.$user->name.'.');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'email' => 'Gagal masuk menggunakan Akun Google. Silakan coba lagi atau daftar secara manual.',
            ]);
        }
    }

    /**
     * Proses autentikasi login pengguna.
     */
    public function login(Request $request): RedirectResponse
    {
        // Allow 'admin123' as an ID without strictly requiring email format initially
        $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email atau ID wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $loginField = $request->email;
        if ($loginField === 'admin123') {
            $loginField = 'admin123@maroadventure.com'; // Map ID to email internally
            // Auto-create admin if it doesn't exist
            User::firstOrCreate(
                ['email' => $loginField],
                ['name' => 'Administrator', 'password' => Hash::make('12345678')]
            );
        } elseif ($loginField === 'superadmin123') {
            $loginField = 'superadmin123@maroadventure.com';
            User::firstOrCreate(
                ['email' => $loginField],
                ['name' => 'Super Administrator', 'password' => Hash::make('12345678')]
            );
        }

        $credentials = [
            'email' => $loginField,
            'password' => $request->password,
        ];

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (Auth::user()->email === 'admin123@maroadventure.com') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang di Admin Panel!');
            }
            if (Auth::user()->email === 'superadmin123@maroadventure.com') {
                return redirect()->route('superadmin.dashboard')->with('success', 'Selamat datang di Superadmin Panel!');
            }

            return redirect()->intended(url('/'))->with('success', 'Selamat datang kembali, '.Auth::user()->name.'!');
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan halaman registrasi.
     */
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    /**
     * Proses pendaftaran akun baru.
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain.',
            'phone.required' => 'Nomor HP/WhatsApp wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect()->to(url('/'))->with('success', 'Akun berhasil dibuat! Selamat bergabung bersama Maro Adventure.');
    }

    /**
     * Proses logout pengguna.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to(url('/'))->with('success', 'Anda telah berhasil keluar.');
    }
}
