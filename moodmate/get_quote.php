<?php
header('Content-Type: application/json');

$mood = $_GET['mood'] ?? "";

$quotes = [

    "angry" => [
        ["quote" => "For every minute you remain angry, you lose sixty seconds of peace.", "author" => "Ralph Waldo Emerson"],
        ["quote" => "Speak when you are angry and you will make the best speech you will ever regret.", "author" => "Ambrose Bierce"],
        ["quote" => "Anger is an acid that can do more harm to the vessel in which it is stored than to anything on which it is poured.", "author" => "Mark Twain"]
    ],

    "calm" => [
        ["quote" => "Peace begins with a smile.", "author" => "Mother Teresa"],
        ["quote" => "Feelings pass like clouds in a windy sky.", "author" => "Thich Nhat Hanh"],
        ["quote" => "The true strength of a man is in calmness.", "author" => "Leo Tolstoy"],
        ["quote" => "Gentleness is strength under control. It is the ability to stay calm, no matter what happens.", "author" => "Elizabeth George"],
        ["quote" => "Within you, there is a stillness and a sanctuary to which you can retreat at any time and be yourself.", "author" => "Hermann Hesse"]
    ],

    "sad" => [
        ["quote" => "Even the darkest night will end and the sun will rise.", "author" => "Victor Hugo"],
        ["quote" => "Tears are words the heart can't express.", "author" => "Unknown"],
        ["quote" => "Depression is melancholy minus its charms.", "author" => "Susan Sontag"],
        ["quote" => "You don’t think in depression … that veil of happiness is taken away, and now you’re seeing truly.", "author" => "Andrew Solomon"],
        ["quote" => "The mere sense of living is joy enough.", "author" => "Emily Dickinson"]
    ],

    "happy" => [
        ["quote" => "Happiness is a journey, not a destination.", "author" => "Buddha"],
        ["quote" => "The purpose of our lives is to be happy.", "author" => "Dalai Lama"],
        ["quote" => "If you want to be happy, be.", "author" => "Leo Tolstoy"],
        ["quote" => "Nothing can bring you happiness but yourself.", "author" => "Ralph Waldo Emerson"],
        ["quote" => "Try to be a rainbow in someone else’s cloud.", "author" => "Maya Angelou"]
    ],

    "tired" => [
        ["quote" => "Rest is not something you earn. It is something you need.", "author" => "Unknown"],
        ["quote" => "When your body says ‘enough,’ listen the first time.", "author" => "Unknown"],
        ["quote" => "What lies behind us and what lies before us are tiny matters compared to what lies within us.", "author" => "Ralph Waldo Emerson"]
    ],

    "empty" => [
        ["quote" => "Emptiness is the starting point. In order to taste my cup of water you must first empty your cup.", "author" => "Bruce Lee"],
        ["quote" => "Empty your mind … be like water.", "author" => "Bruce Lee"],
        ["quote" => "The greatest tragedy in life is not death, but a life without purpose.", "author" => "Myles Munroe"]
    ],
];

// fallback if mood doesn't exist
if (!isset($quotes[$mood])) {
    echo json_encode(["quote" => "Breathe. You are stronger than you think.", "author" => ""]);
    exit;
}

// choose random
$pick = $quotes[$mood][array_rand($quotes[$mood])];

echo json_encode($pick);
