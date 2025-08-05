@extends('layout')

@section('title', 'Users Under Admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Users You Manage</h2>

    @if($users->count())
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No users found under your admin account.</p>
    @endif
</div>
@endsection
