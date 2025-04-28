<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | FlavorShare</title>
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

<body class="bg-white min-h-screen">
    <!-- Header -->
    <header class="w-full py-4 px-4 md:px-16 flex justify-between items-center relative">
        <a href="#" class="flex items-center z-10">
            <span class="logo-text text-2xl font-bold text-black">flavor<span class="text-flavorshare-orange">share</span></span>
        </a>
        
        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-6">
            <a href="#" class="text-flavorshare-text hover:text-flavorshare-orange">Contact us</a>
            <a href="#" class="text-flavorshare-text hover:text-flavorshare-orange">Explore</a>
            <a href="#" class="text-flavorshare-text hover:text-flavorshare-orange">Account</a>
            <a href="#" class="px-6 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Login</a>
            <a href="#" class="px-6 py-2 bg-flavorshare-orange text-white rounded-md hover:bg-orange-500">SignUp</a>
        </nav>
        
        <!-- Mobile Menu Button -->
        <button class="md:hidden text-flavorshare-text z-10" id="menu-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu fixed top-0 left-0 w-full h-screen bg-white z-0 flex flex-col items-center justify-center space-y-6 md:hidden">
            <a href="#" class="text-xl text-flavorshare-text hover:text-flavorshare-orange">Contact us</a>
            <a href="#" class="text-xl text-flavorshare-text hover:text-flavorshare-orange">Explore</a>
            <a href="#" class="text-xl text-flavorshare-text hover:text-flavorshare-orange">Account</a>
            <a href="#" class="text-xl text-flavorshare-text hover:text-flavorshare-orange">Login</a>
            <a href="#" class="text-xl text-flavorshare-text hover:text-flavorshare-orange">SignUp</a>
        </div>
    </header>


    <form action="{{ url('/recipes') }}" method="POST" enctype="multipart/form-data" id="recipeForm">
        @csrf
        <div class="bg-white rounded-lg shadow-sm p-6">
            <!-- Header with Cancel & Exit and Save buttons -->
            <div class="flex justify-between items-center mb-8">
                <a href="{{ url()->previous() }}" class="flex items-center text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                        <path d="M19 12H5M12 19l-7-7 7-7"></path>
                    </svg>
                    Cancel & Exit
                </a>
                <button type="submit" class="bg-orange-500 text-white px-4 py-1 rounded-full">
                    Save
                </button>
            </div>

            <!-- Title -->
            <div class="mb-8">
                <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded p-2 mb-1" required placeholder="Give your recipe a name...">
                
                <div class="flex justify-between items-center mt-3">
                    <div>
                        <span class="text-gray-700">Recipe language:</span>
                        <select name="language" class="ml-2 border border-gray-300 rounded">
                            <option value="en">English</option>
                            <!-- Add other languages as needed -->
                        </select>
                    </div>
                </div>
            </div>

            <!-- About -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-2">
                    <label class="block text-gray-700 font-medium">About</label>
                    <label for="coverImage" class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm cursor-pointer">
                        Upload photo
                    </label>
                </div>
                <div id="photoPreviewContainer" class="bg-gray-100 flex flex-col items-center justify-center rounded-md h-40 mb-2">
                    <div id="photoUploadPlaceholder" class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-gray-400 mb-2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                        <p class="text-gray-500 text-sm">Add photo</p>
                    </div>
                    <img id="coverImagePreview" class="hidden h-full w-auto rounded-md" src="#" alt="Recipe cover">
                </div>
                <input type="file" name="cover_image" id="coverImage" class="hidden" accept="image/*">
            </div>

            <!-- Description -->
            <div class="mb-8">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea name="description" id="description" rows="3" class="w-full border border-gray-300 rounded p-2" placeholder="Introduce your recipe. Add notes, cooking tips, serving suggestions, etc..."></textarea>
            </div>

            <!-- Ingredients -->
            <div class="mb-8">
                <label class="block text-gray-700 font-medium mb-2">Ingredients</label>
                <div class="flex border border-gray-300 rounded mb-2">
                    <input type="text" id="ingredientSearch" class="flex-grow p-2 rounded-l" placeholder="Add new ingredient">
                    <button type="button" id="addIngredientBtn" class="bg-white border-l border-gray-300 p-2 rounded-r">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </button>
                </div>
                <div id="ingredientSearchResults" class="bg-white border border-gray-300 rounded mt-1 hidden"></div>
                <div id="ingredientsList" class="space-y-2">
                    <!-- Ingredients will be added dynamically -->
                </div>
            </div>

            <!-- Instructions -->
            <div class="mb-8">
                <label class="block text-gray-700 font-medium mb-2">Instructions</label>
                <div id="instructionsList" class="space-y-3">
                    <div class="step-container flex">
                        <div class="flex-grow">
                            <textarea name="steps[0][description]" class="w-full border border-gray-300 rounded p-2" placeholder="Describe your step (e.g. Make crepe batter)" required></textarea>
                        </div>
                        <button type="button" class="remove-step ml-2 text-gray-400 hover:text-red-500" style="display:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                </div>
                <button type="button" id="addStepBtn" class="flex items-center text-gray-700 mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Add step
                </button>
            </div>



            <!-- Prep time -->
            <div class="mb-8">
                <label class="block text-gray-700 font-medium mb-2">Prep time</label>
                <div class="flex space-x-4">
                    <div class="w-1/2">
                        <input type="number" name="preparation_time" id="prepTime" class="w-full border border-gray-300 rounded p-2" min="1" required placeholder="Minutes">
                    </div>
                    <div class="w-1/2">
                        <input type="number" name="servings" id="servings" class="w-full border border-gray-300 rounded p-2" min="1" required placeholder="Servings">
                    </div>
                </div>
            </div>

            <!-- Tags -->
            <div class="mb-8">
                <label for="tags" class="block text-gray-700 font-medium mb-2">Tags</label>
                <input type="text" id="tagSearch" class="w-full border border-gray-300 rounded p-2" placeholder="Add new tag">
                <div id="tagSearchResults" class="bg-white border border-gray-300 rounded mt-1 hidden"></div>
                <div id="selectedTags" class="flex flex-wrap gap-2 mt-2">
                    <!-- Selected tags will be displayed here -->
                </div>
            </div>

            <!-- Categories -->
            <div class="mb-8">
                <label for="categories" class="block text-gray-700 font-medium mb-2">Categories</label>
                <div class="relative">
                    <input type="text" id="categorySearch" class="w-full border border-gray-300 rounded p-2" placeholder="Select one category">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </div>
                <div id="categorySearchResults" class="bg-white border border-gray-300 rounded mt-1 hidden"></div>
                <div id="selectedCategories" class="flex flex-wrap gap-2 mt-2">
                    <!-- Selected categories will be displayed here -->
                </div>
            </div>

            <!-- Hidden field for status -->
            <input type="hidden" name="status" value="safe">
            
            <!-- Hidden field for video_type -->
            <input type="hidden" name="video_type" value="url">
            
            <!-- Video URL field (conditionally shown) -->
            <div id="videoUrlContainer" class="mb-8 hidden">
                <label for="video" class="block text-gray-700 font-medium mb-2">Video URL</label>
                <input type="text" name="video" id="videoUrl" class="w-full border border-gray-300 rounded p-2" placeholder="Enter video URL">
            </div>
        </div>
    </form>

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
</div>

{{-- @endsection --}}

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image Upload Preview
        const coverImage = document.getElementById('coverImage');
        const photoUploadPlaceholder = document.getElementById('photoUploadPlaceholder');
        const coverImagePreview = document.getElementById('coverImagePreview');

        coverImage.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    coverImagePreview.src = e.target.result;
                    coverImagePreview.classList.remove('hidden');
                    photoUploadPlaceholder.classList.add('hidden');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Instructions / Steps
        const addStepBtn = document.getElementById('addStepBtn');
        const instructionsList = document.getElementById('instructionsList');
        let stepCount = 1;

        addStepBtn.addEventListener('click', function() {
            const stepContainer = document.createElement('div');
            stepContainer.className = 'step-container flex';
            stepContainer.innerHTML = `
                <div class="flex-grow">
                    <textarea name="steps[${stepCount}][description]" class="w-full border border-gray-300 rounded p-2" placeholder="Describe your step" required></textarea>
                </div>
                <button type="button" class="remove-step ml-2 text-gray-400 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            `;
            instructionsList.appendChild(stepContainer);
            stepCount++;

            // Show remove buttons if there are multiple steps
            if (instructionsList.children.length > 1) {
                document.querySelectorAll('.remove-step').forEach(btn => {
                    btn.style.display = 'block';
                });
            }
        });

        // Event delegation for remove step buttons
        instructionsList.addEventListener('click', function(e) {
            if (e.target.closest('.remove-step')) {
                e.target.closest('.step-container').remove();
                
                // Hide remove buttons if only one step remains
                if (instructionsList.children.length <= 1) {
                    document.querySelectorAll('.remove-step').forEach(btn => {
                        btn.style.display = 'none';
                    });
                }
            }
        });

        // Ingredients Search and Add
        const ingredientSearch = document.getElementById('ingredientSearch');
        const ingredientSearchResults = document.getElementById('ingredientSearchResults');
        const ingredientsList = document.getElementById('ingredientsList');
        let ingredientCount = 0;

        ingredientSearch.addEventListener('input', debounce(function() {
            const query = this.value.trim();
            if (query.length < 2) {
                ingredientSearchResults.classList.add('hidden');
                return;
            }

            // AJAX request to search ingredients
            fetch(`{{ url('/Ingredient_search') }}?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    ingredientSearchResults.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(ingredient => {
                            const div = document.createElement('div');
                            div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                            div.textContent = ingredient.name;
                            div.dataset.id = ingredient.id;
                            div.dataset.name = ingredient.name;
                            div.addEventListener('click', function() {
                                addIngredient(this.dataset.id, this.dataset.name);
                                ingredientSearch.value = '';
                                ingredientSearchResults.classList.add('hidden');
                            });
                            ingredientSearchResults.appendChild(div);
                        });
                        ingredientSearchResults.classList.remove('hidden');
                    } else {
                        ingredientSearchResults.classList.add('hidden');
                    }
                })
                .catch(error => console.error('Error:', error));
        }, 300));

        document.getElementById('addIngredientBtn').addEventListener('click', function() {
            const query = ingredientSearch.value.trim();
            if (query.length > 0) {
                // This assumes you have a way to add custom ingredients
                // For now we'll just show an alert that this isn't implemented
                alert('Custom ingredients need to be added to the database first');
                ingredientSearch.value = '';
            }
        });

        function addIngredient(id, name) {
            const ingredientRow = document.createElement('div');
            ingredientRow.className = 'flex items-center bg-gray-50 p-2 rounded';
            ingredientRow.innerHTML = `
                <span class="flex-grow">${name}</span>
                <div class="flex items-center space-x-2">
                    <input type="number" name="ingredients[${ingredientCount}][quantity]" min="0.01" step="0.01" class="w-16 border border-gray-300 rounded p-1" placeholder="Qty" required>
                    <input type="text" name="ingredients[${ingredientCount}][unit]" class="w-16 border border-gray-300 rounded p-1" placeholder="Unit" required>
                    <button type="button" class="remove-ingredient text-gray-400 hover:text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <input type="hidden" name="ingredients[${ingredientCount}][ingredient_id]" value="${id}">
            `;
            ingredientsList.appendChild(ingredientRow);
            ingredientCount++;

            // Event delegation for remove ingredient
            ingredientRow.querySelector('.remove-ingredient').addEventListener('click', function() {
                ingredientRow.remove();
            });
        }

        // Tags Search and Add
        const tagSearch = document.getElementById('tagSearch');
        const tagSearchResults = document.getElementById('tagSearchResults');
        const selectedTags = document.getElementById('selectedTags');
        const selectedTagIds = new Set();

        tagSearch.addEventListener('input', debounce(function() {
            const query = this.value.trim();
            if (query.length < 2) {
                tagSearchResults.classList.add('hidden');
                return;
            }

            // AJAX request to search tags
            fetch(`{{ url('/tags_search') }}?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    tagSearchResults.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(tag => {
                            if (!selectedTagIds.has(tag.id.toString())) {
                                const div = document.createElement('div');
                                div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                                div.textContent = tag.name;
                                div.dataset.id = tag.id;
                                div.dataset.name = tag.name;
                                div.addEventListener('click', function() {
                                    addTag(this.dataset.id, this.dataset.name);
                                    tagSearch.value = '';
                                    tagSearchResults.classList.add('hidden');
                                });
                                tagSearchResults.appendChild(div);
                            }
                        });
                        tagSearchResults.classList.remove('hidden');
                    } else {
                        tagSearchResults.classList.add('hidden');
                    }
                })
                .catch(error => console.error('Error:', error));
        }, 300));

        function addTag(id, name) {
            if (selectedTagIds.has(id.toString())) return;
            
            selectedTagIds.add(id.toString());
            
            const tagBadge = document.createElement('div');
            tagBadge.className = 'flex items-center bg-gray-100 rounded-full px-3 py-1 text-sm';
            tagBadge.innerHTML = `
                <span>${name}</span>
                <button type="button" class="remove-tag ml-2 text-gray-400 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <input type="hidden" name="tags[]" value="${id}">
            `;
            selectedTags.appendChild(tagBadge);

            // Event delegation for remove tag
            tagBadge.querySelector('.remove-tag').addEventListener('click', function() {
                selectedTagIds.delete(id.toString());
                tagBadge.remove();
            });
        }

        // Categories Search and Add
        const categorySearch = document.getElementById('categorySearch');
        const categorySearchResults = document.getElementById('categorySearchResults');
        const selectedCategories = document.getElementById('selectedCategories');
        const selectedCategoryIds = new Set();

        categorySearch.addEventListener('input', debounce(function() {
            const query = this.value.trim();
            if (query.length < 2) {
                categorySearchResults.classList.add('hidden');
                return;
            }

            // AJAX request to search categories
            fetch(`{{ url('/categories_search') }}?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    categorySearchResults.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(category => {
                            if (!selectedCategoryIds.has(category.id.toString())) {
                                const div = document.createElement('div');
                                div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                                div.textContent = category.name;
                                div.dataset.id = category.id;
                                div.dataset.name = category.name;
                                div.addEventListener('click', function() {
                                    addCategory(this.dataset.id, this.dataset.name);
                                    categorySearch.value = '';
                                    categorySearchResults.classList.add('hidden');
                                });
                                categorySearchResults.appendChild(div);
                            }
                        });
                        categorySearchResults.classList.remove('hidden');
                    } else {
                        categorySearchResults.classList.add('hidden');
                    }
                })
                .catch(error => console.error('Error:', error));
        }, 300));

        function addCategory(id, name) {
            if (selectedCategoryIds.has(id.toString())) return;
            
            selectedCategoryIds.add(id.toString());
            
            const categoryBadge = document.createElement('div');
            categoryBadge.className = 'flex items-center bg-gray-100 rounded-full px-3 py-1 text-sm';
            categoryBadge.innerHTML = `
                <span>${name}</span>
                <button type="button" class="remove-category ml-2 text-gray-400 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <input type="hidden" name="categories[]" value="${id}">
            `;
            selectedCategories.appendChild(categoryBadge);

            // Event delegation for remove category
            categoryBadge.querySelector('.remove-category').addEventListener('click', function() {
                selectedCategoryIds.delete(id.toString());
                categoryBadge.remove();
            });
        }

        // Helper function to debounce input events
        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    func.apply(context, args);
                }, wait);
            };
        }

        // Close search results when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#ingredientSearch') && !e.target.closest('#ingredientSearchResults')) {
                ingredientSearchResults.classList.add('hidden');
            }
            if (!e.target.closest('#tagSearch') && !e.target.closest('#tagSearchResults')) {
                tagSearchResults.classList.add('hidden');
            }
            if (!e.target.closest('#categorySearch') && !e.target.closest('#categorySearchResults')) {
                categorySearchResults.classList.add('hidden');
            }
        });
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
{{-- @endsection --}}