<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body, html {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0; /* Light gray background */
            font-family: Arial, sans-serif; /* Font style */
        }

        .container {
            background-color: white; /* White background for the form */
            padding: 20px;
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            width: 300px; /* Fixed width */
            text-align: center;
        }

        h2 {
            margin-bottom: 20px; /* Spacing below the title */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%; /* Full width */
            padding: 10px;
            margin: 10px 0; /* Spacing above and below */
            border: 1px solid #ccc; /* Border style */
            border-radius: 4px; /* Rounded corners */
            font-size: 16px; /* Font size */
        }

        .submit-button {
            padding: 10px;
            font-size: 18px;
            background-color: #007bff; /* Blue background */
            color: white; /* White text */
            border: none;
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Register</h2>

    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <input type="text" placeholder="Name" required name="name">
        <input type="email" placeholder="Email" required name="email">
        <input type="password" placeholder="Password" required name="password">
        <input type="password" placeholder="Confirm Password" required name="password_confirmation"> <!-- Added name attribute -->
        <button type="submit" class="submit-button">Register</button>
    </form>
</div>

<style>
    .error-message {
        color: red;
        margin-bottom: 15px;
    }
</style>
</body>

</html>
