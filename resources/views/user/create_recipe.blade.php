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



        <!-- Instructions -->
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

        <!-- Video Section -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Video</label>
            <div class="flex space-x-3 mb-3">
                <label class="inline-flex items-center">
                    <input type="radio" name="video_type" value="none" class="video-type-radio" checked>
                    <span class="ml-2">None</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="video_type" value="url" class="video-type-radio">
                    <span class="ml-2">URL</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="video_type" value="file" class="video-type-radio">
                    <span class="ml-2">Upload</span>
                </label>
            </div>
            
            <!-- Video URL input (hidden by default) -->
            <div id="video-url-container" class="hidden">
                <input type="url" name="video" id="video-url" 
                       class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                       placeholder="Enter video URL">
            </div>
            
            <!-- Video File upload (hidden by default) -->
            <div id="video-file-container" class="hidden">
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <input type="file" name="video" id="video-file" class="hidden" accept="video/*">
                    <label for="video-file" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <span class="mt-2 block text-sm font-medium text-gray-700">
                            Click to upload a video
                        </span>
                    </label>
                </div>
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

        <!-- Images -->
        <div>
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
            
            <div class="mt-4">
                <label class="block text-gray-700 font-medium mb-2">Additional Images</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <input type="file" name="images[]" id="additional-images" class="hidden" accept="image/*" multiple>
                    <label for="additional-images" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <span class="mt-2 block text-sm font-medium text-gray-700">
                            Click to upload additional images
                        </span>
                    </label>
                    <div id="additional-images-preview" class="mt-4 grid grid-cols-2 sm:grid-cols-3 gap-2 hidden"></div>
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
    
    <!-- Footer -->
    <footer class="mt-12 pt-6 border-t border-gray-200">
        <div class="grid grid-cols-3 gap-4 text-sm text-gray-500">
            <div>
                <h5 class="font-medium text-gray-700 mb-2">Company</h5>
                <ul class="space-y-1">
                    <li><a href="#" class="hover:text-gray-700">About</a></li>
                    <li><a href="#" class="hover:text-gray-700">Press</a></li>
                    <li><a href="#" class="hover:text-gray-700">Careers</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-medium text-gray-700 mb-2">Support</h5>
                <ul class="space-y-1">
                    <li><a href="#" class="hover:text-gray-700">Contact</a></li>
                    <li><a href="#" class="hover:text-gray-700">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-gray-700">Terms of Service</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-medium text-gray-700 mb-2">Follow Us</h5>
                <div class="flex space-x-2 mt-2">
                    <a href="#" class="text-gray-400 hover:text-gray-600">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-600">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-600">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-600">
                        <span class="sr-only">Pinterest</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C5.373 0 0 5.372 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 01.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============= Video Type Selection =============
    const videoTypeRadios = document.querySelectorAll('.video-type-radio');
    const videoUrlContainer = document.getElementById('video-url-container');
    const videoFileContainer = document.getElementById('video-file-container');
    
    videoTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'url') {
                videoUrlContainer.classList.remove('hidden');
                videoFileContainer.classList.add('hidden');
            } else if (this.value === 'file') {
                videoUrlContainer.classList.add('hidden');
                videoFileContainer.classList.remove('hidden');
            } else {
                videoUrlContainer.classList.add('hidden');
                videoFileContainer.classList.add('hidden');
            }
        });
    });
    
    // ============= Cover Image Preview =============
    const coverImageInput = document.getElementById('cover-image');
    const coverImagePreview = document.getElementById('cover-image-preview');
    const coverImagePreviewImg = coverImagePreview.querySelector('img');
    const removeCoverImageBtn = document.getElementById('remove-cover-image');
    
    coverImageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                coverImagePreviewImg.src = e.target.result;
                coverImagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    removeCoverImageBtn.addEventListener('click', function() {
        coverImageInput.value = '';
        coverImagePreview.classList.add('hidden');
    });
    
    // ============= Additional Images Preview =============
    const additionalImagesInput = document.getElementById('additional-images');
    const additionalImagesPreview = document.getElementById('additional-images-preview');
    
    additionalImagesInput.addEventListener('change', function() {
        if (this.files && this.files.length > 0) {
            additionalImagesPreview.innerHTML = '';
            additionalImagesPreview.classList.remove('hidden');
            
            Array.from(this.files).forEach((file, index) => {
                const reader = new FileReader();
                const imgContainer = document.createElement('div');
                imgContainer.className = 'relative';
                
                const img = document.createElement('img');
                img.className = 'w-full h-24 object-cover rounded';
                
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'absolute top-1 right-1 bg-white rounded-full p-1 shadow-md text-gray-500 hover:text-red-500';
                removeBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                `;
                
                reader.onload = function(e) {
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
                
                removeBtn.addEventListener('click', function() {
                    // Remove this image from the preview
                    imgContainer.remove();
                    
                    // If no more images, hide the preview container
                    if (additionalImagesPreview.children.length === 0) {
                        additionalImagesPreview.classList.add('hidden');
                    }
                    
                    // Note: Since we can't directly modify the FileList object,
                    // we'll handle the actual removal during form submission
                });
                
                imgContainer.appendChild(img);
                imgContainer.appendChild(removeBtn);
                additionalImagesPreview.appendChild(imgContainer);
            });
        }
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
    
    // ============= Instructions Management =============
    const instructionsContainer = document.getElementById('instructions-container');
    const addInstructionBtn = document.getElementById('add-instruction-btn');
    let instructionCount = 1;
    
    addInstructionBtn.addEventListener('click', function() {
        instructionCount++;
        
        const newInstruction = document.createElement('div');
        newInstruction.className = 'instruction-item flex items-start';
        newInstruction.innerHTML = `
            <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-orange-100 text-orange-500 font-medium text-sm mr-3 mt-3">${instructionCount}</span>
            <textarea name="steps[${instructionCount-1}][description]" rows="2" required
                      class="flex-1 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                      placeholder="Describe step by step the recipe"></textarea>
            <button type="button" class="delete-instruction ml-2 mt-3 text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        `;
        
        instructionsContainer.appendChild(newInstruction);
        
        // Add delete functionality
        newInstruction.querySelector('.delete-instruction').addEventListener('click', function() {
            instructionsContainer.removeChild(newInstruction);
            // Renumber the steps
            updateInstructionNumbers();
        });
        
        // Show delete button for first instruction if we now have multiple
        if (instructionCount === 2) {
            document.querySelector('.delete-instruction').style.display = 'block';
        }
    });
    
    function updateInstructionNumbers() {
        const instructions = instructionsContainer.querySelectorAll('.instruction-item');
        instructions.forEach((item, index) => {
            item.querySelector('span').textContent = index + 1;
            // Update name attribute to maintain sequence
            item.querySelector('textarea').name = `steps[${index}][description]`;
        });
        
        instructionCount = instructions.length;
        
        // Hide delete button if only one instruction left
        if (instructionCount === 1) {
            document.querySelector('.delete-instruction').style.display = 'none';
        }
    }
    
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
                    <div class="w-24">
                        <input type="text" name="ingredients[${ingredientCount}][unit]" 
                               class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                               placeholder="Unit" required maxlength="50">
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




    
    
    // Utility function for debouncing
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            const context = this;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }
    
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
