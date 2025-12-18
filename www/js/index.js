document.addEventListener("DOMContentLoaded", function () {
    var bulles = document.querySelectorAll(".bulle"); // Sélectionner toutes les bulles
    var popup = document.getElementById("popup");
    var popupTitle = popup.querySelector("h2");
    var popupContent = popup.querySelector(".description p");
    var popupImg = popup.querySelector("#popup-img");
    var popupAffiche = popup.querySelector("#popup-affiche");
    var popupActors = popup.querySelector("#actor-list"); // Zone où les acteurs seront ajoutés
    var closeBtn = document.getElementById("close-btn");
  
    bulles.forEach(function (bulle) {
      bulle.addEventListener("click", function () {
        var title = this.getAttribute("data-title");
        var content = this.getAttribute("data-content");
        var imgSrc = this.getAttribute("data-img");
        var afficheSrc = this.getAttribute("data-affiche");
        var actors = this.getAttribute("data-actors"); // Les acteurs séparés par des virgules
        var actorLinks = []; // Tableau pour stocker les liens des acteurs
  
        // Récupérer les liens des acteurs dynamiquement
        actors.split(",").forEach(function (actor, index) {
          var actorLink = this.getAttribute("data-actor-link-" + (index + 1)); // Attribut pour chaque acteur
          actorLinks.push({ name: actor.trim(), link: actorLink });
        }, this);
  
        // Mise à jour du contenu du pop-up
        popupTitle.textContent = title;
        popupContent.textContent = content;
        popupImg.src = imgSrc || "";
        popupAffiche.src = afficheSrc || "";
  
        // Afficher les acteurs avec leurs liens
        if (actorLinks.length > 0) {
          popupActors.innerHTML = ""; // Vider la section des acteurs avant de la remplir
  
          actorLinks.forEach(function (actor) {
            var actorLinkElement = document.createElement("a");
            actorLinkElement.href = actor.link || "#";
            actorLinkElement.textContent = actor.name;
            actorLinkElement.target = "_blank";
            actorLinkElement.classList.add("actor-link");
  
            popupActors.appendChild(actorLinkElement);
            popupActors.appendChild(document.createElement("br")); // Ajoute un saut de ligne après chaque acteur
          });
        } else {
          popupActors.innerHTML = "Aucun acteur trouvé."; // Si aucun acteur, afficher un message par défaut
        }
  
        popup.showModal();
      });
    });
  
    // Fermer le pop-up avec la croix
    closeBtn.addEventListener("click", function () {
      popup.close();
    });
  
    // Fermer en cliquant en dehors du pop-up
    popup.addEventListener("click", function (event) {
      if (event.target === popup) {
        popup.close();
      }
    });
  });



  function filterResults() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let items = document.querySelectorAll(".bulle");

    items.forEach(item => {
        let title = item.getAttribute("data-title").toLowerCase();
        if (title.includes(input)) {
            item.classList.remove("hidden");
        } else {
            item.classList.add("hidden");
        }
    });
}
