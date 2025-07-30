<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class FrontendAccountController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $user = Auth::user();
        $user = auth()->user();
        // Load orders with their items and related medicines
        $orders = $user->orders()->with(['items.medicine'])->latest()->get();
        return view('frontend.account', compact('user','categories','orders'));
    }
}
