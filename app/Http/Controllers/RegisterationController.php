<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterationController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','min:8']
        ]);
        $user = User::create([
            "email" => $request->email,
            'password' => $request->password,
        ]);
        return [
            "status" => "🎉 🍾 Registeration Successful 🎉 🍾",
            "token" => $user->createToken("sultantodo".\Illuminate\Support\Str::random(6))->plainTextToken,
            "token_type" => "Bearer",
            "message" => "Ensure to store this token somewhere prying eyes won't see !🤣🤣🤣🤣! "
            ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
