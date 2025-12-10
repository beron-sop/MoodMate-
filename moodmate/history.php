<?php
require "db.php";

$result = $conn->query("SELECT * FROM moods ORDER BY created_at DESC");

// assign colors per mood
function moodColor($m) {
    return [
        "happy" => "#FFE79A",
        "sad" => "#A7D0FF",
        "calm" => "#C7F5D0",
        "angry" => "#F7B5B5",
        "tired" => "#D7C6E6",
        "empty" => "#E5E5E5"
    ][$m] ?? "#e7f1ff";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mood History — MoodMate</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* Make the history layout centered */
        .history-list {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 22px; /* spacing between cards */
            margin-top: 25px;
        }

        /* Override card width for history */
        .history-list .quote-card {
            width: 70%;
            max-width: 600px;
            text-align: left;
        }
    </style>
</head>
<body>

<nav class="nav">
    <div class="logo">MoodMate</div>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="history.php">Mood History</a>
    </div>
</nav>

<main class="main">
    <h1 class="headline">Your Mood History</h1>

    <?php if ($result->num_rows === 0): ?>
        <p>No moods recorded yet.</p>
    <?php else: ?>

        <div class="history-list">

        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="history-card"
                 style="background: <?= moodColor($row['mood']) ?>;">
                 
                <p><strong>Mood:</strong> <?= htmlspecialchars($row['mood']) ?></p>

                <?php if (!empty($row['note'])): ?>
                    <p><strong>Note:</strong> <?= nl2br(htmlspecialchars($row['note'])) ?>
                    </p>
                <?php endif; ?>

                <p style="opacity:0.6; font-size:14px; margin-top:10px;">
                    <?= $row['created_at'] ?>
                </p>

            </div>
        <?php endwhile; ?>

        </div>

    <?php endif; ?>
</main>

</body>
</html>
