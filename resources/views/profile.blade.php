<!-- resources/views/user/profile.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        /* Basic styling */
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .profile-image {
            width: 150px; /* عرض الصورة */
            height: 150px; /* ارتفاع الصورة */
            border-radius: 75px; /* شكل دائري */
            object-fit: cover; /* ضمان عدم تشويه الصورة */
        }
    </style>
</head>
<body>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div style="margin-bottom: 20px; text-align: center;">
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="button" style="background-color: #dc3545;">
            Logout
        </button>
    </form>
</div>

<div class="container">
    <h2>{{ auth()->user()->utype === 'admin' ? 'Admin' : 'User' }} Profile</h2>

    <div style="text-align: center; margin-bottom: 20px;">
        @if($user->photo)
            <img src="{{ asset('storage/' . $user->photo) }}" alt="Profile Photo" class="profile-image">
        @else
            <img src="{{ asset('default-profile.png') }}" alt="Default Profile Photo" class="profile-image"> <!-- صورة افتراضية في حالة عدم وجود صورة -->
        @endif
    </div>

    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <a href="{{ route('profile.edit', $user->id) }}" class="button">Edit Profile</a>
</div>
</body>
</html>
