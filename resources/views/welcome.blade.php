<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
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
        a {
            display: flex;
            top:0;
            right:0;
            position: absolute;
            padding: 10px 20px;
            border-color:black;
            border-style: solid;
            border-width: 2px;
            border-radius: 5px;
            margin: 20px;
            font-size: 18px;
            font-weight: bold;
            color:rgb(44, 135, 196);
            background-color:rgb(255, 255, 255);
            text-decoration: none;
        }
        input[type="text"] {
            padding: 10px;
            margin-top: 20px;
            width: 300px;
            font-size: 16px;
        }
        button {
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
    <h1>Welcome to the Charging Quiz</h1>
    <a href="adminacces.blade.php">Admin?</a>
    <input type="text" placeholder="Username">
    <button type="submit">Start</button>
</body>
</html>