@extends('layouts.app')

@section('content')
<div class="romantic-card max-w-2xl mx-auto" data-animate="fade-in">
    <div class="text-center mb-8">
        <div style="font-size: 3rem; margin-bottom: 0.5rem; animation: float 3s infinite ease-in-out;"><img src="{{ asset('icons/surat.png') }}" style="width: 35%; height: 35%; object-fit: contain;"></div>
        <h2 class="text-3xl font-light mb-2" style="color: var(--pink-main);">
            Surat Untukmu
        </h2>
        <p class="opacity-75" style="color: var(--grey-dark);">
            Tuliskan isi hatimu yang paling dalam...
        </p>
    </div>
    
    <form method="POST" action="{{ route('letter') }}" onsubmit="handleLetterSubmit(event)" id="letterForm">
        @csrf
        
        <div class="mb-6" style="animation: fadeIn 0.6s ease-out 0.3s both;">
            <textarea id="message" 
                      name="message" 
                      class="romantic-textarea" 
                      style="min-height: 200px; resize: vertical;"
                      placeholder="Tuliskan perasaanmu di sini... ✍️"
                      maxlength="1000"
                      required></textarea>
            <div style="display: flex; justify-content: space-between; margin-top: 0.75rem; font-size: 0.875rem; color: var(--grey-dark); opacity: 0.75;">
                <span>💌 Pesan ini akan disimpan selamanya</span>
                <span id="charCount">0/1000</span>
            </div>
        </div>
        
        <button type="submit" class="romantic-btn w-full" style="animation: fadeIn 0.6s ease-out 0.5s both;">
            💝 Kirim Surat Cinta
        </button>
    </form>
    
    <div class="mt-8 text-center" style="animation: fadeIn 0.6s ease-out 0.7s both;">
        <p class="text-sm opacity-75" style="color: var(--grey-dark); font-style: italic;">
            "Kata-kata yang tulus adalah hadiah terindah"
        </p>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    
    // Character counter with smooth update
    textarea.addEventListener('input', function() {
        const length = this.value.length;
        charCount.textContent = `${length}/1000`;
        
        if (length > 900) {
            charCount.style.color = 'var(--pink-main)';
            charCount.style.fontWeight = '600';
        } else {
            charCount.style.color = '';
            charCount.style.fontWeight = '';
        }
    });
    
    // Auto-resize textarea smoothly
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
    
    // Add gentle typing effect feedback
    let typingTimeout;
    textarea.addEventListener('input', function() {
        clearTimeout(typingTimeout);
        this.style.borderColor = 'var(--pink-main)';
        this.style.boxShadow = '0 0 0 4px rgba(242, 161, 179, 0.15)';
        
        typingTimeout = setTimeout(() => {
            this.style.borderColor = '';
            this.style.boxShadow = '';
        }, 1000);
    });
});
</script>
@endsection
