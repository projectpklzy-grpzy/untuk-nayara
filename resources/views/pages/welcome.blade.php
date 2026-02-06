@extends('layouts.app')

@section('content')
<div class="romantic-card text-center" data-animate="fade-in">
    <div class="mb-8">
        <h1 class="text-4xl font-light mb-4" style="color: var(--pink-main); opacity: 0; animation: fadeIn 1s ease-out 0.3s forwards;">
            Untuk Kamu yang Spesial <img src="{{ asset('icons/pita.png') }}" style="width: 15%; height: 15%; object-fit: contain;">
        </h1>
        <div style="width: 60px; height: 3px; background: linear-gradient(90deg, transparent, var(--pink-main), transparent); margin: 0 auto; opacity: 0; animation: fadeIn 0.8s ease-out 1s forwards;"></div>
    </div>
    
    <div class="space-y-6 mb-8">
        @php
            $messages = [
                "Setiap detik bersamamu adalah anugerah, karna aku belum bisa...",
                "Senyummu adalah cahaya terindah dalam hariku, walaupun jarang lihat...",
                "Terima kasih sudah menjadi cerita di hidupku...",
                "Kamu membuat dunia lebih berarti...",
                "Aku bersyukur bisa suka sama kamu...   semoga kamu ga sambil muntah bacanya" 
            ];
        @endphp
        
        @foreach($messages as $index => $message)
            <p class="text-lg" 
               style="opacity: 0; animation: fadeIn 0.8s ease-out {{ $index * 0.4 + 1.5 }}s forwards; color: var(--grey-dark);">
                {{ $message }}
            </p>
        @endforeach
    </div>
    
    <div class="heart-loader mb-8" style="opacity: 0; animation: fadeIn 0.6s ease-out 4s forwards, heartbeat 1.5s infinite ease-in-out 4.5s;"></div>
    
    <button onclick="window.RomanticApp.transitionTo('{{ route('login') }}')" 
            class="romantic-btn" 
            data-transition
            href="{{ route('login') }}"
            style="opacity: 0; animation: fadeIn 0.6s ease-out 4.5s forwards;">
        Mulai Pengalaman Romantis ✨
    </button>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Create gentle heart particles
    setTimeout(() => {
        const container = document.querySelector('.romantic-card');
        for(let i = 0; i < 20; i++) {
            const heart = document.createElement('div');
            heart.textContent = ['💕', '💖', '💗', '✨'][Math.floor(Math.random() * 4)];
            heart.style.cssText = `
                position: absolute;
                left: ${Math.random() * 100}%;
                top: ${Math.random() * 100}%;
                font-size: ${12 + Math.random() * 12}px;
                opacity: 0;
                pointer-events: none;
                animation: fadeIn 1s ease-out ${3 + Math.random() * 2}s forwards, float ${5 + Math.random() * 3}s infinite ease-in-out ${Math.random() * 2}s;
            `;
            container.appendChild(heart);
        }
    }, 3000);
});
</script>
@endsection