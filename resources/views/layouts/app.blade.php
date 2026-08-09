<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bukuku') — Bukuku</title>
</head>
<body>

    <header>
        <nav>
            <strong><a href="{{ route('home') }}">Bukuku</a></strong>
            &nbsp;|&nbsp;
            <a href="{{ route('home') }}">Home</a>

            @if(session()->has('user_id'))
                &nbsp;|&nbsp;
                Halo, <strong>{{ session('user_name') }}</strong>
                &nbsp;|&nbsp;
                <a href="{{ route('profile') }}">Profil Saya</a>

                @if(session('user_role') === 'admin')
                    &nbsp;|&nbsp;
                    <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                @endif

                &nbsp;|&nbsp;
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                &nbsp;|&nbsp;
                <a href="{{ route('login') }}">Login</a>
            @endif
        </nav>

        {{-- Flash Messages --}}
        @if(session('success'))
            <p><strong>[Sukses]</strong> {{ session('success') }}</p>
        @endif
        @if(session('error'))
            <p><strong>[Error]</strong> {{ session('error') }}</p>
        @endif
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </header>

    <hr>

    <main>
        @yield('content')
    </main>

    <hr>

    <footer>
        <p>&copy; {{ date('Y') }} Bukuku — Website Review Buku</p>
    </footer>

</body>
</html>
