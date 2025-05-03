<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy Cooking Recipes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body class="font-sans">
    <!-- Header Section -->
    <header class="relative">
        <div class="container mx-auto px-4 py-8 md:py-16">
            <div class="max-w-4xl mx-auto text-center mb-8">
                <h1 class="text-3xl md:text-5xl font-bold mb-4 fade-in">HEALTHY COOKING RECIPES<br>AND THE RIGHT NUTRITION</h1>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="hover-scale">
                    <img src="/api/placeholder/400/300" alt="Healthy meal" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 font-medium">Veggie Bowl</p>
                    <p class="text-gray-500 text-sm">$12.99</p>
                </div>
                <div class="hover-scale">
                    <img src="/api/placeholder/400/300" alt="Healthy meal" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 font-medium">Grilled Salmon</p>
                    <p class="text-gray-500 text-sm">$15.99</p>
                </div>
                <div class="hover-scale">
                    <img src="/api/placeholder/400/300" alt="Healthy meal" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 font-medium">Rainbow Salad</p>
                    <p class="text-gray-500 text-sm">$10.99</p>
                </div>
                <div class="hover-scale">
                    <img src="/api/placeholder/400/300" alt="Healthy meal" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 font-medium">Protein Mix</p>
                    <p class="text-gray-500 text-sm">$14.99</p>
                </div>
                <div class="hover-scale">
                    <img src="/api/placeholder/400/300" alt="Healthy meal" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 font-medium">Fresh Pasta</p>
                    <p class="text-gray-500 text-sm">$13.99</p>
                </div>
                <div class="hover-scale">
                    <img src="/api/placeholder/400/300" alt="Healthy meal" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 font-medium">Avocado Toast</p>
                    <p class="text-gray-500 text-sm">$8.99</p>
                </div>
                <div class="hover-scale">
                    <img src="/api/placeholder/400/300" alt="Healthy meal" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 font-medium">Asian Noodles</p>
                    <p class="text-gray-500 text-sm">$11.99</p>
                </div>
                <div class="hover-scale">
                    <img src="/api/placeholder/400/300" alt="Healthy meal" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 font-medium">Grain Bowl</p>
                    <p class="text-gray-500 text-sm">$12.49</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="container mx-auto px-4 py-16">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0">
                <img src="/api/placeholder/600/600" alt="Beautiful food bowl" class="w-full rounded-lg shadow-lg">
            </div>
            <div class="md:w-1/2 md:pl-12">
                <h2 class="text-2xl md:text-4xl font-bold mb-6 fade-in">HEALTHY AND QUALITY<br>WITH A NEW FEEL</h2>
                <p class="text-gray-600 mb-6">Experience the perfect blend of nutrition and taste with our carefully crafted recipes. Our chefs combine fresh ingredients to create meals that are not just healthy but also delightful to your taste buds.</p>
                <button class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-6 rounded-md transition duration-300">LEARN MORE</button>
            </div>
        </div>
    </section>

    <!-- Future of Food Section -->
    <section class="container mx-auto px-4 py-16 bg-gray-50">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0 md:pr-12">
                <h2 class="text-2xl md:text-4xl font-bold mb-6 fade-in">TASTE THE FUTURE<br>OF GOOD FOOD</h2>
                <p class="text-gray-600 mb-6">We're pioneering new approaches to healthy cooking that preserve nutrients while maximizing flavor. Our innovative techniques ensure you get the most out of every bite while enjoying incredible taste experiences.</p>
                <button class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-6 rounded-md transition duration-300">EXPLORE NOW</button>
            </div>
            <div class="md:w-1/2">
                <img src="/api/placeholder/600/500" alt="Innovative food preparation" class="w-full rounded-lg shadow-lg">
            </div>
        </div>
    </section>

    <!-- Popular Items Section -->
    <section class="container mx-auto px-4 py-16">
        <h2 class="text-2xl md:text-4xl font-bold mb-12 text-center fade-in">MOST POPULAR ITEMS</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale">
                <img src="/api/placeholder/400/300" alt="Popular dish" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold mb-2">Mediterranean Bowl</h3>
                    <p class="text-gray-600 text-sm mb-4">A delicious mix of fresh vegetables, hummus, and falafel served with whole grain pita bread.</p>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white text-sm py-1 px-4 rounded-md transition duration-300">ORDER NOW</button>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale">
                <img src="/api/placeholder/400/300" alt="Popular dish" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold mb-2">Quinoa Power Salad</h3>
                    <p class="text-gray-600 text-sm mb-4">Protein-rich quinoa with roasted vegetables, nuts, and our signature house dressing.</p>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white text-sm py-1 px-4 rounded-md transition duration-300">ORDER NOW</button>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale">
                <img src="/api/placeholder/400/300" alt="Popular dish" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold mb-2">Green Detox Smoothie</h3>
                    <p class="text-gray-600 text-sm mb-4">Blend of spinach, kale, banana, and almond milk with natural superfoods boost.</p>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white text-sm py-1 px-4 rounded-md transition duration-300">ORDER NOW</button>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale">
                <img src="/api/placeholder/400/300" alt="Popular dish" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold mb-2">Rainbow Sushi Roll</h3>
                    <p class="text-gray-600 text-sm mb-4">Fresh vegetables and avocado wrapped in brown rice and nori, served with ginger.</p>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white text-sm py-1 px-4 rounded-md transition duration-300">ORDER NOW</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="container mx-auto px-4 py-16 bg-gray-50">
        <h2 class="text-2xl md:text-4xl font-bold mb-12 text-center fade-in">THAT'S WHAT OUR<br>KEY CLIENTS SAY</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <img src="/api/placeholder/100/100" alt="Client" class="w-16 h-16 rounded-full mr-4">
                    <div>
                        <h4 class="font-bold">Sarah Johnson</h4>
                        <p class="text-gray-500 text-sm">Fitness Trainer</p>
                    </div>
                </div>
                <p class="text-gray-600">"These recipes have transformed my meal prep routine. My clients love the nutritional recommendations I can now provide alongside their workout plans."</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <img src="/api/placeholder/100/100" alt="Client" class="w-16 h-16 rounded-full mr-4">
                    <div>
                        <h4 class="font-bold">Michael Rodriguez</h4>
                        <p class="text-gray-500 text-sm">Restaurant Owner</p>
                    </div>
                </div>
                <p class="text-gray-600">"Incorporating these healthy recipes into our menu has attracted a whole new customer base. The flavors are incredible and the techniques easy to master."</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <img src="/api/placeholder/100/100" alt="Client" class="w-16 h-16 rounded-full mr-4">
                    <div>
                        <h4 class="font-bold">Emily Chen</h4>
                        <p class="text-gray-500 text-sm">Nutritionist</p>
                    </div>
                </div>
                <p class="text-gray-600">"I recommend this resource to all my clients. The nutritional information is accurate and the recipes are both healthy and delicious - a rare combination!"</p>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <button class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-6 rounded-md transition duration-300">READ MORE</button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <h3 class="font-bold mb-4">CONTACT</h3>
                    <ul class="text-gray-600">
                        <li class="mb-2">123 Nutrition St.</li>
                        <li class="mb-2">Healthy City, HC 12345</li>
                        <li class="mb-2">Phone: (123) 456-7890</li>
                        <li class="mb-2">Email: info@healthycooking.com</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold mb-4">ABOUT</h3>
                    <ul class="text-gray-600">
                        <li class="mb-2">Our Story</li>
                        <li class="mb-2">Our Chefs</li>
                        <li class="mb-2">Nutrition Philosophy</li>
                        <li class="mb-2">Sustainability</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold mb-4">EXPLORE</h3>
                    <ul class="text-gray-600">
                        <li class="mb-2">Recipes</li>
                        <li class="mb-2">Meal Plans</li>
                        <li class="mb-2">Cooking Classes</li>
                        <li class="mb-2">Nutritional Guides</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold mb-4">CONNECT</h3>
                    <div class="flex space-x-4">
                        <i class="fab fa-facebook-f text-gray-600 hover:text-orange-500 cursor-pointer"></i>
                        <i class="fab fa-twitter text-gray-600 hover:text-orange-500 cursor-pointer"></i>
                        <i class="fab fa-instagram text-gray-600 hover:text-orange-500 cursor-pointer"></i>
                        <i class="fab fa-pinterest text-gray-600 hover:text-orange-500 cursor-pointer"></i>
                    </div>
                </div>
            </div>
            
            <div class="text-center text-gray-500 text-sm border-t border-gray-300 pt-8">
                &copy; 2025 Healthy Cooking Recipes. All rights reserved.
            </div>
        </div>
    </footer>
    
    <script>
        // Animation for fade-in elements
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.1 });
            
            fadeElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
</body>
</html>