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
    </style>
</head>
<body>
    <h1>Edit Quiz: {{ $quiz->name }}</h1>

    @foreach ($quiz->questions as $question)
        <div class="editor">
            <div class="question">
                <h2>{{ $question->text }}</h2>
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
                    <button onclick="openEditModal('answer', {{ $answer->id }}, '{{ addslashes($answer->text) }}')">Edit Answer</button>
                </div>
            @endforeach
        </div>
    @endforeach

    <button onclick="openAddQuestionModal()" style="margin-top: 40px;">
        ➕ Add New Question
    </button>

    <!-- Edit Modal -->
    <div id="editModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); align-items:center; justify-content:center; z-index:999;">
        <div style="background:white; padding:30px; border-radius:8px; width:400px; position:relative;">
            <h2 id="modalTitle">Edit</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="text" id="editInput" style="width:100%; padding:10px; margin-top:15px;" required>
                <div style="margin-top:20px; display:flex; justify-content:space-between;">
                    <button type="submit" style="padding:10px 20px;">Save</button>
                    <button type="button" onclick="closeModal()" style="padding:10px 20px; background:red;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Question Modal -->
    <div id="addQuestionModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); align-items:center; justify-content:center; z-index:999;">
        <div style="background:white; padding:30px; border-radius:8px; width:400px; position:relative;">
            <h2>Add New Question</h2>
            <form method="POST" action="{{ url('/admin/add-question-with-answers') }}">
                @csrf
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                <label for="questionText">Question Text:</label>
                <input type="text" name="text" id="questionText" required style="width:100%; padding:10px; margin-top:10px;">

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

                <div style="margin-top:20px; display:flex; justify-content:space-between;">
                    <button type="submit" style="padding:10px 20px;">Add Question</button>
                    <button type="button" onclick="closeAddQuestionModal()" style="padding:10px 20px; background:red;">Cancel</button>
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

            // Use Laravel route helper embedded in JS
            if (type === 'question') {
                form.action = `{{ url('/admin/edit-question') }}/${id}`;
            } else if (type === 'answer') {
                form.action = `{{ url('/admin/edit-answer') }}/${id}`;
            }

            modal.style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
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
