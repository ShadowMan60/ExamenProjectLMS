<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $quiz->name }} - Question</title>
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
            min-height: 80vh;
        }
        h1 {
            color: #2c3e50;
            font-size: 32px;
            margin-bottom: 30px;
        }
        img {
            max-width: 200px;
            max-height: 200px;
            margin-bottom: 20px;
            border-radius: 8px;
            object-fit: contain;
        }
        div {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        button.answer-btn {
            margin: 10px 0;
            padding: 15px 25px;
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            width: 300px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button.answer-btn:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>
    <h1 id="question-text">{{ $quiz->questions[0]->text }}</h1>

    @if ($quiz->questions[0]->image)
        <img id="question-image" src="{{ asset('storage/' . $quiz->questions[0]->image) }}" alt="Question Image" />
    @else
        <img id="question-image" style="display:none;" />
    @endif

    <div id="answers-container">
        @foreach ($quiz->questions[0]->answers as $answer)
            <button class="answer-btn" data-index="{{ $loop->index }}">{{ $answer->text }}</button>
        @endforeach
    </div>

    <script>
        const quiz = @json($quiz);
        let currentQuestionIndex = 0;
        const userAnswers = [];

        const questionTextEl = document.getElementById('question-text');
        const questionImageEl = document.getElementById('question-image');
        const answersContainer = document.getElementById('answers-container');

        function loadQuestion(index) {
            const question = quiz.questions[index];
            questionTextEl.textContent = question.text;

            if (question.image) {
                questionImageEl.src = `/storage/${question.image}`;
                questionImageEl.style.display = 'block';
            } else {
                questionImageEl.style.display = 'none';
            }

            answersContainer.innerHTML = '';

            question.answers.forEach((answer, idx) => {
                const btn = document.createElement('button');
                btn.textContent = answer.text;
                btn.classList.add('answer-btn');
                btn.dataset.index = idx;
                btn.onclick = () => selectAnswer(idx);
                answersContainer.appendChild(btn);
            });
        }

        function selectAnswer(answerIndex) {
            userAnswers[currentQuestionIndex] = answerIndex;

            currentQuestionIndex++;

            if (currentQuestionIndex >= quiz.questions.length) {
                const answersParam = encodeURIComponent(JSON.stringify(userAnswers));
                window.location.href = "{{ url('results/' . $quiz->id) }}?answers=" + answersParam;
            } else {
                loadQuestion(currentQuestionIndex);
            }
        }

        loadQuestion(0);
    </script>
</body>
</html>
