<?php
  $search = "%" . trim(strip_tags($_GET["search"])) . "%";

  $dsn = "mysql:host=localhost;dbname=movieshuffle";
  $db = new PDO($dsn, "root", "root");

  $query = $db->prepare("
    SELECT
      movies.id AS id,
      movies.title AS title,
      movies.description AS description,
      GROUP_CONCAT(genres.genre SEPARATOR ', ') AS genres
    FROM movies
    INNER JOIN movies_genres
    ON movies.id = movies_genres.movie_id
    INNER JOIN genres
    ON movies_genres.genre_id = genres.id
    WHERE movies.title LIKE :search
    GROUP BY movies.id
  ");
  $query->bindParam(":search", $search);
  
  $query->execute();

  $movies = $query->fetchAll(PDO::FETCH_ASSOC);
  // var_dump($movies);

  include("templates/header.php");
?>

<main class="search-container">
  <?php if (count($movies) === 0) { ?>
    <h1>Aucun film pour votre recherche</h1>
  <?php } else { ?>
    <h1><?= count($movies) ?> films pour votre recherche</h1>
  <?php } ?>

  <?php foreach ($movies as $movie) { ?>
    <div class="search-card">
      <div class="search-poster">
        <img src="img/poster/<?= str_replace(' ', '-', strtolower($movie["title"])) ?>.jpg" alt="Affiche du film <?= $movie["title"] ?>">
      </div>
      <div class="search-description">
        <h2>
          <a href="./movieDescription.php?id=<?= $movie["id"] ?>"><?= $movie["title"] ?></a>
        </h2>
        <p class="search-genres"><?= $movie["genres"] ?></p>
        <p class="search-description"><?= implode(' ', array_splice(explode(' ', $movie["description"]), 0, 20)) . "..." ?></p>
      </div>
    </div>
  <?php } ?>
</main>

<?php include("templates/footer.php"); ?>