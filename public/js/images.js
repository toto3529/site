window.onload = () => {
    // Gestion des boutons "Supprimer"
    let links = document.querySelectorAll("[data-delete]")
    console.log(links)
    // On boucle sur links
    for (link of links) {

        // On écoute le clic
        link.addEventListener("click", (e) => {
            // On empêche la navigation
            e.preventDefault()
            // On demande confirmation
            if (confirm("Êtes-vous sur de vouloir supprimer cette image ?")) {
                // On envoie une requête Ajax vers le href du lien avec la méthode DELETE
                fetch(link.getAttribute("href"), {
                    method: "POST",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({"_token": link.dataset.token})
                }).then(
                    // On récupère la réponse en JSON
                    response => {
                        console.log(response)
                        return response.json()
                    }
                ).then(data => {

                    if (data.success) {

                       let closest = link.closest("div.divPhotoSecond")
                        closest.parentElement.removeChild(closest)
                    }
                    else
                        alert(data.error)
                            .catch(e => alert(e))
                })
            }
        })
    }

}