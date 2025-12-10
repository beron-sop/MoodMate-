console.log("SCRIPT LOADED OK!");

document.addEventListener('DOMContentLoaded', () => {
    const moodButtons = document.querySelectorAll('.mood-btn');
    const quoteArea = document.getElementById('quote-area');
    const quoteText = document.getElementById('quote-text');
    const quoteAuthor = document.getElementById('quote-author');
    const anotherBtn = document.getElementById('another');
    const shareBtn = document.getElementById('share');
    const saveForm = document.getElementById('saveForm');
    const noteInput = document.getElementById('note');

    let currentMood = "";

    // Fetch quote from PHP
    function fetchQuote(mood) {
        return fetch('get_quote.php?mood=' + encodeURIComponent(mood))
            .then(res => res.json())
            .then(data => {
                quoteText.textContent = data.quote;
                quoteAuthor.textContent = data.author ? "— " + data.author : "";
            })
            .catch(err => {
                quoteText.textContent = "Something went wrong. Try again.";
                quoteAuthor.textContent = "";
            });
    }

    // When emoji buttons are clicked
    moodButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            currentMood = btn.dataset.mood; // reads data-mood
            noteInput.value = ""; // reset note

            fetchQuote(currentMood).then(() => {
                quoteArea.classList.remove('hidden');
                document.getElementById('quote-area').scrollIntoView({ behavior: "smooth" });
            });
        });
    });

    // Save mood + note
    saveForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const note = noteInput.value.trim();

        const body = new URLSearchParams();
        body.append('mood', currentMood);
        body.append('note', note);

        fetch('save_mood.php', {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: body.toString()
        })
        .then(r => r.json())
        .then(resp => {
            if (resp.status === "ok") {
                const btn = document.getElementById('saveMood');
                btn.textContent = "Saved!";
                setTimeout(() => btn.textContent = "Save Mood", 1500);
            } else {
                alert("Unable to save mood.");
            }
        });
    });

    // Another quote
    anotherBtn.addEventListener('click', () => {
        if (currentMood) {
            fetchQuote(currentMood);
        }
    });

    // Share quote (copy to clipboard)
    shareBtn.addEventListener('click', () => {
        const text = quoteText.textContent + " " + quoteAuthor.textContent;

        navigator.clipboard.writeText(text)
            .then(() => alert("Quote copied to clipboard!"))
            .catch(() => alert("Unable to copy quote."));
    });
});
