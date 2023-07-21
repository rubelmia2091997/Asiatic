<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('backend.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(Request $request)
    // {
    //     if(!is_null($request->name)){
    //         $request->validate([
    //             'name' => ['string', 'max:255'],
    //         ]);
    //         auth()->user()->name = $request->name;
    //     }
    //     if(!is_null($request->email)){
    //         $request->validate([
    //             'email' => ['email', 'max:255', 'unique:users'],
    //         ]);
    //         auth()->user()->name = $request->email;
    //     }
    //     if($request->hasFile('profile_picture')){
    //         $request->validate([
    //             'profile_picture' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
    //         ]);
    //         $image = $request->file('profile_picture');
    //         $filename = time().mt_rand(10,10000).'.'.$image->getClientOriginalExtension();
    //         Storage::disk('public')->put('profile_picture/'.$filename, File::get($image));
    //         auth()->user()->profile_picture_path = $filename;
    //     }

    //     auth()->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
