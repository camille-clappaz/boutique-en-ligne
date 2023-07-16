function appliquerCodePromo() {
    var codePromo = document.getElementById('code_promo').value;
  
    // Vérifiez si le code promo est valide
    if (codePromo === 'PROMO123') {
      // Appliquez la réduction appropriée sur le panier
      var reduction = 10; // 10% de réduction
      var total = obtenirTotalPanier(); // Supposons que vous ayez une fonction pour obtenir le total du panier
      var nouveauTotal = total - (total * reduction / 100);
  
      // Affichez le nouveau total avec la réduction
      alert("Total avec réduction : " + nouveauTotal);
    } else {
      alert("Code promo invalide.");
    }
  }
  
  function obtenirTotalPanier() {
    // Implémentez votre logique pour obtenir le total du panier ici
    // Retournez la valeur du total
  }