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