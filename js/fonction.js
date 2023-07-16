// Pour adapter le chemin de la page OU de l'image par rapport à la page actuelle
// modifier pour le plesk ET/OU pour chacun suivant son dossier racine

function getPage() {
    let url = window.location.href;
    let page = url.split("/")[4];
    if (page == "php") {
      let php = "";
      return php;
    } else {
      let php = "php/";
      return php;
    }
  }