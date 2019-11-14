<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $uid = $request->get('uid');

        if (is_null(User::where('card_number', $uid)->first())) {
            do {
                $pin = mt_rand(1000, 9999);
            } while (!is_null(User::where('pin', $pin)->first()));

            $data['pin'] = $pin;

            $user = User::create([
                'name' => $uid,
                'email' => $uid . '@acc.ess',
                'password' => Hash::make('abcD123!'),
                'pin' => $data['pin'],
                'card_number' => $uid
            ]);

            return response()->json(['user_id' => $user->id, 'pin' => $user->pin], 201);
        }

        return response()->json(['error' => 'Nutzer ist bereits vorhanden.'], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $uid = $request->get('uid');

        $user = User::where('card_number', $uid)->first();

        if (is_null($user)) {
            return response()->json(['error' => 'Karte nicht bekannt.'], 404);
        }

        if ($user->fails >= 3) {
            return response()->json(['error' => 'Der Benutzer ist gesperrt.'], 403);
        }

        return response()->json(['user_id' => $user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        $user_id = $request->get('user_id');
        $pin = $request->get('pin');

        $user = User::where('id', $user_id)->first();

        if (is_null($user)) {
            return response()->json(['error' => 'Der Benutzer konnte nicht gefunden werden!'], 404);
        }

        if ($user->fails >= 3) {
            return response()->json(['error' => 'Der Benutzer ist gesperrt.'], 403);
        }

        if ($pin !== $user->pin) {
            $user->update(['fails' => $user->fails + 1]);
            return response()->json(['error' => 'Die Pin ist nicht korrekt.'], 403);
        }

        $user->update(['last_seen' => now()]);

        return response()->json(['text' => 'Herzlich willkommen ' . $user->name . '!'], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
