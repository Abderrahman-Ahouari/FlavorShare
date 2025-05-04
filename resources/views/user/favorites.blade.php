<!-- favorites.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Recipes - FlavorShare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-6">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-gray-700 hover:text-orange-500 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Back</span>
            </a>
        </div>

        <!-- Page Title -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Favorite Recipes</h1>
        </div>

        <!-- Recipe Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($recipes as $recipe)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="w-full h-56 overflow-hidden">
                    <img src="{{ asset('storage/recipes/' . $recipe['cover_image']) }}" alt="{{ $recipe['title'] }}" class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-medium text-gray-800">{{ $recipe['title'] }}</h3>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State (displayed when no favorites) -->
        @if(count($recipes) === 0)
        <div class="flex flex-col items-center justify-center py-16">
            <div class="text-gray-400 mb-4">
                <i class="far fa-bookmark text-5xl"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-800 mb-2">No favorite recipes yet</h3>
            <p class="text-gray-600 text-center max-w-md">Browse recipes and bookmark your favorites to see them here.</p>
            <a href="{{ route('recipes_page') }}" class="mt-6 bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition">Explore Recipes</a>
        </div>
        @endif

        <!-- Load More Button (shown if there are more recipes to load) -->
        @if(isset($hasMoreRecipes) && $hasMoreRecipes)
        <div class="mt-10 text-center">
            <button id="load-more" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition">
                Load More
            </button>
        </div>
        @endif
    </div>

    <script>
        // Load more functionality (you can implement AJAX loading)
        const loadMoreButton = document.getElementById('load-more');
        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', function() {
                // Example: You can implement AJAX loading here
                const currentPage = parseInt(this.dataset.page || 1);
                const nextPage = currentPage + 1;
                
                // Update the current page
                this.dataset.page = nextPage;
                
                // AJAX request example (replace with your actual implementation)
                fetch(`/favorites?page=${nextPage}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.html) {
                        // Append new recipes to the grid
                        const recipeGrid = document.querySelector('.grid');
                        recipeGrid.insertAdjacentHTML('beforeend', data.html);
                        
                        // Hide load more button if no more pages
                        if (!data.hasMorePages) {
                            this.style.display = 'none';
                        }
                    }
                })
                .catch(error => console.error('Error loading more recipes:', error));
            });
        }
    </script>
</body>
</html>