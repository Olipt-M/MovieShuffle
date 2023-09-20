<?php
  $dsn = "mysql:host=localhost;dbname=movieshuffle";
  $db = new PDO($dsn, "root", "root");
  $query = $db->query("
    SELECT movies.id AS id, movies.title AS title, GROUP_CONCAT(genres.genre SEPARATOR ', ') AS genres FROM movies
    INNER JOIN movies_genres
    ON movies.id = movies_genres.movie_id
    INNER JOIN genres
    ON movies_genres.genre_id = genres.id
    GROUP BY movies.id
  ");
  $movies = $query->fetchAll(PDO::FETCH_ASSOC);
  // var_dump($movies);
  
  include("templates/header.php");
?>

<main class="movies-container">
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
</main>

<?php include("templates/footer.php"); ?>