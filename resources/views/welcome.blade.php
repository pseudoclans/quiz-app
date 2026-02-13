<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Quiz App') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased selection:bg-indigo-500 selection:text-white">

        <!-- Background Mesh -->
        <div class="mesh-gradient">
            <div class="mesh-blob blob-1"></div>
            <div class="mesh-blob blob-2"></div>
            <div class="mesh-blob blob-3"></div>
        </div>

        <!-- Navigation -->
        <nav class="fixed w-full z-50 top-0 transition-all duration-300" id="navbar">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="glass-panel rounded-full px-6 py-3 flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center font-bold text-white shadow-lg shadow-indigo-500/30">Q</div>
                        <span class="font-semibold text-lg tracking-tight">QuizApp</span>
                    </div>
                    
                    <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-300">
                        <a href="#" class="hover:text-white transition-colors">Features</a>
                        <a href="#" class="hover:text-white transition-colors">Pricing</a>
                        <a href="#" class="hover:text-white transition-colors">Community</a>
                    </div>

                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm text-slate-300 hover:text-white transition-colors">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-slate-300 hover:text-white transition-colors">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm bg-white/10 hover:bg-white/20 border border-white/10 rounded-full transition-all text-white font-medium">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative pt-40 pb-20 lg:pt-52 lg:pb-32 px-6">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-xs font-medium mb-6 fade-in-up">
                    <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                    <span>New: AI-Powered Questions</span>
                </div>
                
                <h1 class="text-5xl md:text-7xl font-bold tracking-tight mb-8 leading-tight fade-in-up delay-100">
                    <span class="text-gradient">Master your skills with</span><br />
                    <span class="text-gradient-primary">intelligent quizzes.</span>
                </h1>
                
                <p class="text-lg md:text-xl text-slate-400 mb-10 max-w-2xl mx-auto leading-relaxed fade-in-up delay-200">
                    Challenge yourself with curated tests designed to boost your retention and understanding. The modern way to learn.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 fade-in-up delay-300">
                    <a href="{{ route('register') }}" class="floating-cta px-8 py-4 rounded-full text-white font-semibold text-lg hover:shadow-2xl hover:shadow-indigo-500/40 w-full sm:w-auto">
                        Start for free
                    </a>
                    <a href="#features" class="px-8 py-4 rounded-full glass-card hover:bg-white/5 font-medium text-slate-200 w-full sm:w-auto">
                        View demo
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats / Social Proof -->
        <div class="max-w-6xl mx-auto px-6 mb-32 fade-in-up delay-300">
            <div class="glass-panel rounded-2xl p-8 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl font-bold text-white mb-1">10k+</div>
                    <div class="text-xs uppercase tracking-wider text-slate-500">Active Users</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-white mb-1">500+</div>
                    <div class="text-xs uppercase tracking-wider text-slate-500">Topics</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-white mb-1">1M+</div>
                    <div class="text-xs uppercase tracking-wider text-slate-500">Quizzes Taken</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-white mb-1">4.9/5</div>
                    <div class="text-xs uppercase tracking-wider text-slate-500">User Rating</div>
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <div id="features" class="max-w-7xl mx-auto px-6 py-20">
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="glass-card p-8 rounded-2xl group">
                    <div class="w-12 h-12 bg-indigo-500/20 rounded-xl flex items-center justify-center mb-6 text-indigo-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-white">Lightning Fast</h3>
                    <p class="text-slate-400 leading-relaxed">Experience zero latency with our edge-cached quiz engine designed for global performance.</p>
                </div>

                <!-- Feature 2 -->
                <div class="glass-card p-8 rounded-2xl group">
                    <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center mb-6 text-purple-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-white">Deep Analytics</h3>
                    <p class="text-slate-400 leading-relaxed">Track your progress with detailed insights and performance metrics visualized beautifully.</p>
                </div>

                <!-- Feature 3 -->
                <div class="glass-card p-8 rounded-2xl group">
                    <div class="w-12 h-12 bg-pink-500/20 rounded-xl flex items-center justify-center mb-6 text-pink-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-white">Customizable</h3>
                    <p class="text-slate-400 leading-relaxed">Tailor every aspect of your learning experience with our flexible settings and themes.</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="border-t border-white/5 mt-20">
            <div class="max-w-7xl mx-auto px-6 py-12 flex flex-col md:flex-row justify-between items-center text-slate-500 text-sm">
                <p>&copy; 2026 QuizApp Inc. All rights reserved.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms</a>
                    <a href="#" class="hover:text-white transition-colors">Twitter</a>
                </div>
            </div>
        </footer>
    </body>
</html>
