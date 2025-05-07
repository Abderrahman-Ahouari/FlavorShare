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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
</head>
<body class="bg-gray-50">


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
                        @if(in_array($user->id, $authFollowings))
                        <button class="follow-toggle bg-orange-500 text-white px-4 py-1 rounded hover:bg-orange-600 transition" data-user-id="{{ $user->id }}" data-action="unfollow">Unfollow</button>
                        @else
                        <button class="follow-toggle bg-orange-500 text-white px-4 py-1 rounded hover:bg-orange-600 transition" data-user-id="{{ $user->id }}" data-action="follow">Follow</button>
                        @endif
                        <a href="{{ route('account_page', $user->id) }}" class="bg-orange-500 text-white px-4 py-1 rounded hover:bg-orange-600 transition text-center">See Profile</a>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No users found.</p>
            @endforelse
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 py-12 px-6 md:px-16">
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
        // JavaScript for follow button functionality
        $(document).on('click', '.follow-toggle', function() {
            var btn = $(this);
            var userId = btn.data('user-id');
            var action = btn.data('action');
            var url = action === 'follow'
                ? '/users/' + userId + '/follow'
                : '/users/' + userId + '/unfollow';
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    if (action === 'follow') {
                        btn.text('Unfollow');
                        btn.data('action', 'unfollow');
                    } else {
                        btn.text('Follow');
                        btn.data('action', 'follow');
                    }
                },
                error: function(xhr) {
                    alert(xhr.responseJSON?.message || 'Action failed.');
                }
            });
        });
    </script>
</body>
</html>