// recupération et affichage des menus select catégorie, dans la création de sous cat et création/modif d'article
fetch('./recherche.php?panelAdmin=1').then((res) =>
    res.json()
).then((data) => {
    data.filter(function (resultats) {
        let select = document.getElementById("categorie-select");
        let select2 = document.getElementById("categories-select");
        let option = document.createElement('option');
        let option2 = document.createElement('option');
        option.setAttribute('value', resultats.idCat);
        option.innerHTML = resultats.titreCat;
        option2.setAttribute('value', resultats.idCat);
        option2.innerHTML = resultats.titreCat;
        select.append(option);
        select2.append(option2);
    });

})
// recupération et affichage du menus select sous-catégorie dans création et modification d'articles
fetch('./recherche.php?sousCat=1').then((res) =>
    res.json()
).then((data) => {
    data.filter(function (resultats) {
        let select = document.getElementById("sousCategories-select");
        let option = document.createElement('option');
        option.setAttribute('value', resultats.id);
        option.innerHTML = resultats.titreSousCat;
        select.append(option);
    });

})
// MODIFICATION DU CAROUSEL EN HAUT DE L'INDEX
fetch('./recherche.php?carousel=1')
    .then(response => {
        return response.json();
    })
    .then(data => {
        let modifCarouselIndex = document.getElementById("modifCarouselIndex");
        let slide = document.createElement("div");
        slide.setAttribute("class", "slide");
        modifCarouselIndex.append(slide);

        data.filter(function (resultats) {
            let slides = document.createElement('div');
            slides.className = "slides";
            let displaySlide = document.createElement('div');
            displaySlide.className = "displaySlide";
            let updateSlide = document.createElement('div');
            updateSlide.className = "updateSlide";
            let h3 = document.createElement("h3");
            h3.innerText = "Slide" + resultats.id

            displaySlide.innerHTML = '<img class="imgCarousel" id="imgCarousel' + resultats.id + '" src="' + resultats.imgCarousel + '" alt=""><div class=infosSlide><h4>' + resultats.titreCarousel + '</h4><p>' + resultats.texteCarousel + '<p></div>';
            updateSlide.innerHTML = '<form><input id="inputCarousel' + resultats.id + '"  value="' + resultats.imgCarousel + '"><br><input id="titreCarousel' + resultats.id + '" value="' + resultats.titreCarousel + '"><br><input id="texteCarousel' + resultats.id + '" value="' + resultats.texteCarousel + '"><br><button class="editCar" name="editCarousel" data-idCar ="' + resultats.id + '"  id="editCarousel' + resultats.id + '"><i class="fa-regular fa-pen-to-square fa-lg"></i></button></form></br>';
            
            slides.append(displaySlide);
            slides.append(updateSlide);
            displaySlide.prepend(h3);
            slide.append(slides);
        });

        let updateCar = document.getElementsByName("editCarousel");
        for (let i = 0; i < updateCar.length; i++) {
            let id2 = updateCar[i].getAttribute('data-idCar');
            updateCar[i].addEventListener('click', () => {
                let id2 = updateCar[i].getAttribute('data-idCar');
                let imgCarousel = document.getElementById("inputCarousel" + id2);
                let titreCarousel = document.getElementById("titreCarousel" + id2);
                let texteCarousel = document.getElementById("texteCarousel" + id2);
                let img = imgCarousel.value;
                let titre = titreCarousel.value;
                let texte = texteCarousel.value;

                fetch("traitementPanel.php", {
                    method: "POST",
                    headers: {
                        'Content-type': "multipart/form-data"
                    },
                    body: JSON.stringify({
                        "imgUpdate": img,
                        "titreUpdate": titre,
                        "texteUpdate": texte,
                        "idUpdate": id2,
                        "action": "updateCarousel"
                    })
                })
                    .then(response => response.json()).then(data => window.location.reload()) // window.location.reload(), permet de voir en direct la suppression
                    .catch(error => console.log(error));
            });
        }
    })
    .catch(error => console.log(error));
//affichage des catégories avec deletion et modification
fetch('./recherche.php?panelAdmin=1').then(response => {
    return response.json();
}).then(data => {
    let categories = document.getElementById("categories");
    let cats = document.createElement("div");
    cats.setAttribute("id", "cats");
    categories.append(cats);

    data.filter(function (resultats) {
        let divCat = document.createElement('div');
        divCat.className = "divCat";
        let deleteCat = document.createElement('div');
        deleteCat.className = "deleteCat";
        let updateCat = document.createElement('div');
        updateCat.className = "updateCat";

        deleteCat.innerHTML = '<span>  <img id="imgCat" src="' + resultats.imgCat + '" alt=""><br>' + resultats.titreCat + '</span> <button class="deleteCat" name="deleteCat" data-id ="' + resultats.idCat + '" id="deleteCat' + resultats.idCat + '"><i class="fa-solid fa-trash-can fa-lg"></i></button>';
        updateCat.innerHTML = '<input id="imgCat' + resultats.idCat + '"  value="' + resultats.imgCat + '"><input id="titreCat' + resultats.idCat + '" value="' + resultats.titreCat + '"><button class="editCat" name="editCat" data-id ="' + resultats.idCat + '"  id="editCat' + resultats.idCat + '"><i class="fa-regular fa-pen-to-square fa-lg"></i></button>';

        divCat.append(deleteCat);
        divCat.append(updateCat);
        cats.append(divCat);



    })
    let submit = document.getElementsByName("deleteCat");

    for (let i = 0; i < submit.length; i++) {

        submit[i].addEventListener('click', () => {
            let id = submit[i].getAttribute('data-id');
            if (window.confirm("Voulez vous vraiment supprimer la catégorie")) {
                fetch("traitementPanel.php", {
                    method: "POST",
                    body: JSON.stringify({
                        "idDelete": id,
                        "action": "delete"
                    })
                }).then(response => response.json()).then(data => window.location.reload()) // window.location.reload(), permet de voir en direct la suppression
                    .catch(error => console.log(error));
            }
        })
    }
    let update = document.getElementsByName("editCat");
    for (let i = 0; i < update.length; i++) {
        update[i].addEventListener('click', () => {
            let id2 = update[i].getAttribute('data-id');
            let imgCat = document.getElementById("imgCat" + id2);
            let titreCat = document.getElementById("titreCat" + id2);
            let img = imgCat.value;
            let titre = titreCat.value;
            fetch("traitementPanel.php", {
                method: "POST",
                headers: {
                    'Content-type': "multipart/form-data"
                },
                body: JSON.stringify({
                    "titreUpdate": titre,
                    "imgUpdate": img,
                    "idUpdate": id2,
                    "action": "update"

                })
            }).then(response => response.json()).then(data => window.location.reload()) // window.location.reload(), permet de voir en direct la suppression
                .catch(error => console.log(error));
        })
    }

}).catch(error => console.log(error));

//affichage des sous-catégories avec deletion et modification
fetch('./recherche.php?sousCat=1').then(response => {
    return response.json();
}).then(data => {
    let categories = document.getElementById("sousCategories");
    let sousCats = document.createElement("div");
    sousCats.setAttribute("id", "sousCats");
    categories.append(sousCats);

    data.filter(function (resultats) {
        let divSousCat = document.createElement('div');
        divSousCat.className = "divSousCat";
        let deleteCat = document.createElement('div');
        deleteCat.className="deleteSousCat";
        let updateCat = document.createElement('div');
        updateCat.className="updateSousCat";

        deleteCat.innerHTML = '<span>  <img id="imgSousCat" src="' + resultats.imgSousCat + '" alt=""><br>' + resultats.titreSousCat + '</span> <button class="deleteSousCat" name="deleteSousCat" data-id ="' + resultats.id + '" id="deleteSousCat' + resultats.id + '"><i class="fa-solid fa-trash-can fa-lg"></i></button>';
        updateCat.innerHTML = '<input id="imgSousCat' + resultats.id + '"  value="' + resultats.imgSousCat + '"><input id="titreSousCat' + resultats.id + '" value="' + resultats.titreSousCat + '"><button class="editSousCat" name="editSousCat" data-id ="' + resultats.id + '"  id="editSousCat' + resultats.id + '"><i class="fa-regular fa-pen-to-square fa-lg"></i></button>';

        divSousCat.append(deleteCat);
        divSousCat.append(updateCat);
        sousCats.append(divSousCat);
    })
    let submit = document.getElementsByName("deleteSousCat");
    for (let i = 0; i < submit.length; i++) {
        submit[i].addEventListener('click', () => {
            let id = submit[i].getAttribute('data-id');
            if (window.confirm("Voulez vous vraiment supprimer la sous-catégorie")) {
                fetch("traitementPanel.php", {
                    method: "POST",
                    body: JSON.stringify({
                        "idDelete": id,
                        "action": "deleteSousCat"
                    })
                }).then(response => response.json()).then(data => window.location.reload()) // window.location.reload(), permet de voir en direct la suppression
                    .catch(error => console.log(error));
            }
        })
    }
    let update = document.getElementsByName("editSousCat");
    for (let i = 0; i < update.length; i++) {
        update[i].addEventListener('click', () => {
            let id2 = update[i].getAttribute('data-id');
            let imgSousCat = document.getElementById("imgSousCat" + id2);
            let titreSousCat = document.getElementById("titreSousCat" + id2);
            let img = imgSousCat.value;
            let titre = titreSousCat.value;
            fetch("traitementPanel.php", {
                method: "POST",
                headers: {
                    'Content-type': "multipart/form-data"
                },
                body: JSON.stringify({
                    "titreUpdate": titre,
                    "imgUpdate": img,
                    "idUpdate": id2,
                    "action": "updateSousCat"

                })
            }).then(response => response.json()).then(data => window.location.reload()) // window.location.reload(), permet de voir en direct la suppression
                .catch(error => console.log(error));
        })
    }

}).catch(error => console.log(error));



// AFFICHAGE ET MODIF ARTICLES
fetch('./recherche.php?all=1').then(response => {
    return response.json();
}).then(data => {

    let articles = document.getElementById("articles");
    let arts = document.createElement("div");
    arts.setAttribute("id", "arts");
    articles.append(arts);

    data.filter(function (resultArt) {
        let divArt = document.createElement('div');
        divArt.className="divArt";
        let deleteArt = document.createElement('div');
        deleteArt.className="deleteArt";
        let updateArt = document.createElement('div');
        updateArt.className="updateArt";

        deleteArt.innerHTML = '<img id="imgArt" src="' + resultArt.imgArt + '" alt=""><div><h4> '+ resultArt.titreArt +'</h4><p>'+ resultArt.description +'</p><p>'+ resultArt.prix + '</p><p> Quantité:' +resultArt.quantite +'</p><p>'+ resultArt.titreCat +'/'+ resultArt.titreSousCat +'</p> <button class="deleteArt" name="deleteArt" data-idArt ="' + resultArt.idArt + '" id="deleteArt' + resultArt.idArt + '"><i class="fa-solid fa-trash-can fa-lg"></i></button></div>';
        updateArt.innerHTML = '<input id="imgArt' + resultArt.idArt + '"  value="' + resultArt.imgArt + '"><input id="titreArt' + resultArt.idArt + '" value="' + resultArt.titreArt + '"><input id="description' + resultArt.idArt + '" value="' + resultArt.description + '"><input id="prixArt' + resultArt.idArt + '" value="' + resultArt.prix + '€"> <select required name="categorieArtUp" id="categorieArtUp-select' + resultArt.idArt + '" value="categorieArtUp"><option selected disabled>Catégorie</option></select><select required name="sousCatArtUp" id="sousCatArtUp-select' + resultArt.idArt + '" value="sousCatArtUp"><option selected disabled>Sous-catégorie</option></select><input id="quantiteArt' + resultArt.idArt + '"  value="Quantité: ' + resultArt.quantite + '"><input id="promoArt' + resultArt.idArt + '"  value="Promotion: ' + resultArt.promotion + '%"><button class="editArt" name="editArt" data-idArt ="' + resultArt.idArt + '"  id="editArt' + resultArt.idArt + '"><i class="fa-regular fa-pen-to-square fa-lg"></i></button>';

        divArt.append(deleteArt);
        divArt.append(updateArt);
        arts.append(divArt);


        fetch('./recherche.php?panelAdmin=1').then((res) =>
            res.json()
        ).then((data) => {
            data.filter(function (resultats) {
                let selectUpArt = document.getElementById("categorieArtUp-select" + resultArt.idArt);
                let option3 = document.createElement('option');
                option3.setAttribute('value', resultats.idCat);
                option3.innerHTML = resultats.titreCat;
                selectUpArt.append(option3);
            });

        })
        fetch('./recherche.php?sousCat=1').then((res) =>
            res.json()
        ).then((data) => {
            data.filter(function (resultats) {
                let selectUpArt = document.getElementById("sousCatArtUp-select" + resultArt.idArt);
                let option = document.createElement('option');
                option.setAttribute('value', resultats.id);
                option.innerHTML = resultats.titreSousCat;
                selectUpArt.append(option);
            });

        })
    })
    let artDeleteBtn = document.getElementsByName("deleteArt");
    for (let i = 0; i < artDeleteBtn.length; i++) {
        artDeleteBtn[i].addEventListener('click', () => {
            let id3 = artDeleteBtn[i].getAttribute('data-idArt');
            if (window.confirm("Voulez vous vraiment supprimer l'article'")) {
                fetch("traitementPanel.php", {
                    method: "POST",
                    body: JSON.stringify({
                        "idDelete": id3,
                        "action": "deleteArt"
                    })
                }).then(response => response.json()).then(data => window.location.reload()) // window.location.reload(), permet de voir en direct la suppression
                    .catch(error => console.log(error));
            }
        })
    }
    let update = document.getElementsByName("editArt");
    console.log(update)
    for (let i = 0; i < update.length; i++) {

        update[i].addEventListener('click', () => {
            let id2 = update[i].getAttribute('data-idArt');
            let imgArt = document.getElementById("imgArt" + id2);
            let titreArt = document.getElementById("titreArt" + id2);
            let descriptionArt = document.getElementById("description" + id2);
            let prixArt = document.getElementById("prixArt" + id2);
            let catArt = document.getElementById("categorieArtUp-select" + id2);
            let sousCatArt = document.getElementById("sousCatArtUp-select" + id2);
            let quantiteArt = document.getElementById("quantiteArt" + id2);
            let promoArt = document.getElementById("promoArt" + id2);
            let img = imgArt.value;
            let titre = titreArt.value;
            let description = descriptionArt.value;
            let prix = prixArt.value;
            let cat = catArt.value;
            let sousCat = sousCatArt.value;
            let promo = promoArt.value;
            let quantite = quantiteArt.value;
            let date = new Date();
            if ((sousCat != "Sous-catégorie") && (cat != "Catégorie")) {
                fetch("traitementPanel.php", {
                    method: "POST",
                    headers: {
                        'Content-type': "multipart/form-data"
                    },
                    body: JSON.stringify({
                        "titreUpdate": titre,
                        "imgUpdate": img,
                        "descriptionUpdate": description,
                        "prixUpdate": prix,
                        "catUpdate": cat,
                        "sousCatUpdate": sousCat,
                        "quantite": quantite,
                        "promoArt": promo,
                        "date": date,
                        "idUpdate": id2,
                        "action": "updateArt",

                    })
                }).then(response => response.json()).then(data => window.location.reload()) // window.location.reload(), permet de voir en direct la suppression
                    .catch(error => console.log(error));
            }
        })
    }

}).catch(error => console.log(error));