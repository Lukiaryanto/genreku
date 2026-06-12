<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('login', [
            'title' => 'Login Page',
        ]);
    }

    /**
     * Handle a login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $welcomeMessage = 'Selamat datang kembali, ' . $user->name . '!';

            // Redirect based on role
            switch ($user->role) {
                case \App\Models\User::ROLE_ADMIN:
                    return redirect()->intended(route('admin.dashboard'))->with('success', $welcomeMessage);
                case \App\Models\User::ROLE_JURI:
                    return redirect()->intended('/juri')->with('success', $welcomeMessage);
                case \App\Models\User::ROLE_PESERTA:
                    return redirect()->intended(route('peserta.dashboard'))->with('success', $welcomeMessage);
                case \App\Models\User::ROLE_PIMPINAN:
                    return redirect()->intended(route('pimpinan.ringkasan'))->with('success', $welcomeMessage);
                default:
                    return redirect()->intended('/')->with('success', $welcomeMessage);
            }
        }

        // Authentication failed - always use Bahasa Indonesia message here
        $message = 'Email atau password salah.';

        // Redirect back with old input and a flash error message so the view can show it
        return back()
            ->withInput($request->only('email', 'remember'))
            ->with('error', $message);
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout.');
    }

    /**
     * Show the registration form.
     */
    public function showRegisterForm()
    {
        return view('register', [
            'title' => 'Register Page',
        ]);
    }

    /**
     * Handle registration and create user.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Create user (User model casts password to hashed)
        $user = \App\Models\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => \App\Models\User::ROLE_PESERTA,
        ]);

        // Create an associated Peserta record with minimal placeholder data
        // nama is set to the user's name and umur set to 0 so required integer column is satisfied.
        \App\Models\Peserta::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'tanggal_lahir' => null,
            'alamat' => null,
            'asal_instansi' => null,
            // status_seleksi will use default 'pending' from migration
        ]);

        // Log the user in
        Auth::login($user);

        return redirect()->intended('/peserta')->with('success', 'Registrasi berhasil. Selamat datang!');
    }
}
