@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-600 to-purple-600 text-white">
    <div class="container mx-auto px-4 py-16">
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-4">OSSD Bheri Educational Portal</h1>
            <p class="text-xl mb-8">A complete educational management system for schools and students</p>
            
            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary inline-block">
                    Go to Dashboard
                </a>
            @endauth
            
            @guest
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="btn-primary inline-block">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn-secondary inline-block">
                        Register
                    </a>
                </div>
            @endguest
        </div>
    </div>
    
    <div class="container mx-auto px-4 py-16">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="card bg-white text-gray-900">
                <h3 class="text-2xl font-bold mb-4">📚 Announcements</h3>
                <p>Stay updated with latest announcements and news from the institute</p>
            </div>
            <div class="card bg-white text-gray-900">
                <h3 class="text-2xl font-bold mb-4">📊 Results</h3>
                <p>View your exam results and academic performance</p>
            </div>
            <div class="card bg-white text-gray-900">
                <h3 class="text-2xl font-bold mb-4">📁 Documents</h3>
                <p>Access important documents and study materials</p>
            </div>
        </div>
    </div>
</div>
@endsection
