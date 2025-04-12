<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Espérance Sportive de Tunis</title>
    <link rel="icon" href="../img/logo.png" />
    <link rel="stylesheet" href="../css/hearderfooter.css" />
    <link rel="stylesheet" href="../css/player.css" />
  </head>
  <body>
  <?php include '../assets/header.php'; ?> 

    <div class="player-container">
      <h1 class="player-page-title">Espérance Sportive de Tunis Academie</h1>
      <h2 class="player-subtitle">Become a Champion Join Now</h2>

      <div class="player-filter-container">
        <div class="player-sport-filter">
          <button class="player-filter-button active" data-sport="all">
            All Sports
          </button>
          <button class="player-filter-button" data-sport="football">
            Football
          </button>
          <button class="player-filter-button" data-sport="handball">
            Handball
          </button>
          <button class="player-filter-button" data-sport="volleyball">
            Volleyball
          </button>
        </div>
      </div>

      <div class="player-players" id="player-players-list"></div>
    </div>
    <script src="../js/nav.js"></script>
    <!-- footer -->
    <?php include '../assets/footer.php'; ?> 

    <script src="../js/players.js"></script>
  </body>
</html>
