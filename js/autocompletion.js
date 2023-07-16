const search = document.getElementById("search-bar");
const result = document.getElementById("result");
if (search) {
  //on choisi de travailler avec le keyup car le keydown a un tour de retard comparé au keyup
  search.addEventListener("keyup", () => {
    result.innerHTML = "";
    if (search.value != "") {
      fetch(`./${getPage()}autocompletion.php/?search=` + search.value) //on recherche avec la value de ce qui a été rentré
        .then((response) => {
          return response.json();
        })
        .then((data) => {
          data.forEach((element) => {
            let e = document.createElement("p"); // on affiche les resultat dans des balises "p"
            // on stock l'id pour pouvoir cliquer dessus et aller vers la page detail de l'article
            e.innerHTML =
              `<a href= "./${getPage()}detail.php?article_id=` +
              element.idArt +
              `">` +
              element.titreArt;
            result.appendChild(e);
          });
        });
    }
  });
}

const link = window.location.href;
const id = link.split("="); //sa split en deux une chaine de caractere au niveau du "="
fetch(`./${getPage()}autocompletion.php/?id=` + id[1]) // on prend la 2eme partie du split donc l'id
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    data.forEach((element) => {
      let e = document.createElement("p");
      e.innerHTML = "Nom: " + element.titreArt + "</br>";
      result.appendChild(e);
    });
  });
