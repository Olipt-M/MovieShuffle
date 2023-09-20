<?php
  $search = trim(strip_tags($_GET["search"]));

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

<main class="movies-container">
  <?php foreach ($movies as $movie) { ?>
    <div class="search-card">
      <img src="img/poster/<?= str_replace(' ', '-', strtolower($movie["title"])) ?>.jpg" alt="Affiche du film <?= $movie["title"] ?>">
      <div class="search-description">
        <h2>
          <a href="./movieDescription.php?id=<?= $movie["id"] ?>"><?= $movie["title"] ?></a>
        </h2>
        <p><?= $movie["genres"] ?></p>
        <p><?= $movie["description"] ?></p>
      </div>
    </div>
  <?php } ?>
</main>

<?php include("templates/footer.php"); ?>