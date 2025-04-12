<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Esperance Sportive de Tunis</title>
    <link rel="icon" href="../img/logo.png" />
    <link rel="stylesheet" href="../css/honors.css" />
    <link rel="stylesheet" href="../css/hearderfooter.css" />
  </head>

  <body>
  <?php include '../assets/header.php'; ?> 
    <div class="container">
      

      <div class="trophies-containers">
        <h1 class="score-page-title">Espérance Sportive de Tunis Honours </h1>
        <h2 class="score-subtitle">A Really Big One</h2>
        <div class="filter-container">
          
          <div class="sport-filter">
            <button class="show-all-button" id="show-all">Show All</button>
            <button class="filter-button active" data-sport="football">
              Football
            </button>
            <button class="filter-button" id="filter-button" data-sport="handball">
              Handball
            </button>
            <button class="filter-button"id="filter-button" data-sport="volleyball">
              Volleyball
            </button>
          </div>
          <div class="year-filter">
            <label for="start-year">From:</label>
            <select id="start-year"></select>
            <label for="end-year">To:</label>
            <select id="end-year"></select>
            <button id="filter-year-button">Filter</button>
          </div>
        </div>

        <div class="honours" id="honours-list"></div>
      </div>
    </div>
    <script src="../js/honor.js"></script>
    <script src="../js/nav.js"></script>
    <?php include '../assets/footer.php'; ?> 
  </body>
</html>
