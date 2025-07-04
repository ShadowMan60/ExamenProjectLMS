<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quiz Result</title>
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
            justify-content: center;
            height: 60vh;
        }
        .progress-container {
            width: 70vw;
            height: 30px;
            background-color: #ddd;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .progress-bar {
            height: 100%;
            background-color: rgb(32, 159, 190);
            width: 0%;
            border-radius: 15px 0 0 15px;
            transition: width 1s ease-in-out;
        }
        .result-text {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        button {
            padding: 15px 25px;
            background-color: #2980b9;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 18px;
            margin-top: 30px;
            width: 150px;
        }
        button:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>
    <h1>Quiz Result</h1>

    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>

    <div class="result-text" id="percentageText">0%</div>
    <div class="result-text" id="scoreText">0/0 Correct</div>

    <button onclick="window.location.href='{{ route('selectquiz') }}'">Return to Quizzes</button>

    <script>
        const correct = {{ $correct }};
        const total = {{ $total }};
        const percentage = Math.round((correct / total) * 100);

        document.getElementById('progressBar').style.width = percentage + '%';
        document.getElementById('percentageText').textContent = percentage + '%';
        document.getElementById('scoreText').textContent = `${correct}/${total} Correct`;
    </script>
</body>
</html>
