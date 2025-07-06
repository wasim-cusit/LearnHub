<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnHub - Your Gateway to Knowledge</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .gradient-bg-dark { background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }

        /* Dark mode styles */
        .dark body { background-color: #111827; color: #f9fafb; }
        .dark .bg-white { background-color: #1f2937; }
        .dark .bg-gray-50 { background-color: #374151; }
        .dark .bg-gray-100 { background-color: #4b5563; }
        .dark .text-gray-900 { color: #f9fafb; }
        .dark .text-gray-700 { color: #d1d5db; }
        .dark .text-gray-600 { color: #9ca3af; }
        .dark .text-gray-500 { color: #6b7280; }
        .dark .text-gray-400 { color: #9ca3af; }
        .dark .border-gray-800 { border-color: #374151; }
        .dark .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.2); }
        .dark .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4); }

        /* Smooth transitions for theme switching */
        * { transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease; }

        /* Theme toggle button styles */
        .theme-toggle {
            position: relative;
            width: 60px;
            height: 30px;
            background: #e5e7eb;
            border-radius: 15px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .theme-toggle.dark {
            background: #374151;
        }

        .theme-toggle::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            width: 26px;
            height: 26px;
            background: #fbbf24;
            border-radius: 50%;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .theme-toggle.dark::after {
            transform: translateX(30px);
            background: #6b7280;
        }

        .theme-toggle .sun-icon,
        .theme-toggle .moon-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 12px;
            transition: opacity 0.3s ease;
        }

        .theme-toggle .sun-icon {
            left: 8px;
            color: #f59e0b;
        }

        .theme-toggle .moon-icon {
            right: 8px;
            color: #6b7280;
        }

        .theme-toggle.dark .sun-icon {
            opacity: 0;
        }

        .theme-toggle.dark .moon-icon {
            opacity: 1;
        }

        .theme-toggle:not(.dark) .sun-icon {
            opacity: 1;
        }

        .theme-toggle:not(.dark) .moon-icon {
            opacity: 0;
        }
    </style>
</head>
<body class="bg-gray-50" id="body">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-indigo-600">LearnHub</h1>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Home</a>
                    <a href="#courses" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Courses</a>
                    <a href="#features" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Features</a>
                    <a href="#testimonials" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Testimonials</a>
                    <a href="#contact" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Contact</a>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle Button -->
                    <div class="theme-toggle" id="themeToggle" title="Toggle dark mode">
                        <i class="fas fa-sun sun-icon"></i>
                        <i class="fas fa-moon moon-icon"></i>
                    </div>
                    <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-300 font-medium">
                        <a href="{{ route('getStarted') }}">Get Started</a>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="gradient-bg dark:gradient-bg-dark min-h-screen flex items-center justify-center pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-left">
                    <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                        Master New Skills
                        <span class="block text-yellow-300">Anytime, Anywhere</span>
                    </h1>
                    <p class="text-xl text-gray-200 mb-8 leading-relaxed">
                        Join millions of learners worldwide and unlock your potential with our comprehensive online learning platform. From coding to design, business to arts - we've got you covered.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition duration-300 shadow-lg">
                            <i class="fas fa-play mr-2"></i> <a href="{{ route('startLearning') }}">Start Learning</a>
                        </button>
                        <button class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-indigo-600 transition duration-300">
                            <i class="fas fa-info-circle mr-2"></i><a href="{{ route('learnMore') }}">Learn More</a>
                        </button>
                    </div>
                    <div class="mt-8 flex items-center text-white">
                        <div class="flex -space-x-2">
                            <img class="w-10 h-10 rounded-full border-2 border-white" src="https://ix-marketing.imgix.net/focalpoint.png?auto=format,compress&w=1946" alt="User">
                            <img class="w-10 h-10 rounded-full border-2 border-white" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=100&q=80" alt="User">
                            <img class="w-10 h-10 rounded-full border-2 border-white" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=100&q=80" alt="User">
                        </div>
                        <p class="ml-4 text-sm">Join 50,000+ learners worldwide</p>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-white rounded-2xl p-8 shadow-2xl">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            </div>
                            <div class="bg-gray-100 rounded-lg p-4">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-code text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">Web Development</h3>
                                        <p class="text-sm text-gray-600">Learn HTML, CSS, JavaScript</p>
                                    </div>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: 75%"></div>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">75% Complete</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose LearnHub?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Discover the features that make us the preferred choice for learners worldwide
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl card-hover">
                    <div class="w-16 h-16 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-laptop-code text-2xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Interactive Learning</h3>
                    <p class="text-gray-600">Engage with hands-on projects, real-world scenarios, and interactive exercises that make learning fun and effective.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl card-hover">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-clock text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Learn at Your Pace</h3>
                    <p class="text-gray-600">No deadlines, no pressure. Learn whenever and wherever you want with our flexible, self-paced courses.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl card-hover">
                    <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-certificate text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Certificates</h3>
                    <p class="text-gray-600">Earn industry-recognized certificates upon completion to boost your resume and career prospects.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl card-hover">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-users text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Expert Instructors</h3>
                    <p class="text-gray-600">Learn from industry experts and professionals who have real-world experience in their fields.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl card-hover">
                    <div class="w-16 h-16 bg-yellow-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-mobile-alt text-2xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Mobile Friendly</h3>
                    <p class="text-gray-600">Access your courses on any device - desktop, tablet, or mobile. Learn on the go!</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl card-hover">
                    <div class="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-headset text-2xl text-red-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">24/7 Support</h3>
                    <p class="text-gray-600">Get help whenever you need it with our round-the-clock customer support team.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Categories -->
    <section id="courses" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Explore Our Courses</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Choose from hundreds of courses across various categories and start your learning journey today
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl overflow-hidden shadow-lg card-hover">
                    <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                        <i class="fas fa-code text-6xl text-white"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Programming</h3>
                        <p class="text-gray-600 mb-4">Master coding languages and frameworks</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">150+ Courses</span>
                            <button class="text-indigo-600 hover:text-indigo-700 font-medium">Explore →</button>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl overflow-hidden shadow-lg card-hover">
                    <div class="h-48 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-palette text-6xl text-white"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Design</h3>
                        <p class="text-gray-600 mb-4">Create stunning visuals and user experiences</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">120+ Courses</span>
                            <button class="text-indigo-600 hover:text-indigo-700 font-medium">Explore →</button>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl overflow-hidden shadow-lg card-hover">
                    <div class="h-48 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                        <i class="fas fa-chart-line text-6xl text-white"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Business</h3>
                        <p class="text-gray-600 mb-4">Develop essential business skills</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">200+ Courses</span>
                            <button class="text-indigo-600 hover:text-indigo-700 font-medium">Explore →</button>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl overflow-hidden shadow-lg card-hover">
                    <div class="h-48 bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center">
                        <i class="fas fa-language text-6xl text-white"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Languages</h3>
                        <p class="text-gray-600 mb-4">Learn new languages and cultures</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">80+ Courses</span>
                            <button class="text-indigo-600 hover:text-indigo-700 font-medium">Explore →</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">What Our Students Say</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Hear from our community of learners who have transformed their careers and lives
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">"LearnHub completely changed my career trajectory. The web development course helped me land my dream job as a frontend developer."</p>
                    <div class="flex items-center">
                        <img class="w-12 h-12 rounded-full mr-4" src="https://ix-marketing.imgix.net/focalpoint.png?auto=format,compress&w=1946" alt="Sarah Johnson">
                        <div>
                            <h4 class="font-semibold text-gray-900">Sarah Johnson</h4>
                            <p class="text-sm text-gray-500">Frontend Developer</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">"The flexibility of learning at my own pace was perfect for my busy schedule. The instructors are incredibly knowledgeable and supportive."</p>
                    <div class="flex items-center">
                        <img class="w-12 h-12 rounded-full mr-4" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=100&q=80" alt="Michael Chen">
                        <div>
                            <h4 class="font-semibold text-gray-900">Michael Chen</h4>
                            <p class="text-sm text-gray-500">UX Designer</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6">"I started with zero coding knowledge and now I'm building my own applications. The step-by-step approach made everything so clear."</p>
                    <div class="flex items-center">
                        <img class="w-12 h-12 rounded-full mr-4" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=100&q=80" alt="Emily Rodriguez">
                        <div>
                            <h4 class="font-semibold text-gray-900">Emily Rodriguez</h4>
                            <p class="text-sm text-gray-500">Full Stack Developer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 gradient-bg dark:gradient-bg-dark">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-white mb-6">Ready to Start Your Learning Journey?</h2>
            <p class="text-xl text-gray-200 mb-8">
                Join thousands of learners who have already transformed their careers with LearnHub
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition duration-300 shadow-lg">
                    <i class="fas fa-rocket mr-2"></i><a href="{{ route('getStarted') }}">Get Started Free</a>
                </button>
                <button class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-indigo-600 transition duration-300">
                    <i class="fas fa-play mr-2"></i>Watch Demo
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-indigo-400 mb-4">LearnHub</h3>
                    <p class="text-gray-400 mb-4">Your gateway to knowledge and skill development. Start learning today and unlock your potential.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Courses</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition duration-300">Programming</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Design</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Business</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Languages</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition duration-300">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Press</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition duration-300">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition duration-300">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2024 LearnHub. All rights reserved. Made with ❤️ for learners worldwide.</p>
            </div>
        </div>
    </footer>

    <script>
        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const body = document.getElementById('body');

        // Check for saved theme preference or default to light mode
        const currentTheme = localStorage.getItem('theme') || 'light';

        // Apply the saved theme on page load
        if (currentTheme === 'dark') {
            body.classList.add('dark');
            themeToggle.classList.add('dark');
        }

        // Theme toggle click handler
        themeToggle.addEventListener('click', () => {
            if (body.classList.contains('dark')) {
                // Switch to light mode
                body.classList.remove('dark');
                themeToggle.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                // Switch to dark mode
                body.classList.add('dark');
                themeToggle.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to navigation
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 100) {
                nav.classList.add('bg-white/95', 'backdrop-blur-sm');
            } else {
                nav.classList.remove('bg-white/95', 'backdrop-blur-sm');
            }
        });
    </script>
</body>
</html>
