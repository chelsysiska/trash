<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Your App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#3B82F6',
                        'primary-dark': '#1E40AF',
                        'accent': '#8B5CF6'
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #059669 0%, #10b981 50%, #34d399 100%);
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .pulse-slow {
            animation: pulse 3s infinite;
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white opacity-10 rounded-full floating-animation"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-white opacity-5 rounded-full floating-animation" style="animation-delay: -3s;"></div>
        <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-white opacity-10 rounded-full pulse-slow"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Main login card -->
        <div class="glass-effect rounded-2xl shadow-2xl p-8 transform transition-all duration-300 hover:scale-105">
            <!-- Logo and branding -->
            <div class="text-center mb-8">
                <!-- Attractive Waste Bank Digital Logo -->
                <div class="relative inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-green-400 via-emerald-500 to-teal-600 rounded-3xl mb-4 shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-300">
                    <!-- Glow effect -->
                    <div class="absolute inset-0 bg-gradient-to-br from-green-400 to-teal-600 rounded-3xl opacity-75 blur-lg"></div>
                    
                    <!-- Main logo container -->
                    <div class="relative z-10">
                        <svg class="w-14 h-14 text-white drop-shadow-lg" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <!-- Modern trash bin with rounded corners -->
                            <defs>
                                <linearGradient id="binGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:rgba(255,255,255,0.9)"/>
                                    <stop offset="100%" style="stop-color:rgba(255,255,255,0.7)"/>
                                </linearGradient>
                                <linearGradient id="lidGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:rgba(255,255,255,1)"/>
                                    <stop offset="100%" style="stop-color:rgba(255,255,255,0.8)"/>
                                </linearGradient>
                            </defs>
                            
                            <!-- Trash bin body with rounded bottom -->
                            <path d="M6 7L7 19.5C7 20.3 7.7 21 8.5 21H15.5C16.3 21 17 20.3 17 19.5L18 7Z" 
                                  fill="url(#binGradient)" stroke="rgba(255,255,255,0.3)" stroke-width="0.5"/>
                            
                            <!-- Trash bin lid with handles -->
                            <path d="M4 5V7H20V5C20 4.4 19.6 4 19 4H17.5V3C17.5 2.2 16.8 1.5 16 1.5H8C7.2 1.5 6.5 2.2 6.5 3V4H5C4.4 4 4 4.4 4 5Z" 
                                  fill="url(#lidGradient)"/>
                            
                            <!-- Recycle symbol in center -->
                            <g transform="translate(12,13)">
                                <!-- Circular arrows forming recycle symbol -->
                                <path d="M-2.5,-1.5 Q-3,-3 -1.5,-3.5 Q0,-4 1.5,-3.5 Q3,-3 2.5,-1.5" 
                                      stroke="rgba(34,197,94,0.9)" stroke-width="1.2" fill="none" stroke-linecap="round"/>
                                <path d="M2.5,-1.5 Q3,0 2.5,1.5 Q2,3 0.5,3.5 Q-1,4 -2.5,3.5" 
                                      stroke="rgba(34,197,94,0.9)" stroke-width="1.2" fill="none" stroke-linecap="round"/>
                                <path d="M-2.5,1.5 Q-3,0 -2.5,-1.5 Q-2,-3 -0.5,-3.5 Q1,-4 2.5,-3.5" 
                                      stroke="rgba(34,197,94,0.9)" stroke-width="1.2" fill="none" stroke-linecap="round"/>
                                
                                <!-- Arrow heads -->
                                <polygon points="2,2 3,1.5 2.5,0.5" fill="rgba(34,197,94,0.9)"/>
                                <polygon points="-2,-2 -3,-1.5 -2.5,-0.5" fill="rgba(34,197,94,0.9)"/>
                                <polygon points="0.5,3 -0.5,3.5 0,2.5" fill="rgba(34,197,94,0.9)"/>
                            </g>
                            
                            <!-- Digital pixels/sparkles around -->
                            <circle cx="8" cy="9" r="0.8" fill="rgba(52,211,153,0.8)"/>
                            <circle cx="16" cy="11" r="0.6" fill="rgba(52,211,153,0.6)"/>
                            <circle cx="10" cy="16" r="0.7" fill="rgba(52,211,153,0.7)"/>
                            <circle cx="14" cy="18" r="0.5" fill="rgba(52,211,153,0.5)"/>
                            
                            <!-- Money/coin symbols for bank aspect -->
                            <text x="19" y="10" font-size="3" fill="rgba(253,224,71,0.8)" font-weight="bold">₿</text>
                            <text x="3" y="15" font-size="2.5" fill="rgba(253,224,71,0.6)" font-weight="bold">$</text>
                        </svg>
                    </div>
                    
                    <!-- Animated ring -->
                    <div class="absolute inset-0 border-2 border-white/30 rounded-3xl animate-pulse"></div>
                </div>
                
                <!-- App title with animated text -->
                <div class="relative">
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 bg-clip-text text-transparent mb-2 animate-pulse">
                        💚 TRASH2CASH
                    </h1>
                    <div class="absolute -top-2 -right-8">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 animate-bounce">
                            ♻️ Go Green!
                        </span>
                    </div>
                </div>
                <p class="text-gray-600 font-medium">🌱 Kelola sampah pintar, raup cuan digital! 💰</p>
            </div>

            <!-- Error message (Laravel Blade) -->
            <div class="mb-6">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg mb-4 animate-pulse">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Login form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <!-- Email input -->
                <div class="relative">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                        </svg>
                        Email Address
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email"
                           class="input-focus w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-green-500 transition-all duration-300 bg-white/70"
                           placeholder="masukkan@email.com"
                           required 
                           autofocus>
                    <div class="absolute inset-y-0 right-0 top-8 pr-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>

                <!-- Password input -->
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Password
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password"
                           class="input-focus w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-green-500 transition-all duration-300 bg-white/70"
                           placeholder="••••••••"
                           required>
                </div>

                <!-- Remember me & Forgot password -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                        <span class="ml-2 text-gray-600">Ingat saya</span>
                    </label>
                    <a href="#" class="text-green-600 hover:text-green-700 font-medium transition-colors duration-200">
                        Lupa password?
                    </a>
                </div>

                <!-- Login button -->
                <button type="submit"
                        class="btn-hover w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform focus:outline-none focus:ring-4 focus:ring-green-500/50">
                    <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Masuk ke Bank Sampah
                </button>
            </form>

            <!-- Register link -->
            <div class="text-center">
                <p class="text-gray-600">
                    Belum punya akun?
                    <a href="{{ url('/register') }}" 
                       class="text-green-600 hover:text-green-700 font-semibold transition-colors duration-200 ml-1">
                        Register
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-white/80">
            <p class="text-sm">© 2025 Bank Sampah Digital. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>