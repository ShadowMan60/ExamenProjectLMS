@php
    $user = \App\Models\User::find(session('user_id'));
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Select Quiz to Edit</title>
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
            justify-content: flex-start;
            min-height: 100vh;
        }
        div.quiz-item {
            margin: 20px;
            padding: 10px;
            background-color: #ecf0f1;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 50vw;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        h1 {
            margin-top:10vh;
            color: #2c3e50;
            font-size: 40px;
            margin-bottom: 40px;
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
    <h1>Welcome {{ $user->name ?? 'Guest' }} <br> Please Select Quiz</h1>

    @foreach($quizzes as $quiz)
        <div class="quiz-item">
            <h2>{{ $quiz->name }}</h2>
            <a href="{{ route('admin.editquiz', $quiz->id) }}">
                <button type="button">Edit</button>
            </a>
        </div>
    @endforeach

</body>
</html>
