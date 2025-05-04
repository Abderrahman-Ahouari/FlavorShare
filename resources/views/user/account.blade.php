<!-- profile.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - FlavorShare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
        .header-border {
            border-bottom: 2px dashed #0ea5e9;
        }
        
        .tab-active {
            border-bottom: 2px solid #f97316;
            color: #f97316;
        }
    </style>
</head>
<body class="bg-gray-50">
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

    <!-- Profile Header -->
    <div class="max-w-5xl mx-auto mt-8 pb-3 header-border">
        <div class="flex justify-between items-center px-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                    @if($user->profile_image)
                        <img src="{{ asset('http://127.0.0.1:8000/storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-3xl text-gray-500">{{ substr($user->name, 0, 1) }}</span>
                    @endif
                </div>
                <div>
                    <h1 class="text-xl font-medium text-gray-800">{{ $user->name }}</h1>
                    <div class="flex gap-6 mt-1 text-sm">
                        <span><strong>{{ $followingCount }}</strong> Following</span>
                        <span><strong>{{ $followersCount }}</strong> Followers</span>
                    </div>
                </div>
            </div>
            <div class="flex gap-3">
                @if(!$isOwner)
                    <button type="button" class="bg-orange-500 text-white px-4 py-1.5 rounded hover:bg-orange-600 transition">Follow</button>
                @else
                    <button id="edit-profile-btn" type="button" class="bg-orange-500 text-white px-4 py-1.5 rounded hover:bg-orange-600 transition">Edit Profile</button>
                    <a href="{{ route('favorites_page') }}" class="bg-orange-500 text-white px-4 py-1.5 rounded hover:bg-orange-600 transition">Favorites</a>    
                @endif

            </div>
        </div>

        <!-- Social Media Icons -->
        <div class="flex gap-4 mt-4 px-6">
            @if(isset($socialLinks['youtube']))
                <a href="{{ $socialLinks['youtube'] }}" target="_blank" class="text-gray-600 hover:text-red-600">
                    <i class="fab fa-youtube"></i>
                </a>
            @endif
            @if(isset($socialLinks['instagram']))
                <a href="{{ $socialLinks['instagram'] }}" target="_blank" class="text-gray-600 hover:text-pink-600">
                    <i class="fab fa-instagram"></i>
                </a>
            @endif
            @if(isset($socialLinks['facebook']))
                <a href="{{ $socialLinks['facebook'] }}" target="_blank" class="text-gray-600 hover:text-blue-600">
                    <i class="fab fa-facebook"></i>
                </a>
            @endif
            @if(isset($socialLinks['twitter']))
                <a href="{{ $socialLinks['twitter'] }}" target="_blank" class="text-gray-600 hover:text-blue-400">
                    <i class="fab fa-twitter"></i>
                </a>
            @endif
            @if(isset($socialLinks['tiktok']))
                <a href="{{ $socialLinks['tiktok'] }}" target="_blank" class="text-gray-600 hover:text-black">
                    <i class="fab fa-tiktok"></i>
                </a>
            @endif
        </div>

        <!-- Bio -->
        <div class="mt-4 px-6">
            <p class="text-gray-600">{{ $user->bio ?? 'No bio available' }}</p>
            <button class="text-gray-500 text-sm mt-1 hover:text-gray-700" id="more-bio">...more</button>
        </div>
    </div>

    <!-- Content Tabs -->
    <div class="max-w-5xl mx-auto mt-2">
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
                <button class="tab-button tab-active whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm">
                    Created
                </button>
            </nav>
        </div>

        <!-- Recipe Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 px-6">
            @foreach($recipes as $recipe)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-3 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                            @if($user->profile_image)
                                <img src="{{ asset('http://127.0.0.1:8000/storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-sm text-gray-500">{{ substr($user->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($recipe['created_at'])->diffForHumans() }}</p>
                        </div>
                    </div>

                </div>
                <div class="w-full h-64 overflow-hidden">
                    <img src="{{ asset('http://127.0.0.1:8000/storage/' . $recipe['cover_image']) }}" alt="{{ $recipe['title'] }}" class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-medium text-gray-800">{{ $recipe['title'] }}</h3>
                    <div class="flex justify-between items-center mt-3">
                        <div class="flex gap-6">
                            <div class="flex items-center gap-1">
                                <button class="text-gray-700"><i class="far fa-thumbs-up"></i></button>
                                <span class="text-sm">{{ $recipe['likes_count'] }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <button class="text-gray-700"><i class="far fa-comment"></i></button>
                                <span class="text-sm">{{ $recipe['comments_count'] }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <button class="text-gray-700"><i class="far fa-bookmark"></i></button>
                                <span class="text-sm">{{ $recipe['saves_count'] }}</span>
                            </div>
                        </div>
                        <div>
                            <button id="edit-profile-btn" type="button" class="bg-orange-500 text-white px-4 py-1.5 rounded hover:bg-orange-600 transition">view more</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div id="edit-profile-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Edit Profile</h2>
                <button id="close-modal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="edit-profile-form" method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4 text-center">
                    <div class="w-24 h-24 rounded-full bg-gray-300 mx-auto mb-2 flex items-center justify-center overflow-hidden relative">
                        <div id="profile-preview" class="w-full h-full">
                            @if($user->profile_image)
                                <img src="{{ asset('http://127.0.0.1:8000/storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-4xl text-gray-500">{{ substr($user->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <label for="profile_image" class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 hover:opacity-100 cursor-pointer transition">
                            <i class="fas fa-camera text-white text-xl"></i>
                        </label>
                    </div>
                    <input type="file" name="profile_image" id="profile_image" class="hidden" accept="image/*">
                </div>
                <div class="mb-4">
                    <input type="name" name="name" id="name" value="{{ $user->name ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <div class="mb-4">
                    <input type="email" name="email" id="email" value="{{ $user->email ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                
                <div class="mb-4">
                    <label for="bio" class="block text-gray-700 text-sm font-medium mb-1">Bio</label>
                    <textarea name="bio" id="bio" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">{{ $user->bio ?? '' }}</textarea>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Social Media Links</label>
                    
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <span class="w-8 text-center text-gray-500"><i class="fab fa-facebook"></i></span>
                            <input type="url" name="facebook_link" value="{{ $socialLinks['facebook'] ?? '' }}" placeholder="Facebook URL" class="flex-1 ml-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        
                        <div class="flex items-center">
                            <span class="w-8 text-center text-gray-500"><i class="fab fa-instagram"></i></span>
                            <input type="url" name="instagram_link" value="{{ $socialLinks['instagram'] ?? '' }}" placeholder="Instagram URL" class="flex-1 ml-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        
                        <div class="flex items-center">
                            <span class="w-8 text-center text-gray-500"><i class="fab fa-twitter"></i></span>
                            <input type="url" name="twitter_link" value="{{ $socialLinks['twitter'] ?? '' }}" placeholder="Twitter URL" class="flex-1 ml-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        
                        <div class="flex items-center">
                            <span class="w-8 text-center text-gray-500"><i class="fab fa-youtube"></i></span>
                            <input type="url" name="youtube_link" value="{{ $socialLinks['youtube'] ?? '' }}" placeholder="YouTube URL" class="flex-1 ml-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        
                        <div class="flex items-center">
                            <span class="w-8 text-center text-gray-500"><i class="fab fa-tiktok"></i></span>
                            <input type="url" name="tiktok_link" value="{{ $socialLinks['tiktok'] ?? '' }}" placeholder="TikTok URL" class="flex-1 ml-2 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancel-edit" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

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
        // Toggle more/less for bio
        document.getElementById('more-bio').addEventListener('click', function() {
            const bioText = this.previousElementSibling;
            if (this.textContent === '...more') {
                bioText.classList.remove('line-clamp-2');
                this.textContent = 'less';
            } else {
                bioText.classList.add('line-clamp-2');
                this.textContent = '...more';
            }
        });

        // Tab switching
        const tabButtons = document.querySelectorAll('.tab-button');
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                tabButtons.forEach(btn => {
                    btn.classList.remove('tab-active');
                    btn.classList.add('text-gray-500');
                });
                this.classList.add('tab-active');
                this.classList.remove('text-gray-500');
            });
        });

        // Edit profile modal
        const editProfileBtn = document.getElementById('edit-profile-btn');
        const editProfileModal = document.getElementById('edit-profile-modal');
        const closeModalBtn = document.getElementById('close-modal');
        const cancelEditBtn = document.getElementById('cancel-edit');

        if (editProfileBtn) {
            editProfileBtn.addEventListener('click', function() {
                editProfileModal.classList.remove('hidden');
            });
        }

        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', function() {
                editProfileModal.classList.add('hidden');
            });
        }

        if (cancelEditBtn) {
            cancelEditBtn.addEventListener('click', function() {
                editProfileModal.classList.add('hidden');
            });
        }

        // Profile image preview
        const profileImageInput = document.getElementById('profile_image');
        const profilePreview = document.getElementById('profile-preview');

        if (profileImageInput) {
            profileImageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profilePreview.innerHTML = `<img src="${e.target.result}" alt="Profile Preview" class="w-full h-full object-cover">`;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }

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