<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;

class SettingController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(
            Auth::id()
        );

        if ($user->role !== 'admin') {
            abort(403);
        }

        return view(
            'admin.settings.index',
            compact('user')
        );
    }


    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(
            Auth::id()
        );

        if ($user->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        $photoPath =
            $user->profile_photo;

        if ($request->hasFile('profile_photo')) {

            if ($photoPath) {
                Storage::disk('public')
                    ->delete($photoPath);
            }

            $photoPath =
                $request
                ->file('profile_photo')
                ->store(
                    'profiles',
                    'public'
                );
        }

        $user->update([
            'name' =>
            $validated['name'],

            'email' =>
            $validated['email'],

            'phone' =>
            $validated['phone']
                ?? null,

            'profile_photo' =>
            $photoPath,
        ]);

        return back()
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }


    public function updatePreferences(Request $request)
    {
        $user = User::findOrFail(
            Auth::id()
        );

        if ($user->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'language' => [
                'required',
                'in:id,en',
            ],

            'theme' => [
                'required',
                'in:light,dark',
            ],
        ]);

        $user->update([
            'language' =>
            $validated['language'],

            'theme' =>
            $validated['theme'],
        ]);

        return back()
            ->with(
                'success',
                'Preferensi berhasil diperbarui.'
            );
    }


    public function updatePassword(Request $request)
    {
        $user = User::findOrFail(
            Auth::id()
        );

        if ($user->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user->update([
            'password' =>
            Hash::make(
                $validated['password']
            ),
        ]);

        return back()
            ->with(
                'success',
                'Password berhasil diperbarui.'
            );
    }
}
