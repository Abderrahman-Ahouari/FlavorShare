<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlavorShare - Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        orange: {
                            500: '#FF8A00',
                            600: '#E67A00'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="#" class="flex items-center">
                <span class="text-orange-500 font-bold text-xl">flavor</span>
                <span class="text-gray-800 font-bold text-xl">share</span>
            </a>
            <nav class="hidden md:flex items-center space-x-6">
                <a href="#" class="text-gray-600 hover:text-gray-800">Contact us</a>
                <a href="#" class="text-gray-600 hover:text-gray-800">Explore</a>
                <a href="#" class="text-gray-600 hover:text-gray-800">Account</a>
                <a href="#" class="text-gray-800 hover:text-gray-900">Login</a>
                <a href="#" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition">SignUp</a>
            </nav>
            <button class="md:hidden text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-8">
            {{ ucfirst($type) }} of {{ $profileUser->name }}
        </h1>
        <div class="flex flex-col gap-4">
            @forelse($users as $user)
                <div class="bg-white rounded-lg shadow-sm flex items-center p-4 space-x-6 w-[85vw] max-w-[85vw] mx-auto">
                    <img src="{{ $user->profile_image ? asset('storage/profiles/' . $user->profile_image) : 'https://via.placeholder.com/64' }}" alt="User avatar" class="w-20 h-20 rounded-full object-cover flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-lg text-gray-800 truncate">{{ $user->name }}</h3>
                        <p class="text-gray-500 text-sm truncate">{{ $user->bio ?? 'No bio available' }}</p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <button class="bg-orange-500 text-white px-4 py-1 rounded hover:bg-orange-600 transition">Follow</button>
                        <button class="bg-orange-500 text-white px-4 py-1 rounded hover:bg-orange-600 transition">Unfollow</button>
                        <a href="#" class="bg-orange-500 text-white px-4 py-1 rounded hover:bg-orange-600 transition text-center">See Profile</a>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No users found.</p>
            @endforelse
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-12 py-8 border-t border-gray-200">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <a href="#" class="flex items-center mb-4">
                        <span class="text-orange-500 font-bold text-xl">flavor</span>
                        <span class="text-gray-800 font-bold text-xl">share</span>
                    </a>
                    <h3 class="font-bold text-gray-700 mb-2">ABOUT US</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-gray-800">About me</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-800">Work with me</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-800">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-gray-700 mb-2">Explore</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-gray-800">Recipes</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-800">Fitness</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-800">Healthy living</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-gray-800">Blogs</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-gray-700 mb-2">Connect</h3>
                    <div class="flex space-x-4 mt-2">
                        <a href="#" class="text-gray-600 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.054 10.054 0 01-3.127 1.184 4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.372-12 12 0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146 1.124.347 2.317.535 3.554.535 6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-200 pt-6 text-center text-gray-500 text-sm">
                &copy; 2025 FlavorShare. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // JavaScript for follow button functionality
        document.addEventListener('DOMContentLoaded', function() {
            const followButtons = document.querySelectorAll('button');
            
            followButtons.forEach(button => {
                if (button.textContent === 'Follow') {
                    button.addEventListener('click', function() {
                        if (this.textContent === 'Follow') {
                            this.textContent = 'Following';
                            this.classList.remove('bg-orange-500', 'hover:bg-orange-600');
                            this.classList.add('bg-gray-200', 'text-gray-800', 'hover:bg-gray-300');
                        } else {
                            this.textContent = 'Follow';
                            this.classList.remove('bg-gray-200', 'text-gray-800', 'hover:bg-gray-300');
                            this.classList.add('bg-orange-500', 'text-white', 'hover:bg-orange-600');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>