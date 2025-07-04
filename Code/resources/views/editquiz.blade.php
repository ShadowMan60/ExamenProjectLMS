<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Quiz: {{ $quiz->name }}</title>
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
        }
        h1 {
            margin-top: 10vh;
            color: #2c3e50;
            font-size: 40px;
        }
        div.editor {
            margin: 20px;
            padding: 10px;
            background-color: #ecf0f1;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 50vw;
            display: flex;
            flex-direction: column;
        }
        div.answer, div.question {
            width: 45vw;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px;
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
        img {
            max-height: 100px;
            max-width: 100px;
            margin-bottom: 10px;
            border-radius: 5px;
            object-fit: contain;
        }
        label {
            display: block;
            margin-top: 10px;
            text-align: left;
        }
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
        }
        .modal-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <h1>Edit Quiz: {{ $quiz->name }}</h1>

    @foreach ($quiz->questions as $question)
        <div class="editor">
            <div class="question">
                <h2>{{ $question->text }}</h2>

                @if ($question->image)
                    <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" />
                @endif

                <button onclick="openEditModal('question', {{ $question->id }}, '{{ addslashes($question->text) }}')">Edit Question</button>
                <form method="POST" action="{{ url('/admin/delete-question/' . $question->id) }}" onsubmit="return confirm('Are you sure you want to delete this question?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:#e74c3c;">Delete Question</button>
                </form>
            </div>

            @foreach ($question->answers as $answer)
                <div class="answer">
                    <p>{{ $answer->text }}</p>
                </div>
            @endforeach

            <button onclick='openEditAnswersModal({{ $question->id }}, @json($question->answers))'>
                Edit Answers
            </button>
        </div>
    @endforeach

    <button onclick="openAddQuestionModal()" style="margin-top: 40px;">
        ➕ Add New Question
    </button>

    <div id="editModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); align-items:center; justify-content:center; z-index:999;">
        <div style="background:white; padding:30px; border-radius:8px; width:400px; position:relative;">
            <h2 id="modalTitle">Edit</h2>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label for="editInput">Question Text:</label>
                <input type="text" name="text" id="editInput" required>

                <label for="editImage">Replace Image (optional):</label>
                <input type="file" name="image" id="editImage" accept="image/*">

                <div class="modal-buttons">
                    <button type="submit">Save</button>
                    <button type="button" onclick="closeModal()" style="background:red;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editAnswersModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); align-items:center; justify-content:center; z-index:999;">
        <div style="background:white; padding:30px; border-radius:8px; width:400px;">
            <h2>Edit Answers</h2>
            <form method="POST" id="editAnswersForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="question_id" id="answersQuestionId">

                <label for="answerA">Answer A:</label>
                <input type="text" name="answers[0][text]" id="answerA" required>
                <input type="radio" name="correct_answer" value="0" id="correct0"> Correct

                <label for="answerB">Answer B:</label>
                <input type="text" name="answers[1][text]" id="answerB" required>
                <input type="radio" name="correct_answer" value="1" id="correct1"> Correct

                <label for="answerC">Answer C:</label>
                <input type="text" name="answers[2][text]" id="answerC" required>
                <input type="radio" name="correct_answer" value="2" id="correct2"> Correct

                <div class="modal-buttons">
                    <button type="submit">Save</button>
                    <button type="button" onclick="closeEditAnswersModal()" style="background:red;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div id="addQuestionModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); align-items:center; justify-content:center; z-index:999;">
        <div style="background:white; padding:30px; border-radius:8px; width:400px; position:relative;">
            <h2>Add New Question</h2>
            <form method="POST" action="{{ url('/admin/add-question-with-answers') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                <label for="questionText">Question Text:</label>
                <input type="text" name="text" id="questionText" required>

                <label for="image">Image (optional):</label>
                <input type="file" name="image" accept="image/*">

                <label>Answers:</label>
                <div>
                    <input type="text" name="answers[0][text]" placeholder="Answer A" required>
                    <input type="radio" name="correct_answer" value="0" required> Correct
                </div>
                <div>
                    <input type="text" name="answers[1][text]" placeholder="Answer B" required>
                    <input type="radio" name="correct_answer" value="1"> Correct
                </div>
                <div>
                    <input type="text" name="answers[2][text]" placeholder="Answer C" required>
                    <input type="radio" name="correct_answer" value="2"> Correct
                </div>

                <div class="modal-buttons">
                    <button type="submit">Add Question</button>
                    <button type="button" onclick="closeAddQuestionModal()" style="background:red;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(type, id, text) {
            const modal = document.getElementById('editModal');
            const input = document.getElementById('editInput');
            const form = document.getElementById('editForm');
            const title = document.getElementById('modalTitle');

            input.value = text;
            title.textContent = `Edit ${type}`;

            if (type === 'question') {
                form.action = `{{ url('/admin/edit-question') }}/${id}`;
            }

            modal.style.display = 'flex';
        }

        function openEditAnswersModal(questionId, answers) {
            const modal = document.getElementById('editAnswersModal');
            const form = document.getElementById('editAnswersForm');

            modal.style.display = 'flex';
            document.getElementById('answersQuestionId').value = questionId;

            document.getElementById('answerA').value = answers[0]?.text || '';
            document.getElementById('answerB').value = answers[1]?.text || '';
            document.getElementById('answerC').value = answers[2]?.text || '';

            ['correct0', 'correct1', 'correct2'].forEach(id => {
                document.getElementById(id).checked = false;
            });

            answers.forEach((ans, index) => {
                if (ans.correct == 1 || ans.correct === true || ans.correct === '1') {
                    document.getElementById(`correct${index}`).checked = true;
                }
            });

            form.action = `/admin/edit-answers/${questionId}`;
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function closeEditAnswersModal() {
            document.getElementById('editAnswersModal').style.display = 'none';
        }

        function openAddQuestionModal() {
            document.getElementById('addQuestionModal').style.display = 'flex';
        }

        function closeAddQuestionModal() {
            document.getElementById('addQuestionModal').style.display = 'none';
        }
    </script>
</body>
</html>
