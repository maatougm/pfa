
let scoresData = [];

async function loadScores() {
    try {
        const response = await fetch('../php/get_scores.php');
        scoresData = await response.json();
        console.log("Loaded scores:", scoresData);
        displayScores(scoresData);
        filterScores("all");
    } catch (error) {
        console.error("Erreur lors du chargement des scores:", error);
    }
}

function displayScores(scores) {
    const scoresList = document.getElementById("score-results-list");
    scoresList.innerHTML = "";

    scores.forEach(score => {
        const scoreCard = document.createElement("div");
        scoreCard.classList.add("score-card");

        const match = document.createElement("div");
        match.classList.add("score-match");

        const homeLogo = document.createElement("img");
        homeLogo.classList.add("score-team-logo");
        homeLogo.src = "../" + score.home_logo;
        homeLogo.alt = `${score.home_team} Logo`;
        match.appendChild(homeLogo);

        const scoreText = document.createElement("div");
        scoreText.classList.add("score-match-score");
        scoreText.textContent = `${score.home_score} - ${score.away_score}`;
        match.appendChild(scoreText);

        const awayLogo = document.createElement("img");
        awayLogo.classList.add("score-team-logo");
        awayLogo.src = "../" + score.away_logo;
        awayLogo.alt = `${score.away_team} Logo`;
        match.appendChild(awayLogo);

        scoreCard.appendChild(match);

        const matchInfo = document.createElement("div");
        matchInfo.classList.add("score-match-info");
        matchInfo.textContent = score.date;
        scoreCard.appendChild(matchInfo);

        scoresList.appendChild(scoreCard);
    });
}

function filterScores(sport) {
    const filtered = sport === "all"
        ? scoresData
        : scoresData.filter(score => score.sport === sport);
    displayScores(filtered);
}

document.querySelectorAll(".score-filter-button").forEach(button => {
    button.addEventListener("click", () => {
        document.querySelectorAll(".score-filter-button").forEach(b => b.classList.remove("active"));
        button.classList.add("active");
        filterScores(button.dataset.sport);
    });
});

loadScores();
