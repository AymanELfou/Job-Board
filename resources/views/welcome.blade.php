<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JobBoard | Find Your Next Big Opportunity</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --jb-red: #a31b1b;
            --jb-red-dark: #8b1616;
            --jb-red-light: #c22121;
        }

        body {
            font-family: 'Figtree', sans-serif;
            scroll-behavior: smooth;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .btn-primary-jb {
            background-color: var(--jb-red);
            border-color: var(--jb-red);
            color: white;
            font-weight: 700;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-primary-jb:hover {
            background-color: var(--jb-red-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(163, 27, 27, 0.3);
            color: white;
        }

        .nav-link-jb {
            font-weight: 600;
            font-size: 1.125rem;
            color: #4a5568;
            transition: all 0.3s ease;
            text-decoration: none !important;
        }

        .nav-link-jb:hover {
            color: var(--jb-red);
            text-decoration: none !important;
        }

        .card-feature {
            border: none;
            border-radius: 24px;
            padding: 2.5rem;
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .card-feature:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .icon-box {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            background: rgba(163, 27, 27, 0.1);
            color: var(--jb-red);
        }

        .search-box {
            background: white;
            border-radius: 20px;
            padding: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid #edf2f7;
        }

        .feature-tag {
            display: inline-block;
            padding: 6px 16px;
            background: rgba(163, 27, 27, 0.08);
            color: var(--jb-red);
            border-radius: 100px;
            font-size: 0.875rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body class="antialiased bg-white text-gray-900">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-lg border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('imgs/empj.png') }}" alt="JobBoard Logo" class="h-10 w-auto" />
                    <span class="text-2xl font-extrabold tracking-tighter text-gray-900 hidden sm:block">Job<span class="text-[#a31b1b]">Board</span></span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="nav-link-jb">Find Jobs</a>
                    <a href="#" class="nav-link-jb">Browse Companies</a>
                    <a href="#" class="nav-link-jb">Salary Guide</a>
                </div>

                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-primary-jb">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-lg font-bold text-gray-700 hover:text-[#a31b1b] transition-colors no-underline">Log In</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-primary-jb text-lg no-underline">Sign Up</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen pt-32 pb-20 hero-gradient relative overflow-hidden">
        <!-- Decorative blobs -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-red-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-red-50 rounded-full blur-3xl opacity-50"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <!-- Hero Content -->
                <div class="w-full lg:w-1/2 text-center lg:text-left">
                    <div class="feature-tag">#1 Recruitment Choice of 2024</div>
                    <h1 class="text-5xl lg:text-7xl font-extrabold text-gray-900 leading-[1.1] mb-8">
                        Connect with your <span class="text-[#a31b1b]">Destiny.</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-10 leading-relaxed max-w-xl mx-auto lg:mx-0">
                        The ultimate destination for ambitious professionals and elite employers. Navigate your career with the most advanced job board platform.
                    </p>

                    <!-- Mock Search Box -->
                    <div class="search-box mb-12 flex flex-col sm:flex-row items-center gap-4">
                        <div class="flex-grow flex items-center px-4 w-full">
                            <i class="bi bi-search text-gray-400 mr-3"></i>
                            <input type="text" placeholder="Job title, keywords..." class="w-full py-3 border-none focus:ring-0 outline-none placeholder-gray-400 font-medium" />
                        </div>
                        <div class="hidden sm:block h-8 w-px bg-gray-200"></div>
                        <div class="flex-grow flex items-center px-4 w-full">
                            <i class="bi bi-geo-alt text-gray-400 mr-3"></i>
                            <input type="text" placeholder="City or remote" class="w-full py-3 border-none focus:ring-0 outline-none placeholder-gray-400 font-medium" />
                        </div>
                        <button class="btn-primary-jb w-full sm:w-auto flex items-center justify-center gap-2">
                            <span>Search</span>
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>

                    <div class="flex items-center justify-center lg:justify-start space-x-6 text-sm text-gray-500 font-medium">
                        <span class="flex items-center"><i class="bi bi-check-circle-fill text-green-500 mr-2"></i> 15k+ Real Jobs</span>
                        <span class="flex items-center"><i class="bi bi-check-circle-fill text-green-500 mr-2"></i> Trusted Companies</span>
                    </div>
                </div>

                <!-- Hero Visual / Placeholder -->
                <div class="w-full lg:w-1/2">
                    <div class="relative">
                        <!-- Red Accent Frame -->
                        <div class="absolute -top-6 -right-6 w-full h-full border-2 border-[#a31b1b]/20 rounded-[40px] pointer-events-none"></div>
                        <div class="bg-white p-4 rounded-[40px] shadow-2xl relative">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1976&auto=format&fit=crop" 
                                 alt="Professional Networking" 
                                 class="rounded-[32px] w-full h-[500px] object-cover" />
                            
                            <!-- Floating Card -->
                            <div class="absolute -bottom-10 -left-10 bg-white p-6 rounded-3xl shadow-2xl border border-gray-50 max-w-xs animate-bounce-slow">
                                <div class="flex items-center gap-4 mb-3">
                                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600">
                                        <i class="bi bi-graph-up-arrow"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500 font-bold uppercase tracking-wider">Growth Rate</div>
                                        <div class="text-lg font-extrabold text-gray-900">+85% This Month</div>
                                    </div>
                                </div>
                                <div class="text-gray-600 text-sm leading-snug">
                                    "Your profile matches 12 new high-paying positions."
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Why Choose JobBoard?</h2>
                <p class="text-gray-500 max-w-2xl mx-auto text-lg">We provide a seamless experience for both sides of the recruitment market.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- For Candidates -->
                <div class="card-feature">
                    <div class="icon-box">
                        <i class="bi bi-person-check"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">For Candidates</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Access exclusive opportunities at top-tier companies. Our smart algorithms match your skills with the perfect roles.
                    </p>
                    <a href="{{ route('register') }}" class="text-[#a31b1b] text-lg font-extrabold flex items-center gap-2 hover:gap-3 transition-all no-underline">
                        Create Candidate Account <i class="bi bi-chevron-right"></i>
                    </a>
                </div>

                <!-- For Employers -->
                <div class="card-feature">
                    <div class="icon-box">
                        <i class="bi bi-building-check"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">For Employers</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Post your vacancies and browse our curated pool of elite candidates. Streamline your hiring process with our advanced dashboard.
                    </p>
                    <a href="{{ route('register') }}" class="text-[#a31b1b] text-lg font-extrabold flex items-center gap-2 hover:gap-3 transition-all no-underline">
                        Join as Employer <i class="bi bi-chevron-right"></i>
                    </a>
                </div>

                <!-- For Growth -->
                <div class="card-feature">
                    <div class="icon-box">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Secure & Private</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Your data is encrypted and protected. We value your privacy and ensure a safe environment for all professional connections.
                    </p>
                    <a href="#" class="text-[#a31b1b] text-lg font-extrabold flex items-center gap-2 hover:gap-3 transition-all no-underline">
                        Learn about Security <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-50 py-20 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-10">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('imgs/empj.png') }}" alt="JobBoard Logo" class="h-10 w-auto" />
                    <span class="text-2xl font-extrabold tracking-tighter text-gray-900">Job<span class="text-[#a31b1b]">Board</span></span>
                </div>

                <div class="flex space-x-8 text-base font-bold text-gray-500">
                    <a href="#" class="hover:text-[#a31b1b] no-underline transition-colors">About Us</a>
                    <a href="#" class="hover:text-[#a31b1b] no-underline transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-[#a31b1b] no-underline transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-[#a31b1b] no-underline transition-colors">Contact</a>
                </div>

                <div class="text-sm text-gray-400 font-medium">
                    &copy; {{ date('Y') }} JobBoard Platform. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <style>
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(-5%); animation-timing-function: cubic-bezier(0.8,0,1,1); }
            50% { transform: none; animation-timing-function: cubic-bezier(0,0,0.2,1); }
        }
        .animate-bounce-slow {
            animation: bounce-slow 4s infinite;
        }
    </style>
</body>
</html>
