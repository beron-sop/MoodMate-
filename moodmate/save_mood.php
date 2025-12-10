<?php
require "db.php";

$mood = $_POST['mood'] ?? '';
$note = $_POST['note'] ?? '';

$stmt = $conn->prepare("INSERT INTO moods (mood, note) VALUES (?, ?)");
$stmt->bind_param("ss", $mood, $note);

if ($stmt->execute()) {
    echo json_encode(["status" => "ok"]);
} else {
    echo json_encode(["status" => "error"]);
}
?>
