@extends('layouts.app')

@section('content')
<div class="romantic-card max-w-md mx-auto" data-animate="slide-up" style="background-image: url('{{ asset('images/bg/background-popup.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="text-center mb-8">
        <div style="font-size: 3rem; margin-bottom: 1rem; animation: float 3s infinite ease-in-out;"><img src="{{ asset('icons/kunci.png') }}" style="width: 30%; height: 30%; object-fit: contain;"></div>
        <h2 class="text-3xl font-light mb-2" style="color: var(--pink-main); -webkit-text-stroke: 0.5px rgba(58, 58, 58, 0.3); text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">
            Akses Khusus
        </h2>
        <p class="text-grey-dark opacity-75" style="-webkit-text-stroke: 0.3px rgba(58, 58, 58, 0.2); text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1);">
            Hanya untuk <span class="font-semibold" style="color: var(--pink-main); -webkit-text-stroke: 0.4px rgba(58, 58, 58, 0.3);">{{ session('username') ?? 'seseorang yang spesial' }}</span>
        </p>
    </div>
    
    <form method="POST" action="{{ route('login') }}" onsubmit="handleLogin(event)" id="loginForm">
        @csrf
        
        <div class="mb-6">
            <label for="username" class="block mb-2 text-sm font-medium" style="color: var(--grey-dark);">👤 Nama Kamu</label>
            <input type="text" 
                   id="username" 
                   name="username" 
                   class="romantic-input" 
                   placeholder="Masukkan nama lengkapmu"
                   required
                   autocomplete="name"
                   value="{{ session('username') ?? '' }}">
        </div>
        
        <div class="mb-8">
            <label for="pin" class="block mb-2 text-sm font-medium" style="color: var(--grey-dark);">🔐 PIN Rahasia</label>
            <input type="password" 
                   id="pin" 
                   name="pin" 
                   class="romantic-input" 
                   placeholder="••••••••"
                   maxlength="8"
                   pattern="\d{8}"
                   autocomplete="off"
                   required>
            <p class="text-sm opacity-75 mt-2" style="color: var(--grey-dark);">
                
            </p>
        </div>
        
        <button type="submit" class="romantic-btn w-full">
            Masuk ke halaman khusus kamu ✨
        </button>
    </form>
</div>

<div class="text-center mt-6">
    <a href="{{ route('welcome') }}" 
       data-transition
       style="color: var(--pink-main); text-decoration: none; font-weight: 500; transition: all 0.3s ease;"
       onmouseover="this.style.textDecoration='underline'"
       onmouseout="this.style.textDecoration='none'">
        ← Kembali ke Halaman Utama
    </a>
</div>
@endsection