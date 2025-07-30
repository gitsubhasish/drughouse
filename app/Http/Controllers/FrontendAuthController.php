<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class FrontendAuthController extends Controller
{
    public function showLogin(Request $request)
    {
        $categories = Category::all();
        return view('frontend.auth.login', [
            'redirectTo' => $request->query('redirect_to', '/'),
            'categories' => $categories
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string', // email or phone
            'password' => 'required|string',
        ]);

        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$login_type => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended(session('url.intended') ?? route('home'));
        }

        return back()->withErrors([
            'login' => 'Invalid credentials.',
        ]);



        /*$request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$login_type => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();

            // Laravel handles redirecting to the intended URL automatically
            return redirect()->intended(); // ✅ This is enough
        }

        return back()->withErrors([
            'login' => 'Invalid credentials.',
        ]);*/
    }

    public function showRegister(Request $request)
    {
        $categories = Category::all();
        return view('frontend.auth.register', [
            'redirectTo' => $request->query('redirect_to', '/'),
            'categories' => $categories
        ]);
    }

    public function register(Request $request)
    {
         $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_admin' => 0
        ]);

        Auth::login($user);

        return redirect($request->input('redirect_to', '/'));
    }

    public function index()
    {
        $user = Auth::user();
        return view('frontend.account', compact('user'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
