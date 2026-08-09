<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', 'Dashboard') | Bukuku</title>
</head>
<body>

    <table width="100%">
        <tr>
            {{-- Sidebar --}}
            <td width="200" valign="top" style="border-right: 1px solid #ccc; padding-right: 16px">
                <h3>Bukuku Admin</h3>
                <nav>
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.books.index') }}">Kelola Buku</a></li>
                        <li><a href="{{ route('admin.genres.index') }}">Kelola Genre</a></li>
                        <li><a href="{{ route('admin.users.index') }}">Lihat User</a></li>
                    </ul>
                    <hr>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </nav>
            </td>

            {{-- Konten Utama --}}
            <td valign="top" style="padding-left: 16px">

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

                @yield('content')
            </td>
        </tr>
    </table>

</body>
</html>
