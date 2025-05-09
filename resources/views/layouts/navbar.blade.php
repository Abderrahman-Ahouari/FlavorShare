
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

    @auth
    <!-- Header -->
    <header class="w-full py-4 px-4 md:px-16 flex justify-between items-center relative">
        <a href="{{ route('home_page') }}" class="flex items-center z-10">
            <span class="logo-text text-2xl font-bold text-black">flavor<span class="text-flavorshare-orange">share</span></span>
        </a>
        
        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-6">
            <a href="{{ route('contact_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Contact us</a>
            <a href="{{ route('recipes_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Explore</a>
            <a href="{{ route('account_page') }}" class="px-6 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Account</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="px-6 py-2 bg-flavorshare-orange text-white rounded-md hover:bg-orange-500">Logout</button>
            </form>
        </nav>
        
        <!-- Mobile Menu Button -->
        <button class="md:hidden text-flavorshare-text z-10" id="menu-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu fixed top-0 left-0 w-full h-screen bg-white z-0 flex flex-col items-center justify-center space-y-6 md:hidden">
            <a href="{{ route('home_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Home</a>
            <a href="{{ route('contact_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Contact us</a>
            <a href="{{ route('recipes_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Explore</a>
            <a href="{{ route('account_page') }}" class="px-6 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Account</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="px-6 py-2 bg-flavorshare-orange text-white rounded-md hover:bg-orange-500">Logout</button>
            </form>
        </div>
    </header>
    @else
    <!-- Header -->
    <header class="w-full py-4 px-4 md:px-16 flex justify-between items-center relative">
        <a href="{{ route('home_page') }}" class="flex items-center z-10">
            <span class="logo-text text-2xl font-bold text-black">flavor<span class="text-flavorshare-orange">share</span></span>
        </a>
        
        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-6">
            <a href="{{ route('contact_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Contact us</a>
            <a href="{{ route('recipes_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Explore</a>
            <a href="{{ route('login_page') }}" class="px-6 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Login</a>
            <a href="{{ route('signup_page') }}" class="px-6 py-2 bg-flavorshare-orange text-white rounded-md hover:bg-orange-500">SignUp</a>
        </nav>
        
        <!-- Mobile Menu Button -->
        <button class="md:hidden text-flavorshare-text z-10" id="menu-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu fixed top-0 left-0 w-full h-screen bg-white z-0 flex flex-col items-center justify-center space-y-6 md:hidden">
            <a href="{{ route('home_page') }}" class="flex items-center z-10">home</a>
            <a href="{{ route('contact_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Contact us</a>
            <a href="{{ route('recipes_page') }}" class="text-flavorshare-text hover:text-flavorshare-orange">Explore</a>
            <a href="{{ route('login_page') }}" class="px-6 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Login</a>
            <a href="{{ route('signup_page') }}" class="px-6 py-2 bg-flavorshare-orange text-white rounded-md hover:bg-orange-500">SignUp</a>
        </div>
    </header>
    @endauth

<script>
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