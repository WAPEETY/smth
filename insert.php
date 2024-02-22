<?php

//TEMP TEST

require_once './model/DAO/classes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn = Connection::getConnection();

        if (isset($_POST['match_name'])) {
            $match_name = $_POST['match_name'];
            $sql = "INSERT INTO matches (name) VALUES (:name)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $match_name);
            $stmt->execute();
        } elseif (isset($_POST['uuid'])) {
            $uuid = $_POST['uuid'];
            $sql = "INSERT INTO qrs (uuid) VALUES (:uuid)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':uuid', $uuid);
            $stmt->execute();
        } elseif (isset($_POST['question'])) {
            $question = $_POST['question'];
            $answers = $_POST['answers'];
            $qr_id = $_POST['qr_id'];
            $team_id = $_POST['team_id'];
            $hint = $_POST['hint'];
            $sql = "INSERT INTO questions (question, answers, qr_id, team_id, hint) VALUES (:question, :answers, :qr_id, :team_id, :hint)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':question', $question);
            $stmt->bindParam(':answers', $answers);
            $stmt->bindParam(':qr_id', $qr_id);
            $stmt->bindParam(':team_id', $team_id);
            $stmt->bindParam(':hint', $hint);
            $stmt->execute();
        } elseif (isset($_POST['team_name'])) {
            $team_name = $_POST['team_name'];
            $secret = $_POST['secret'];
            $match_id = $_POST['match_id'];
            $sql = "INSERT INTO teams (name, secret, match_id) VALUES (:name, :secret, :match_id)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $team_name);
            $stmt->bindParam(':secret', $secret);
            $stmt->bindParam(':match_id', $match_id);
            $stmt->execute();
        }

        // Redirect to admin.php
        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    //  If someone tries to access the file directly without POST data
    echo "Invalid request.";
}
?>