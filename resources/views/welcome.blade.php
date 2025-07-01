<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome to the Laravel Application</h1>
    <p>This is a simple welcome page.</p>

    <a href="{{ url('/login') }}">Login</a>
    <a href="{{ url('/register') }}">Register</a>

    <p>Current Date and Time: {{ now() }}</p>
    
</body>
</html>