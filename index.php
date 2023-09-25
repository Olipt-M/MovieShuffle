<?php
  $dsn = "mysql:host=localhost;dbname=movieshuffle";
  $db = new PDO($dsn, "root", "root");
  
  $nbMoviesPerPage = 5;
  
  if (isset($_GET["page"])) {
    $indexFirstMovieOfPage = ($_GET["page"] - 1) * $nbMoviesPerPage;
  } else {
    $indexFirstMovieOfPage = 0;
  }

  // Recherche des infos des films
  $queryMovies = $db->query("
    SELECT movies.id AS id, movies.title AS title, GROUP_CONCAT(genres.genre SEPARATOR ', ') AS genres FROM movies
    INNER JOIN movies_genres
    ON movies.id = movies_genres.movie_id
    INNER JOIN genres
    ON movies_genres.genre_id = genres.id
    GROUP BY movies.id
    LIMIT $indexFirstMovieOfPage,$nbMoviesPerPage;
  ");
  $movies = $queryMovies->fetchAll(PDO::FETCH_ASSOC);
  // echo '<pre style="color: white;">', var_dump($movies), '<pre>';

  // Recherche du nombre total de films
  $queryNbMovies = $db->query("SELECT COUNT(*) AS movies_number FROM movies;");
  $nbMoviesTotal = $queryNbMovies->fetch(PDO::FETCH_ASSOC);
  // var_dump($nbMoviesTotal);
  $nbPages = ceil($nbMoviesTotal["movies_number"] / $nbMoviesPerPage);
  
  include("templates/header.php");
?>

<main class="movies-container">
  <div class="movies-list">
    <?php foreach ($movies as $movie) { ?>
      <div class="movie-card">
        <img src="img/poster/<?= str_replace(' ', '-', strtolower($movie["title"])) ?>.jpg" alt="Affiche du film <?= $movie["title"] ?>">
        <div class="card-description">
          <h2>
            <a href="./movieDescription.php?id=<?= $movie["id"] ?>"><?= $movie["title"] ?></a>
          </h2>
          <p><?= $movie["genres"] ?></p>
        </div>
      </div>
    <?php } ?>
  </div>

  <div class="page-buttons-container">
    <?php for ($i = 0; $i < $nbPages; $i++) { 
      if ($i === 0) { ?>
        <a href="./index.php" class="page-button <?= !isset($_GET["page"]) ? "disabled" : "" ?>"><?= $i + 1 ?></a>
      <?php } else { ?>
        <a href="./index.php?page=<?= $i + 1 ?>" class="page-button <?= $_GET["page"] == $i + 1 ? "disabled" : "" ?>"><?= $i + 1 ?></a>
      <?php }
    } ?>
  </div>
</main>

<?php include("templates/footer.php"); ?>