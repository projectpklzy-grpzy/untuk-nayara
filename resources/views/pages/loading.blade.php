@extends('layouts.app')

@section('content')
<div class="text-center">
    <div class="heart-loader mb-8" style="animation: heartbeat 1.2s infinite ease-in-out;"></div>
    
    <h2 class="text-2xl font-light mb-4" style="color: var(--pink-main); animation: fadeIn 0.6s ease-out;">
        Menyiapkan Kejutan...
    </h2>
    
    <!-- Cute Animals Animation Container -->
    <div id="animalStage" style="position: relative; height: 250px; margin: 2rem auto; max-width: 600px; animation: fadeIn 0.6s ease-out 0.3s both;">
        <!-- Animals will appear here -->
    </div>
    
    <div class="romantic-card max-w-md mx-auto mb-8" style="animation: slideUp 0.6s ease-out 0.5s both;">
        <div id="loadingMessages" style="min-height: 150px;">
            <!-- Messages will appear here -->
        </div>
        
        <div class="progress-container mt-6">
            <div id="progressBar" class="progress-bar" style="width: 0%"></div>
        </div>
        
        <p id="progressText" class="text-sm mt-3" style="color: var(--pink-main); font-weight: 500;">0%</p>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const messages = @json($messages);
    const container = document.getElementById('loadingMessages');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');
    const animalStage = document.getElementById('animalStage');
    
    // Cute messages with animals
    const cuteMessages = [
        { text: "Proses ke halaman berikutnya... 🌸", delay: 0 },
        { text: "Lihaatt... ada hamster 🐹", delay: 2000, showAnimals: ['hamster'] },
        { text: "Ada kucing jugaaa... 🐱✨", delay: 4000, showAnimals: ['kucing'] },
        { text: "Lucu ya kaya kamuu 🌹💕", delay: 6000, showAnimals: ['all'] }
    ];
    
    // Animal images
    const animals = {
        hamster: [
            '{{ asset("images/hewan-kesukaan/hamster-cilok.png") }}',
            '{{ asset("images/hewan-kesukaan/hamster-cis.png") }}',
            '{{ asset("images/hewan-kesukaan/hamster-starboy.png") }}'
        ],
        kucing: [
            '{{ asset("images/hewan-kesukaan/kucing-imut.png") }}',
            '{{ asset("images/hewan-kesukaan/kucing1.png") }}',
            '{{ asset("images/hewan-kesukaan/kucing2.png") }}',
            '{{ asset("images/hewan-kesukaan/kucing3.png") }}'
        ]
    };
    
    let currentMessage = 0;
    let animalIndex = 0;
    
    // Show cute messages
    function showCuteMessages() {
        cuteMessages.forEach((msg, index) => {
            setTimeout(() => {
                const messageEl = document.createElement('p');
                messageEl.style.cssText = `
                    opacity: 0;
                    animation: fadeIn 0.6s ease-out forwards;
                    color: var(--grey-dark);
                    font-size: 1.1rem;
                    font-weight: 500;
                    margin-bottom: 0.75rem;
                `;
                messageEl.textContent = msg.text;
                container.appendChild(messageEl);
                
                // Show animals
                if (msg.showAnimals) {
                    showAnimals(msg.showAnimals);
                }
                
                // Update progress
                const progress = Math.round(((index + 1) / cuteMessages.length) * 100);
                animateProgress(progress);
                
            }, msg.delay);
        });
    }
    
    // Show animals with cute animation
    function showAnimals(types) {
        animalStage.innerHTML = ''; // Clear previous
        
        if (types.includes('all')) {
            // Show all animals in a cute arrangement
            const allAnimals = [...animals.hamster, ...animals.kucing];
            allAnimals.forEach((src, i) => {
                setTimeout(() => {
                    createAnimal(src, i);
                }, i * 150);
            });
        } else if (types.includes('hamster')) {
            animals.hamster.forEach((src, i) => {
                setTimeout(() => {
                    createAnimal(src, i);
                }, i * 200);
            });
        } else if (types.includes('kucing')) {
            animals.kucing.forEach((src, i) => {
                setTimeout(() => {
                    createAnimal(src, i);
                }, i * 200);
            });
        }
    }
    
    // Create animal element with animation
    function createAnimal(src, index) {
        const animal = document.createElement('img');
        animal.src = src;
        animal.style.cssText = `
            position: absolute;
            width: 80px;
            height: 80px;
            object-fit: contain;
            opacity: 0;
            transform: scale(0) rotate(-180deg);
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
        `;
        
        // Random position
        const positions = [
            { left: '10%', top: '20%' },
            { left: '30%', top: '60%' },
            { left: '50%', top: '10%' },
            { left: '70%', top: '50%' },
            { left: '85%', top: '25%' },
            { left: '15%', top: '70%' },
            { left: '60%', top: '75%' }
        ];
        
        const pos = positions[index % positions.length];
        animal.style.left = pos.left;
        animal.style.top = pos.top;
        
        animalStage.appendChild(animal);
        
        // Animate in
        setTimeout(() => {
            animal.style.opacity = '1';
            animal.style.transform = 'scale(1) rotate(0deg)';
            
            // Add floating animation
            setTimeout(() => {
                animal.style.animation = `float ${3 + Math.random() * 2}s infinite ease-in-out ${Math.random()}s`;
            }, 600);
            
            // Add cute bounce on hover
            animal.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.2) rotate(5deg)';
            });
            
            animal.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1) rotate(0deg)';
            });
        }, 50);
    }
    
    // Animate progress
    function animateProgress(targetProgress) {
        let currentProgress = parseInt(progressText.textContent);
        const interval = setInterval(() => {
            if (currentProgress < targetProgress) {
                currentProgress++;
                progressBar.style.width = `${currentProgress}%`;
                progressText.textContent = `${currentProgress}%`;
            } else {
                clearInterval(interval);
            }
        }, 20);
    }
    
    // Start animations
    showCuteMessages();
    
    // Add emoji decorations
    setTimeout(() => {
        const emojis = ['🌸', '✨', '💕', '🌹', '💖', '⭐'];
        for(let i = 0; i < 10; i++) {
            setTimeout(() => {
                const emoji = document.createElement('div');
                emoji.textContent = emojis[Math.floor(Math.random() * emojis.length)];
                emoji.style.cssText = `
                    position: fixed;
                    left: ${Math.random() * 100}%;
                    top: ${Math.random() * 100}%;
                    font-size: ${20 + Math.random() * 20}px;
                    opacity: 0;
                    pointer-events: none;
                    animation: fadeIn 0.8s ease-out forwards, float ${4 + Math.random() * 2}s infinite ease-in-out ${Math.random()}s;
                    z-index: 0;
                `;
                document.body.appendChild(emoji);
            }, i * 300);
        }
    }, 1000);
    
    // Redirect after all animations
    setTimeout(() => {
        const finalMsg = document.createElement('p');
        finalMsg.style.cssText = `
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
            color: var(--pink-main);
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 1.5rem;
        `;
        finalMsg.innerHTML = '✨ Selesai! Menuju halaman berikutnya...';
        container.appendChild(finalMsg);
        
        setTimeout(() => {
            window.RomanticApp.transitionTo('{{ route("romantic.letter") }}');
        }, 1500);
    }, 8500);
});
</script>
@endsection
