<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    aaaaa <br>    
<a href="logout.php">Logout</a>

<?php
require_once 'model/DAO/classes/connection.php';
require_once 'model/DAO/classes/gamematch.php';
require_once 'model/DAO/gamematchDAO.php';


// READ DATABASE
try {
    $conn = Connection::getConnection();

    // SQL queries
    $sql_matches = "SELECT id, name FROM matches";
    $sql_qrs = "SELECT id, uuid FROM qrs";
    $sql_questions = "SELECT id, question, answers, qr_id, team_id, hint FROM questions";
    $sql_teams = "SELECT id, name, secret, match_id FROM teams";

    //Fetch
    $stmt_matches = $conn->prepare($sql_matches);
    $stmt_matches->execute();
    $matches = $stmt_matches->fetchAll(PDO::FETCH_ASSOC);

    $stmt_qrs = $conn->prepare($sql_qrs);
    $stmt_qrs->execute();
    $qrs = $stmt_qrs->fetchAll(PDO::FETCH_ASSOC);

    $stmt_questions = $conn->prepare($sql_questions);
    $stmt_questions->execute();
    $questions = $stmt_questions->fetchAll(PDO::FETCH_ASSOC);

    $stmt_teams = $conn->prepare($sql_teams);
    $stmt_teams->execute();
    $teams = $stmt_teams->fetchAll(PDO::FETCH_ASSOC);

    // Print values (only for testing purposes)
    echo "<h2>Matches</h2>";
    foreach ($matches as $match) {
        echo "ID: " . $match['id'] . ", Name: " . $match['name'] . "<br>";
    }

    echo "<h2>QRs</h2>";
    foreach ($qrs as $qr) {
        echo "ID: " . $qr['id'] . ", UUID: " . $qr['uuid'] . "<br>";
    }

    echo "<h2>Questions</h2>";
    foreach ($questions as $question) {
        echo "ID: " . $question['id'] . ", Question: " . $question['question'] . "<br>" . ", Answers: " . $question['answer'] . "<br>" . ", QR id: " . $question['qr_id'] . "<br>" . ", Team ID: " . $question['team_id'] . "<br>" . ", Hint: " . $question['hint'] . "<br>";
    }

    echo "<h2>Teams</h2>";
    foreach ($teams as $teams) {
        echo "ID: " . $team['id'] . ", Name: " . $team['name'] . "<br>" . ", Secret: " . $team['secret'] . "<br>" . ", Match ID: " . $team['match_id'] . "<br>";
    }

} catch (PDOException $e) {
    // Handle database connection errors
    echo "Error: " . $e->getMessage();
}


// CREATE GAMEMATCH
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_match'])) {
    $gameMatchName = $_POST['match_name'];
    $gameMatchDAO = new GameMatchDAO();
    $gameMatch = new GameMatch(null, $gameMatchName);
    $gameMatchDAO->createGameMatch($gameMatch);
    header("Location: admin.php");
    exit();
}



?>

<!-- insert values in database, only for testing purposes 
<br>
<h1> Insert area </h1>
<form action="insert.php" method="post">
    <label for="match_name">Match Name:</label>
    <input type="text" id="match_name" name="match_name" required>
    <button type="submit">Add Match</button>
</form>

<form action="insert.php" method="post">
    <label for="uuid">UUID:</label>
    <input type="text" id="uuid" name="uuid" required>
    <button type="submit">Add QR</button>
</form>

<form action="insert.php" method="post">
    <label for="question">Question:</label>
    <input type="text" id="question" name="question" required>
    <label for="answers">Answers:</label>
    <input type="text" id="answers" name="answers" required>
    <label for="qr_id">QR ID:</label>
    <input type="number" id="qr_id" name="qr_id" required>
    <label for="team_id">Team ID:</label>
    <input type="number" id="team_id" name="team_id" required>
    <label for="hint">Hint:</label>
    <input type="text" id="hint" name="hint">
    <button type="submit">Add Question</button>
</form>

<form action="insert.php" method="post">
    <label for="team_name">Team Name:</label>
    <input type="text" id="team_name" name="team_name" required>
    <label for="secret">Secret:</label>
    <input type="text" id="secret" name="secret" required>
    <label for="match_id">Match ID:</label>
    <input type="number" id="match_id" name="match_id" required>
    <button type="submit">Add Team</button>
</form>
-->

<h2>Create a Match</h2>
    <form method="post" action="POST">
        <label for="match_name">Match Name:</label>
        <input type="text" id="match_name" name="match_name">
        <button type="submit" name="create_match">Create Match</button>
    </form>



</body>
</html>