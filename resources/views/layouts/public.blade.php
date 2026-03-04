<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - eMaS</title>
    <link rel="icon" type="image/png" href="{{ asset('prem.icon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-gradient {
            background: linear-gradient(135deg, #004d40 0%, #00695c 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="hero-gradient text-white py-4 shadow-lg">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold tracking-tighter">
                <span class="text-yellow-500">e</span>MaS
            </a>
            <div class="flex items-center space-x-6">
                <a href="{{ route('public.results.index') }}" class="text-sm font-semibold hover:text-teal-200">Results</a>
                <a href="{{ route('public.resources.index') }}" class="text-sm font-semibold hover:text-teal-200">Resources</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-white text-teal-900 px-4 py-2 rounded-lg text-sm font-bold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-teal-200">Sign In</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-teal-950 text-white py-10 mt-20">
        <div class="container mx-auto px-6 text-center">
            <p class="text-sm opacity-75">&copy; {{ date('Y') }} <span class="text-yellow-500">e</span>MaS - Electronic Marking System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
