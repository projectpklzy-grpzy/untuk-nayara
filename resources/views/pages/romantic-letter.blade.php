@extends('layouts.app')

@section('content')
<div class="text-center" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
    
    <!-- Floating Stickers Background -->
    <div id="stickersContainer" style="position: fixed; inset: 0; pointer-events: none; z-index: 0;"></div>
    
    <!-- Floating Envelope -->
    <div id="envelopeContainer" style="cursor: pointer; position: relative; z-index: 1;">
        <img src="{{ asset('assets/icons/surat.png') }}" 
             alt="Surat Untukmu" 
             id="envelope"
             style="width: 200px; height: auto; opacity: 0; transform: translateY(-100vh) rotate(-20deg); transition: all 1.5s cubic-bezier(0.34, 1.56, 0.64, 1); animation: float 3s infinite ease-in-out;"
             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
        
        <!-- Fallback jika gambar tidak ada -->
        <!-- Bagian fallback ini sekarang memiliki animasi mengambang yang sama dengan elemen envelope utama -->
        <div id="envelopeFallback" style="display: none; width: 200px; height: 200px; background: linear-gradient(135deg, var(--pink-main), var(--pink-soft)); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 5rem; box-shadow: var(--shadow-lg); animation: float 3s infinite ease-in-out;">
            <img src="{{ asset('icons/surat.png') }}" style="width: 100%; height: 100%; object-fit: contain;">
        </div>
        
        <div style="margin-top: 2rem; opacity: 0; animation: fadeIn 0.8s ease-out 2s forwards;">
            <p style="color: var(--pink-main); font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">
                Ada Surat Untukmu ✨
            </p>
            <p style="color: var(--grey-dark); opacity: 0.75; font-size: 0.95rem;">
                Klik untuk membuka...
            </p>
        </div>
    </div>

    <!-- Popup Modal -->
    <div id="letterModal" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(10px); z-index: 1000; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;">
        <div id="letterContent" style="position: relative; max-width: 600px; width: 90%; max-height: 80vh; overflow-y: auto; transform: scale(0.8) rotateX(90deg); transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);">
            <!-- Letter Paper -->
            <div style="background: url('{{ asset('assets/images/bg/background-popup.png') }}') center/cover, linear-gradient(135deg, #fff9f0, #fffaf5); background-blend-mode: overlay; border-radius: 24px; padding: 3rem 2rem; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); border: 2px solid rgba(242, 161, 179, 0.3); position: relative; overflow: hidden;">
                
                <!-- Decorative corners -->
                <div style="position: absolute; top: 20px; left: 20px; font-size: 2rem; opacity: 0.3;">🌸</div>
                <div style="position: absolute; top: 20px; right: 20px; font-size: 2rem; opacity: 0.3;">🌸</div>
                <div style="position: absolute; bottom: 20px; left: 20px; font-size: 2rem; opacity: 0.3;">💕</div>
                <div style="position: absolute; bottom: 20px; right: 20px; font-size: 2rem; opacity: 0.3;">💕</div>

                <!-- Close button -->
                <button onclick="closeModal()" style="position: absolute; top: 15px; right: 15px; background: rgba(242, 161, 179, 0.2); border: none; width: 36px; height: 36px; border-radius: 50%; cursor: pointer; font-size: 1.25rem; transition: all 0.3s ease; z-index: 10;" onmouseover="this.style.background='rgba(242, 161, 179, 0.4)'" onmouseout="this.style.background='rgba(242, 161, 179, 0.2)'">
                    ✕
                </button>

                <!-- Letter Header -->
                <div style="text-align: center; margin-bottom: 2rem;">
                    <div style="font-size: 3rem; margin-bottom: 0.5rem; animation: heartbeat 1.5s infinite ease-in-out;"><img src="{{ asset('icons/love.png') }}" alt="Love" style="width: 7rem; height: 7rem; object-fit: contain;"></div>
                    <h2 style="font-family: 'Playfair Display', serif; color: var(--pink-main); font-size: 2rem; margin-bottom: 0.5rem;">
                        Untuk Kamu yang Istimewa
                    </h2>
                    <div style="width: 80px; height: 3px; background: linear-gradient(90deg, transparent, var(--pink-main), transparent); margin: 0 auto;"></div>
                </div>

                <!-- Letter Body -->
                <div id="letterBody" style="color: var(--grey-dark); line-height: 1.8; font-size: 1.05rem; text-align: left; margin-bottom: 2rem;">
                    <p style="margin-bottom: 1rem; opacity: 0; animation: fadeIn 0.6s ease-out 0.3s forwards;">
                        Hai Nayaraa... 💕
                    </p>
                    <p style="margin-bottom: 1rem; opacity: 0; animation: fadeIn 0.6s ease-out 0.6s forwards;">
                        Aku bikin ini khusus buat kamu, dengan sepenuh hati dan cinta yang tulus ASEEKK. Setiap detik yang kuhabiskan untuk membuatnya adalah momen dimana aku memikirkanmu.
                    </p>
                    <p style="margin-bottom: 1rem; opacity: 0; animation: fadeIn 0.6s ease-out 0.9s forwards;">
                        Kamu adalah alasan mengapa aku tersenyum setiap hari. Kehadiranmu membuat dunia ini lebih indah dan bermakna. ✨
                    </p>
                    <p style="margin-bottom: 1rem; opacity: 0; animation: fadeIn 0.6s ease-out 1.2s forwards;">
                        Terima kasih sudah lahir ke dunia ini, tapi sayang nya kamu lahir di indo hahaha. Tapi aku bersyukur kamu jadi orang ranca, jadi bisa ketemu kamu
                    </p>
                    <p style="text-align: center; margin-top: 2rem; font-style: italic; color: var(--pink-main); opacity: 0; animation: fadeIn 0.6s ease-out 1.5s forwards;">
                        Dengan cinta, <br>
                        <span style="font-size: 1.25rem; font-weight: 600;">❤️ Untukmu ❤️</span>
                    </p>
                </div>

                <!-- Timer Section -->
                <div id="timerSection" style="text-align: center; padding: 1.5rem; background: rgba(253, 232, 238, 0.5); border-radius: 16px; margin-bottom: 1.5rem; opacity: 0; animation: fadeIn 0.6s ease-out 1.8s forwards;">
                    <p style="color: var(--grey-dark); margin-bottom: 0.75rem; font-size: 0.95rem;">
                        Nikmati pesanku dulu ya... 💭
                    </p>
                    <div id="countdown" style="font-size: 3rem; font-weight: 700; color: var(--pink-main); font-family: 'Playfair Display', serif; animation: pulse 1s infinite ease-in-out;">
                        5
                    </div>
                    <p style="color: var(--grey-dark); opacity: 0.75; font-size: 0.9rem; margin-top: 0.5rem;">
                        detik lagi...
                    </p>
                </div>

                <!-- Continue Button (hidden initially) -->
                <button id="continueBtn" onclick="continueToQuiz()" class="romantic-btn w-full" style="display: none; opacity: 0;">
                    Lanjutkan Perjalanan ✨
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const envelope = document.getElementById('envelope');
    const envelopeFallback = document.getElementById('envelopeFallback');
    const envelopeContainer = document.getElementById('envelopeContainer');
    const modal = document.getElementById('letterModal');
    const letterContent = document.getElementById('letterContent');
    const countdown = document.getElementById('countdown');
    const continueBtn = document.getElementById('continueBtn');
    const timerSection = document.getElementById('timerSection');
    const stickersContainer = document.getElementById('stickersContainer');
    
    // Cute stickers from icons folder (excluding surat.png)
    const stickers = [
        '{{ asset("icons/buket.png") }}',
        '{{ asset("icons/bulan.png") }}',
        '{{ asset("icons/bunga.png") }}',
        '{{ asset("icons/kupu-kupu.png") }}',
        '{{ asset("icons/love.png") }}',
        '{{ asset("icons/pita.png") }}'
    ];
    
    // Create floating stickers
    function createFloatingStickers() {
        stickers.forEach((src, index) => {
            setTimeout(() => {
                // Create multiple instances of each sticker
                for(let i = 0; i < 2; i++) {
                    const sticker = document.createElement('img');
                    sticker.src = src;
                    sticker.style.cssText = `
                        position: absolute;
                        width: ${40 + Math.random() * 40}px;
                        height: auto;
                        left: ${Math.random() * 100}%;
                        top: ${Math.random() * 100}%;
                        opacity: 0;
                        transform: scale(0) rotate(${Math.random() * 360}deg);
                        transition: all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
                        filter: drop-shadow(0 4px 8px rgba(242, 161, 179, 0.2));
                    `;
                    
                    stickersContainer.appendChild(sticker);
                    
                    // Animate in
                    setTimeout(() => {
                        sticker.style.opacity = '0.6';
                        sticker.style.transform = 'scale(1) rotate(0deg)';
                        
                        // Add floating animation
                        setTimeout(() => {
                            const duration = 4 + Math.random() * 3;
                            const delay = Math.random() * 2;
                            sticker.style.animation = `float ${duration}s infinite ease-in-out ${delay}s, stickerRotate ${duration * 2}s infinite ease-in-out ${delay}s`;
                        }, 800);
                    }, 100);
                }
            }, index * 300);
        });
    }
    
    // Start sticker animations
    setTimeout(createFloatingStickers, 500);
    
    // Animate envelope entrance
    setTimeout(() => {
        envelope.style.opacity = '1';
        envelope.style.transform = 'translateY(0) rotate(0deg)';
        
        // Add floating animation after landing
        setTimeout(() => {
            envelope.style.animation = 'float 3s infinite ease-in-out';
            if (envelopeFallback.style.display === 'flex') {
                envelopeFallback.style.animation = 'float 3s infinite ease-in-out';
            }
        }, 1500);
    }, 300);
    
    // Open modal on click
    envelopeContainer.addEventListener('click', function() {
        // Envelope fly away animation
        envelope.style.transform = 'translateY(-100vh) rotate(360deg) scale(0.5)';
        envelope.style.opacity = '0';
        
        setTimeout(() => {
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.style.opacity = '1';
                letterContent.style.transform = 'scale(1) rotateX(0deg)';
                
                // Start countdown after modal opens
                setTimeout(startCountdown, 2000);
            }, 50);
        }, 600);
    });
    
    // Countdown timer
    let timeLeft = 5;
    let countdownInterval;
    
    function startCountdown() {
        countdownInterval = setInterval(() => {
            timeLeft--;
            countdown.textContent = timeLeft;
            
            // Add bounce effect on each count
            countdown.style.transform = 'scale(1.3)';
            setTimeout(() => {
                countdown.style.transform = 'scale(1)';
            }, 200);
            
            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                showContinueButton();
            }
        }, 1000);
    }
    
    function showContinueButton() {
        // Hide timer, show button
        timerSection.style.transition = 'all 0.5s ease';
        timerSection.style.opacity = '0';
        timerSection.style.transform = 'scale(0.9)';
        
        setTimeout(() => {
            timerSection.style.display = 'none';
            continueBtn.style.display = 'block';
            
            setTimeout(() => {
                continueBtn.style.opacity = '1';
                continueBtn.style.animation = 'slideUp 0.6s ease-out forwards, pulse 2s infinite ease-in-out 0.6s';
            }, 50);
        }, 500);
    }
    
    // Close modal
    window.closeModal = function() {
        modal.style.opacity = '0';
        letterContent.style.transform = 'scale(0.8) rotateX(90deg)';
        
        setTimeout(() => {
            modal.style.display = 'none';
            
            // Reset envelope
            envelope.style.transform = 'translateY(0) rotate(0deg)';
            envelope.style.opacity = '1';
            envelope.style.transition = 'all 1s cubic-bezier(0.34, 1.56, 0.64, 1)';
            
            // Reset timer
            timeLeft = 5;
            countdown.textContent = '5';
            clearInterval(countdownInterval);
            timerSection.style.display = 'block';
            timerSection.style.opacity = '1';
            timerSection.style.transform = 'scale(1)';
            continueBtn.style.display = 'none';
            continueBtn.style.opacity = '0';
        }, 300);
    };
    
    // Continue to quiz
    window.continueToQuiz = function() {
        continueBtn.disabled = true;
        continueBtn.innerHTML = '<span style="display: inline-block; animation: spin 1s linear infinite;">⏳</span> Melanjutkan...';
        
        setTimeout(() => {
            window.RomanticApp.transitionTo('{{ route("photo.loading") }}');
        }, 800);
    };
    
    // Close on outside click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
});

// Add sticker rotation animation
const style = document.createElement('style');
style.textContent = `
    @keyframes stickerRotate {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(5deg); }
        75% { transform: rotate(-5deg); }
    }
`;
document.head.appendChild(style);
</script>
@endsection
