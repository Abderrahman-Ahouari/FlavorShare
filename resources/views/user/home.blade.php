@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="pt-24 pb-12 md:py-32 bg-gradient-to-r from-green-50 to-green-100">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">HEALTHY COOKING RECIPES AND THE RIGHT NUTRITION</h1>
                <p class="text-lg mb-8">Discover delicious, nutritious meals that are easy to prepare and will transform your approach to healthy eating.</p>
                <a href="{{ route('recipes_page') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-md transition duration-300 inline-block">EXPLORE RECIPES</a>
            </div>
            <div class="md:w-1/2 grid grid-cols-3 gap-4">
                <div class="recipe-card col-span-1">
                    <img src="http://127.0.0.1:8000/storage/assets/tb83glu72e9guv4uy8n8.jpg.png" alt="Healthy Recipe" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 text-sm font-medium">Avocado Toast</p>
                    <p class="text-xs text-gray-500">15 min</p>
                </div>
                <div class="recipe-card col-span-1">
                    <img src="http://127.0.0.1:8000/storage/assets/qc6mrixtyl6ma9x9f47k.jpg.png" alt="Healthy Recipe" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 text-sm font-medium">Green Salad</p>
                    <p class="text-xs text-gray-500">10 min</p>
                </div>
                <div class="recipe-card col-span-1">
                    <img src="http://127.0.0.1:8000/storage/assets/acxhjjxsu75xk6fwqazn.jpg.png" alt="Healthy Recipe" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 text-sm font-medium">Veggie Bowl</p>
                    <p class="text-xs text-gray-500">20 min</p>
                </div>
                <div class="recipe-card col-span-1">
                    <img src="http://127.0.0.1:8000/storage/assets/69s4bbsn6v44cvllukdj.jpg.png" alt="Healthy Recipe" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 text-sm font-medium">Quinoa Salad</p>
                    <p class="text-xs text-gray-500">25 min</p>
                </div>
                <div class="recipe-card col-span-1">
                    <img src="http://127.0.0.1:8000/storage/assets/32jo3oxq7sfneppw8hrw.jpg.png" alt="Healthy Recipe" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 text-sm font-medium">Fruit Smoothie</p>
                    <p class="text-xs text-gray-500">5 min</p>
                </div>
                <div class="recipe-card col-span-1">
                    <img src="http://127.0.0.1:8000/storage/assets/9pbikyfivldmvf8rivfg.jpg.png" alt="Healthy Recipe" class="w-full h-40 object-cover rounded-lg shadow-md">
                    <p class="mt-2 text-sm font-medium">Protein Bowl</p>
                    <p class="text-xs text-gray-500">30 min</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Quality Section -->
    <section class="py-16 md:py-24">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <img src="http://127.0.0.1:8000/storage/assets/tb83glu72e9guv4uy8n8.jpg.png" alt="Bowl of healthy food" class="w-full rounded-lg shadow-lg fade-in">
            </div>
            <div class="md:w-1/2 md:pl-12 fade-in">
                <h2 class="text-2xl md:text-4xl font-bold mb-6">HEALTHY AND QUALITY WITH A NEW FEEL</h2>
                <p class="mb-8">Our recipes combine traditional cooking wisdom with modern nutritional science. We focus on whole ingredients, balanced macronutrients, and meals that satisfy both your body and taste buds.</p>
                <a href="{{ route('recipes_page') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-md transition duration-300 inline-block">LEARN MORE</a>
            </div>
        </div>
    </section>
    <!-- Future of Food Section -->
    <section class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4 flex flex-col md:flex-row-reverse items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <img src="http://127.0.0.1:8000/storage/assets/acxhjjxsu75xk6fwqazn.jpg.png" alt="Modern food preparation" class="w-full rounded-lg shadow-lg fade-in">
            </div>
            <div class="md:w-1/2 md:pr-12 fade-in">
                <h2 class="text-2xl md:text-4xl font-bold mb-6">TASTE THE FUTURE OF GOOD FOOD</h2>
                <p class="mb-8">We believe that healthy eating doesn't mean sacrificing flavor or satisfaction. Our innovative approach to cooking introduces new techniques and ingredient combinations that will revolutionize your kitchen experience.</p>
                <a href="{{ route('recipes_page') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-md transition duration-300 inline-block">DISCOVER</a>
            </div>
        </div>
    </section>
    <!-- Popular Items Section -->
    <section class="py-16 md:py-24">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-4xl font-bold mb-12 text-center">MOST POPULAR ITEMS</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="fade-in">
                    <img src="http://127.0.0.1:8000/storage/assets/58q9ssssox2malve6cey.jpg.png" alt="Popular dish" class="w-full h-64 object-cover rounded-lg shadow-md mb-4">
                    <h3 class="text-xl font-semibold mb-2">Buddha Bowl with Tahini</h3>
                    <p class="text-gray-600 mb-3">A nourishing bowl packed with colorful vegetables, proteins, and a creamy tahini dressing that brings everything together.</p>
                    <a href="{{ route('recipes_page') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-md transition duration-300 inline-block mt-8">View More</a>
                </div>
                <div class="fade-in">
                    <img src="http://127.0.0.1:8000/storage/assets/okl0xaxft6552fjjtz2v.jpg.png" alt="Popular dish" class="w-full h-64 object-cover rounded-lg shadow-md mb-4">
                    <h3 class="text-xl font-semibold mb-2">Mediterranean Salad</h3>
                    <p class="text-gray-600 mb-3">Fresh vegetables, olives, and feta cheese drizzled with olive oil and herbs for a taste of the Mediterranean.</p>
                    <a href="{{ route('recipes_page') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-md transition duration-300 inline-block mt-8">View More</a>
                </div>
                <div class="fade-in">
                    <img src="http://127.0.0.1:8000/storage/assets/tont20fs91ztyywbv1w3.jpg.png" alt="Popular dish" class="w-full h-64 object-cover rounded-lg shadow-md mb-4">
                    <h3 class="text-xl font-semibold mb-2">Protein-Packed Breakfast</h3>
                    <p class="text-gray-600 mb-3">Start your day right with this energizing breakfast that combines whole grains, fruits, and quality proteins.</p>
                    <a href="{{ route('recipes_page') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-md transition duration-300 inline-block mt-8">View More</a>
                </div>
                <div class="fade-in">
                    <img src="http://127.0.0.1:8000/storage/assets/jep6d8153aqns3lmxkzz.jpg.png" alt="Popular dish" class="w-full h-64 object-cover rounded-lg shadow-md mb-4">
                    <h3 class="text-xl font-semibold mb-2">Vegetable Curry</h3>
                    <p class="text-gray-600 mb-3">A flavorful and aromatic curry that's both satisfying and packed with nutrients from seasonal vegetables.</p>
                    <a href="{{ route('recipes_page') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium px-6 py-3 rounded-md transition duration-300 inline-block mt-8">View More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials Section -->
    <section class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 mb-8 md:mb-0 grid grid-cols-2 gap-4 fade-in">
                    <img src="http://127.0.0.1:8000/storage/assets/a0yv0qjk4433b9072j79.jpg.png" alt="Food testimonial" class="w-full h-48 object-cover rounded-lg shadow-md">
                    <img src="http://127.0.0.1:8000/storage/assets/r5zc0u7fz74lhg7l09bt.jpg.png" alt="Food testimonial" class="w-full h-48 object-cover rounded-lg shadow-md">
                    <img src="http://127.0.0.1:8000/storage/assets/tb83glu72e9guv4uy8n8.jpg.png" alt="Food testimonial" class="w-full h-48 object-cover rounded-lg shadow-md">
                </div>
                <div class="md:w-1/2 md:pl-12 fade-in">
                    <h2 class="text-2xl md:text-4xl font-bold mb-6">THAT'S WHAT OUR SAY CLIENTS</h2>
                    <p class="mb-6 text-lg italic">"These recipes have transformed my relationship with food. I never thought healthy eating could be this delicious and satisfying. My entire family now looks forward to our meals!"</p>
                    <p class="font-semibold">- Sarah Johnson, Mom of three</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Fade-in animation
    document.addEventListener('DOMContentLoaded', function() {
        const fadeElements = document.querySelectorAll('.fade-in');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });
        
        fadeElements.forEach(element => {
            observer.observe(element);
        });
    });
</script>
@endpush