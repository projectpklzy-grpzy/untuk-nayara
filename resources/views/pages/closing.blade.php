@extends('layouts.app')

@section('content')
<div class="text-center" data-animate="fade-in">
    <div class="romantic-card max-w-2xl mx-auto">
        @if($photo && $photo->photo_path)
        <div class="upload-preview mx-auto mb-8" style="animation: fadeIn 0.8s ease-out 0.3s both, float 6s infinite ease-in-out 1s;">
            <img src="{{ Storage::url($photo->photo_path) }}" 
                 alt="Foto Kenangan"
                 onerror="this.onerror=null; this.src='{{ asset('assets/images/photo-placeholder.png') }}'; this.style.filter='grayscale(0.3) opacity(0.7)';">
        </div>
        @endif
        
        <h1 class="text-4xl font-light mb-6" style="color: var(--pink-main); animation: fadeIn 0.8s ease-out 0.5s both;">
            Terima Kasih, {{ $username }} ❤️
        </h1>
        
        <div class="space-y-4 mb-8" style="animation: fadeIn 0.8s ease-out 0.7s both;">
            <p class="text-lg" style="color: var(--grey-dark);">
                Website ini dibuat khusus buat kamu, dengan segenap cinta dan ketulusan.
            </p>
            
            
            
            <p class="text-lg mt-6" style="color: var(--grey-dark);">
                Kapan lagikan di kasih ginian, semoga ini jadi firs ekperiens yang bagus juga buat kamu....
            </p>
        </div>
        
        <div class="heart-loader mx-auto mb-8" style="animation: fadeIn 0.6s ease-out 1s both, heartbeat 1.5s infinite ease-in-out 1.5s;"></div>
        
        <div class="space-y-4" style="animation: fadeIn 0.6s ease-out 1.2s both;">
            <p class="text-sm opacity-75" style="color: var(--grey-dark);">
                💝 Segenap hati, jiwa, dan raga, aku persembahkan buat kamu😋
                alay banget yaa yang buat nya?
            </p>
            <p class="text-sm opacity-75" style="color: var(--grey-dark);">
                This website was created by Fijan with great love for you <3 💕
            </p>
        </div>
    </div>
    
    <div class="mt-8" style="animation: fadeIn 0.6s ease-out 1.4s both;">
        <a href="{{ route('logout') }}" 
           data-transition
           style="color: var(--pink-main); text-decoration: none; font-weight: 500; transition: all 0.3s ease;"
           onmouseover="this.style.textDecoration='underline'"
           onmouseout="this.style.textDecoration='none'">
            ← Kembali ke Awal
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.romantic-container');
    const hearts = ['❤️', '💕', '💖', '💗', '💓', '💝', '💘'];
    
    // Create cascading floating hearts
    for(let i = 0; i < 25; i++) {
        setTimeout(() => {
            const heart = document.createElement('div');
            heart.textContent = hearts[Math.floor(Math.random() * hearts.length)];
            heart.style.cssText = `
                position: absolute;
                left: ${Math.random() * 100}%;
                top: ${Math.random() * 100}%;
                font-size: ${16 + Math.random() * 24}px;
                opacity: 0;
                pointer-events: none;
                animation: fadeIn 1s ease-out forwards, float ${5 + Math.random() * 3}s infinite ease-in-out ${Math.random() * 2}s;
                filter: drop-shadow(0 2px 4px rgba(242, 161, 179, 0.3));
            `;
            container.appendChild(heart);
        }, i * 200);
    }
    
    // Gentle confetti effect on load
    setTimeout(() => {
        for(let i = 0; i < 15; i++) {
            const confetti = document.createElement('div');
            confetti.textContent = '✨';
            confetti.style.cssText = `
                position: fixed;
                left: ${Math.random() * 100}%;
                top: -50px;
                font-size: ${20 + Math.random() * 20}px;
                opacity: 0.8;
                pointer-events: none;
                animation: fall ${3 + Math.random() * 2}s linear forwards;
            `;
            document.body.appendChild(confetti);
            
            setTimeout(() => confetti.remove(), 5000);
        }
    }, 1000);
});

// Falling animation for confetti
const style = document.createElement('style');
style.textContent = `
    @keyframes fall {
        to {
            transform: translateY(100vh) rotate(360deg);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection
