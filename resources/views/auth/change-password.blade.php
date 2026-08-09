@extends('layouts.app')

@section('title', 'Ganti Password')

@section('content')
    <h1>Ganti Password</h1>

    <form action="{{ route('change-password.submit') }}" method="POST">
        @csrf

        <p>
            <label for="email">Email Anda:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </p>

        <p>
            <label for="old_password">Password Lama:</label><br>
            <input type="password" id="old_password" name="old_password" required>
        </p>

        <p>
            <label for="new_password">Password Baru:</label><br>
            <input type="password" id="new_password" name="new_password" required>
        </p>

        <p>
            <label for="new_password_confirmation">Konfirmasi Password Baru:</label><br>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
        </p>

        <p>
            <button type="submit">Ganti Password</button>
        </p>
    </form>
@endsection
