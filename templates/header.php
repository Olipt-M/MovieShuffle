<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MovieShuffle</title>
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=poppins:400" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.typekit.net/oek3jfu.css?ver=1.0.4" />
  <link rel="stylesheet" href="css/main.css">
</head>

<script>
  function displaySearchBar() {
    document.querySelector(".search-input").classList.add("opened");
    document.querySelector(".close-search-icon").classList.add("opened");
    document.querySelector(".search-icon").classList.add("closed");
  }

  function closeSearchBar() {
    document.querySelector(".search-input").value = "";
    document.querySelector(".search-input").classList.remove("opened");
    document.querySelector(".close-search-icon").classList.remove("opened");
    document.querySelector(".search-icon").classList.remove("closed");
  }
</script>

<body>
  <div class="container">
    <header>
      <div class="title-bar">
        <a href="index.php" class="logo">MovieShuffle</a>
        <form class="search-bar" action="researchResults.php" method="get">
          <img src="./features/loupe.svg" alt="open search bar button" class="search-icon" onclick="displaySearchBar()">
          <img src="./features/cross.svg" alt="close search bar button" class="close-search-icon" onclick="closeSearchBar()">
          <input type="text" class="search-input" placeholder="Rechercher un film" name="search" value="<?= $_GET["search"] ?>">
        </form>
      </div>
      <hr>
    <header>
