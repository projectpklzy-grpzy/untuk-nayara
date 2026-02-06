<?php
// app/Http/Controllers/ExperienceController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Message;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    public function welcome()
    {
        return view('pages.welcome');
    }

    public function loading()
    {
        if (!session('authenticated')) {
            return redirect()->route('login');
        }

        $romanticMessages = [
            "Menyiapkan kejutan untukmu...",
            "Memuat momen-momen indah...",
            "Menyusun kata-kata dari hati...",
            "Hampir siap, sayang...",
            "Semua ini khusus untukmu..."
        ];

        return view('pages.loading', [
            'messages' => $romanticMessages
        ]);
    }

    public function romanticLetter()
    {
        if (!session('authenticated')) {
            return redirect()->route('login');
        }

        return view('pages.romantic-letter');
    }

    public function photoLoading()
    {
        if (!session('authenticated')) {
            return redirect()->route('login');
        }

        return view('pages.photo-loading');
    }

    public function quiz()
    {
        if (!session('authenticated')) {
            return redirect()->route('login');
        }

        $questions = [
            [
                'question' => 'Apakah kamu tahu siapa yang membuat website lucu ini? Apa ini sial nama orangnya?',
                'options' => ['A', 'F', 'Z', 'R'],
                'answer' => 1
            ],
            [
                'question' => 'Mana yang termasuk huruf vokal?',
                'options' => ['M', 'N', 'I', 'S'],
                'answer' => 2
            ],
            [
                'question' => 'Urutan ke 5 sesudah huruf O',
                'options' => ['J', 'L', 'A', 'O'],
                'answer' => 0
            ],
            [
                'question' => 'Huruf vokal di nama depan kamu',
                'options' => ['A', 'I', 'U', 'E', 'O'],
                'answer' => 0 // Semua benar
            ],
            [
                'question' => 'Sebutkan huruf belakang dari nama orang paling keren se Batujajar',
                'options' => ['I', 'S', 'N', 'M'],
                'answer' => 2
            ]
        ];

        return view('pages.quiz', ['questions' => $questions]);
    }

    public function uploadPhoto(Request $request)
    {
        if (!session('authenticated')) {
            return redirect()->route('login');
        }

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('photo')->store('photos', 'public');

        Photo::create(['photo_path' => $path]);

        return response()->json([
            'success' => true,
            'path' => Storage::url($path)
        ]);
    }

    public function showUpload()
    {
        if (!session('authenticated')) {
            return redirect()->route('login');
        }

        return view('pages.upload');
    }

    public function showLetter()
    {
        if (!session('authenticated')) {
            return redirect()->route('login');
        }

        return view('pages.letter');
    }

    public function submitLetter(Request $request)
    {
        if (!session('authenticated')) {
            return redirect()->route('login');
        }

        $request->validate([
            'message' => 'required|min:10|max:1000'
        ]);

        Message::create(['message' => $request->message]);

        return response()->json(['success' => true]);
    }

    public function closing()
    {
        if (!session('authenticated')) {
            return redirect()->route('login');
        }

        $photo = Photo::latest()->first();
        $message = Message::latest()->first();

        return view('pages.closing', [
            'photo' => $photo,
            'message' => $message,
            'username' => session('username')
        ]);
    }
}
