const formEl = document.querySelector("#signup");
const message = document.querySelector("#message");

formEl.addEventListener("submit", (event) => {
    event.preventDefault();
  
    const formData = new FormData(formEl);
    const data = Object.fromEntries(formData);
  
    fetch("./traitement_signup.php", { 
      method: "POST",
      headers: {
        "Content-Type": "application/json;charset=UTF-8",
      },
      body: JSON.stringify(data),
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        console.log(data);
        message.style.color = "";
        if (data.erreur) {
          // message.style.display = "flex";
          message.innerHTML = data.erreur;
        } else {
          window.location.href = `http://localhost/boutique-en-ligne/php/connexion.php`;
          // message.style.display = "flex";
          message.style.color = "green";
          message.innerHTML = data.succes;
          formEl.reset();
        }
      })
      .catch((error) => console.log(error));
  });
