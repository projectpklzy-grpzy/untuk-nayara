@extends('layouts.app')

@section('content')
<div class="romantic-card text-center" data-animate="slide-up">
    <div class="mb-8">
        <div style="font-size: 3rem; margin-bottom: 0.5rem; animation: float 3s infinite ease-in-out;"><img src="{{ asset('icons/buket.png') }}" style="width: 55%; height: 55%; object-fit: contain;"></div>
        <h2 class="text-3xl font-light mb-2" style="color: var(--pink-main);">
            Ayo Scan Kecantikan Kamu
        </h2>
        <p class="opacity-75" style="color: var(--grey-dark);">
            Tenang aja, upload foto di sini aman ko, gaakan ada penyalah gunaan foto😉, Tapi harus Upload Foto kamu ya...
            Supaya Sistem Menghitung 100% akurasi nya... 
        </p>
    </div>
    
    <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data" onsubmit="handlePhotoUpload(event)">
        @csrf
        
        <div class="upload-preview mb-6 mx-auto" style="animation: fadeIn 0.6s ease-out 0.3s both; position: relative;">
            <img src="{{ asset('assets/images/photo-placeholder.png') }}" 
                 alt="Preview" 
                 id="imagePreview"
                 style="filter: grayscale(0.3) opacity(0.7);">
            <div id="scanOverlay" style="display: none; position: absolute; top: 0; left: 0; right: 0; bottom: 0; overflow: hidden; border-radius: inherit;">
                <div class="scan-line"></div>
                <div class="scan-grid"></div>
                <div class="scan-corners">
                    <span class="corner top-left"></span>
                    <span class="corner top-right"></span>
                    <span class="corner bottom-left"></span>
                    <span class="corner bottom-right"></span>
                </div>
                <div class="scan-progress">
                    <div class="progress-bar"></div>
                    <span class="scan-text">Analyzing...</span>
                </div>
            </div>
        </div>
        
        <div id="accuracyMessage" style="display: none; animation: fadeIn 0.5s ease-out; margin-bottom: 1.5rem;">
            <p style="color: var(--pink-main); font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">
                ✨ Akurasi Kecantikan: <span id="accuracyCounter">0</span>% 💯
            </p>
            <p style="color: var(--grey-dark); font-size: 0.95rem; opacity: 0.9;">Ga pernah kurang, aku makin cinta 💖</p>
        </div>
        
        <div class="mb-6" style="animation: fadeIn 0.6s ease-out 0.5s both;">
            <input type="file" 
                   id="photo" 
                   name="photo" 
                   accept="image/*" 
                   style="display: none;"
                   onchange="previewImage(event)">
            <label for="photo" class="romantic-btn" style="cursor: pointer; display: inline-block;">
                📸 Pilih Foto
            </label>
            <p class="text-sm opacity-75 mt-3" style="color: var(--grey-dark);">
                Format: JPG, PNG, GIF (maks. 2MB)
            </p>
        </div>
        
        <button type="submit" class="romantic-btn w-full max-w-xs mx-auto" style="animation: fadeIn 0.6s ease-out 0.7s both;">
            💖 Upload Foto
        </button>
    </form>
    
    <div class="mt-8" style="animation: fadeIn 0.6s ease-out 0.9s both;">
        <p class="text-sm opacity-75" style="color: var(--grey-dark);">
            ❤️ Foto ini akan di scan oleh sistem
        </p>
    </div>
</div>
@endsection

@section('scripts')
<style>
.scan-line {
    position: absolute;
    width: 100%;
    height: 3px;
    background: linear-gradient(90deg, transparent, rgba(242, 161, 179, 0.8), transparent);
    box-shadow: 0 0 20px rgba(242, 161, 179, 0.6);
    animation: scanMove 2.5s ease-in-out infinite;
}

.scan-grid {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: 
        repeating-linear-gradient(0deg, rgba(242, 161, 179, 0.03) 0px, transparent 1px, transparent 20px),
        repeating-linear-gradient(90deg, rgba(242, 161, 179, 0.03) 0px, transparent 1px, transparent 20px);
    animation: gridPulse 2s ease-in-out infinite;
}

.scan-corners {
    position: absolute;
    width: 100%;
    height: 100%;
}

.corner {
    position: absolute;
    width: 30px;
    height: 30px;
    border: 2px solid rgba(242, 161, 179, 0.8);
    animation: cornerGlow 1.5s ease-in-out infinite;
}

.corner.top-left { top: 10px; left: 10px; border-right: none; border-bottom: none; }
.corner.top-right { top: 10px; right: 10px; border-left: none; border-bottom: none; }
.corner.bottom-left { bottom: 10px; left: 10px; border-right: none; border-top: none; }
.corner.bottom-right { bottom: 10px; right: 10px; border-left: none; border-top: none; }

.scan-progress {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80%;
    text-align: center;
}

.progress-bar {
    width: 100%;
    height: 4px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 8px;
}

.progress-bar::after {
    content: '';
    display: block;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, rgba(242, 161, 179, 0.8), rgba(242, 161, 179, 1));
    animation: progressFill 2.5s ease-out forwards;
    box-shadow: 0 0 10px rgba(242, 161, 179, 0.6);
}

.scan-text {
    color: rgba(242, 161, 179, 1);
    font-size: 0.75rem;
    font-weight: 600;
    text-shadow: 0 0 10px rgba(242, 161, 179, 0.5);
    letter-spacing: 1px;
    animation: textBlink 1s ease-in-out infinite;
}

@keyframes scanMove {
    0%, 100% { transform: translateY(-10px); opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { transform: translateY(calc(100% + 10px)); }
}

@keyframes gridPulse {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 0.6; }
}

@keyframes cornerGlow {
    0%, 100% { opacity: 0.5; box-shadow: 0 0 5px rgba(242, 161, 179, 0.3); }
    50% { opacity: 1; box-shadow: 0 0 15px rgba(242, 161, 179, 0.6); }
}

@keyframes progressFill {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(0); }
}

@keyframes textBlink {
    0%, 100% { opacity: 0.7; }
    50% { opacity: 1; }
}
</style>
<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('imagePreview');
    const previewContainer = preview.parentElement;
    const scanOverlay = document.getElementById('scanOverlay');
    const accuracyMessage = document.getElementById('accuracyMessage');
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Validate file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            RomanticExperience.showError(input, 'Ukuran file terlalu besar (maks. 2MB)');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        
        reader.onload = function(e) {
            // Fade out current image
            preview.style.opacity = '0';
            preview.style.transform = 'scale(0.9)';
            preview.style.transition = 'all 0.3s ease';
            
            setTimeout(() => {
                preview.src = e.target.result;
                preview.style.filter = 'none';
                
                // Fade in new image
                setTimeout(() => {
                    preview.style.opacity = '1';
                    preview.style.transform = 'scale(1)';
                }, 50);
                
                // Add glow effect to container
                previewContainer.style.boxShadow = '0 0 30px rgba(242, 161, 179, 0.4)';
                previewContainer.style.borderColor = 'var(--pink-main)';
                
                // Start scanning animation
                setTimeout(() => {
                    scanOverlay.style.display = 'block';
                    
                    // Show accuracy message after scan completes
                    setTimeout(() => {
                        scanOverlay.style.display = 'none';
                        accuracyMessage.style.display = 'block';
                        
                        // Animate counter from 0 to 100
                        const counter = document.getElementById('accuracyCounter');
                        const duration = 2000;
                        const steps = 60;
                        const increment = 100 / steps;
                        const stepDuration = duration / steps;
                        let current = 0;
                        
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= 100) {
                                counter.textContent = '100';
                                counter.parentElement.style.animation = 'pulse 2s infinite';
                                clearInterval(timer);
                            } else {
                                counter.textContent = Math.floor(current);
                            }
                        }, stepDuration);
                    }, 2800);
                }, 400);
            }, 300);
        };
        
        reader.readAsDataURL(file);
    }
}
</script>
@endsection