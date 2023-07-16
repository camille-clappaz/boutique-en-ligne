
   // affiche le premier carousel
   fetch('./php/recherche.php?carousel=1').then(response => {
    return response.json();
  }).then(data => {
    console.log("data");
    let carouselInner = document.getElementsByClassName("carousel-inner");
    for (let i = 0; i < data.length; i++) {
      let carouselItem = document.createElement("div");
      if (i == 0) {
        carouselItem.setAttribute("class", "carousel-item active");
      } else {
        carouselItem.setAttribute("class", "carousel-item");
      }
      carouselInner[0].append(carouselItem);
      let img = document.createElement("img");
      img.setAttribute("id", "img" + i);
      img.setAttribute("class", "d-block w-75 imgCarousel");
      img.setAttribute("alt", "img" + i)
      img.src = data[i].imgCarousel;
     

      let carouselCaption = document.createElement("div");
      carouselCaption.setAttribute("class", "carousel-caption ")
      carouselItem.append(carouselCaption);

      let h5 = document.createElement("h5");
      h5.setAttribute("id", "titre" + i);
      h5.textContent = data[i].titreCarousel;
      carouselCaption.append(h5);

      let p = document.createElement("p");
      p.setAttribute("id", "texte" + i);
      p.textContent = data[i].texteCarousel;
      carouselCaption.append(p);
      carouselItem.append(img);
    }
  }).catch(error => console.log(error));

// AFFICHE LE SECOND CAROUSEL
  fetch('./php/recherche.php?all=1').then(response => {
    return response.json();
  }).then(data => {
    let nouveautes= document.querySelector('.nouveautes')
    data.filter(function(resultats) {
      let articles = document.createElement("div");
      articles.setAttribute("class", "scroll_card");
      let img = document.createElement('img');
      img.className="imgArticles";
      let a = document.createElement("a");
      let nouveaute = document.createElement("p");
      nouveaute.setAttribute("class", "nouveaute");
      let date = new Date();
      let dateArt = new Date(resultats.date)
      let month = date.getMonth();
      date.setMonth(month - 2);
      console.log(dateArt);
      console.log(resultats.date)
      for (let i = 0; i < 10; i++) {if (dateArt > date) {
        a.setAttribute("href", "php/detail.php?article_id=" + resultats.idArt);
        img.src = resultats.imgArt;
        a.append(img);
        
          nouveaute.textContent = "Nouveauté";
          articles.append(nouveaute);
          articles.append(a);
          nouveautes.append(articles);
        
      }
      }
      
    })
  }).catch(error => console.log(error))

  