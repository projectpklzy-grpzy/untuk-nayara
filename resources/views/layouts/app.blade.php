<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#f2a1b3">
    <title>{{ $title ?? 'Romantic Experience' }} ❤️</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
        body {
            opacity: 0;
        }
        .romantic-container {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body>
    <div class="romantic-container">
        @yield('content')
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>