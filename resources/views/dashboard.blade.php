<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex; /* Use flexbox for layout */
        }
        .sidebar {
            background-color: #343a40;
            color: white;
            min-width: 200px;
            padding: 20px;
            height: 100vh; /* Full height */
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px; /* Add margin to separate from sidebar */
            flex-grow: 1; /* Allow container to grow */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex; /* Use flexbox for centering */
            flex-direction: column; /* Align children vertically */
            align-items: center; /* Center horizontally */
            justify-content: center; /* Center vertically */
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%; /* Take full width */
            max-width: 800px; /* Set a maximum width */
            border-collapse: collapse;
            margin-top: 20px;
            text-align: center; /* Center table text */
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .toggle-button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .active {
            background-color: #28a745;
            color: white;
        }
        .inactive {
            background-color: #dc3545;
            color: white;
        }
        .success-message {
            color: green;
            margin-bottom: 20px;
            text-align: center;
        }
        .admin-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .admin-info img {
            width: 40px; /* Set image size */
            height: 40px;
            border-radius: 50%; /* Circular image */
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="sidebar">

    @if(Auth::check() && Auth::user()->utype === 'admin')
        <!-- الشريط الجانبي للأدمن فقط -->
        <div class="sidebar">
            <div class="admin-info">
                <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Admin Picture">
                <span>{{ auth()->user()->name }}</span>
            </div>
            <h2>Menu</h2>
            <a href="/admin/users">Dashboard</a>
            <a href="{{ route('profile.show') }}">Admin Profile</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="button" style="background-color: #dc3545;">
                    Logout
                </button>
            </form>
        </div>
    @endif
</div>




<!-- Main content -->
<div class="container">
    <h1>User Management</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <!-- Button to add a new user -->
    <div style="margin-bottom: 20px; text-align: center;">
        <a href="{{ route('add.user') }}" class="toggle-button" style="display: block; margin-bottom: 20px; background-color: #007bff; color: white; padding: 10px; text-align: center; border-radius: 5px; text-decoration: none;">
            Add New User
        </a>
    </div>

    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr id="user-{{ $user->id }}">
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <form action="{{ route('admin.users.toggle.status', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="toggle-button {{ $user->status ? 'inactive' : 'active' }}">
                            {{ $user->status ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="toggle-button" style="background-color: #dc3545; color: white;">
                            Delete
                        </button>
                    </form>
                    <a href="{{ route('profile.edit', $user->id) }}" class="toggle-button" style="background-color: #007bff; color: white;">
                        Edit
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
