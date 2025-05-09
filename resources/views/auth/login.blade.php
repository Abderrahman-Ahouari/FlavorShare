@extends('layouts.app')



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
                    @csrf
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