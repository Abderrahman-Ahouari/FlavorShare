<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlavorShare - Recipes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }
        .logo {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-style: italic;
            color: #333;
        }
        .logo span {
            color: #FF8A00;
        }
        .recipe-card {
            transition: transform 0.3s ease;
        }
        .recipe-card:hover {
            transform: translateY(-5px);
        }
        .category-pill, .ingredient-pill {
            transition: all 0.2s ease;
        }
        .category-pill:hover, .ingredient-pill:hover {
            background-color: #FF8A00;
            color: white;
        }
        .category-pill.selected, .ingredient-pill.selected {
            background-color: #FF8A00;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="logo text-2xl">flavor<span>share</span></a>
            <nav class="hidden md:flex space-x-6">
                <a href="/contact" class="text-gray-600 hover:text-gray-900">Contact us</a>
                <a href="/explore" class="text-gray-600 hover:text-gray-900">Explore</a>
                <a href="/account" class="text-gray-600 hover:text-gray-900">Account</a>
            </nav>
            <div class="flex items-center space-x-3">
                <a href="/login" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Login</a>
                <a href="/signup" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">Signup</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Recipe Listing -->
            <div class="w-full md:w-3/4">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">Recipes</h1>
                    <div class="flex items-center">
                        <span class="mr-2 text-gray-600">Sort by:</span>
                        <form id="sortForm" method="GET" action="{{ route('recipes.index') }}">
                            <!-- Hidden inputs for currently selected filters -->
                            @if(request()->has('categories'))
                                @foreach(request()->categories as $category)
                                    <input type="hidden" name="categories[]" value="{{ $category }}">
                                @endforeach
                            @endif
                            @if(request()->has('ingredients'))
                                @foreach(request()->ingredients as $ingredient)
                                    <input type="hidden" name="ingredients[]" value="{{ $ingredient }}">
                                @endforeach
                            @endif
                            
                            <select name="sort" id="sort" class="border border-gray-300 rounded-lg px-3 py-2" onchange="document.getElementById('sortForm').submit()">
                                <option value="newest" {{ request()->sort == 'newest' || !request()->has('sort') ? 'selected' : '' }}>newest</option>
                                <option value="oldest" {{ request()->sort == 'oldest' ? 'selected' : '' }}>oldest</option>
                                <option value="top_rated" {{ request()->sort == 'top_rated' ? 'selected' : '' }}>top-rated</option>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Recipe Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($recipes as $recipe)
                    <a href="{{ route('recipes.show', $recipe->id) }}" class="recipe-card bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg">
                        <div class="relative">
                            <img src="{{ asset($recipe->cover_image) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover">
                            <div class="absolute top-2 left-2 bg-black bg-opacity-60 text-white rounded-full px-2 py-1 text-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                {{ $recipe->likes_count }}%
                            </div>
                            <div class="absolute bottom-2 left-2 flex items-center">
                                <img src="{{ asset($recipe->creator->profile_image) }}" alt="{{ $recipe->creator->name }}" class="w-8 h-8 rounded-full border-2 border-white">
                                <span class="ml-2 text-white text-sm bg-black bg-opacity-60 px-2 py-1 rounded-lg">{{ $recipe->creator->name }}</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-2">{{ $recipe->title }}</h3>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>{{ $recipe->ingredients_count }} ingredients</span>
                                <span>{{ $recipe->preparation_time }}min</span>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500 text-lg">No recipes found matching your criteria.</p>
                        <a href="{{ route('recipes.index') }}" class="mt-4 inline-block px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">View all recipes</a>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $recipes->appends(request()->query())->links() }}
                </div>
            </div>

            <!-- Filter Sidebar -->
            <div class="w-full md:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-6">Filter</h2>
                    <form action="{{ route('recipes.index') }}" method="GET">
                        <!-- Keep the sort parameter if set -->
                        @if(request()->has('sort'))
                            <input type="hidden" name="sort" value="{{ request()->sort }}">
                        @endif

                        <!-- Ingredients -->
                        <div class="mb-6">
                            <h3 class="font-medium mb-3">Ingredients</h3>
                            <div class="flex flex-wrap gap-2">
                                <div class="ingredient-pill {{ in_array(1, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="ingredients[]" value="1" id="ingredient-1" class="hidden" {{ in_array(1, request()->ingredients ?? []) ? 'checked' : '' }}>
                                    <label for="ingredient-1" class="cursor-pointer">Milk</label>
                                </div>
                                <div class="ingredient-pill {{ in_array(2, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="ingredients[]" value="2" id="ingredient-2" class="hidden" {{ in_array(2, request()->ingredients ?? []) ? 'checked' : '' }}>
                                    <label for="ingredient-2" class="cursor-pointer">Eggs</label>
                                </div>
                                <div class="ingredient-pill {{ in_array(3, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="ingredients[]" value="3" id="ingredient-3" class="hidden" {{ in_array(3, request()->ingredients ?? []) ? 'checked' : '' }}>
                                    <label for="ingredient-3" class="cursor-pointer">Bread</label>
                                </div>
                                <div class="ingredient-pill {{ in_array(4, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="ingredients[]" value="4" id="ingredient-4" class="hidden" {{ in_array(4, request()->ingredients ?? []) ? 'checked' : '' }}>
                                    <label for="ingredient-4" class="cursor-pointer">Onions</label>
                                </div>
                                <div class="ingredient-pill {{ in_array(5, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="ingredients[]" value="5" id="ingredient-5" class="hidden" {{ in_array(5, request()->ingredients ?? []) ? 'checked' : '' }}>
                                    <label for="ingredient-5" class="cursor-pointer">Potatoes</label>
                                </div>
                            </div>
                        </div>

                        <!-- Diet Categories -->
                        <div class="mb-6">
                            <h3 class="font-medium mb-3">Diet</h3>
                            <div class="flex flex-wrap gap-2">
                                <div class="category-pill {{ in_array(1, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="1" id="category-1" class="hidden" {{ in_array(1, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-1" class="cursor-pointer">Lacto Vegetarian</label>
                                </div>
                                <div class="category-pill {{ in_array(2, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="2" id="category-2" class="hidden" {{ in_array(2, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-2" class="cursor-pointer">Ovo Vegetarian</label>
                                </div>
                                <div class="category-pill {{ in_array(3, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="3" id="category-3" class="hidden" {{ in_array(3, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-3" class="cursor-pointer">Ovo-Lacto Vegetarian</label>
                                </div>
                                <div class="category-pill {{ in_array(4, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="4" id="category-4" class="hidden" {{ in_array(4, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-4" class="cursor-pointer">Pescatarian</label>
                                </div>
                                <div class="category-pill {{ in_array(5, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="5" id="category-5" class="hidden" {{ in_array(5, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-5" class="cursor-pointer">Vegan</label>
                                </div>
                            </div>
                        </div>

                        <!-- Cuisine Categories -->
                        <div class="mb-6">
                            <h3 class="font-medium mb-3">Cuisine</h3>
                            <div class="flex flex-wrap gap-2">
                                <div class="category-pill {{ in_array(6, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="6" id="category-6" class="hidden" {{ in_array(6, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-6" class="cursor-pointer">African</label>
                                </div>
                                <div class="category-pill {{ in_array(7, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="7" id="category-7" class="hidden" {{ in_array(7, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-7" class="cursor-pointer">American</label>
                                </div>
                                <div class="category-pill {{ in_array(8, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="8" id="category-8" class="hidden" {{ in_array(8, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-8" class="cursor-pointer">Asian</label>
                                </div>
                                <div class="category-pill {{ in_array(9, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="9" id="category-9" class="hidden" {{ in_array(9, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-9" class="cursor-pointer">Australian</label>
                                </div>
                                <div class="category-pill {{ in_array(10, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="10" id="category-10" class="hidden" {{ in_array(10, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-10" class="cursor-pointer">British</label>
                                </div>
                            </div>
                        </div>

                        <!-- Nutrition Categories -->
                        <div class="mb-6">
                            <h3 class="font-medium mb-3">Nutrition</h3>
                            <div class="flex flex-wrap gap-2">
                                <div class="category-pill {{ in_array(11, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="11" id="category-11" class="hidden" {{ in_array(11, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-11" class="cursor-pointer">Healthy</label>
                                </div>
                                <div class="category-pill {{ in_array(12, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="12" id="category-12" class="hidden" {{ in_array(12, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-12" class="cursor-pointer">High Protein</label>
                                </div>
                                <div class="category-pill {{ in_array(13, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="13" id="category-13" class="hidden" {{ in_array(13, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-13" class="cursor-pointer">Low Sugars</label>
                                </div>
                                <div class="category-pill {{ in_array(14, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="14" id="category-14" class="hidden" {{ in_array(14, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-14" class="cursor-pointer">Low Energy</label>
                                </div>
                                <div class="category-pill {{ in_array(15, request()->categories ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="15" id="category-15" class="hidden" {{ in_array(15, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="category-15" class="cursor-pointer">Low Sodium</label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition-colors">
                            filter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white py-10 border-t mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="/" class="logo text-2xl mb-4 inline-block">flavor<span>share</span></a>
                    <h3 class="font-semibold text-lg mb-2">ABOUT FS</h3>
                    <ul class="space-y-2">
                        <li><a href="/about" class="text-gray-600 hover:text-gray-900">About me</a></li>
                        <li><a href="/work" class="text-gray-600 hover:text-gray-900">Work with me</a></li>
                        <li><a href="/contact" class="text-gray-600 hover:text-gray-900">Contact</a></li>
                    </ul>
                </div>
                <div class="mb-6 md:mb-0">
                    <h3 class="font-semibold text-lg mb-2">Explore</h3>
                    <ul class="space-y-2">
                        <li><a href="/recipes" class="text-gray-600 hover:text-gray-900">Recipes</a></li>
                        <li><a href="/fitness" class="text-gray-600 hover:text-gray-900">Fitness</a></li>
                        <li><a href="/healthy-living" class="text-gray-600 hover:text-gray-900">Healthy living</a></li>
                        <li><a href="/blogs" class="text-gray-600 hover:text-gray-900">Blogs</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-2">Connect</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Toggle selection for category and ingredient pills
        document.querySelectorAll('.category-pill, .ingredient-pill').forEach(pill => {
            pill.addEventListener('click', function() {
                const checkbox = this.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked;
                this.classList.toggle('selected');
            });
        });
    </script>
</body>
</html>     