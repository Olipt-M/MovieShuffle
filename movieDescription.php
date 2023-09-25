<?php
  $find = false;
  $data = array("name" => "Film introuvable");
  if (isset($_GET["id"])) {
    $id = trim(strip_tags($_GET["id"]));
    $dsn = "mysql:host=localhost;dbname=movieshuffle";
    $db = new PDO($dsn, "root", "root");

    $query = $db->prepare("
      SELECT
        movies.id AS id,
        movies.title AS title,
        movies.description AS description,
        movies.releaseDate AS releaseDate,
        movies.duration AS duration,
        movies.video AS video,
        GROUP_CONCAT(genres.genre SEPARATOR ', ') AS genres
      FROM movies
      INNER JOIN movies_genres
      ON movies.id = movies_genres.movie_id
      INNER JOIN genres
      ON movies_genres.genre_id = genres.id
      WHERE movies.id = :id
      GROUP BY movies.id
    ");
    $query->bindParam(":id", $id, PDO::PARAM_INT);
    $query->execute();
    // var_dump($query->errorInfo());
    $movie = $query->fetch();
    // var_dump($movie);

    if ($movie) {
      $find = true;
      $data = $movie;
    }
  }

  include("templates/header.php");
?>

<main class="movie-container">
  <div class="poster-container">
    <img src="img/poster/<?= str_replace(' ', '-', strtolower($data["title"])) ?>.jpg" alt="Affiche du film <?= $data["title"] ?>">
  </div>
  
  <div class="description-container">
    <p><?= date("Y", strtotime($data["releaseDate"])) ?></p>

    <h1><?= $data["title"] ?></h1>

    <p><?= $data["description"] ?></p>

    <p><?= $data["genres"] ?></p>
    <p><?= date("G\hi", mktime(0, $data["duration"])) ?> - <?= date("d/m/Y", strtotime($data["releaseDate"])) ?></p>

    <a href="<?= $data["video"] ?>" target="_blank">Bande-annonce</a>
  </div>
</main>

<?php include("templates/footer.php"); ?>