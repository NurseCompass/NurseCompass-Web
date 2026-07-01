<!DOCTYPE html>
<html>

<head>
    <title>Quiz Results</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding: 50px;
        }

        .score {
            font-size: 2em;
            font-weight: bold;
            color: #2ecc71;
        }
    </style>
</head>

<body>
    <h1>Quiz Completed!</h1>

    <p>Your Score for Academic Performance:</p>
    <div class="score">
        {{ $score }} / {{ $totalQuestions }}
    </div>

    <br>
    <a href="/dashboard">Return to Dashboard</a>
</body>

</html>