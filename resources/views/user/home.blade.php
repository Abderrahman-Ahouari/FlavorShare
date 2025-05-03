<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy Cooking Recipes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Montserrat', sans-serif;
        }
        
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3));
            background-size: cover;
            background-position: center;
        }
        
        .recipe-card {
            transition: transform 0.3s ease;
        }
        
        .recipe-card:hover {
            transform: translateY(-10px);
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-white text-gray-800">
    <!-- Header -->
    <header class="w-full py-4 px-4 md:px-16 flex justify-between items-center relative">
        <a href="#" class="flex items-center z-10">
            <span class="logo-text text-2xl font-bold text-black">flavor<span class="text-flavorshare-orange">share</span></span>
        </a>
        
        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-6">
            <a href="{{ route('contact_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Contact us</a>
            <a href="{{ route('recipes_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Explore</a>
            <a href="{{ route('account_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Account</a>
            <a href="{{ route('login_page') }}" class="px-6 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Login</a>
            <a href="{{ route('signup_page') }}" class="px-6 py-2 bg-flavorshare-orange text-white rounded-md hover:bg-orange-500">SignUp</a>
        </nav>
        
        <!-- Mobile Menu Button -->
        <button class="md:hidden text-flavorshare-text z-10" id="menu-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu fixed top-0 left-0 w-full h-screen bg-white z-0 flex flex-col items-center justify-center space-y-6 md:hidden">
            <a href="{{ route('contact_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Contact us</a>
            <a href="{{ route('recipes_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Explore</a>
            <a href="{{ route('account_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Account</a>
            <a href="{{ route('login_page') }}" class="px-6 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Login</a>
            <a href="{{ route('signup_page') }}" class="px-6 py-2 bg-flavorshare-orange text-white rounded-md hover:bg-orange-500">SignUp</a>
        </div>
    </header>
    <!-- Hero Section -->
    <section class="pt-24 pb-12 md:py-32 bg-gradient-to-r from-green-50 to-green-100">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">HEALTHY COOKING RECIPES AND THE RIGHT NUTRITION</h1>
                <p class="text-lg mb-8">Discover delicious, nutritious meals that are easy to prepare and will transform your approach to healthy eating.</p>
                <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-md transition duration-300 inline-block">EXPLORE RECIPES</a>
            </div>
            <div class="md:w-1/2 grid grid-cols-3 gap-4">
                <div class="recipe-card col-span-1">
                    <img src="/api/placeholder/250/250" alt="Healthy Recipe" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 text-sm font-medium">Avocado Toast</p>
                    <p class="text-xs text-gray-500">15 min</p>
                </div>
                <div class="recipe-card col-span-1">
                    <img src="/api/placeholder/250/250" alt="Healthy Recipe" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 text-sm font-medium">Green Salad</p>
                    <p class="text-xs text-gray-500">10 min</p>
                </div>
                <div class="recipe-card col-span-1">
                    <img src="/api/placeholder/250/250" alt="Healthy Recipe" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 text-sm font-medium">Veggie Bowl</p>
                    <p class="text-xs text-gray-500">20 min</p>
                </div>
                <div class="recipe-card col-span-1">
                    <img src="/api/placeholder/250/250" alt="Healthy Recipe" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 text-sm font-medium">Quinoa Salad</p>
                    <p class="text-xs text-gray-500">25 min</p>
                </div>
                <div class="recipe-card col-span-1">
                    <img src="/api/placeholder/250/250" alt="Healthy Recipe" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 text-sm font-medium">Fruit Smoothie</p>
                    <p class="text-xs text-gray-500">5 min</p>
                </div>
                <div class="recipe-card col-span-1">
                    <img src="/api/placeholder/250/250" alt="Healthy Recipe" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 text-sm font-medium">Protein Bowl</p>
                    <p class="text-xs text-gray-500">30 min</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quality Section -->
    <section class="py-16 md:py-24">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <img src="/api/placeholder/600/600" alt="Bowl of healthy food" class="w-full rounded-lg shadow-lg fade-in">
            </div>
            <div class="md:w-1/2 md:pl-12 fade-in">
                <h2 class="text-2xl md:text-4xl font-bold mb-6">HEALTHY AND QUALITY WITH A NEW FEEL</h2>
                <p class="mb-8">Our recipes combine traditional cooking wisdom with modern nutritional science. We focus on whole ingredients, balanced macronutrients, and meals that satisfy both your body and taste buds.</p>
                <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-md transition duration-300 inline-block">LEARN MORE</a>
            </div>
        </div>
    </section>

    <!-- Future of Food Section -->
    <section class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4 flex flex-col md:flex-row-reverse items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <img src="/api/placeholder/600/600" alt="Modern food preparation" class="w-full rounded-lg shadow-lg fade-in">
            </div>
            <div class="md:w-1/2 md:pr-12 fade-in">
                <h2 class="text-2xl md:text-4xl font-bold mb-6">TASTE THE FUTURE OF GOOD FOOD</h2>
                <p class="mb-8">We believe that healthy eating doesn't mean sacrificing flavor or satisfaction. Our innovative approach to cooking introduces new techniques and ingredient combinations that will revolutionize your kitchen experience.</p>
                <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-md transition duration-300 inline-block">DISCOVER</a>
            </div>
        </div>
    </section>

    <!-- Popular Items Section -->
    <section class="py-16 md:py-24">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-4xl font-bold mb-12 text-center">MOST POPULAR ITEMS</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="fade-in">
                    <img src="/api/placeholder/300/300" alt="Popular dish" class="w-full h-64 object-cover rounded-lg shadow-md mb-4">
                    <h3 class="text-xl font-semibold mb-2">Buddha Bowl with Tahini</h3>
                    <p class="text-gray-600 mb-3">A nourishing bowl packed with colorful vegetables, proteins, and a creamy tahini dressing that brings everything together.</p>
                    <a href="#" class="text-orange-500 font-medium hover:underline">View Recipe</a>
                </div>
                <div class="fade-in">
                    <img src="/api/placeholder/300/300" alt="Popular dish" class="w-full h-64 object-cover rounded-lg shadow-md mb-4">
                    <h3 class="text-xl font-semibold mb-2">Mediterranean Salad</h3>
                    <p class="text-gray-600 mb-3">Fresh vegetables, olives, and feta cheese drizzled with olive oil and herbs for a taste of the Mediterranean.</p>
                    <a href="#" class="text-orange-500 font-medium hover:underline">View Recipe</a>
                </div>
                <div class="fade-in">
                    <img src="/api/placeholder/300/300" alt="Popular dish" class="w-full h-64 object-cover rounded-lg shadow-md mb-4">
                    <h3 class="text-xl font-semibold mb-2">Protein-Packed Breakfast</h3>
                    <p class="text-gray-600 mb-3">Start your day right with this energizing breakfast that combines whole grains, fruits, and quality proteins.</p>
                    <a href="#" class="text-orange-500 font-medium hover:underline">View Recipe</a>
                </div>
                <div class="fade-in">
                    <img src="/api/placeholder/300/300" alt="Popular dish" class="w-full h-64 object-cover rounded-lg shadow-md mb-4">
                    <h3 class="text-xl font-semibold mb-2">Vegetable Curry</h3>
                    <p class="text-gray-600 mb-3">A flavorful and aromatic curry that's both satisfying and packed with nutrients from seasonal vegetables.</p>
                    <a href="#" class="text-orange-500 font-medium hover:underline">View Recipe</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 mb-8 md:mb-0 grid grid-cols-2 gap-4 fade-in">
                    <img src="/api/placeholder/300/300" alt="Food testimonial" class="w-full h-48 object-cover rounded-lg shadow-md">
                    <img src="/api/placeholder/300/300" alt="Food testimonial" class="w-full h-48 object-cover rounded-lg shadow-md">
                    <img src="/api/placeholder/300/300" alt="Food testimonial" class="w-full h-48 object-cover rounded-lg shadow-md">
                </div>
                <div class="md:w-1/2 md:pl-12 fade-in">
                    <h2 class="text-2xl md:text-4xl font-bold mb-6">THAT'S WHAT OUR SAY CLIENTS</h2>
                    <p class="mb-6 text-lg italic">"These recipes have transformed my relationship with food. I never thought healthy eating could be this delicious and satisfying. My entire family now looks forward to our meals!"</p>
                    <p class="font-semibold">- Sarah Johnson, Mom of three</p>
                    <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-md transition duration-300 inline-block mt-8">READ MORE</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-flavorshare-bg py-12 px-6 md:px-16">
        <div class="max-w-6xl mx-auto">
            <!-- Logo -->
            <div class="mb-8">
                <span class="logo-text text-2xl font-bold text-black">flavor<span class="text-flavorshare-orange">share</span></span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- About -->
                <div>
                    <h3 class="font-bold uppercase mb-4">About FS</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-flavorshare-orange">About me</a></li>
                        <li><a href="#" class="hover:text-flavorshare-orange">Work with me</a></li>
                        <li><a href="#" class="hover:text-flavorshare-orange">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Explore -->
                <div>
                    <h3 class="font-bold uppercase mb-4">Explore</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-flavorshare-orange">Recipes</a></li>
                        <li><a href="#" class="hover:text-flavorshare-orange">Fitness</a></li>
                        <li><a href="#" class="hover:text-flavorshare-orange">Healthy living</a></li>
                        <li><a href="#" class="hover:text-flavorshare-orange">Blogs</a></li>
                    </ul>
                </div>
                
                <!-- Connect -->
                <div>
                    <h3 class="font-bold mb-4">Connect</h3>
                    <div class="flex space-x-4">
                        <a href="#" aria-label="Facebook" class="text-flavorshare-text hover:text-flavorshare-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                            </svg>
                        </a>
                        <a href="#" aria-label="Twitter" class="text-flavorshare-text hover:text-flavorshare-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#" aria-label="Email" class="text-flavorshare-text hover:text-flavorshare-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </a>
                        <a href="#" aria-label="Pinterest" class="text-flavorshare-text hover:text-flavorshare-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12 0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146 1.124.347 2.317.535 3.554.535 6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z" />
                            </svg>
                        </a>
                        <a href="#" aria-label="LinkedIn" class="text-flavorshare-text hover:text-flavorshare-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Fade-in animation
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });
            
            fadeElements.forEach(element => {
                observer.observe(element);
            });
        });

        // Recipe card hover effect already handled in CSS
    </script>
</body>
</html>