// document.addEventListener('DOMContentLoaded', () => {
    let id = window.location.href.split('=');
    fetch('recherche.php?id=' + id[1]).then(response => {
        return response.json();
    }).then(data => {
        let main = document.getElementById("mainDetail");
        main.setAttribute("class", "mainDetail")
        let detail = document.createElement("div");
        let img = document.createElement("img");
        let infos = document.createElement("div");
        let textInfos= document.createElement("div");
        let cat = document.createElement("h2");
        cat.className="titreDetail";
        cat.innerHTML = data.titreCat + "/" + data.titreSousCat;
        let titrePrix = document.createElement("div");
        titrePrix.setAttribute("id", "titrePrix");
        let titre = document.createElement("h1");
        titre.className="nomDetail";
        titre.textContent = data.titreArt;
        let prix = document.createElement("p");
        prix.className="prixDetail";
        prix.textContent = data.prix + "€";
        let description = document.createElement("p");
        description.className="descripDetail";
        description.textContent = data.description;
        let form = document.createElement("form");
        form.method = "POST";
        let button = document.createElement("button");
        button.setAttribute("id", "ajouterPanier");
        button.setAttribute("name", "ajouterPanier");
        button.setAttribute("value", data.idArt);
        button.textContent = "Ajouter au panier ";
        detail.setAttribute("id", "detail");
        infos.setAttribute("id", "infos");
        textInfos.setAttribute("id", "textInfos");
        img.setAttribute("src", data.imgArt);
        main.append(detail);
        detail.append(img);
        detail.append(infos);
        textInfos.append(cat);
        titrePrix.append(titre);
        titrePrix.append(prix);
        textInfos.append(titrePrix)
        textInfos.append(description);
        form.append(button);
        infos.append(textInfos);
        infos.append(form);

    }).catch(err => {
        console.log(err)
    });