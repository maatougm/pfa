<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Espérance Sportive de Tunis</title>
  <link rel="icon" href="../img/logo.png" />
  
  <link rel="stylesheet" href="../css/index.css" />
  <link rel="stylesheet" href="../css/hearderfooter.css" />
</head>

<body>
<?php include '../assets/header.php'; ?> 
  <main>
    <div class="est-hero">
      <div class="est-carousel">
        <div class="est-carousel-slide">
          <img src="../img/hand.jpg" alt="equioe hand" />
        </div>
        <div class="est-carousel-slide">
          <img src="../img/regi.jpg" alt="equipe foot" />
        </div>
        <div class="est-carousel-slide">
          <img src="../img/volly.jpg" alt="volly" />
        </div>
        <button class="est-carousel-prev" aria-label="Previous Slide">
          &lt;
        </button>
        <button class="est-carousel-next" aria-label="Next Slide">
          &gt;
        </button>
      </div>
    </div>
    <main class="main-content">
      <aside class="main-sidebar">
        <div class="main-standings">
          <h3 class="main-sidebar-title">Championship Placement</h3>
          <table class="main-standings-table" id="main-standings-table">
            <thead>
              <tr>
                <th>Pos</th>
                <th>Team</th>
                <th>Played</th>
                <th>W</th>
                <th>D</th>
                <th>L</th>
                <th>G</th>
                <th>Pts</th>

              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </aside>

      <section class="main-main-section">
        <h1>Join Us In USA</h1>
        <h2 class="subtitle">Get Your Tickets Now</h2>
        <a href="https://www.fifa.com/en/tournaments/mens/club-world-cup/usa-2025/articles/teams-dates-venue-groups-draw-matches-tickets" class="world-cup-banner" ><img src="img/wc.png" alt="worldcuplogo"></a>
        <section class="main-presidents">
          <h2 class="main-section-title">Club Presidents</h2>
          <div class="main-presidents-list">
          </div>
        </section>
      </section>
    </main>

    <script src="../js/nav.js"></script>
    <?php include '../assets/footer.php'; ?> 

    <script src="../js/index.js"></script>
    
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
</body>

</html>