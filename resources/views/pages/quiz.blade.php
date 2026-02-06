@extends('layouts.app')

@section('content')
<div class="romantic-card" data-animate="fade-in" style="min-height: 100vh; display: flex; flex-direction: column;">
    <div class="text-center mb-6">
        <div style="font-size: 2rem; margin-bottom: 0.5rem; animation: float 3s infinite ease-in-out;"><img src="{{ asset('icons/bunga.png') }}" style="width: 11%; height: 11%; object-fit: contain;">🎮</div>
        <h2 class="text-2xl font-light" style="color: var(--pink-main);">
            Kuis Spesial
        </h2>
        <p class="opacity-75 mt-2" style="color: var(--grey-dark); font-size: 0.9rem;">
            Jawab pertanyaan ini dengan hati-hati ya... ✨
        </p>
    </div>
    
    <div id="quizContainer" style="position: relative; min-height: 420px;">
        @foreach($questions as $index => $question)
        <div class="quiz-section {{ $index > 0 ? 'hidden' : '' }}" 
             data-question="{{ $index }}"
             style="{{ $index === 0 ? 'animation: fadeIn 0.6s ease-out;' : '' }}">
            
            <div style="display: flex; align-items: flex-start; gap: 0.75rem; margin-bottom: 1.5rem;">
                <div style="background: var(--pink-soft); color: var(--pink-main); min-width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; flex-shrink: 0; font-size: 1rem;">
                    {{ $index + 1 }}
                </div>
                <h3 style="color: var(--grey-dark); font-size: 1.1rem; line-height: 1.6; font-weight: 500;">
                    {{ $question['question'] }}
                </h3>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 1.5rem;">
                @foreach($question['options'] as $optionIndex => $option)
                <div class="quiz-option" 
                     style="animation: slideUp 0.4s ease-out {{ $optionIndex * 0.1 }}s both;"
                     onclick="handleQuizAnswer({{ $index }}, {{ $optionIndex }}, {{ $question['answer'] }})">
                    <span style="color: var(--pink-main); font-weight: 600; margin-right: 0.75rem; font-size: 1.1rem;">{{ $option }}</span>
                </div>
                @endforeach
            </div>
            
            @if($index < count($questions) - 1)
            <button class="romantic-btn mt-4 hidden next-btn" 
                    style="width: 100%;"
                    onclick="showNextQuestion({{ $index }})">
                Lanjut →
            </button>
            @endif
        </div>
        @endforeach
    </div>

    <!-- Name Reveal Section -->
    <div id="nameReveal" style="display: none; text-align: center; padding: 2rem 1rem; flex-direction: column; align-items: center; justify-content: center;">
        <p style="color: var(--grey-dark); font-size: 1rem; margin-bottom: 2rem; opacity: 0; animation: fadeIn 0.6s ease-out 0.3s forwards;">
            Dari semua jawabanmu, tersusun sebuah nama... ✨
        </p>
        
        <div id="letterContainer" style="display: flex; justify-content: center; gap: 0.75rem; margin-bottom: 2rem; flex-wrap: wrap;">
            <!-- Letters will appear here -->
        </div>
        
        <p id="subtitle" style="color: var(--pink-main); font-size: 1.2rem; font-weight: 600; opacity: 0; margin-top: 1.5rem;">
            Calon masa depan kamu 💕
        </p>
        
        <!-- Playful Button -->
        <button id="playfulBtn" class="romantic-btn" style="display: none; margin-top: 2rem; width: 100%; max-width: 400px; position: relative; transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
            Lanjutkan ✨
        </button>
        
        <p id="playfulMessage" style="color: var(--pink-main); font-weight: 600; margin-top: 1rem; opacity: 0; font-size: 0.95rem;"></p>
    </div>
</div>
@endsection

@section('scripts')
<script>
let correctAnswers = [];
let currentQuestion = 0;
let playfulClickCount = 0;
let buttonSetup = false;

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
    
    // Question 4 (index 3) - all answers are correct
    const isCorrect = questionIndex === 3 || optionIndex === correctIndex;
    
    if (isCorrect) {
        selectedOption.classList.add('correct');
        
        // Store correct answer letter
        const answerLetter = selectedOption.textContent.trim();
        correctAnswers.push(answerLetter);
        
        const feedback = document.createElement('div');
        feedback.className = 'success-message';
        feedback.style.marginTop = '1rem';
        feedback.innerHTML = '💖 Benar! Kamu hebat...';
        questionEl.appendChild(feedback);
        
        if (nextBtn) {
            setTimeout(() => {
                nextBtn.style.display = 'block';
                nextBtn.classList.add('slide-up');
            }, 800);
        } else {
            // Last question - show name reveal
            setTimeout(() => {
                showNameReveal();
            }, 1500);
        }
    } else {
        selectedOption.classList.add('wrong');
        
        const feedback = document.createElement('div');
        feedback.className = 'error-message';
        feedback.style.marginTop = '1rem';
        feedback.innerHTML = '💭 Hmm, coba lagi ya...';
        questionEl.appendChild(feedback);
        
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

function showNextQuestion(currentIndex) {
    const currentSection = document.querySelector(`[data-question="${currentIndex}"]`);
    const nextSection = document.querySelector(`[data-question="${currentIndex + 1}"]`);
    
    currentSection.style.opacity = '0';
    currentSection.style.transform = 'translateX(-30px) scale(0.98)';
    currentSection.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
    
    setTimeout(() => {
        currentSection.style.display = 'none';
        currentSection.classList.add('hidden');
        
        nextSection.classList.remove('hidden');
        nextSection.style.display = 'block';
        nextSection.style.opacity = '0';
        nextSection.style.transform = 'translateX(30px) scale(0.98)';
        
        setTimeout(() => {
            nextSection.style.opacity = '1';
            nextSection.style.transform = 'translateX(0) scale(1)';
            nextSection.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
        }, 50);
    }, 500);
}

function showNameReveal() {
    const quizContainer = document.getElementById('quizContainer');
    const nameReveal = document.getElementById('nameReveal');
    const letterContainer = document.getElementById('letterContainer');
    const subtitle = document.getElementById('subtitle');
    const playfulBtn = document.getElementById('playfulBtn');
    
    console.log('showNameReveal called');
    console.log('nameReveal element:', nameReveal);
    
    // Hide quiz
    quizContainer.style.opacity = '0';
    quizContainer.style.transform = 'scale(0.95)';
    quizContainer.style.transition = 'all 0.5s ease';
    
    setTimeout(() => {
        quizContainer.style.display = 'none';
        nameReveal.style.display = 'flex';
        console.log('nameReveal display set to flex');
        
        // Animate letters one by one
        const name = 'FIJAN';
        console.log('Starting letter animation for:', name);
        name.split('').forEach((letter, index) => {
            setTimeout(() => {
                console.log('Adding letter:', letter);
                const letterEl = document.createElement('div');
                letterEl.textContent = letter;
                letterEl.style.cssText = `
                    font-size: 2.5rem;
                    font-weight: 700;
                    color: var(--pink-main);
                    font-family: 'Playfair Display', serif;
                    opacity: 0;
                    transform: scale(0) rotate(-180deg);
                    transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
                    text-shadow: 0 4px 12px rgba(242, 161, 179, 0.3);
                `;
                letterContainer.appendChild(letterEl);
                
                setTimeout(() => {
                    letterEl.style.opacity = '1';
                    letterEl.style.transform = 'scale(1) rotate(0deg)';
                }, 50);
            }, index * 400);
        });
        
        // Show subtitle
        setTimeout(() => {
            subtitle.style.opacity = '1';
            subtitle.style.animation = 'fadeIn 0.8s ease-out forwards';
        }, name.length * 400 + 500);
        
        // Fade out subtitle and show playful button
        setTimeout(() => {
            subtitle.style.opacity = '0';
            subtitle.style.transform = 'translateY(-20px)';
            subtitle.style.transition = 'all 0.6s ease-out';
            
            setTimeout(() => {
                playfulBtn.style.display = 'inline-block';
                playfulBtn.style.opacity = '1';
                playfulBtn.style.animation = 'slideUp 0.6s ease-out forwards';
                
                // Add playful button behavior
                setupPlayfulButton();
            }, 700);
        }, name.length * 400 + 3500);
        
    }, 500);
}

function setupPlayfulButton() {
    if (buttonSetup) return;
    buttonSetup = true;
    
    const playfulBtn = document.getElementById('playfulBtn');
    const playfulMessage = document.getElementById('playfulMessage');
    const messages = [
        'Etsss coba click lagi 😝',
        'Coba lagi deh... 😏',
        'Coba coba sekali lagi.. 😆',
        'Sabar ya Cantik, sekali lagi.. 💕'
    ];
    
    console.log('setupPlayfulButton called, adding event listener');
    
    playfulBtn.addEventListener('click', function(e) {
        console.log('Button clicked, count:', playfulClickCount);
        
        if (playfulClickCount < 4) {
            e.preventDefault();
            
            // Move button randomly
            const maxX = 150;
            const maxY = 100;
            const randomX = (Math.random() - 0.5) * maxX;
            const randomY = (Math.random() - 0.5) * maxY;
            
            console.log('Moving button to:', randomX, randomY);
            this.style.transform = `translate(${randomX}px, ${randomY}px)`;
            
            // Show playful message
            playfulMessage.textContent = messages[playfulClickCount];
            playfulMessage.style.opacity = '1';
            
            setTimeout(() => {
                playfulMessage.style.opacity = '0';
            }, 1500);
            
            playfulClickCount++;
            
            if (playfulClickCount === 4) {
                setTimeout(() => {
                    this.style.transform = 'translate(0, 0)';
                    this.textContent = 'Oke sekarang bisa! Klik aku 💖';
                    this.style.animation = 'pulse 1s infinite ease-in-out';
                }, 1000);
            }
        } else {
            // Allow navigation
            this.disabled = true;
            this.innerHTML = '<span style="display: inline-block; animation: spin 1s linear infinite;">⏳</span> Melanjutkan...';
            
            setTimeout(() => {
                window.RomanticApp.transitionTo('{{ route("upload") }}');
            }, 800);
        }
    });
}

// Add fadeOut animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(-20px); }
    }
`;
document.head.appendChild(style);
</script>
@endsection
