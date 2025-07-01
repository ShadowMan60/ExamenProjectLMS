<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        h1 {
            margin-top:10vh;
            color: #2c3e50;
            font-size: 40px;
        }
        input[type="text"] {
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
    <h1>Acces Admin</h1>
    <input type="text" placeholder="Username">
    <input type="text" placeholder="Password">
    <button type="submit">Log In</button>
</body>
</html>