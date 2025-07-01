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
            height: 100vh;
        }
        h1 {
            margin-top:10vh;
            color: #2c3e50;
            font-size: 40px;
        }
        div {
            margin: 20px;
            padding: 10px;
            background-color: #ecf0f1;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 50vw;
            justify-content: space-between;
            align-items: center;
            display: flex;
            flex-direction: column;
        }
        div div{
            width: 45vw;
            flex-direction: row;
        }
        button {
            padding: 15px 20px;
            background-color: #2980b9;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        button:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>
    <h1>Quiz 1</h1>
    <div>
        <div>
            <h2>Question 1 lorem ipsum</h2>
            <button>edit</button>
        </div>
        <div>
            <p>A lorem ipsum</p>
            <button>edit</button>
        </div>
        <div>
            <p>B lorem ipsum</p>
            <button>edit</button>
        </div>
        <div>
            <p>C lorem ipsum</p>
            <button>edit</button>
        </div>
    </div>
    <div>
        <div>
            <h2>Question 2 lorem ipsum</h2>
            <button>edit</button>
        </div>
        <div>
            <p>A lorem ipsum</p>
            <button>edit</button>
        </div>
        <div>
            <p>B lorem ipsum</p>
            <button>edit</button>
        </div>
        <div>
            <p>C lorem ipsum</p>
            <button>edit</button>
        </div>
    </div>
</body>
</html>