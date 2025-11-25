<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class RequestResetPassword extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate(["email" => "required|email"]);

        $user = $request->user();

        if ($user->email !== $validated["email"]) {
            return back()
                ->withErrors([
                    "email" =>
                        "The provided credentials do not match our records.",
                ])
                ->onlyInput("email");
        }

        $token = Password::createToken($user);

        return redirect("/reset-password/$token");
    }
}
