<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // validasi dasar nama + email
        $rules = [
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255', Rule::unique('users')->ignore($user->id)],
        ];

        // hanya tambahkan validasi password jika user isi field password baru
        if ($request->filled('current_password') || $request->filled('password') || $request->filled('password_confirmation')) {
            $rules['current_password'] = ['required', 'string'];
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        $validated = $request->validate($rules);

        // jika user ingin mengubah password: cek current_password benar
        if ($request->filled('password')) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai'])->withInput();
            }

            $user->password = Hash::make($request->input('password'));
        }

        // jika email berubah, set email_verified_at ke null (jika kamu memakai verifikasi email)
        if ($request->input('email') !== $user->email) {
            $user->email = $request->input('email');
            // jika menggunakan fitur email verification, reset verified flag:
            if (property_exists($user, 'email_verified_at') || array_key_exists('email_verified_at', $user->getAttributes())) {
                $user->email_verified_at = null;
                // optionally: dispatch email verification notification
                // $user->sendEmailVerificationNotification();
            }
        }

        $user->name = $request->input('name');
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
