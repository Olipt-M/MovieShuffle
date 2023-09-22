<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyPHPmovies</title>
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=poppins:400" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.typekit.net/oek3jfu.css?ver=1.0.4" />
  <link rel="stylesheet" href="css/main.css">
</head>

<body>
  <div class="container">
    <header>
      <div class="title-bar">
        <a href="index.php" class="logo">MyPHPmovies</a>
        <form class="search-bar" action="researchResults.php" method="get">
          <label for="search-input"><img src="./features/loupe.svg" alt="open search bar button" class="search-icon" onclick="displaySearchBar()"></label>
          <img src="./features/cross.svg" alt="close search bar button" class="close-search-icon" onclick="closeSearchBar()">
          <input type="text" class="search-input" id="search-input" placeholder="Rechercher un film" name="search" value="<?= $_GET["search"] ?>">
        </form>
      </div>
      <hr>
    <header>
