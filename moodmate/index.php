<?php // index.php ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MoodMate</title>
  <link rel="stylesheet" href="css/style.css">
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
    <h1 class="headline">How are you feeling today?</h1>

    <div class="mood-row">

      <button class="mood-btn" data-mood="happy" style="background:#FFE79A;">😊 Happy</button>
      <button class="mood-btn" data-mood="sad" style="background:#A7D0FF;">😢 Sad</button>
      <button class="mood-btn" data-mood="calm" style="background:#C7F5D0;">😌 Calm</button>
      <button class="mood-btn" data-mood="angry" style="background:#F7B5B5;">😡 Angry</button>
      <button class="mood-btn" data-mood="tired" style="background:#D7C6E6;">😴 Tired</button>
      <button class="mood-btn" data-mood="empty" style="background:#E5E5E5;">😶 Empty</button>

    </div>

    <section id="quote-area" class="quote-area hidden">
      <div id="quote-card" class="quote-card">
        <p id="quote-text" class="quote-text"></p>
        <p id="quote-author" class="quote-author"></p>
      </div>

      <form id="saveForm" class="note-form">
        <label>Add a short note (optional)</label>
        <textarea id="note" name="note" rows="3" placeholder="How did this feeling come up?"></textarea>

        <div class="quote-controls">
          <button id="saveMood" type="submit" class="control-btn">Save Mood</button>
          <button id="another" type="button" class="control-btn">Show Another Quote</button>
          <button id="share" type="button" class="control-btn">Share Quote</button>
        </div>
      </form>
    </section>
  </main>
<script src="js/script.js"></script>
</body>
</html>
