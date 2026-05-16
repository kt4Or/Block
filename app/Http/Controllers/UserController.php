<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', 'Регистрация пройдена');
        Auth::login($user);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function loginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
       $request->validate([
        'email' => 'required|email',
        'password' => 'required',
       ]);

       if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password,
       ])){
        session()->flash('success', 'You are logged');
        if (Auth::user()->is_admin){
            return redirect()->route('admin.index');
        } else {
            return redirect()->route('home');
        }

       }

       return redirect()->back()->with('error', 'Incorrect login or password daun');
    }

    public function logout(){
        return redirect()->route('login.create');
    }
}
