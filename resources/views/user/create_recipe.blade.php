{{-- resources/views/recipes/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Recipe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-300">
    <div class="container mx-auto max-w-3xl px-4 pt-8 pb-20" x-data="{
        showConfirmation: false,
        showIngredientForm: false,
        ingredients: [],
        steps: [],
        videoType: '',
        newIngredient: {
            ingredient_id: '',
            quantity: '',
            unit: ''
        },
        newStep: {
            description: ''
        },
        addIngredient() {
            if (this.newIngredient.ingredient_id && this.newIngredient.quantity && this.newIngredient.unit) {
                this.ingredients.push({...this.newIngredient});
                this.newIngredient = {
                    ingredient_id: '',
                    quantity: '',
                    unit: ''
                };
                this.showIngredientForm = false;
            }
        },
        addStep() {
            if (this.newStep.description) {
                this.steps.push({...this.newStep});
                this.newStep = {
                    description: ''
                };
            }
        },
        removeIngredient(index) {
            this.ingredients.splice(index, 1);
        },
        removeStep(index) {
            this.steps.splice(index, 1);
        }
    }">
        <h1 class="text-2xl font-medium text-gray-700 mb-4">add recipe</h1>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <form action="/recipes" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="flex items-center justify-between mb-6">
                    <a href="#" @click.prevent="showConfirmation = true" class="flex items-center text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Cancel & Exit
                    </a>
                    <button type="submit" class="bg-orange-500 text-white px-4 py-1 rounded-full text-sm font-medium">Post</button>
                </div>
                
                <!-- Confirmation Dialog -->
                <div x-show="showConfirmation" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                        <h3 class="text-lg font-medium mb-4">Confirm Exit</h3>
                        <p class="text-gray-600 mb-6">Are you sure you want to exit? Your changes will not be saved.</p>
                        <div class="flex justify-end space-x-3">
                            <button type="button" @click="showConfirmation = false" class="px-4 py-2 border border-gray-300 rounded-md">Cancel</button>
                            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-red-600 text-white rounded-md">Exit</a>
                        </div>
                    </div>
                </div>
                
                <!-- Title Section -->
                <div class="mb-6">
                    <label for="title" class="block text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" id="title" placeholder="Recipe name or title" 
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" 
                        required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Servings (Added field from controller) -->
                <div class="mb-6">
                    <label for="servings" class="block text-gray-700 mb-1">Servings</label>
                    <input type="number" name="servings" id="servings" min="1" placeholder="Number of servings" 
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" 
                        required>
                    @error('servings')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- About Section (Hidden field for status) -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-1">About</label>
                    <div class="flex items-center space-x-4">
                        <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-medium">Original recipe</span>
                        <input type="hidden" name="status" value="safe">
                    </div>
                </div>
                
                <!-- Cover Image -->
                <div class="mb-6">
                    <div class="bg-gray-100 p-8 rounded flex items-center justify-center flex-col">
                        <div class="cover-image-preview mb-3 hidden">
                            <img id="cover-image-preview" class="max-h-48 w-auto" src="" alt="Cover image preview">
                        </div>
                        <label for="cover_image" class="flex flex-col items-center justify-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="mt-2 text-gray-600">Add photo</span>
                            <input type="file" name="cover_image" id="cover_image" class="hidden" accept="image/*" onchange="previewCoverImage(this)">
                        </label>
                    </div>
                    @error('cover_image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="4" 
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        placeholder="Introduce your recipe. Add notes, cooking tips, serving suggestions, etc..."></textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Ingredients -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-gray-700">Ingredients</label>
                        <button type="button" @click="showIngredientForm = true" class="text-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Ingredient Items -->
                    <div x-show="ingredients.length > 0" class="mb-4">
                        <template x-for="(ingredient, index) in ingredients" :key="index">
                            <div class="flex items-center justify-between py-2 border-b border-gray-200">
                                <div>
                                    <input type="hidden" :name="`ingredients[${index}][ingredient_id]`" :value="ingredient.ingredient_id">
                                    <input type="hidden" :name="`ingredients[${index}][quantity]`" :value="ingredient.quantity">
                                    <input type="hidden" :name="`ingredients[${index}][unit]`" :value="ingredient.unit">
                                    <span x-text="`${ingredient.quantity} ${ingredient.unit} of ingredient #${ingredient.ingredient_id}`"></span>
                                </div>
                                <button type="button" @click="removeIngredient(index)" class="text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>
                    
                    <div x-show="ingredients.length === 0" class="text-gray-500 text-sm mb-2">
                        Add one ingredient
                    </div>
                    
                    <!-- Add Ingredient Form -->
                    <div x-show="showIngredientForm" class="mt-3 p-4 bg-gray-100 rounded-md">
                        <div class="grid grid-cols-3 gap-3 mb-3">
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Ingredient</label>
                                <select x-model="newIngredient.ingredient_id" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                                    <option value="" disabled selected>Select</option>
                                    @foreach($ingredients ?? [] as $ingredient)
                                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                    @endforeach
                                    <!-- If you don't have ingredients data yet, you can use dummy data -->
                                    <option value="1">Flour</option>
                                    <option value="2">Sugar</option>
                                    <option value="3">Salt</option>
                                    <option value="4">Butter</option>
                                    <option value="5">Eggs</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Quantity</label>
                                <input type="number" x-model="newIngredient.quantity" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm" step="0.01" min="0.01">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Unit</label>
                                <select x-model="newIngredient.unit" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                                    <option value="" disabled selected>Select</option>
                                    <option value="g">grams (g)</option>
                                    <option value="kg">kilograms (kg)</option>
                                    <option value="ml">milliliters (ml)</option>
                                    <option value="l">liters (l)</option>
                                    <option value="tsp">teaspoon (tsp)</option>
                                    <option value="tbsp">tablespoon (tbsp)</option>
                                    <option value="cup">cup</option>
                                    <option value="piece">piece</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" @click="showIngredientForm = false" class="px-3 py-1 text-sm border border-gray-300 rounded-md">Cancel</button>
                            <button type="button" @click="addIngredient()" class="px-3 py-1 text-sm bg-orange-500 text-white rounded-md">Add</button>
                        </div>
                    </div>
                    @error('ingredients')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Orange Header (Instructions) -->
                <div class="mb-4">
                    <div class="flex items-center text-orange-500 font-medium">
                        <span class="mr-2">•</span>
                        <span>Header</span>
                    </div>
                </div>
                
                <!-- Instructions (Steps) -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-gray-700">Instructions</label>
                        <button type="button" @click="addStep()" class="text-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Step Items -->
                    <div x-show="steps.length > 0" class="mb-4">
                        <template x-for="(step, index) in steps" :key="index">
                            <div class="flex items-start justify-between py-2 border-b border-gray-200">
                                <div class="flex">
                                    <span class="mr-2 bg-orange-100 text-orange-800 py-1 px-2 rounded-full" x-text="index + 1"></span>
                                    <div>
                                        <input type="hidden" :name="`steps[${index}][description]`" :value="step.description">
                                        <p x-text="step.description"></p>
                                    </div>
                                </div>
                                <button type="button" @click="removeStep(index)" class="text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>
                    
                    <div class="mt-2">
                        <textarea x-model="newStep.description" placeholder="Simple instruction step..." class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                        <div class="mt-2 flex justify-end">
                            <button type="button" @click="addStep()" class="px-3 py-1 text-sm bg-orange-500 text-white rounded-md">Add Step</button>
                        </div>
                    </div>
                    @error('steps')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Orange Header (Prep Time) -->
                <div class="mb-4">
                    <div class="flex items-center text-orange-500 font-medium">
                        <span class="mr-2">•</span>
                        <span>Header</span>
                    </div>
                </div>
                
                <!-- Prep Time -->
                <div class="mb-6">
                    <label for="preparation_time" class="block text-gray-700 mb-1">Prep time</label>
                    <div class="flex items-center">
                        <input type="number" name="preparation_time" id="preparation_time" min="1" 
                            class="w-24 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" 
                            required>
                        <span class="ml-2 text-gray-600">Minutes</span>
                    </div>
                    @error('preparation_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Tags -->
                <div class="mb-6">
                    <label for="tags" class="block text-gray-700 mb-1">Tags</label>
                    <select name="tags[]" id="tags" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" multiple>
                        @foreach($tags ?? [] as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                        <!-- If you don't have tags data yet, you can use dummy data -->
                        <option value="1">Breakfast</option>
                        <option value="2">Lunch</option>
                        <option value="3">Dinner</option>
                        <option value="4">Dessert</option>
                        <option value="5">Vegan</option>
                        <option value="6">Vegetarian</option>
                        <option value="7">Gluten-free</option>
                    </select>
                    <p class="text-gray-500 text-sm mt-1">Select one or more tags</p>
                    @error('tags')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Categories -->
                <div class="mb-6">
                    <label for="categories" class="block text-gray-700 mb-1">Categories</label>
                    <select name="categories[]" id="categories" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" multiple>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        <!-- If you don't have categories data yet, you can use dummy data -->
                        <option value="1">Italian</option>
                        <option value="2">Mexican</option>
                        <option value="3">Asian</option>
                        <option value="4">French</option>
                        <option value="5">American</option>
                    </select>
                    <p class="text-gray-500 text-sm mt-1">Select one or more categories</p>
                    @error('categories')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Additional Images -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-1">Additional Images</label>
                    <div class="grid grid-cols-4 gap-3" id="image-container">
                        <label for="additional-images" class="flex flex-col items-center justify-center w-full h-24 bg-gray-100 rounded cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="mt-1 text-xs text-gray-600">Add Images</span>
                            <input type="file" name="images[]" id="additional-images" class="hidden" accept="image/*" multiple onchange="previewAdditionalImages(this)">
                        </label>
                    </div>
                    @error('images.*')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Video Section (Hidden in design but needed for controller) -->
                <div class="mb-6">
                    <label class="block text-gray-700 mb-1">Video (Optional)</label>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <input type="radio" name="video_type" id="video_none" value="" x-model="videoType" checked>
                            <label for="video_none">No Video</label>
                        </div>
                        <div class="flex items-center space-x-3">
                            <input type="radio" name="video_type" id="video_file" value="file" x-model="videoType">
                            <label for="video_file">Upload Video File</label>
                        </div>
                        <div class="flex items-center space-x-3">
                            <input type="radio" name="video_type" id="video_url" value="url" x-model="videoType">
                            <label for="video_url">Video URL</label>
                        </div>
                        
                        <div x-show="videoType === 'file'" class="mt-2">
                            <input type="file" name="video" accept="video/*" class="w-full border border-gray-300 rounded-md px-3 py-2">
                        </div>
                        
                        <div x-show="videoType === 'url'" class="mt-2">
                            <input type="url" name="video" placeholder="https://example.com/video.mp4" class="w-full border border-gray-300 rounded-md px-3 py-2">
                        </div>
                    </div>
                    @error('video')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </form>
        </div>
        
        <!-- Footer (simplified) -->
        <div class="mt-10 flex items-center justify-between text-gray-500 text-sm">
            <div>
                <p class="font-bold">Recipe App</p>
                <p>© 2025 All rights reserved</p>
            </div>
            <div>
                <p class="font-bold">Explore</p>
                <p>Categories</p>
                <p>Recipes</p>
                <p>Chefs</p>
                <p>Blogs</p>
            </div>
            <div>
                <p class="font-bold">Connect</p>
                <div class="flex space-x-2 mt-2">
                    <span>F</span>
                    <span>T</span>
                    <span>I</span>
                    <span>Y</span>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function previewCoverImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('cover-image-preview').src = e.target.result;
                    document.querySelector('.cover-image-preview').classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function previewAdditionalImages(input) {
            const container = document.getElementById('image-container');
            // Keep only the first child (the upload button)
            const uploadButton = container.firstElementChild;
            container.innerHTML = '';
            container.appendChild(uploadButton);
            
            if (input.files) {
                for (let i = 0; i < input.files.length; i++) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-full h-24 object-cover rounded';
                        
                        div.appendChild(img);
                        
                        // Insert before the upload button
                        container.insertBefore(div, uploadButton);
                    }
                    
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    </script>
</body>
</html>