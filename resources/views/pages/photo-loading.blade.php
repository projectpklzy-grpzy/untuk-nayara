@extends('layouts.app')

@section('content')
<div class="text-center" style="min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem;">
    <div style="margin-bottom: 2rem;">
        <h2 class="text-2xl font-light mb-2" style="color: var(--pink-main); animation: fadeIn 0.6s ease-out;">
            Memuat Halaman Imutee Berikutnya...
        </h2>
        <p style="color: var(--grey-dark); opacity: 0.8; animation: fadeIn 0.6s ease-out 0.3s both;">
            ✨ Menyiapkan sesuatu yang spesial ✨
        </p>
    </div>
    
    <!-- Hologram Photo Container -->
    <div id="hologramContainer" style="position: relative; width: 280px; height: 350px; margin: 2rem auto;">
        <div id="photoFrame" style="
            position: relative;
            width: 100%;
            height: 100%;
            border: 3px solid var(--pink-main);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 0 30px rgba(242, 161, 179, 0.4), 0 0 60px rgba(242, 161, 179, 0.2);
            animation: float 4s infinite ease-in-out, hologramGlow 2s infinite ease-in-out;
        ">
            <img id="hologramPhoto" src="{{ asset('images/foto-nay/nay1.jpeg') }}" 
                 style="width: 100%; height: 100%; object-fit: cover; opacity: 0.9; filter: brightness(1.1);">
            
            <!-- Love Corner Decorations -->
            <div style="position: absolute; top: -10px; left: -10px; font-size: 2rem; animation: pulse 2s infinite;">💖</div>
            <div style="position: absolute; top: -10px; right: -10px; font-size: 2rem; animation: pulse 2s infinite 0.5s;">💕</div>
            <div style="position: absolute; bottom: -10px; left: -10px; font-size: 2rem; animation: pulse 2s infinite 1s;">💗</div>
            <div style="position: absolute; bottom: -10px; right: -10px; font-size: 2rem; animation: pulse 2s infinite 1.5s;">💓</div>
            
            <!-- Scan Lines -->
            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(242, 161, 179, 0.05) 2px, rgba(242, 161, 179, 0.05) 4px); pointer-events: none; animation: scanLines 8s linear infinite;"></div>
        </div>
    </div>
    
    <!-- Progress Bar -->
    <div style="width: 100%; max-width: 400px; margin-top: 2rem; animation: fadeIn 0.6s ease-out 0.6s both;">
        <div style="width: 100%; height: 6px; background: rgba(242, 161, 179, 0.2); border-radius: 3px; overflow: hidden;">
            <div id="progressBar" style="width: 0%; height: 100%; background: linear-gradient(90deg, var(--pink-main), rgba(242, 161, 179, 0.6)); border-radius: 3px; transition: width 0.3s ease; box-shadow: 0 0 10px rgba(242, 161, 179, 0.6);"></div>
        </div>
        <p id="loadingText" style="color: var(--pink-main); font-size: 0.9rem; margin-top: 1rem; font-weight: 500;">Memuat foto 1/6...</p>
    </div>
</div>
@endsection

@section('scripts')
<style>
@keyframes hologramGlow {
    0%, 100% { box-shadow: 0 0 30px rgba(242, 161, 179, 0.4), 0 0 60px rgba(242, 161, 179, 0.2); }
    50% { box-shadow: 0 0 40px rgba(242, 161, 179, 0.6), 0 0 80px rgba(242, 161, 179, 0.3); }
}

@keyframes scanLines {
    0% { transform: translateY(0); }
    100% { transform: translateY(20px); }
}
</style>

<script>
const photos = [
    '{{ asset("images/foto-nay/nay1.jpeg") }}',
    '{{ asset("images/foto-nay/nay2.jpeg") }}',
    '{{ asset("images/foto-nay/nay3.jpeg") }}',
    '{{ asset("images/foto-nay/nay4.jpeg") }}',
    '{{ asset("images/foto-nay/nay5.jpeg") }}',
    '{{ asset("images/foto-nay/nay6.jpeg") }}'
];

let currentPhotoIndex = 0;
let progress = 100 / photos.length;

const hologramPhoto = document.getElementById('hologramPhoto');
const progressBar = document.getElementById('progressBar');
const loadingText = document.getElementById('loadingText');

// Set initial progress
progressBar.style.width = progress + '%';

// Change photo every 800ms
const photoInterval = setInterval(() => {
    currentPhotoIndex++;
    
    if (currentPhotoIndex >= photos.length) {
        clearInterval(photoInterval);
        loadingText.textContent = 'Selesai! ✨';
        setTimeout(() => {
            window.location.href = '{{ route("quiz") }}';
        }, 800);
        return;
    }
    
    // Fade transition
    hologramPhoto.style.opacity = '0';
    hologramPhoto.style.transform = 'scale(0.95)';
    hologramPhoto.style.transition = 'all 0.3s ease';
    
    setTimeout(() => {
        hologramPhoto.src = photos[currentPhotoIndex];
        hologramPhoto.style.opacity = '0.9';
        hologramPhoto.style.transform = 'scale(1)';
    }, 300);
    
    // Update progress
    progress = ((currentPhotoIndex + 1) / photos.length) * 100;
    progressBar.style.width = progress + '%';
    loadingText.textContent = `Memuat foto ${currentPhotoIndex + 1}/${photos.length}...`;
}, 800);
</script>
@endsection
