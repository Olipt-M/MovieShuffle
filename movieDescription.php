<?php
  $find = false;
  $data = array("name" => "Film introuvable");
  if (isset($_GET["id"])) {
    $movies = json_decode(file_get_contents("movies.json"), true);

    foreach ($movies as $movie) {
      if ($movie["id"] == $_GET["id"]) {
        $find = true;
        $data = $movie;
      }
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

    <p><?= implode(', ', $data["genres"]) ?></p>
    <p><?= date("G\hi", mktime(0, $data["duration"])) ?> - <?= date("d/m/Y", strtotime($data["releaseDate"])) ?></p>

    <a href="<?= $data["video"] ?>" target="_blank">Bande-annonce</a>
  </div>
</main>

<?php include("templates/footer.php"); ?>