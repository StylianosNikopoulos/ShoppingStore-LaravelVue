<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ShoppingStore')</title>
    @vite('resources/js/app.js') 
    @vite('resources/sass/app.scss')
    <script>
        window.isAuthenticated = @json(auth()->check());
    </script>
</head>
<body>
    <header class="navbar">
        <div class="container">
            <div class="logo">ShoppingStore</div>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/products">Products</a></li>
                    <li><a href="/about">About</a></li>
                    {{-- @if (auth()->check() && auth()->user()->isAdmin())
                    <li><a href="/admin/dashboard">Admin</a></li>
                     @endif --}}
                    @if (!auth()->check())
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register" class="register-btn">Register</a></li>
                @else
                    <li><a href="/cart">Cart</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </li>
                @endif
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">ShoppingStore</div>
                <div class="footer-info">
                    <p>&copy; 2024 ShoppingStore. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
