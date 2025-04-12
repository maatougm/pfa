<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Espérance Sportive de Tunis</title>
    <link rel="icon" href="../img/logo.png" />
    <link rel="stylesheet" href="../css/score.css" />
    <link rel="stylesheet" href="../css/hearderfooter.css" />
  </head>
  <body>
  <?php include '../assets/header.php'; ?> 
    <main>
      <div class="score-container">
        <h1 class="score-page-title">Espérance Sportive de Tunis - Scores</h1>
        <p class="score-subtitle">Latest Match Results</p>

        <div class="score-filter-container">
          <div class="score-sport-filter">
            <button class="score-filter-button active" data-sport="all">
              All Sports
            </button>
            <button class="score-filter-button" data-sport="football">
              Football
            </button>
            <button class="score-filter-button" data-sport="handball">
              Handball
            </button>
            <button class="score-filter-button" data-sport="volleyball">
              Volleyball
            </button>
          </div>
        </div>

        <div class="score-results" id="score-results-list"></div>
      </div>
    </main>
    <script src="..js/nav.js"></script>
    
    <?php include '../assets/footer.php'; ?> 
    <script src="../js/score.js"></script>
  </body>
</html>
