<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
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
            text-align: center;
        }

        .enter-button {
            padding: 15px 30px;
            font-size: 20px;
            background-color: #007bff; /* Blue background */
            color: white; /* White text */
            border: none;
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s;
            text-decoration: none; /* Remove underline from link */
        }

        .enter-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
<div class="container">
    <a href="{{ route('login') }}" class="enter-button">Enter</a> <!-- Change to login route -->
</div>
</body>
</html>
