<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | FlavorShare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'flavorshare-orange': '#FF9017',
                        'flavorshare-text': '#333333',
                        'flavorshare-bg': '#F8F9FA',
                        'flavorshare-input-bg': '#FFFFFF',
                    },
                    fontFamily: {
                        'cursive': ['cursive'],
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .logo-text {
            font-family: 'cursive', sans-serif;
        }

        .mobile-menu {
            transform: translateY(-100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .mobile-menu.active {
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-white min-h-screen">
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

    <!-- Main Content -->
    <main class="w-full items-center
     flex flex-col md:flex-row">
        <!-- Image Section (Hidden on Mobile) -->
        <div class="hidden md:block w-full md:w-1/2 p-6">
            <img src="https://samsungfood.com/wp-content/cache/thumb/77/aaa69d2d52e3377_717x650.webp" alt="Delicious pasta dish" class="w-full h-auto rounded-lg object-cover" />
        </div>
        
        <!-- Form Section -->   
        <div class="w-full md:w-1/2 p-6 md:p-10 bg-gray-100 md:bg-white rounded-lg md:rounded-none">
            <div class="max-w-md mx-auto">
                <h1 class="text-3xl font-bold mb-8 text-center md:text-left">login</h1>
                
                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label for="email" class="block text-flavorshare-orange mb-2">email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-flavorshare-orange" required>
                    </div>
                    
                    <div>
                        <label for="password" class="block text-flavorshare-orange mb-2">password</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-flavorshare-orange" required>
                    </div>
                    
                    <button type="submit" class="w-full py-3 bg-flavorshare-orange text-white rounded-lg hover:bg-orange-500 transition-colors">login</button>
                </form>
                
                <p class="mt-6 text-center">
                    Don't have an account?
                    <a href="{{ route('signup_page') }}" class="text-flavorshare-orange hover:underline">Sign up</a>
                </p>
            </div>
        </div>
    </main>

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
        // Mobile menu toggle
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('active');
                if (mobileMenu.classList.contains('active')) {
                    document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
                } else {
                    document.body.style.overflow = ''; // Re-enable scrolling when menu is closed
                }
            });
        }
    </script>
</body>
</html>