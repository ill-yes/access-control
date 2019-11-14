<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function get()
    {
        $user = Auth::user();

        return view('users.profile', [
            'user' => $user
        ]);
    }

    public function setPin(Request $request)
    {
        $this->validate($request, [
            'newPin' => ['required', 'int', 'digits:4']
        ]);

        User::where('id', Auth::user()->id)->update([
            'pin' => $request->newPin
        ]);

        return redirect()->back();
    }
}
