@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard Admin</h1>

    <p>Selamat datang, <strong>{{ session('user_name') }}</strong>!</p>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Total Buku</th>
                <th>Total User</th>
                <th>Total Review</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $totalBooks }}</td>
                <td>{{ $totalUsers }}</td>
                <td>{{ $totalReviews }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <ul>
        <li><a href="{{ route('admin.books.index') }}">Kelola Buku</a></li>
        <li><a href="{{ route('admin.genres.index') }}">Kelola Genre</a></li>
        <li><a href="{{ route('admin.users.index') }}">Kelola User</a></li>
    </ul>
@endsection
