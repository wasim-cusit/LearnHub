<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - LearnHub</title>
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

        /* Animation classes */
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .scale-in {
            animation: scaleIn 0.6s ease-out;
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
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
                        <a href="/" class="text-2xl font-bold text-indigo-600">LearnHub</a>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Home</a>
                    <a href="/#courses" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Courses</a>
                    <a href="/#features" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Features</a>
                    <a href="/about-us" class="text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">About Us</a>
                    <a href="/#contact" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Contact</a>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle Button -->
                    <div class="theme-toggle" id="themeToggle" title="Toggle dark mode">
                        <i class="fas fa-sun sun-icon"></i>
                        <i class="fas fa-moon moon-icon"></i>
                    </div>
                    <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-300 font-medium">
                        <a href="/getStarted">Get Started</a>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-bg dark:gradient-bg-dark min-h-screen flex items-center justify-center pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="fade-in-up">
                <h1 class="text-5xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                    Our Story
                    <span class="block text-yellow-300">Our Mission</span>
                </h1>
                <p class="text-xl lg:text-2xl text-gray-200 mb-8 max-w-4xl mx-auto leading-relaxed">
                    We're passionate about democratizing education and making quality learning accessible to everyone, everywhere.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-white text-indigo-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition duration-300 shadow-lg">
                        <i class="fas fa-play mr-2"></i>Watch Our Story
                    </button>
                    <button class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-indigo-600 transition duration-300">
                        <i class="fas fa-download mr-2"></i>Download Brochure
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="fade-in-up">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Mission</h2>
                    <p class="text-xl text-gray-600 mb-6 leading-relaxed">
                        To empower individuals worldwide with the knowledge, skills, and confidence they need to achieve their dreams and make a positive impact in the world.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-check text-indigo-600 text-sm"></i>
                            </div>
                            <p class="text-gray-600">Making education accessible to everyone, regardless of their background or location</p>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-check text-indigo-600 text-sm"></i>
                            </div>
                            <p class="text-gray-600">Providing industry-relevant skills that lead to real career opportunities</p>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-check text-indigo-600 text-sm"></i>
                            </div>
                            <p class="text-gray-600">Creating a supportive community of learners and mentors</p>
                        </div>
                    </div>
                </div>
                <div class="scale-in">
                    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-8 text-white">
                        <h3 class="text-2xl font-bold mb-4">Our Vision</h3>
                        <p class="text-lg mb-6">
                            To become the world's leading platform for accessible, high-quality education that transforms lives and communities.
                        </p>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold">50M+</div>
                                <div class="text-sm opacity-90">Learners Worldwide</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold">200+</div>
                                <div class="text-sm opacity-90">Countries Reached</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Core Values</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    The principles that guide everything we do and shape our culture
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-8 rounded-xl card-hover text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-heart text-2xl text-red-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Passion</h3>
                    <p class="text-gray-600">We're passionate about education and committed to helping every learner succeed.</p>
                </div>
                <div class="bg-white p-8 rounded-xl card-hover text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-lightbulb text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Innovation</h3>
                    <p class="text-gray-600">We constantly innovate to provide the best learning experience possible.</p>
                </div>
                <div class="bg-white p-8 rounded-xl card-hover text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Community</h3>
                    <p class="text-gray-600">We believe in the power of community and collaborative learning.</p>
                </div>
                <div class="bg-white p-8 rounded-xl card-hover text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-star text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Excellence</h3>
                    <p class="text-gray-600">We strive for excellence in everything we do, from content to customer service.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Meet Our Team</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    The passionate individuals behind LearnHub who are dedicated to transforming education
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-xl p-8 text-center card-hover">
                    <img class="w-32 h-32 rounded-full mx-auto mb-6 object-cover" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=300&q=80" alt="CEO">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">David Chen</h3>
                    <p class="text-indigo-600 font-medium mb-4">CEO & Founder</p>
                    <p class="text-gray-600 mb-4">Former Google engineer with 15+ years in edtech. Passionate about making education accessible to everyone.</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition duration-300">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-8 text-center card-hover">
                    <img class="w-32 h-32 rounded-full mx-auto mb-6 object-cover" src="https://ix-marketing.imgix.net/focalpoint.png?auto=format,compress&w=1946" alt="CTO">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Sarah Johnson</h3>
                    <p class="text-indigo-600 font-medium mb-4">CTO</p>
                    <p class="text-gray-600 mb-4">Tech leader with expertise in AI and machine learning. Building the future of personalized education.</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition duration-300">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition duration-300">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-xl p-8 text-center card-hover">
                    <img class="w-32 h-32 rounded-full mx-auto mb-6 object-cover" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=300&q=80" alt="Head of Content">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Emily Rodriguez</h3>
                    <p class="text-indigo-600 font-medium mb-4">Head of Content</p>
                    <p class="text-gray-600 mb-4">Former university professor with a PhD in Education. Creating world-class learning experiences.</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition duration-300">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition duration-300">
                            <i class="fas fa-globe"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 gradient-bg dark:gradient-bg-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">Our Impact in Numbers</h2>
                <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                    See how we're making a difference in the world of education
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">2M+</div>
                    <div class="text-gray-200">Active Learners</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">500+</div>
                    <div class="text-gray-200">Expert Instructors</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">10K+</div>
                    <div class="text-gray-200">Courses Available</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">95%</div>
                    <div class="text-gray-200">Success Rate</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Journey</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    From a small startup to a global education platform
                </p>
            </div>
            <div class="relative">
                <div class="absolute left-1/2 transform -translate-x-1/2 w-1 bg-indigo-200 h-full"></div>
                <div class="space-y-12">
                    <div class="flex items-center">
                        <div class="w-1/2 pr-8 text-right">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">2018 - The Beginning</h3>
                            <p class="text-gray-600">Founded with a vision to democratize education and make learning accessible to everyone.</p>
                        </div>
                        <div class="w-4 h-4 bg-indigo-600 rounded-full border-4 border-white shadow-lg"></div>
                        <div class="w-1/2 pl-8"></div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-1/2 pr-8"></div>
                        <div class="w-4 h-4 bg-indigo-600 rounded-full border-4 border-white shadow-lg"></div>
                        <div class="w-1/2 pl-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">2020 - First Million</h3>
                            <p class="text-gray-600">Reached our first million learners and expanded to 50+ countries worldwide.</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-1/2 pr-8 text-right">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">2022 - AI Integration</h3>
                            <p class="text-gray-600">Launched AI-powered personalized learning paths and adaptive assessments.</p>
                        </div>
                        <div class="w-4 h-4 bg-indigo-600 rounded-full border-4 border-white shadow-lg"></div>
                        <div class="w-1/2 pl-8"></div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-1/2 pr-8"></div>
                        <div class="w-4 h-4 bg-indigo-600 rounded-full border-4 border-white shadow-lg"></div>
                        <div class="w-1/2 pl-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">2024 - Global Leader</h3>
                            <p class="text-gray-600">Became the world's leading online learning platform with 2M+ active learners.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Join Our Mission</h2>
            <p class="text-xl text-gray-600 mb-8">
                Be part of the revolution in education. Start your learning journey with us today.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="bg-indigo-600 text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-indigo-700 transition duration-300 shadow-lg">
                    <i class="fas fa-rocket mr-2"></i>Start Learning
                </button>
                <button class="border-2 border-indigo-600 text-indigo-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-indigo-600 hover:text-white transition duration-300">
                    <i class="fas fa-envelope mr-2"></i>Contact Us
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
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
                        <li><a href="/about-us" class="hover:text-white transition duration-300">About Us</a></li>
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

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.fade-in-up, .scale-in').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            observer.observe(el);
        });
    </script>
</body>
</html>
