<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function myAccount()
    {
        $user = auth()->user();
        $orders = $user->orders()->latest()->get();

        return view('account.my-account', compact('user', 'orders'));
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
        ]);

        $user = auth()->user();
        $user->update($request->only('address', 'city', 'state', 'zip'));

        return redirect()->route('frontend.my-account')->with('success', 'Address updated successfully.');
    }

    public function sendResetLink(Request $request)
    {
        $user = auth()->user();

        $status = Password::sendResetLink(['email' => $user->email]);

        return redirect()->route('frontend.my-account')->with(
            $status === Password::RESET_LINK_SENT
                ? ['success' => 'Password reset link sent to your email.']
                : ['error' => 'Failed to send password reset link.']
        );
    }
}