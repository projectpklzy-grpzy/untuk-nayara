// ═══════════════════════════════════════════════════════════
// ROMANTIC EXPERIENCE - JAVASCRIPT CORE
// Enhanced interactions & smooth animations
// ═══════════════════════════════════════════════════════════

class RomanticExperience {
    constructor() {
        this.initAnimations();
        this.initLoveFloats();
        this.initNavigation();
        this.initSmoothEffects();
    }

    // ─────────────────────────────────────────────────────────
    // ✨ ANIMATIONS
    // ─────────────────────────────────────────────────────────
    initAnimations() {
        // Auto animate elements with data-animate attribute
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const animation = entry.target.getAttribute('data-animate');
                    entry.target.classList.add(animation);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('[data-animate]').forEach(el => {
            observer.observe(el);
        });
    }

    // ─────────────────────────────────────────────────────────
    // 💝 FLOATING LOVE ELEMENTS
    // ─────────────────────────────────────────────────────────
    initLoveFloats() {
        const container = document.querySelector('.romantic-container') || document.body;
        const hearts = ['❤️', '💕', '💖', '💗', '💓'];
        
        for (let i = 0; i < 12; i++) {
            const love = document.createElement('div');
            love.className = 'love-float float';
            love.textContent = hearts[Math.floor(Math.random() * hearts.length)];
            love.style.left = `${Math.random() * 100}%`;
            love.style.top = `${Math.random() * 100}%`;
            love.style.animationDelay = `${Math.random() * 5}s`;
            love.style.animationDuration = `${5 + Math.random() * 3}s`;
            love.style.fontSize = `${16 + Math.random() * 16}px`;
            
            container.appendChild(love);
        }
    }

    // ─────────────────────────────────────────────────────────
    // 🎭 SMOOTH NAVIGATION
    // ─────────────────────────────────────────────────────────
    initNavigation() {
        document.addEventListener('click', (e) => {
            const link = e.target.closest('[data-transition]');
            if (link) {
                e.preventDefault();
                const href = link.getAttribute('href');
                this.transitionTo(href);
            }
        });
    }

    transitionTo(url) {
        const container = document.querySelector('.romantic-container');
        if (container) {
            container.style.opacity = '0';
            container.style.transform = 'translateY(30px) scale(0.98)';
            container.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
            
            setTimeout(() => {
                window.location.href = url;
            }, 500);
        } else {
            window.location.href = url;
        }
    }

    // ─────────────────────────────────────────────────────────
    // ✨ SMOOTH EFFECTS
    // ─────────────────────────────────────────────────────────
    initSmoothEffects() {
        // Smooth entrance
        const container = document.querySelector('.romantic-container');
        if (container) {
            setTimeout(() => {
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            }, 100);
        }

        // Button ripple effect
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('romantic-btn')) {
                this.createRipple(e);
            }
        });

        // Input focus glow
        document.querySelectorAll('.romantic-input, .romantic-textarea').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.style.transform = 'translateY(-2px)';
                input.parentElement.style.transition = 'transform 0.3s ease';
            });
            
            input.addEventListener('blur', () => {
                input.parentElement.style.transform = 'translateY(0)';
            });
        });
    }

    createRipple(event) {
        const button = event.currentTarget;
        const ripple = document.createElement('span');
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;

        ripple.style.width = ripple.style.height = `${size}px`;
        ripple.style.left = `${x}px`;
        ripple.style.top = `${y}px`;
        ripple.style.position = 'absolute';
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(255, 255, 255, 0.6)';
        ripple.style.transform = 'scale(0)';
        ripple.style.animation = 'ripple 0.6s ease-out';
        ripple.style.pointerEvents = 'none';

        button.appendChild(ripple);
        setTimeout(() => ripple.remove(), 600);
    }

    // ─────────────────────────────────────────────────────────
    // 💬 FEEDBACK MESSAGES
    // ─────────────────────────────────────────────────────────
    static showError(element, message) {
        element.classList.add('shake');
        element.style.borderColor = 'var(--error)';
        
        const existingError = element.parentNode.querySelector('.error-message');
        if (existingError) existingError.remove();
        
        if (message) {
            const errorEl = document.createElement('div');
            errorEl.className = 'error-message';
            errorEl.innerHTML = `<span style="margin-right: 0.5rem;">⚠️</span>${message}`;
            element.parentNode.appendChild(errorEl);
            
            setTimeout(() => errorEl.remove(), 4000);
        }
        
        setTimeout(() => {
            element.classList.remove('shake');
            element.style.borderColor = '';
        }, 500);
    }

    static showSuccess(element, message) {
        element.style.borderColor = 'var(--success)';
        element.style.transition = 'all 0.3s ease';
        
        const existingSuccess = element.parentNode.querySelector('.success-message');
        if (existingSuccess) existingSuccess.remove();
        
        if (message) {
            const successEl = document.createElement('div');
            successEl.className = 'success-message';
            successEl.innerHTML = `<span style="margin-right: 0.5rem;">✓</span>${message}`;
            element.parentNode.appendChild(successEl);
            
            setTimeout(() => successEl.remove(), 4000);
        }
        
        setTimeout(() => {
            element.style.borderColor = '';
        }, 2000);
    }

    // ─────────────────────────────────────────────────────────
    // 🎪 LOADING STATE
    // ─────────────────────────────────────────────────────────
    static setLoading(button, isLoading, originalText = 'Submit') {
        if (isLoading) {
            button.disabled = true;
            button.dataset.originalText = button.textContent;
            button.innerHTML = `<span style="display: inline-block; animation: spin 1s linear infinite;">⏳</span> Memproses...`;
        } else {
            button.disabled = false;
            button.textContent = button.dataset.originalText || originalText;
        }
    }
}

// ═══════════════════════════════════════════════════════════
// 🔐 LOGIN HANDLER
// ═══════════════════════════════════════════════════════════
function handleLogin(event) {
    event.preventDefault();
    
    const form = event.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const pinInput = form.querySelector('#pin');
    
    RomanticExperience.setLoading(submitBtn, true);
    
    const formData = new FormData(form);
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            RomanticExperience.showSuccess(pinInput, '✨ Login berhasil!');
            
            // Smooth transition
            setTimeout(() => {
                window.RomanticApp.transitionTo(data.redirect);
            }, 1200);
        } else {
            RomanticExperience.showError(pinInput, data.message || 'PIN salah, coba lagi ya...');
            RomanticExperience.setLoading(submitBtn, false);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        RomanticExperience.showError(pinInput, 'Terjadi kesalahan, coba lagi...');
        RomanticExperience.setLoading(submitBtn, false);
    });
}

// ═══════════════════════════════════════════════════════════
// 🎯 QUIZ HANDLER
// ═══════════════════════════════════════════════════════════
function handleQuizAnswer(questionIndex, optionIndex, correctIndex) {
    const questionEl = document.querySelector(`[data-question="${questionIndex}"]`);
    const options = questionEl.querySelectorAll('.quiz-option');
    const nextBtn = questionEl.querySelector('.next-btn');
    
    options.forEach(option => {
        option.style.pointerEvents = 'none';
        option.style.opacity = '0.6';
    });
    
    const selectedOption = options[optionIndex];
    selectedOption.style.opacity = '1';
    
    if (optionIndex === correctIndex) {
        selectedOption.classList.add('correct');
        
        // Show success feedback
        const feedback = document.createElement('div');
        feedback.className = 'success-message';
        feedback.style.marginTop = '1rem';
        feedback.innerHTML = '💖 Benar! Kamu memang mengerti aku...';
        questionEl.appendChild(feedback);
        
        if (nextBtn) {
            setTimeout(() => {
                nextBtn.style.display = 'block';
                nextBtn.classList.add('slide-up');
            }, 800);
        }
    } else {
        selectedOption.classList.add('wrong');
        
        // Show error feedback
        const feedback = document.createElement('div');
        feedback.className = 'error-message';
        feedback.style.marginTop = '1rem';
        feedback.innerHTML = '💭 Hmm, coba ingat-ingat lagi ya...';
        questionEl.appendChild(feedback);
        
        // Allow retry after 2 seconds
        setTimeout(() => {
            options.forEach(option => {
                option.style.pointerEvents = 'auto';
                option.style.opacity = '1';
            });
            selectedOption.classList.remove('wrong');
            feedback.remove();
        }, 2000);
    }
}

// ═══════════════════════════════════════════════════════════
// 📸 UPLOAD HANDLER
// ═══════════════════════════════════════════════════════════
function handlePhotoUpload(event) {
    event.preventDefault();
    
    const form = event.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const preview = document.querySelector('.upload-preview');
    const fileInput = form.querySelector('input[type="file"]');
    
    if (!fileInput.files.length) {
        RomanticExperience.showError(fileInput, 'Pilih foto terlebih dahulu ya...');
        return;
    }
    
    RomanticExperience.setLoading(submitBtn, true);
    
    // Show preview with animation
    const reader = new FileReader();
    reader.onload = function(e) {
        preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="animation: fadeIn 0.5s ease-out;">`;
    };
    reader.readAsDataURL(fileInput.files[0]);
    
    const formData = new FormData(form);
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Success animation
            const overlay = document.createElement('div');
            overlay.style.cssText = `
                position: absolute;
                inset: 0;
                background: rgba(163, 217, 165, 0.95);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 3rem;
                border-radius: 50%;
                animation: fadeIn 0.3s ease-out;
            `;
            overlay.textContent = '✓';
            preview.style.position = 'relative';
            preview.appendChild(overlay);
            
            setTimeout(() => {
                window.RomanticApp.transitionTo('/letter');
            }, 1500);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        RomanticExperience.showError(fileInput, 'Upload gagal, coba lagi...');
        RomanticExperience.setLoading(submitBtn, false);
    });
}

// ═══════════════════════════════════════════════════════════
// 💌 LETTER HANDLER
// ═══════════════════════════════════════════════════════════
function handleLetterSubmit(event) {
    event.preventDefault();
    
    const form = event.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const textarea = form.querySelector('textarea');
    const message = textarea.value.trim();
    
    if (message.length < 10) {
        RomanticExperience.showError(textarea, 'Tuliskan setidaknya 10 karakter ya... ✍️');
        return;
    }
    
    RomanticExperience.setLoading(submitBtn, true);
    
    fetch(form.action, {
        method: 'POST',
        body: JSON.stringify({ message }),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            RomanticExperience.showSuccess(textarea, '💌 Pesan terkirim!');
            
            // Card glow effect
            const card = form.closest('.romantic-card');
            card.style.transform = 'scale(1.02)';
            card.style.boxShadow = '0 20px 60px rgba(242, 161, 179, 0.4)';
            card.style.transition = 'all 0.5s ease';
            
            setTimeout(() => {
                window.RomanticApp.transitionTo('/closing');
            }, 1500);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        RomanticExperience.showError(textarea, 'Gagal mengirim, coba lagi...');
        RomanticExperience.setLoading(submitBtn, false);
    });
}

// ═══════════════════════════════════════════════════════════
// 🚀 INITIALIZE
// ═══════════════════════════════════════════════════════════
document.addEventListener('DOMContentLoaded', () => {
    window.RomanticApp = new RomanticExperience();
    
    // Smooth page entrance
    document.body.style.opacity = '0';
    setTimeout(() => {
        document.body.style.transition = 'opacity 0.5s ease';
        document.body.style.opacity = '1';
    }, 50);
});

// Mobile touch optimization
document.addEventListener('touchstart', function() {}, {passive: true});
