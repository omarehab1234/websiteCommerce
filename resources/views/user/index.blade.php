<!-- user Index -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users | Cilantro Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel ='stylesheet' href="{{asset('css/user/index.css')}}">
</head>
<div class="d-flex justify-content-between align-items-center mb-4" >

        <h2 class="fw-bold">Users</h2>

        <div>

            <a href="{{ route('admin') }}"
            class="btn btn-outline-dark me-2">
                ← Dashboard
            </a>
        </div>

    </div>
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" >
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>

    @foreach($users as $user)
        @if($user->id != 1)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>

            <td>
                <form action="{{ route('users.admin', $user) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    @if($user->is_admin)
                        <button type="submit">Remove Admin</button>
                    @else
                        <button type="submit">Make Admin</button>
                    @endif
                </form>

                <form action="{{ route('users.destroy', $user) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endif
    @endforeach
</table>