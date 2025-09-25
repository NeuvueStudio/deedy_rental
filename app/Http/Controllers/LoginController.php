<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('failed', 'Invalid credentials.');
        }

        // Store user ID in session
        session(['custom_auth_user' => $user->id, 'user_type' => $user->name]);

        return redirect()->route('dashboard')->with('success', 'Logged in successfully.');
    }
    public function showRegister()
    {
        return view('admin.pages.auth.register');
    }
    /**
     * Display the specified resource.
     */
    public function register(Request $request)
    {
        // 1. Validate input
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', // expects password_confirmation
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        // 2. Create user
        $user = User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Optionally generate token (for API)
        // $token = $user->createToken('API Token')->plainTextToken;

        return redirect()->back()->with('success', 'User registered successfully');
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
}
