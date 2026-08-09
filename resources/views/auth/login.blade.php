@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <h1>Login Bukuku</h1>

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <p>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </p>

        <p>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
        </p>

        <p>
            <button type="submit">Login</button>
        </p>
    </form>
@endsection
