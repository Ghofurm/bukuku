@extends('layouts.admin')

@section('title', 'Kelola User')

@section('content')
    <h1>Daftar User</h1>

    @if($users->isEmpty())
        <p>Belum ada user terdaftar.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Jumlah Review</th>
                    <th>Terdaftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>{{ $user->reviews_count }}</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            @if($user->id !== session('user_id'))
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus user {{ $user->name }}?')">Hapus</button>
                                </form>
                            @else
                                <em>(Akun Anda)</em>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
