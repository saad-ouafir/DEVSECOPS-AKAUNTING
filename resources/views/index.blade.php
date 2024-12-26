<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Akaunting</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: green;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            text-decoration: none;
            background-color: #ff9800;
            color: #fff;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 1.2rem;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #e68900;
        }

        .container {
            text-align: center;
        }

        footer {
            position: absolute;
            bottom: 20px;
            text-align: center;
            width: 100%;
            font-size: 0.9rem;
            color: #ddd;
        }

        footer a {
            color: #ddd;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Akaunting</h1>
        <a href="{{ route('register') }}">Register</a>
    </div>
</body>
</html>
