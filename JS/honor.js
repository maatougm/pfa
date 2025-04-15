
let honoursData = [];

async function loadHonours() {
    try {
        const response = await fetch('../php/get_honours.php');
        honoursData = await response.json();
        displayHonours(honoursData);
        populateYearSelects();
        filterBySport("football");
    } catch (error) {
        console.error("Erreur lors du chargement des palmarès :", error);
    }
}

function displayHonours(data) {
    const honoursList = document.getElementById("honours-list");
    honoursList.innerHTML = "";

    data.forEach(item => {
        const categoryDiv = document.createElement("div");
        categoryDiv.classList.add("trophy-category");

        const imgDiv = document.createElement("div");
        imgDiv.classList.add("trophy-img");
        const img = document.createElement("img");
        img.src = "../" + item.image_url;
        img.alt = item.category + " Trophy";
        imgDiv.appendChild(img);

        const detailsDiv = document.createElement("div");
        detailsDiv.classList.add("trophy-details");
        const title = document.createElement("h3");
        title.textContent = item.category;
        detailsDiv.appendChild(title);

        const yearsList = document.createElement("ul");
        item.years.split(",").forEach(year => {
            const yearItem = document.createElement("li");
            yearItem.innerHTML = `<span>${year.trim()}</span>`;
            yearsList.appendChild(yearItem);
        });
        detailsDiv.appendChild(yearsList);

        categoryDiv.appendChild(imgDiv);
        categoryDiv.appendChild(detailsDiv);
        honoursList.appendChild(categoryDiv);
    });
}

function populateYearSelects() {
    const startYearSelect = document.getElementById("start-year");
    const endYearSelect = document.getElementById("end-year");

    let yearsSet = new Set();
    honoursData.forEach(h => h.years.split(",").forEach(y => yearsSet.add(parseInt(y.trim()))));

    const years = Array.from(yearsSet).sort((a, b) => b - a);

    startYearSelect.innerHTML = "";
    endYearSelect.innerHTML = "";

    years.forEach(year => {
        const opt1 = new Option(year, year);
        const opt2 = new Option(year, year);
        startYearSelect.add(opt1.cloneNode(true));
        endYearSelect.add(opt2);
    });
}

function filterByYear() {
    const startYear = parseInt(document.getElementById("start-year").value);
    const endYear = parseInt(document.getElementById("end-year").value);

    const filteredData = honoursData.filter(item => {
        return item.years.split(",").some(y => {
            const year = parseInt(y.trim());
            return year >= startYear && year <= endYear;
        });
    });

    displayHonours(filteredData);
}

function filterBySport(sport) {
    const filtered = sport === "all" ? honoursData : honoursData.filter(h => h.sport === sport);
    displayHonours(filtered);
}

document.getElementById("filter-year-button").addEventListener("click", filterByYear);
document.querySelectorAll(".filter-button").forEach(button => {
    button.addEventListener("click", () => {
        document.querySelectorAll(".filter-button").forEach(b => b.classList.remove("active"));
        button.classList.add("active");
        filterBySport(button.dataset.sport);
    });
});
document.getElementById("show-all").addEventListener("click", () => {
    displayHonours(honoursData);
    document.querySelectorAll(".filter-button").forEach(b => b.classList.remove("active"));
});
loadHonours();
