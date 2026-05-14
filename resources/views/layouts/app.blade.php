<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'OSSD Bheri') }} - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 bg-gray-50">
    <nav class="bg-blue-600 text-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold">OSSD Bheri</a>
            
            <div class="space-x-4">
                @auth
                    <a href="{{ route('announcements.index') }}" class="nav-link text-white hover:bg-blue-700">Announcements</a>
                    <a href="{{ route('documents.index') }}" class="nav-link text-white hover:bg-blue-700">Documents</a>
                    
                    @if(auth()->user()->isStudent())
                        <a href="{{ route('results.index') }}" class="nav-link text-white hover:bg-blue-700">Results</a>
                    @endif
                    
                    <a href="{{ route('feedbacks.index') }}" class="nav-link text-white hover:bg-blue-700">Feedback</a>
                    <a href="{{ route('dashboard') }}" class="nav-link text-white hover:bg-blue-700">Dashboard</a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="nav-link text-white hover:bg-blue-700">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link text-white hover:bg-blue-700">Login</a>
                    <a href="{{ route('register') }}" class="nav-link text-white hover:bg-blue-700">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    
    <div class="container mx-auto px-4 py-8">
        @if($errors->any())
            <div class="alert alert-error mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        @yield('content')
    </div>
</body>
</html>
