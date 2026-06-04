<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login (email ATAU id_masjid)
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $login = $request->login;

        // LOGIN: email ATAU id_masjid
        if (
            !Auth::attempt([
                'email' => $login,
                'password' => $request->password,
            ]) &&
            !Auth::attempt([
                'id_masjid' => $login,
                'password' => $request->password,
            ])
        ) {
            throw ValidationException::withMessages([
                'login' => 'Login gagal. Email atau ID Masjid salah.',
            ]);
        }

        $request->session()->regenerate();

        return redirect('/');
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}