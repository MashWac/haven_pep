<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\userDetailsModel;
use Illuminate\Http\Request;

use function Symfony\Component\String\u;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('client.login');
    }
    public function loginUser(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        $user = userDetailsModel::where('email_address', $request->email)->first();
        if (!$user || !password_verify($request->password, $user->password)) {
            return redirect('/login')->withErrors(['Invalid credentials provided.']);
        }
        session(['user_id' => $user->id, 'user_name' => $user->full_name, 'user_email' => $user->email_address, 'user_type' => $user->user_type, 'user_phone' => $user->phone_number,'user_logged_in' => true]);
        if ($user->user_type == 1) {
            return redirect('/admin_dashboard')->with('success', 'Login successful!');
        }

        return redirect('/')->with('success', 'Login successful!');
    }
    public function register()
    {
        return view('client.register');
    }

    public function registerUser(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'country_code' => 'required|string|max:5',
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Here you would typically create the user in the database
        $user = new userDetailsModel();
        $user->full_name = $request->name;
        $user->email_address = $request->email;
        $user->phone_number = $request->country_code . $request->phone_number;
        $password = bcrypt($request->password);
        $user->password = $password;
        $user->user_type = 2;
        $user->save();

        // For now, just return a success message
        return redirect('/login')->with('success', 'Registration successful! Please log in.');
    }
    public function logoutUser()
    {
        session()->flush();
        return redirect('/')->with('success', 'Logged out successfully.');
    }
    public function passwordReset()
    {
        return view('client.forgot_pass');
    }
    public function sendPasswordResetLink(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
        ]);

        $user= userDetailsModel::where('email_address', $request->email)->first();
        if (!$user) {
            return redirect('/password_reset')->withErrors(['Email address not found.']);
        }
        $generatedToken = u(sha1(time() . $request->email))->slice(0, 40);
        $encodedToken = base64_encode($generatedToken);
        $user->password_reset_token = $encodedToken;
        $user->token_created_at = now();
        $user->update();
        // Here you would typically send the password reset link via email
        // For now, just return a success message

        return redirect('/login')->with('success', 'Password reset link sent to your email.');
    }
    public function passwordResetForm($token)
    {
        return view('client.reset_pass', ['token' => $token]);
    }
}
