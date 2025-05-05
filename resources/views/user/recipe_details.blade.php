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
    <!-- Navigation -->
    <nav class="bg-white py-4 px-6 shadow-sm">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="logo text-xl">
                <span class="flavor">flavor</span><span class="share">share</span>
            </a>
            <div class="hidden md:flex space-x-6">
                <a href="#" class="text-gray-600 hover:text-gray-900">Contact us</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Explore</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Account</a>
            </div>
            <div class="flex space-x-2">
                <a href="#" class="border border-gray-300 px-4 py-1 rounded-md text-gray-700">Login</a>
                <a href="#" class="bg-primary text-white px-4 py-1 rounded-md">SignUp</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Recipe Header and Image -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="rounded-lg overflow-hidden">
                <img src="/api/placeholder/600/400" alt="Buffalo Chicken TACOS" class="w-full h-full object-cover">
            </div>
            <div class="flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 rounded-full bg-black flex items-center justify-center text-white">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="text-gray-800">by teresa porter</span>
                        <div class="ml-auto flex items-center gap-2">
                            <button id="favorite-btn" class="flex items-center gap-1 text-gray-700">
                                <i class="far fa-bookmark"></i>
                                <span>15</span>
                            </button>
                            <button id="like-btn" class="flex items-center gap-1 text-gray-700 ml-4">
                                <i class="far fa-thumbs-up"></i>
                                <span>65</span>
                            </button>
                        </div>
                    </div>

                    <h1 class="text-3xl font-bold mb-4">Buffalo Chicken TACOS</h1>
                    
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="bg-primary text-sm px-3 py-1 rounded-full">Spicy</span>
                        <span class="bg-primary text-sm px-3 py-1 rounded-full">Healthy</span>
                        <span class="bg-primary text-sm px-3 py-1 rounded-full">30 min</span>
                    </div>

                    <div class="text-gray-700 mb-4">
                        <p>About this recipe Quebec is a melting pot of different cultures and cuisines. There is a burgeoning north African and Middle Eastern community in this beautiful city, so this classic tagine with maple syrup as a delicate sweetener is a nod to how native Canadian...</p>
                        <button class="text-primary font-medium">more</button>
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
                    <div class="bg-gray-100 px-4 py-2 rounded-full inline-block">
                        <span class="font-medium">100 g</span> Potatoes
                    </div>
                    <!-- Add more ingredients as needed -->
                </div>
            </div>

            <!-- Instructions -->
            <div class="bg-white p-6 rounded-lg shadow-sm md:col-span-2">
                <h2 class="text-2xl font-bold mb-6">Instructions</h2>
                
                <div class="space-y-6">
                    <div>
                        <h3 class="text-xl font-bold mb-2">step 1</h3>
                        <p class="text-gray-700">Heat the oil in a non-stick frying pan over a medium heat. Add the onion and garlic and cook, stirring occasionally, for 4-5 minutes until a little golden.</p>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-bold mb-2">step 2</h3>
                        <p class="text-gray-700">Heat the oil in a non-stick frying pan over a medium heat. Add the onion and garlic and cook, stirring occasionally, for 4-5 minutes until a little golden.</p>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-bold mb-2">step 3</h3>
                        <p class="text-gray-700">Heat the oil in a non-stick frying pan over a medium heat. Add the onion and garlic and cook, stirring occasionally, for 4-5 minutes until a little golden.</p>
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-bold mb-2">step 4</h3>
                        <p class="text-gray-700">Heat the oil in a non-stick frying pan over a medium heat. Add the onion and garlic and cook, stirring occasionally, for 4-5 minutes until a little golden.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes and Comments -->
        <div class="bg-white p-6 rounded-lg shadow-sm mt-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Notes</h2>
                <button class="bg-primary text-white px-4 py-2 rounded-full">Leave a comment</button>
            </div>

            <div class="flex items-center gap-4 mb-6">
                <button id="thumbs-up" class="flex items-center gap-1">
                    <i class="far fa-thumbs-up text-green-500 text-xl"></i>
                    <span>46 liked</span>
                </button>
                <button id="thumbs-down" class="flex items-center gap-1">
                    <i class="far fa-thumbs-down text-red-500 text-xl"></i>
                    <span>4 disliked</span>
                </button>
            </div>

            <!-- Comments -->
            <div class="border-t pt-4">
                <div class="flex gap-4 mb-4">
                    <div class="w-10 h-10 rounded-full bg-gray-300 flex-shrink-0"></div>
                    <div>
                        <h3 class="font-medium">teresa porter</h3>
                        <p class="text-gray-700">Put rice on the bottom instead of chips.</p>
                    </div>
                </div>
                <!-- Add more comments as needed -->
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-12 py-8 px-6">
        <div class="container mx-auto">
            <div class="flex justify-center mb-8">
                <div class="logo text-2xl">
                    <span class="flavor">flavor</span><span class="share">share</span>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="font-bold uppercase text-sm text-gray-600 mb-4">About FS</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-700 hover:text-primary">About me</a></li>
                        <li><a href="#" class="text-gray-700 hover:text-primary">Work with me</a></li>
                        <li><a href="#" class="text-gray-700 hover:text-primary">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold uppercase text-sm text-gray-600 mb-4">Explore</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-700 hover:text-primary">Recipes</a></li>
                        <li><a href="#" class="text-gray-700 hover:text-primary">Fitness</a></li>
                        <li><a href="#" class="text-gray-700 hover:text-primary">Healthy living</a></li>
                        <li><a href="#" class="text-gray-700 hover:text-primary">Blogs</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold uppercase text-sm text-gray-600 mb-4">Connect</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-primary"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-600 hover:text-primary"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-600 hover:text-primary"><i class="far fa-envelope"></i></a>
                        <a href="#" class="text-gray-600 hover:text-primary"><i class="fab fa-pinterest-p"></i></a>
                        <a href="#" class="text-gray-600 hover:text-primary"><i class="fab fa-linkedin-in"></i></a>
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
        
        // Mobile responsiveness adjustments
        function adjustForMobile() {
            if (window.innerWidth < 768) {
                // Mobile adjustments if needed
            }
        }
        
        window.addEventListener('resize', adjustForMobile);
        adjustForMobile();
    </script>
</body>
</html>