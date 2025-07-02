<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
            height: 40vh;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        form * {
            margin: 15px;
        }
        h1 {
            margin-top:10vh;
            color: #2c3e50;
            font-size: 40px;
        }
        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin-top: 20px;
            width: 300px;
            font-size: 16px;
        }
        button {
            margin-top: 20px;
            padding: 15px 20px;
            background-color: #2980b9;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>
    <h1>Admin Login</h1>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Log In</button>
    </form>

    @if(session('error'))
        <p style="color:red; margin-top: 20px;">{{ session('error') }}</p>
    @endif
</body>
</html>
