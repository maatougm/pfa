
let playersData = [];

async function loadPlayers() {
  try {
    const response = await fetch('../php/get_players.php');
    playersData = await response.json();
    displayPlayers(playersData);
    filterPlayers("all");
  } catch (error) {
    console.error("Erreur de chargement :", error);
    document.getElementById("player-players-list").innerHTML = "<p>❌ Erreur de chargement des joueurs</p>";
  }
}

function displayPlayers(players) {
  const playersList = document.getElementById("player-players-list");
  playersList.innerHTML = "";

  const baseURL = window.location.origin + "/1/"; // Ensure /1/ is your root folder

  players.forEach(player => {
    const card = document.createElement("div");
    card.className = "player-player-card";

    const img = document.createElement("img");
    img.classList.add("player-player-image");
    img.src = baseURL + player.image_url; // Fixed: full URL
    img.alt = `${player.name} Profile Picture`;

    const name = document.createElement("h3");
    name.classList.add("player-player-name");
    name.textContent = player.name;

    const position = document.createElement("p");
    position.classList.add("player-player-position");
    position.textContent = player.position;

    const details = document.createElement("div");
    details.classList.add("player-player-details");
    details.innerHTML = `
      <p><strong>Number:</strong> ${player.number}</p>
      <p><strong>Nationality:</strong> ${player.nationality}</p>
    `;

    card.appendChild(img);
    card.appendChild(name);
    card.appendChild(position);
    card.appendChild(details);
    playersList.appendChild(card);
  });
}

function filterPlayers(sport) {
  const filtered = sport === "all"
    ? playersData
    : playersData.filter(p => p.sport === sport);
  displayPlayers(filtered);
}

const sportButtons = document.querySelectorAll(".player-filter-button");
sportButtons.forEach(button => {
  button.addEventListener("click", () => {
    sportButtons.forEach(b => b.classList.remove("active"));
    button.classList.add("active");
    filterPlayers(button.dataset.sport);
  });
});

loadPlayers();
