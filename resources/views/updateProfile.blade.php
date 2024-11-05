<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .submit-button {
            padding: 10px;
            font-size: 18px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .submit-button:hover {
            background-color: #0056b3;
        }
        .success-message,
        .error-message {
            margin: 10px 0;
            text-align: center;
        }
        .success-message {
            color: green;
        }
        .error-message {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>User Profile</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="submit-button">Update Profile</button>
    </form>
</div>

</body>
</html>
