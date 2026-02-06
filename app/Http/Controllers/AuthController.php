<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $correctPin = '09092009';
    private $attempts = 0;
    private $errorMessages = [
        1 => "Pin salah cantik",
        2 => "Pin nya masih salah cantik",
        3 => "Coba pakai tanggal lahir kamu"
    ];

    public function showLogin()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $pin = $request->input('pin');
        $username = $request->input('username');

        Session::put('username', $username);

        if ($pin === $this->correctPin) {
            Session::put('authenticated', true);
            Session::forget('login_attempts');
            return response()->json([
                'success' => true,
                'redirect' => route('loading')
            ]);
        }

        $attempts = Session::get('login_attempts', 0) + 1;
        Session::put('login_attempts', $attempts);

        $messageIndex = min($attempts, count($this->errorMessages));
        $message = $this->errorMessages[$messageIndex] ?? "Coba lagi ya...";

        return response()->json([
            'success' => false,
            'message' => $message,
            'attempts' => $attempts
        ]);
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('welcome');
    }
}
