<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('users.index', ['users' => User::all()]);
    }

    public function setUserPin(Request $request)
    {
        $this->validate($request, [
            'userId' => ['required', 'int'],
            'newPin' => ['required', 'int', 'digits:4']
        ]);

        User::where('id',$request->userId)->update([
            'pin' => $request->newPin
        ]);

        return redirect()->back();
    }

    public function setAccountState(Request $request)
    {
        $this->validate($request, [
            'userId' => ['required', 'int'],
            'accountState' => ['required', 'string']
        ]);


        if ($request->accountState == "Enabled")
        {
            User::where('id',$request->userId)->update([
                'fails' => 0
            ]);
        }
        else{
            User::where('id',$request->userId)->update([
                'fails' => 3
            ]);
        }

        return redirect()->back();
    }
    
    

    public function show(User $user)
    {
        dd($user);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        do {
            $pin = mt_rand(1000, 9999);
            } while (!is_null(User::where('pin', $pin)->first()));

        $data['pin'] = $pin;

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'pin' => $data['pin']
        ]);

        session()->flash('success', 'Der Benutzer '.$user->name.' wurde erfolgreich erstellt!');
        return redirect()->route('users.show', $user);
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
