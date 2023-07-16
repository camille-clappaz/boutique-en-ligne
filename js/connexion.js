const formEl = document.querySelector("#login");
const message = document.querySelector("#message");


formEl.addEventListener("submit", (event) => {
  event.preventDefault();

  const formData = new FormData(formEl);
  const data = Object.fromEntries(formData);

  fetch("traitement_connect.php", {
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
      if (data.erreur) {
        message.innerHTML = data.erreur;
      } else {
        //window.location.reload();
        window.location.href = `http://localhost/boutique-en-ligne/index.php`;
        message.style.color = "green";
        message.innerHTML = data.succes;
        formEl.reset();
      }
    })
    .catch((error) => console.log(error));
});