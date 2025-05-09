@extends('layouts.app')

@section('content')
<main class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Recipe Listing -->
        <div class="w-full md:w-3/4">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Recipes</h1>
                <div class="flex items-center">
                    <span class="mr-2 text-gray-600">Sort by:</span>
                    <form id="sortForm" method="GET" action="{{ route('recipes_page') }}">
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
                <a href="{{ route('recipe_page', $recipe['id']) }}" class="recipe-card bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg">
                    <div class="relative">
                        <img src="http://127.0.0.1:8000/storage{{ asset($recipe->cover_image) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover">
                        <div class="absolute top-2 left-2 bg-black bg-opacity-60 text-white rounded-full px-2 py-1 text-sm flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            {{ $recipe->likes_count }}
                        </div>
                        <div class="absolute bottom-2 left-2 flex items-center">
                            <img src="http://127.0.0.1:8000/storage{{ asset($recipe->user->profile_image) }}" alt="" class="w-8 h-8 rounded-full border-2 border-white">
                            <span class="ml-2 text-white text-sm bg-black bg-opacity-60 px-2 py-1 rounded-lg">{{ $recipe->user->name }}</span>
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
                    <a href="{{ route('recipes_page') }}" class="mt-4 inline-block px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">View all recipes</a>
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
                <form action="{{ route('recipes_page') }}" method="GET">
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
                                <label for="ingredient-1" class="cursor-pointer">Chicken</label>
                            </div>
                            <div class="ingredient-pill {{ in_array(2, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="2" id="ingredient-2" class="hidden" {{ in_array(2, request()->ingredients ?? []) ? 'checked' : '' }}>
                                <label for="ingredient-2" class="cursor-pointer">Beef</label>
                            </div>
                            <div class="ingredient-pill {{ in_array(11, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="11" id="ingredient-11" class="hidden" {{ in_array(11, request()->ingredients ?? []) ? 'checked' : '' }}>
                                <label for="ingredient-11" class="cursor-pointer">Carrot</label>
                            </div>
                            <div class="ingredient-pill {{ in_array(15, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="15" id="ingredient-15" class="hidden" {{ in_array(15, request()->ingredients ?? []) ? 'checked' : '' }}>
                                <label for="ingredient-15" class="cursor-pointer">Onion</label>
                            </div>
                            <div class="ingredient-pill {{ in_array(17, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="17" id="ingredient-17" class="hidden" {{ in_array(17, request()->ingredients ?? []) ? 'checked' : '' }}>
                                <label for="ingredient-17" class="cursor-pointer">Potato</label>
                            </div>
                            <div class="ingredient-pill {{ in_array(21, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="21" id="ingredient-21" class="hidden" {{ in_array(21, request()->ingredients ?? []) ? 'checked' : '' }}>
                                <label for="ingredient-21" class="cursor-pointer">Apple</label>
                            </div>
                            <div class="ingredient-pill {{ in_array(31, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="31" id="ingredient-31" class="hidden" {{ in_array(31, request()->ingredients ?? []) ? 'checked' : '' }}>
                                <label for="ingredient-31" class="cursor-pointer">Flour</label>
                            </div>
                            <div class="ingredient-pill {{ in_array(33, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="33" id="ingredient-33" class="hidden" {{ in_array(33, request()->ingredients ?? []) ? 'checked' : '' }}>
                                <label for="ingredient-33" class="cursor-pointer">Salt</label>
                            </div>
                            <div class="ingredient-pill {{ in_array(35, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="35" id="ingredient-35" class="hidden" {{ in_array(35, request()->ingredients ?? []) ? 'checked' : '' }}>
                                <label for="ingredient-35" class="cursor-pointer">Olive Oil</label>
                            </div>
                            <div class="ingredient-pill {{ in_array(36, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="36" id="ingredient-36" class="hidden" {{ in_array(36, request()->ingredients ?? []) ? 'checked' : '' }}>
                                <label for="ingredient-36" class="cursor-pointer">Butter</label>
                            </div>
                            <div class="ingredient-pill {{ in_array(38, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="38" id="ingredient-38" class="hidden" {{ in_array(38, request()->ingredients ?? []) ? 'checked' : '' }}>
                                <label for="ingredient-38" class="cursor-pointer">Eggs</label>
                            </div>
                            <div class="ingredient-pill {{ in_array(39, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="39" id="ingredient-39" class="hidden" {{ in_array(39, request()->ingredients ?? []) ? 'checked' : '' }}>
                                <label for="ingredient-39" class="cursor-pointer">Rice</label>
                            </div>
                            <div class="ingredient-pill {{ in_array(44, request()->ingredients ?? []) ? 'selected' : '' }} px-3 py-1 border border-gray-300 rounded-full text-sm cursor-pointer">
                                <input type="checkbox" name="ingredients[]" value="44" id="ingredient-44" class="hidden" {{ in_array(44, request()->ingredients ?? []) ? 'checked' : '' }}>
                                <label for="ingredient-44" class="cursor-pointer">Garlic</label>
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle selection for category and ingredient pills
    document.querySelectorAll('.category-pill, .ingredient-pill').forEach(pill => {
        pill.addEventListener('click', function(e) {
            // Prevent clicking on labels from triggering twice
            if (e.target.tagName.toLowerCase() === 'label') {
                e.preventDefault();
            }
            const checkbox = this.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
            this.classList.toggle('selected');
        });
    });
    // Handle sort dropdown change - auto submit the form
    const sortDropdown = document.getElementById('sort');
    if (sortDropdown) {
        sortDropdown.addEventListener('change', function() {
            document.getElementById('sortForm').submit();
        });
    }
    // Animation for recipe cards
    const recipeCards = document.querySelectorAll('.recipe-card');
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        recipeCards.forEach(card => {
            observer.observe(card);
        });
    } else {
        // Fallback for browsers that don't support IntersectionObserver
        recipeCards.forEach(card => {
            card.classList.add('animate-fade-in');
        });
    }
    // Clear all filters button functionality
    const clearFiltersBtn = document.getElementById('clear-filters');
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', function(e) {
            e.preventDefault();
            // Uncheck all checkboxes
            document.querySelectorAll('.category-pill input, .ingredient-pill input').forEach(checkbox => {
                checkbox.checked = false;
                checkbox.closest('.category-pill, .ingredient-pill').classList.remove('selected');
            });
            // Reset sort to default (newest)
            if (sortDropdown) {
                sortDropdown.value = 'newest';
            }
            // Submit the form to apply the cleared filters
            document.querySelector('form[action*="recipes.index"]').submit();
        });
    }
});
</script>
@endpush