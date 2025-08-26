<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
//resim yükle

  //bildirim
        $mesaj = array(
            "bildirim" =>"güncelleme başarılı",
            "alert-type " => "success"
        );

        $id = Auth::user()->id;
        $bilgi = User::find($id);
        if($request->file('resim')){
            $resim = $request->file('resim');
            $resimadi = date('ymdhi').$resim->getClientOriginalName();
            $resim->move(public_path("upload/admin").$resimadi);
            $bilgi['resim'] = $resimadi;
        }
        $bilgi->save();

        $request->user()->save();

         Auth::logout();

    // Login sayfasına yönlendir ve mesaj gönder
        return Redirect::to('/login')->with('status', 'Güncelleme başarılı, lütfen tekrar giriş yapın.');
        }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

          //bildirim
        $mesaj = array(
            "bildirim" =>"hesap kalıcı olarak silindi",
            "alert-type " => "error"
        );

        return Redirect::to('/login')->with($mesaj);
    }

}
