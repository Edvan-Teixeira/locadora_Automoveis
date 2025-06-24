<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm() {
        return view('pages.account.register');
    }

    public function register(Request $request) {
        // fluxo em um metodo de controller do metodo post:
        // 1 - receber os dados do formulario
        // 2 - validar os dados
        // 3 - criar o usuario
        // 4 - redirecionar a pagina de login

        // 1 e 2 - recebendo e validando os dados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 3 - criando o usuario
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // 4 - redirecionar a pagina de login
        return redirect()->route('login');
    }

    public function showLoginForm() {
        return view('pages.account.login');
    }

    public function authenticate(Request $request): RedirectResponse {
        // Fluxo de login
        // 1 - receber os dados do formulario
        // 2 - validar os dados
        // 3 - autenticar o usuario
        // 4 - redirecionar a pagina desejada

        // 1 e 2 - recebendo e validando os dados
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->filled('remember');

        if(User::where('email', $credentials['email'])->doesntExist()) {
            return back()
                ->withErrors(['email' => 'Nenhuma conta cadastrada com esse email foi encontrada.'])
                ->withInput($request->only('email'));
        }

        // 3 - autenticar o usuario
        if(Auth::attempt($credentials, $remember)) {
            // 4 - redirecionar a pagina de home
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()
            ->withErrors(['email' => 'Email ou senha incorretos.'])
            ->withInput($request->only('email', 'remember'));

    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
