<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buffalo Chicken TACOS | FlavorShare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#FF8C00',
                        'secondary': '#F5F5F5',
                    }
                }
            }
        }
    </script>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
        }
        .logo {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }
        .flavor {
            color: #000;
        }
        .share {
            color: #FF8C00;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="w-full py-4 px-4 md:px-16 flex justify-between items-center relative">
        <a href="{{ route('home_page') }}" class="flex items-center z-10">
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
    <main class="container mx-auto px-4 py-8">
        <!-- Recipe Header and Image -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $recipe->cover_image) }}" alt="{{ $recipe->title }}" class="w-full h-full object-cover">
            </div>
            <div class="flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 rounded-full bg-black flex items-center justify-center text-white overflow-hidden">
                            @if($recipe->user && $recipe->user->profile_image)
                                <img src="{{ asset('http://127.0.0.1:8000/storage/' . $recipe->user->profile_image) }}" alt="{{ $recipe->user->name }}" class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                        </div>
                        <span class="text-gray-800">by {{ $recipe->user->name ?? 'Unknown' }}</span>
                        <div class="ml-auto flex items-center gap-2">
                            <button id="favorite-btn" class="flex items-center gap-1 text-gray-700">
                                <i class="far fa-bookmark"></i>
                                <span>{{ $recipe->favorites_count }}</span>
                            </button>
                            <button id="like-btn" class="flex items-center gap-1 text-gray-700 ml-4">
                                <i class="far fa-thumbs-up"></i>
                                <span>{{ $recipe->likes_count }}</span>
                            </button>
                        </div>
                    </div>  

                    <h1 class="text-3xl font-bold mb-4">{{ $recipe->title }}</h1>
                    <div class="flex flex-wrap gap-2 mb-6">
                        @if($recipe->categories)
                        @foreach($recipe->categories as $category)
                            <span class="bg-primary text-sm px-3 py-1 rounded-full">{{ $category->name }}</span>
                        @endforeach
                        @endif
                        <span class="bg-primary text-sm px-3 py-1 rounded-full">{{ $recipe->preparation_time }} min</span>
                    </div>
                    <div class="text-gray-700 mb-4">
                        <p>{{ $recipe->description }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recipe Content -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Ingredients -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-2xl font-bold mb-6">Ingredients</h2>
                <div class="space-y-3">
                    @if($recipe->ingredients)
                    @foreach($recipe->ingredients as $ingredient)
                        <div class="bg-gray-100 px-4 py-2 rounded-full inline-block">
                            <span class="font-medium">{{ $ingredient->pivot->quantity }} {{ $ingredient->pivot->unit }}</span> {{ $ingredient->name }}
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>

            <!-- Instructions -->
            <div class="bg-white p-6 rounded-lg shadow-sm md:col-span-2">
                <h2 class="text-2xl font-bold mb-6">Instructions</h2>
                <div class="space-y-6">
                    @if($recipe->steps)
                    @foreach($recipe->steps as $index => $step)
                        <div>
                            <h3 class="text-xl font-bold mb-2">Step {{ $index + 1 }}</h3>
                            <p class="text-gray-700">{{ $step->description }}</p>
                        </div>
                    @endforeach
                    @endif
                    {{-- {{ dd($recipe->steps) }} --}}
                </div>
            </div>
        </div>

        <!-- Comments -->
        <div class="bg-white p-6 rounded-lg shadow-sm mt-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Comments</h2>
                <button type="button" class="bg-orange-500 text-white px-4 py-1.5 rounded hover:bg-orange-600 transition">leave a comment</button>
            </div>
            <div class="border-t pt-4">
                @if($recipe->comments)
                @forelse($recipe->comments as $comment)
                    <div class="flex gap-4 mb-4">
                        <div class="w-10 h-10 rounded-full bg-gray-300 flex-shrink-0 overflow-hidden">
                            @if($comment->user && $comment->user->profile_image)
                                <img src="{{ asset('storage/profiles/' . $comment->user->profile_image) }}" alt="{{ $comment->user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-gray-500 flex items-center justify-center w-full h-full">{{ $comment->user->name[0] ?? '?' }}</span>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-medium">{{ $comment->user->name ?? 'Unknown' }}</h3>
                            <p class="text-gray-700">{{ $comment->content }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                @endforelse
                @endif
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
                        <li><a href="{{ route('contact_page') }}" class="hover:text-flavorshare-orange">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Explore -->
                <div>
                    <h3 class="font-bold uppercase mb-4">Explore</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('recipes_page') }}" class="hover:text-flavorshare-orange">Recipes</a></li>
                        <li><a href="{{ route('recipes_page') }}" class="hover:text-flavorshare-orange">Fitness</a></li>
                        <li><a href="{{ route('recipes_page') }}" class="hover:text-flavorshare-orange">Healthy living</a></li>
                        <li><a href="{{ route('recipes_page') }}" class="hover:text-flavorshare-orange">Blogs</a></li>
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
        // Toggle favorite button
        const favoriteBtn = document.getElementById('favorite-btn');
        let isFavorite = false;
        
        favoriteBtn.addEventListener('click', function() {
            isFavorite = !isFavorite;
            if (isFavorite) {
                favoriteBtn.querySelector('i').classList.remove('far');
                favoriteBtn.querySelector('i').classList.add('fas');
                favoriteBtn.querySelector('i').style.color = '#FF8C00';
            } else {
                favoriteBtn.querySelector('i').classList.remove('fas');
                favoriteBtn.querySelector('i').classList.add('far');
                favoriteBtn.querySelector('i').style.color = '';
            }
        });
        
        // Toggle like button
        const likeBtn = document.getElementById('like-btn');
        let isLiked = false;
        
        likeBtn.addEventListener('click', function() {
            isLiked = !isLiked;
            if (isLiked) {
                likeBtn.querySelector('i').classList.remove('far');
                likeBtn.querySelector('i').classList.add('fas');
                likeBtn.querySelector('i').style.color = '#FF8C00';
            } else {
                likeBtn.querySelector('i').classList.remove('fas');
                likeBtn.querySelector('i').classList.add('far');
                likeBtn.querySelector('i').style.color = '';
            }
        });
        
        // Toggle thumbs up and down
        const thumbsUp = document.getElementById('thumbs-up');
        let isThumbsUp = false;
        
        thumbsUp.addEventListener('click', function() {
            isThumbsUp = !isThumbsUp;
            if (isThumbsUp) {
                thumbsUp.querySelector('i').classList.remove('far');
                thumbsUp.querySelector('i').classList.add('fas');
            } else {
                thumbsUp.querySelector('i').classList.remove('fas');
                thumbsUp.querySelector('i').classList.add('far');
            }
        });
        
        const thumbsDown = document.getElementById('thumbs-down');
        let isThumbsDown = false;
        
        thumbsDown.addEventListener('click', function() {
            isThumbsDown = !isThumbsDown;
            if (isThumbsDown) {
                thumbsDown.querySelector('i').classList.remove('far');
                thumbsDown.querySelector('i').classList.add('fas');
            } else {
                thumbsDown.querySelector('i').classList.remove('fas');
                thumbsDown.querySelector('i').classList.add('far');
            }
        });


        
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