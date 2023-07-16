let buttonsDelete = document.querySelectorAll("button[name='deleteArt']");

buttonsDelete.forEach(button => {
    button.addEventListener ("click", (e) => {
        e.preventDefault();
        const data = {"deleteArt":button.value}
        
        console.log(button.value);
        console.log(data);
        fetch(`./${getPage()}traitementPanier.php`, {
            method:"POST", body:JSON.stringify(data)
        })
        .then((response) => {
            return response.json();
        })
        .then(data => {
            console.log(data)
            if (data.quantite){
                const qt = document.getElementById('quantite'+button.value);
                qt.innerHTML = data.quantite;
                window.location.reload()
            }
            else {
            const div = document.getElementById("prduitImgDescri"+button.value)
            div.remove()
            window.location.reload()
        }
        })
        .catch((error) => console.log(error));
    })
})