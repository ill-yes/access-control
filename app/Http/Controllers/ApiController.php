<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
                'email' => $uid . '@null.de',
                'password' => Hash::make('abcD123!'),
                'pin' => $data['pin'],
                'card_number' => $uid
            ]);

            return response()->json(['user_id' => $user->id]);
        }

        return response()->json(['error' => 'Nutzer ist bereits vorhanden.']);
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
            return response()->json(['error' => 'Karte nicht bekannt.']);
        }

        return response()->json(['user_id' => $user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function auth(User $user)
    {
        if (is_null($user)) {
            return response()->json(['error' => 'Karte nicht bekannt.']);
        }

        return response()->json(['user_id' => $user->id]);
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
