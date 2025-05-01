<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recipe | FlavorShare</title>
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
</head>

<div class="max-w-4xl mx-auto px-4 py-6">
    <!-- Header with back button -->
    <div class="flex items-center mb-8">
        <a href="{{ url()->previous() }}" class="text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Cancel & Exit
        </a>
        <button type="submit" form="recipe-form" class="ml-auto bg-orange-500 hover:bg-orange-600 text-white font-medium py-1.5 px-4 rounded-full">
            Save
        </button>
    </div>

    <!-- Form -->
    <form id="recipe-form" action="{{ url('/recipes') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <!-- Title Section -->
        <div>
            <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
            <div class="flex space-x-2">
                <div class="flex-1">
                    <input type="text" id="title" name="title" required maxlength="255" 
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500" 
                           placeholder="Recipe name">
                </div>
            </div>
        </div>
        <!-- Description -->
        <div>
            <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea id="description" name="description" rows="3" 
                      class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                      placeholder="Write your recipe description, including tips, serving suggestions, etc."></textarea>
        </div>


        <!-- Ingredients Section -->
<div class="mb-6">
    <h3 class="text-lg font-semibold mb-3">Ingredients</h3>
    
    <!-- Ingredient search -->
    <div class="ingredient-search-wrapper relative mb-3">
        <div class="relative">
            <input type="text" 
                   class="ingredient-search w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                   placeholder="Search ingredients...">
            <button type="button" 
                    id="add-ingredient-btn"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg px-3 py-1">
                Add
            </button>
        </div>
        
        <!-- Search results dropdown -->
        <div class="ingredient-search-results absolute z-10 bg-white border border-gray-300 rounded-lg w-full mt-1 max-h-60 overflow-y-auto shadow-lg hidden"></div>
    </div>
    
    <!-- Selected ingredients list -->
    <div id="ingredients-list" class="space-y-2"></div>
</div>



<!-- Instructions Section -->
<div>
    <label class="block text-gray-700 font-medium mb-2">Instructions</label>
    <div id="instructions-container" class="space-y-3">
        <div class="instruction-item flex items-start">
            <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-orange-100 text-orange-500 font-medium text-sm mr-3 mt-3">1</span>
            <textarea name="steps[0][description]" rows="2" required
                      class="flex-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                      placeholder="Describe step by step the recipe"></textarea>
            <button type="button" class="delete-instruction ml-2 mt-3 text-gray-400 hover:text-gray-600" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Add instruction button -->
    <button type="button" id="add-instruction-btn" class="mt-2 text-sm text-orange-500 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        Add another step
    </button>
</div>


        <!-- Preparation Time and Servings -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="preparation_time" class="block text-gray-700 font-medium mb-2">Prep Time</label>
                <div class="flex">
                    <input type="number" id="preparation_time" name="preparation_time" required min="1" 
                           class="w-full border border-gray-300 rounded-l-lg p-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    <span class="inline-flex items-center px-3 bg-gray-100 text-gray-500 text-sm rounded-r-lg border border-l-0 border-gray-300">
                        minutes
                    </span>
                </div>
            </div>
            <div>
                <label for="servings" class="block text-gray-700 font-medium mb-2">Servings</label>
                <input type="number" id="servings" name="servings" required min="1" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
            </div>
        </div>

        <!-- Tags -->
        <div>
            <label for="tags-input" class="block text-gray-700 font-medium mb-2">Tags</label>
            <div class="relative">
                <input type="text" id="tags-input" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                       placeholder="#enter your tags">
                <div id="tags-container" class="flex flex-wrap gap-2 mt-2"></div>
                <!-- Hidden inputs for tags will be added here -->
            </div>
        </div>

        <!-- Categories -->
        <div>
            <label for="categories" class="block text-gray-700 font-medium mb-2">Categories</label>
            <div class="relative">
                <select id="categories" name="categories[]" multiple class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white"
                        style="height: auto; min-height: 42px;">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

<!-- Images Section -->
<div>
    <!-- Cover Image -->
    <div class="mb-6">
        <label class="block text-gray-700 font-medium mb-2">Cover Image</label>
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
            <input type="file" name="cover_image" id="cover-image" class="hidden" accept="image/*">
            <label for="cover-image" class="cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <span class="mt-2 block text-sm font-medium text-gray-700">
                    Click to upload cover image
                </span>
            </label>
            <div id="cover-image-preview" class="mt-4 hidden">
                <img src="#" alt="Cover preview" class="max-h-40 mx-auto">
                <button type="button" id="remove-cover-image" class="mt-2 text-sm text-red-500">Remove</button>
            </div>
        </div>
    </div>
    
    <!-- Additional Images -->
    <div class="mt-4">
        <div class="flex justify-between items-center mb-2">
            <label class="block text-gray-700 font-medium">Additional Images</label>
            <button type="button" id="add-image-btn" class="bg-blue-500 hover:bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        
        <div id="additional-images-container">
            <!-- Image upload items will be added here dynamically -->
        </div>
        
        <!-- Template for image upload item (hidden) -->
        <template id="image-upload-template">
            <div class="image-upload-item mb-3 border-2 border-dashed border-gray-300 rounded-lg p-4">
                <div class="flex justify-between items-start mb-2">
                    <span class="text-sm font-medium text-gray-700">Image</span>
                    <button type="button" class="remove-image bg-white rounded-full p-1 shadow-md text-gray-500 hover:text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                
                <div class="file-upload-container">
                    <input type="file" name="images[]" class="image-file-input hidden" accept="image/*">
                    <label class="file-upload-label cursor-pointer block text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <span class="mt-1 block text-sm font-medium text-gray-700">
                            Click to upload image
                        </span>
                    </label>
                    <div class="image-preview mt-2 hidden">
                        <img src="#" alt="Image preview" class="max-h-32 mx-auto rounded-md">
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>


<!-- Video Section -->
<div class="mb-6">
    <label class="block text-gray-700 font-medium mb-2">Recipe Video</label>
    
    <!-- Video Type Selection -->
    <div class="mb-4">
        <div class="flex items-center space-x-4">
            <div class="flex items-center">
                <input type="radio" id="video-type-url" name="video_type" value="url" 
                       class="h-4 w-4 text-blue-600" checked>
                <label for="video-type-url" class="ml-2 text-sm text-gray-700">
                    Video URL
                </label>
            </div>
            <div class="flex items-center">
                <input type="radio" id="video-type-file" name="video_type" value="file" 
                       class="h-4 w-4 text-blue-600">
                <label for="video-type-file" class="ml-2 text-sm text-gray-700">
                    Upload Video File
                </label>
            </div>
        </div>
    </div>
    
    <!-- Video URL Input -->
    <div id="video-url-container" class="mb-4">
        <input type="text" id="video-url" name="video" 
               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
               placeholder="Enter YouTube URL or direct video link">
    </div>
    
    <!-- Video File Upload -->
    <div id="video-file-container" class="mb-4 hidden">
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
            <input type="file" name="video_file" id="video-file-input" class="hidden" accept="video/*">
            <label for="video-file-input" class="cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                <span class="mt-2 block text-sm font-medium text-gray-700">
                    Click to upload video file
                </span>
                <span class="mt-1 block text-xs text-gray-500">
                    MP4, WebM, or Ogg formats (Max 100MB)
                </span>
            </label>
            <div id="video-file-preview" class="mt-4 hidden">
                <video controls class="max-h-60 mx-auto">
                    <source src="" type="">
                    Your browser does not support the video tag.
                </video>
                <div class="mt-2 flex items-center justify-center">
                    <span id="video-file-name" class="text-sm text-gray-600 mr-2"></span>
                    <button type="button" id="remove-video-file" class="text-sm text-red-500">Remove</button>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Submit Button (Mobile) -->
        <div class="md:hidden">
            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-4 rounded-lg">
                Save Recipe
            </button>
        </div>
    </form>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
     // Video Type Toggle
     const videoTypeUrl = document.getElementById('video-type-url');
        const videoTypeFile = document.getElementById('video-type-file');
        const videoUrlContainer = document.getElementById('video-url-container');
        const videoFileContainer = document.getElementById('video-file-container');
        const videoUrlInput = document.getElementById('video-url');
        const videoFileInput = document.getElementById('video-file-input');
        
        // Toggle between URL and File upload
        videoTypeUrl.addEventListener('change', function() {
            if (this.checked) {
                videoUrlContainer.classList.remove('hidden');
                videoFileContainer.classList.add('hidden');
                videoFileInput.value = ''; // Clear file input
                document.getElementById('video-file-preview').classList.add('hidden');
            }
        });
        
        videoTypeFile.addEventListener('change', function() {
            if (this.checked) {
                videoUrlContainer.classList.add('hidden');
                videoFileContainer.classList.remove('hidden');
                videoUrlInput.value = ''; // Clear URL input
            }
        });
        
        
        // Remove video file
        removeVideoFile.addEventListener('click', function() {
            videoFileInput.value = '';
            videoPreviewSource.src = '';
            videoPlayer.load();
            videoFilePreview.classList.add('hidden');
        });
    
     
    // ============= Tags Input =============
    const tagsInput = document.getElementById('tags-input');
    const tagsContainer = document.getElementById('tags-container');
    let tagsList = [];
    
    tagsInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ' || e.key === ',') {
            e.preventDefault();
            
            let tagText = this.value.trim();
            if (tagText.startsWith('#')) {
                tagText = tagText.substring(1);
            }
            
            if (tagText && !tagsList.includes(tagText)) {
                addTag(tagText);
                this.value = '';
            }
        }
    });
    
    function addTag(text) {
        tagsList.push(text);
        
        // Create tag element
        const tagEl = document.createElement('div');
        tagEl.className = 'bg-gray-100 rounded-full px-3 py-1 text-sm flex items-center';
        tagEl.innerHTML = `
            <span class="text-gray-800">#${text}</span>
            <button type="button" class="ml-1 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        `;
        
        // Add hidden input for form submission
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'tags[]';
        hiddenInput.value = text;
        tagEl.appendChild(hiddenInput);
        
        // Add remove event
        tagEl.querySelector('button').addEventListener('click', function() {
            tagEl.remove();
            tagsList = tagsList.filter(t => t !== text);
        });
        
        tagsContainer.appendChild(tagEl);
    }
    
    // Cover Image Preview
    const coverImageInput = document.getElementById('cover-image');
        const coverImagePreview = document.getElementById('cover-image-preview');
        const coverPreviewImg = coverImagePreview.querySelector('img');
        const removeCoverBtn = document.getElementById('remove-cover-image');
        
        coverImageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    coverPreviewImg.src = e.target.result;
                    coverImagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        removeCoverBtn.addEventListener('click', function() {
            coverImageInput.value = '';
            coverPreviewImg.src = '#';
            coverImagePreview.classList.add('hidden');
        });
        
        // Additional Images Functionality
        const addImageBtn = document.getElementById('add-image-btn');
        const imagesContainer = document.getElementById('additional-images-container');
        const imageTemplate = document.getElementById('image-upload-template');
        
        // Add new image upload item
        addImageBtn.addEventListener('click', function() {
            addImageUploadItem();
        });
        
        function addImageUploadItem() {
            // Clone the template
            const clone = document.importNode(imageTemplate.content, true);
            const imageItem = clone.querySelector('.image-upload-item');
            const fileInput = clone.querySelector('.image-file-input');
            const fileLabel = clone.querySelector('.file-upload-label');
            const imagePreview = clone.querySelector('.image-preview');
            const previewImg = imagePreview.querySelector('img');
            const removeBtn = clone.querySelector('.remove-image');
            
            // Generate unique id for this input
            const uniqueId = 'image-' + Date.now();
            fileInput.id = uniqueId;
            fileLabel.setAttribute('for', uniqueId);
            
            // File input change event
            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                        fileLabel.classList.add('hidden');
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
            
            // Remove button click event
            removeBtn.addEventListener('click', function() {
                imageItem.remove();
            });
            
            // Add the new item to the container
            imagesContainer.appendChild(clone);
        }
        
        // Add first image upload item by default
        addImageUploadItem();

    
 // ============= Instructions Management =============
 const instructionsContainer = document.getElementById('instructions-container');
    const addInstructionBtn = document.getElementById('add-instruction-btn');
    let instructionCount = 1; // Start with 1 as we already have one step by default
    
    // Add event listener to the "Add another step" button
    addInstructionBtn.addEventListener('click', function() {
        addNewInstruction();
    });
    
    // Add event listener to the first delete button (which is initially hidden)
    const firstDeleteBtn = document.querySelector('.delete-instruction');
    if (firstDeleteBtn) {
        firstDeleteBtn.addEventListener('click', function() {
            const firstInstruction = this.closest('.instruction-item');
            if (instructionsContainer.querySelectorAll('.instruction-item').length > 1) {
                instructionsContainer.removeChild(firstInstruction);
                updateInstructionNumbers();
            }
        });
    }
    
    // Function to add a new instruction
    function addNewInstruction() {
        const newInstruction = document.createElement('div');
        newInstruction.className = 'instruction-item flex items-start';
        
        // Create the step number indicator
        const stepNumber = document.createElement('span');
        stepNumber.className = 'inline-flex items-center justify-center h-6 w-6 rounded-full bg-orange-100 text-orange-500 font-medium text-sm mr-3 mt-3';
        stepNumber.textContent = instructionCount + 1;
        newInstruction.appendChild(stepNumber);
        
        // Create the textarea
        const textarea = document.createElement('textarea');
        textarea.name = `steps[${instructionCount}][description]`;
        textarea.rows = 2;
        textarea.required = true;
        textarea.className = 'flex-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500';
        textarea.placeholder = 'Describe step by step the recipe';
        newInstruction.appendChild(textarea);
        
        // Create the delete button
        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className = 'delete-instruction ml-2 mt-3 text-gray-400 hover:text-red-500';
        deleteButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        `;
        
        // Add delete functionality
        deleteButton.addEventListener('click', function() {
            instructionsContainer.removeChild(newInstruction);
            updateInstructionNumbers();
        });
        
        newInstruction.appendChild(deleteButton);
        
        // Add the new instruction to the container
        instructionsContainer.appendChild(newInstruction);
        
        // Increment the counter
        instructionCount++;
        
        // Show delete button for the first instruction if we now have multiple
        if (instructionCount === 2) {
            const firstDeleteBtn = instructionsContainer.querySelector('.instruction-item:first-child .delete-instruction');
            if (firstDeleteBtn) {
                firstDeleteBtn.style.display = 'block';
            }
        }
    }
    
    // Function to update instruction numbers and names after deletion
    function updateInstructionNumbers() {
        const instructions = instructionsContainer.querySelectorAll('.instruction-item');
        
        instructions.forEach((item, index) => {
            // Update the step number
            const stepNumber = item.querySelector('span');
            if (stepNumber) {
                stepNumber.textContent = index + 1;
            }
            
            // Update textarea name to maintain sequence
            const textarea = item.querySelector('textarea');
            if (textarea) {
                textarea.name = `steps[${index}][description]`;
            }
        });
        
        // Update instructionCount
        instructionCount = instructions.length;
        
        // Hide delete button if only one instruction left
        if (instructionCount === 1) {
            const deleteBtn = instructionsContainer.querySelector('.delete-instruction');
            if (deleteBtn) {
                deleteBtn.style.display = 'none';
            }
        }
    }
    
    
    // ============= Ingredient Search and Add =============

    const ingredientSearch = document.querySelector('.ingredient-search');
    const ingredientSearchResults = document.querySelector('.ingredient-search-results');
    const ingredientsList = document.getElementById('ingredients-list');
    let ingredientCount = 0;
    
    // Debounce function to prevent excessive API calls
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }
    
    // Ingredient search with AJAX
    ingredientSearch.addEventListener('input', debounce(function() {
        const query = this.value.trim();
        
        if (query.length < 2) {
            ingredientSearchResults.classList.add('hidden');
            return;
        }
        
        // Show loading indicator
        ingredientSearchResults.innerHTML = '<div class="p-3 text-gray-500">Searching...</div>';
        ingredientSearchResults.classList.remove('hidden');
        
        fetch(`{{ route('Ingredient_search') }}?query=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                ingredientSearchResults.innerHTML = '';
                
                if (data.length === 0) {
                    ingredientSearchResults.innerHTML = '<div class="p-3 text-gray-500">No ingredients found</div>';
                } else {
                    data.forEach(ingredient => {
                        const item = document.createElement('div');
                        item.className = 'p-3 hover:bg-gray-100 cursor-pointer';
                        item.textContent = ingredient.name;
                        item.addEventListener('click', function() {
                            addIngredient(ingredient.id, ingredient.name);
                            ingredientSearch.value = '';
                            ingredientSearchResults.classList.add('hidden');
                        });
                        ingredientSearchResults.appendChild(item);
                    });
                }
            })
            .catch(error => {
                console.error('Error searching ingredients:', error);
                ingredientSearchResults.innerHTML = '<div class="p-3 text-red-500">Error searching ingredients</div>';
            });
    }, 300));
    
    // Hide search results when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.ingredient-search-wrapper')) {
            ingredientSearchResults.classList.add('hidden');
        }
    });
    
    // Add ingredient function
    function addIngredient(id, name) {
    const ingredientItem = document.createElement('div');
    ingredientItem.className = 'ingredient-item flex items-center bg-white border border-gray-300 rounded-lg p-3';
    ingredientItem.dataset.id = id;
    ingredientItem.innerHTML = `
        <div class="flex-1">
            <div class="font-medium">${name}</div>
            <div class="flex flex-wrap mt-2 gap-2">
                <input type="hidden" name="ingredients[${ingredientCount}][ingredient_id]" value="${id}">
                <div class="w-24">
                    <input type="number" name="ingredients[${ingredientCount}][quantity]"
                           class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                           placeholder="Qty" required min="0.01" step="0.01">
                </div>
                <div class="w-28">
                    <select name="ingredients[${ingredientCount}][unit]"
                           class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                           required>
                        <option value="" disabled selected>Unit</option>
                        <option value="g">gram</option>
                        <option value="kg">kilogram</option>
                        <option value="lb">pound</option>
                        <option value="ml">milliliter</option>
                        <option value="l">liter</option>
                        <option value="tbsp">tablespoon</option>
                        <option value="cup">cup</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="button" class="delete-ingredient ml-2 text-gray-400 hover:text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    `;
    
    ingredientsList.appendChild(ingredientItem);
    
    // Add delete functionality
    ingredientItem.querySelector('.delete-ingredient').addEventListener('click', function() {
        ingredientsList.removeChild(ingredientItem);
        updateIngredientIndices();
    });
    
    ingredientCount++;
}
    
    // Update indices when ingredients are removed
    function updateIngredientIndices() {
        const ingredients = ingredientsList.querySelectorAll('.ingredient-item');
        ingredients.forEach((item, index) => {
            item.querySelectorAll('input').forEach(input => {
                const name = input.name;
                const newName = name.replace(/ingredients\[\d+\]/, `ingredients[${index}]`);
                input.name = newName;
            });
        });
        
        ingredientCount = ingredients.length;
    }
    
    // Add ingredient button (alternative to search)
    document.getElementById('add-ingredient-btn').addEventListener('click', function() {
        ingredientSearch.focus();
    });
    
    // Form submission validation
    document.getElementById('recipe-form').addEventListener('submit', function(e) {
        const ingredients = ingredientsList.querySelectorAll('.ingredient-item');
        if (ingredients.length === 0) {
            e.preventDefault();
            alert('Please add at least one ingredient');
            return;
        }
        
        // Additional validation can be added here
    });
});
</script>
