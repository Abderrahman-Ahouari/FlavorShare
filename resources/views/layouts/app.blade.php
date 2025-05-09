<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FlavorShare')</title>
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
        body { font-family: 'Poppins', sans-serif; }
        .logo-text { font-family: 'cursive', sans-serif; }
        .mobile-menu { transform: translateY(-100%); transition: transform 0.3s ease-in-out; }
        .mobile-menu.active { transform: translateY(0); }
    </style>
    @stack('head')
</head>
<body class="bg-white min-h-screen">
    @include('layouts.navbar')
    <main>
        @yield('content')
    </main>
    @include('layouts.footer')
    @stack('scripts')
</body>
</html>
