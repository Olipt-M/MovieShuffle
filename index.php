<?php
  $movies = json_decode(file_get_contents("movies.json"), true);
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
        <p><?= implode(', ', $movie["genres"]) ?></p>
      </div>
    </div>
  <?php } ?>
</main>

<?php include("templates/footer.php"); ?>